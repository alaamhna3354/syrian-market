<?php

namespace App\Http\Controllers;

use App\Models\Fund;
use App\Models\Gateway;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    public function addFundRequest(Request $request)
    {
        $validator = validator()->make($request->all(), [
            'gateway' => 'required',
            'amount' => 'required'
        ]);
        if ($validator->fails()) {
            return response($validator->messages(), 422);
        }

        $basic = (object)config('basic');
        $gate = Gateway::where('code', $request->gateway)->where('status', 1)->first();
        if (!$gate) {
            return response()->json(['error' => 'Invalid Gateway'], 422);
        }
        if ($gate->min_amount > $request->amount || $gate->max_amount < $request->amount) {
            return response()->json(['error' => 'Please Follow Transaction Limit'], 422);
        }
        $charge = getAmount($gate->fixed_charge + ($request->amount * $gate->percentage_charge / 100));
        $payable = getAmount($request->amount + $charge);
        $final_amo = getAmount($payable * $gate->convention_rate);
        $user = auth()->user();

        $fund = $this->newFund($request, $user, $gate, $charge, $final_amo);

        session()->put('track', $fund['transaction']);

        $method_currency = (checkTo($fund->gateway->currencies, $fund->gateway_currency) == 1) ? 'USD' : $fund->gateway_currency;
        $isCrypto = (checkTo($fund->gateway->currencies, $fund->gateway_currency) == 1) ? true : false;

        return [
            'gateway_image' => getFile(config('location.gateway.path') . $gate->image),
            'amount' => getAmount($fund->amount) . ' ' . $basic->currency_symbol,
            'charge' => getAmount($fund->charge) . ' ' . $basic->currency_symbol,
            'gateway_currency' => trans($fund->gateway_currency),
            'payable' => getAmount($fund->amount + $fund->charge) . ' ' . $basic->currency_symbol,
            'conversion_rate' => 1 . ' ' . $basic->currency . ' = ' . getAmount($fund->rate) . ' ' . $method_currency,
            'in' => trans('In') . ' ' . $method_currency . ':' . getAmount($fund->final_amount,2),
            'isCrypto' => $isCrypto,
            'conversion_with' => ($isCrypto) ? trans('Conversion with') . $fund->gateway_currency . ' ' . trans('and final value will Show on next step') : null,
            'payment_url' => route('user.addFund.confirm'),
        ];

    }

    public function depositConfirm(Request $request)
    {
        $track = session()->get('track');
        $order = Fund::where('transaction', $track)->orderBy('id', 'DESC')->with(['gateway','user'])->first();
        if (is_null($order)) {
            return redirect()->route('user.addFund')->with('error', 'Invalid Fund Request');
        }
        if ($order->status != 0) {
            return redirect()->route('user.addFund')->with('error', 'Invalid Fund Request');
        }
        $method = $order->gateway->code;
        try {

            $getwayObj = 'App\\Services\\Gateway\\' . $method . '\\Payment';
            $data = $getwayObj::prepareData($order, $order->gateway);
            $data = json_decode($data);


        } catch (\Exception $exception) {
            return back()->with('error', $exception->getMessage());
        }
        if (isset($data->error)) {
            return back()->with('error', $data->message);
        }
        if (isset($data->redirect)) {
            return redirect($data->redirect_url);
        }
        $page_title = 'Payment Confirm';
        return view($data->view, compact('data', 'page_title', 'order'));
    }

    public function gatewayIpn(Request $request, $code, $trx = null, $type = null)
    {

        try {
            $gateway = Gateway::where('code', $code)->first();
            if (!$gateway) throw new \Exception('Invalid Payment Gateway.');
            if (isset($trx)) {
                $order = Fund::where('transaction', $trx)->orderBy('id','desc')->first();
                if (!$order) throw new \Exception( 'Invalid Payment Request.');
            }
            $getwayObj = 'App\\Services\\Gateway\\' . $code . '\\Payment';
            $data = $getwayObj::ipn($request, $gateway, $order, $trx, $type);

        } catch (\Exception $exception) {
            return back()->with('error', $exception->getMessage());
        }
        if (isset($data['redirect'])) {
            return redirect($data['redirect'])->with($data['status'], $data['msg']);
        }
    }

    public function success()
    {
        return view('success');
    }

    public function failed()
    {
        return view('failed');
    }

    /**
     * @param Request $request
     * @param $user
     * @param $gate
     * @param $charge
     * @param $final_amo
     * @return Fund
     */
    public function newFund(Request $request, $user, $gate, $charge, $final_amo): Fund
    {
        $fund = new Fund();
        $fund->user_id = $user->id;
        $fund->gateway_id = $gate->id;
        $fund->gateway_currency = strtoupper($gate->currency);
        $fund->amount = $request->amount;
        $fund->charge = $charge;
        $fund->rate = $gate->convention_rate;
        $fund->final_amount = getAmount($final_amo);
        $fund->btc_amount = 0;
        $fund->btc_wallet = "";
        $fund->transaction = strRandom();
        $fund->try = 0;
        $fund->status = 0;
        $fund->save();
        return $fund;
    }
}
