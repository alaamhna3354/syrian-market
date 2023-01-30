<?php

namespace App\Services;

use App\Http\Traits\Notify;
use App\Models\Transaction;
use Image;

class BasicService
{
    use Notify;

    public function validateImage(object $getImage, string $path)
    {
        if ($getImage->getClientOriginalExtension() == 'jpg' or $getImage->getClientOriginalName() == 'jpeg' or $getImage->getClientOriginalName() == 'png') {
            $image = uniqid() . '.' . $getImage->getClientOriginalExtension();
        } else {
            $image = uniqid() . '.jpg';
        }
        Image::make($getImage->getRealPath())->resize(300, 250)->save($path . $image);
        return $image;
    }

    public function validateDate(string $date)
    {
        if (preg_match("/^[0-9]{1,2}\/[0-9]{1,2}\/[0-9]{2,4}$/", $date)) {
            return true;
        } else {
            return false;
        }
    }

    public function validateKeyword(string $search, string $keyword)
    {
        return preg_match('~' . preg_quote($search, '~') . '~i', $keyword);
    }

    public function cryptoQR($wallet, $amount, $crypto = null)
    {

        $varb = $wallet . "?amount=" . $amount;
        return "https://chart.googleapis.com/chart?chs=300x300&cht=qr&chl=$varb&choe=UTF-8";
    }

    public function preparePaymentUpgradation($order)
    {

        if ($order->status == 0) {
            $order['status'] = 1;
            $order->update();

            $user = $order->user;
            $user->balance += $order->amount;
            $user->save();

            $basic = (object) config('basic');

            $gateway = $order->gateway;
            $transaction = new Transaction();
            $transaction->user_id = $order->user_id;
            $transaction->trx_type = '+';
            $transaction->amount = $order->amount;
            $transaction->remarks = 'Deposit Via ' . $gateway->name;
            $transaction->trx_id = $order->transaction;
            $transaction->charge = getAmount($order->charge);
            $transaction->save();



            $msg = [
                'username' => $user->username,
                'amount' => getAmount($order->amount),
                'currency' => $basic->currency,
                'gateway' => $gateway->name
            ];
            $action = [
                "link" => route('admin.user.fundLog',$user->id),
                "icon" => "fa fa-money-bill-alt text-white"
            ];
            $this->adminPushNotification('PAYMENT_COMPLETE', $msg, $action);


            $this->sendMailSms($user, 'PAYMENT_COMPLETE', [
                'gateway_name' => $gateway->name,
                'amount' => getAmount($order->amount),
                'charge' => getAmount($order->charge),
                'currency' => $basic->currency,
                'transaction' => $order->transaction,
                'remaining_balance' => getAmount($user->balance)
            ]);

        }
    }




}
