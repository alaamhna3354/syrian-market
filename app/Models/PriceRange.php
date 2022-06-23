<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PriceRange extends Model
{
    use HasFactory;
    protected $guarded = ['id'];


    public function service_price_ranges()
    {
        return $this->hasMany(ServicePriceRange::class, 'price_range_id');
    }

    public function users()
    {
        return $this->hasMany(User::class, 'price_range_id');
    }

    public function userPriceRanges()
    {
        return $this->hasMany(UserPriceRange::class, 'user_id')->latest();
    }
}
