<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PointsTransaction extends Model
{
    use HasFactory;
    protected $guarded=['id'];

    public function user()
    {
        return $this->belongsTo(PointsTransaction::class);
    }
    public function order()
    {
        return $this->belongsTo(Order::class);
    }
}
