<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    public function service()
    {
        return $this->belongsTo(Service::class, 'service_id','id');
    }

    public function agentCommissionRate()
    {
        return $this->belongsTo(AgentCommissionRate::class,'order_id','id');
    }

    public function users()
    {
        return $this->belongsTo(User::class,'user_id','id');
    }

    public function transaction()
    {
        return $this->hasMany(Transaction::class);
    }

    public function debt()
    {
        return $this->hasMany(Debt::class,'order_id');
    }

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id','id');
    }
}
