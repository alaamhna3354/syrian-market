<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ServicePriceRange extends Model
{
    use HasFactory;
    protected $guarded = ['id'];


    public function service()
    {
        return $this->belongsTo(Service::class, 'service_id');
    }

    public function priceRange()
    {
        return $this->belongsTo(PriceRange::class, 'price_range_id');
    }
}
