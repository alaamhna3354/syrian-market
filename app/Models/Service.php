<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    public $appends = ['provider_name'];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
    public function provider()
    {
        return $this->belongsTo(ApiProvider::class, 'api_provider_id', 'id');
    }

    public function orders()
    {
        return $this->hasMany(Order::class, 'service_id','id');
    }

    protected function scopeUserRate($query)
    {
        $query->addSelect(['user_rate' => UserServiceRate::select('price')
            ->whereColumn('service_id', 'services.id')
            ->where('user_id', auth()->id())
        ]);
    }

    public function getProviderNameAttribute($value)
    {
        if(isset($this->api_provider_id) && $this->api_provider_id != 0){
            $prov = ApiProvider::find($this->api_provider_id);
            if($prov){
                return $prov['api_name'] ;
            }
            return false;
        }
    }
}
