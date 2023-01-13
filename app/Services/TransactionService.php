<?php
/**
 * Created by PhpStorm.
 * User: Hammam
 * Date: 1/9/2023
 * Time: 10:29 AM
 */

namespace App\Services;


use App\Models\Transaction;

class TransactionService
{
    public function create($type,$amount,$remark,$user=null,$charge=0)
    {
        if(!$user)
            $user=auth()->user();
        $transaction = new Transaction();
        $transaction->user_id = $user->id;
        $transaction->trx_type =$type;
        $transaction->amount = $amount;
        $transaction->remarks = $remark;
        $transaction->trx_id = strRandom();
        $transaction->charge = $charge;
        $transaction->save();
        return $transaction;
    }
}