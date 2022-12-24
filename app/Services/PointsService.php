<?php
/**
 * Created by PhpStorm.
 * User: Hammam
 * Date: 12/13/2022
 * Time: 10:41 AM
 */

namespace App\Services;


use App\Models\PointsTransaction;
use App\Models\User;
use FontLib\Table\Type\post;
use Ramsey\Uuid\Type\Integer;

class PointsService
{

    public function earnPoints($type, $amount, $note,$order=null)
    {
        $user = auth()->user();
        $user->points = $user->points + $amount;
        $user->save();
        $ptrx = new PointsTransaction();
        $ptrx->user_id = $user->id;
        $ptrx->remarks=$type;
        $ptrx->amount=$amount;
        $ptrx->note=$note;
        $ptrx->order_id=$order;
        $ptrx->save();
        return $ptrx->save();
    }

    public function storePointsTransaction()
    {

    }
}