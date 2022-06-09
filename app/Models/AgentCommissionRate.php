<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AgentCommissionRate extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    public function order()
    {
        return $this->hasone(Order::class, 'order_id','id');
    }

    public function user()
    {
        return $this->hasone(User::class, 'user_id','id');
    }
}
