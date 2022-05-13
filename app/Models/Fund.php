<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Fund extends Model
{
    use HasFactory;
    protected $guarded = ['id'];
    protected $table = "funds";

    protected $casts = [
        'detail' => 'object'
    ];

    public function user()
    {
        return $this->belongsTo(User::class,'user_id');
    }
    public function gateway()
    {
        return $this->belongsTo(Gateway::class, 'gateway_id');
    }
}
