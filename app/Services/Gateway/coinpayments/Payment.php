<?php

namespace App\Services\Gateway\coinpayments;

use Facades\App\Services\BasicService;

class Payment
{
    public static function prepareData($order, $gateway)
    {

        $basic = (object) config('basic');

        $val['merchant'] = $gateway->parameters->merchant_id ?? '';
        $val['item_name'] = 'Payment to ' . @$basic->site_title;
        $val['currency'] = $order->gateway_currency;
        $val['currency_code'] = $order->gateway_currency;
        $val['amountf'] = $order->final_amount;
        $val['ipn_url'] = route('ipn', [$gateway->code, $order->transaction]);
        $val['custom'] = $order->transaction;
        $val['amount'] = $order->final_amount;
        $val['return'] = route('ipn', [$gateway->code, $order->transaction]);
        $val['cancel_return'] = route('failed');
        $val['notify_url'] = route('ipn', [$gateway->code, $order->transaction]);
        $val['success_url'] = route('success');
        $val['cancel_url'] = route('failed');
        $val['cmd'] = '_pay_simple';
        $val['want_shipping'] = 0;
        $send['val'] = $val;
        $send['view'] = 'user.payment.redirect';
        $send['method'] = 'post';
        $send['url'] = 'https://www.coinpayments.net/index.php';

        return json_encode($send);
    }

    public static function ipn($request, $gateway, $order = null, $trx = null, $type = null)
    {
        $status = $request->status;
        $amount1 = floatval($request->amount1);

        if ($status >= 100 || $status == 2) {
            if ($order->gateway_currency == $request->currency1 && $order->final_amount <= $amount1 && $gateway->parameters->merchant_id == $request->merchant && $order->status == '0') {
                BasicService::preparePaymentUpgradation($order);
            } else {
                $data['status'] = 'error';
                $data['msg'] = 'Invalid amount.';
                $data['redirect'] = route('failed');
            }
        } else {
            $data['status'] = 'error';
            $data['msg'] = 'Invalid response.';
            $data['redirect'] = route('failed');
        }

        return $data;
    }
}
