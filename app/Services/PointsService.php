<?php
/**
 * Created by PhpStorm.
 * User: Hammam
 * Date: 12/13/2022
 * Time: 10:41 AM
 */

namespace App\Services;


use App\Models\Order;
use App\Models\PointsTransaction;
use App\Models\Transaction;
use App\Models\User;
use FontLib\Table\Type\post;
use Nette\Utils\DateTime;
use Ramsey\Uuid\Type\Integer;

class PointsService
{

    public function earnPoints($type, $amount, $note, $order = null, $user = null, $status = 'active')
    {
        if (!$user)
            $user = auth()->user();
        $user->points = $user->points + $amount;
        $user->save();
        $ptrx = new PointsTransaction();
        $ptrx->user_id = $user->id;
        $ptrx->remarks = $type;
        $ptrx->amount = $amount;
        $ptrx->note = $note;
        $ptrx->order_id = $order;
        $ptrx->status = $status;
        return $ptrx->save();
    }

    public function refundPoints($note, $order, $user)
    {
        //check if have poins balance
        //sub points balance if enouf
        //or sub from balance
        if ($order) {
            try {
                $order = Order::findorfail($order);
                $ptrx = PointsTransaction::where('order_id', $order->id)->first();
                if ($user->points >= $ptrx->amount)
                    $user->points = $user->points - $ptrx->amount;
                else {
                    $user->balance = $user->balance - ($ptrx->amount * config('basic.points_rate_per_kilo') / 1000);
                    $transaction = new Transaction();
                    $transaction->user_id = $user->id;
                    $transaction->trx_type = '-';
                    $transaction->amount = ($ptrx->amount * config('basic.points_rate_per_kilo') / 1000);
                    $transaction->remarks = ' استرجاع قيمة ربح نقاط بسبب استرجاع الطلب وعدم توفر رصيد نقاط كافي';
                    $transaction->trx_id = strRandom();
                    $transaction->charge = 0;
                    $transaction->save();
                }
                $ptrx->note = $note;
                $ptrx->status = 'refunded';
                $ptrx->save();
                return $user;
            } catch (\Exception $e) {
                return $user;
            }
        }
    }

    public function refundMarketerPoints($amount, $note, $user = null)
    {
        //check if have poins balance
        //sub points balance if enouf
        //or sub from balance

        try {
            if (!$user)
                $user = auth()->user();
            $user->points = $user->points - $amount;
            $user->save();
            $ptrx = new PointsTransaction();
            $ptrx->user_id = $user->id;
            $ptrx->remarks = 'Marketer';
            $ptrx->amount = $amount;
            $ptrx->note = $note;
            $ptrx->status = 'refunded';
            return $ptrx->save();
        } catch (\Exception $e) {
            return back()->with('error', $e->getMessage());
        }
    }

    public function checkPending($user)
    {
        $pendingTransactions=PointsTransaction::where('user_id',$user)->where('status','pending')->where('remarks','Marketer')->get();
        foreach ($pendingTransactions as $transaction)
        {
            if((new DateTime())->diff($transaction->created_at)->days > 3)
                $transaction->update(['status'=>'active']);
        }
    }
}