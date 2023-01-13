<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Marketer extends Model
{
    use HasFactory;

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function parentMarketer()
    {
        return $this->belongsTo(Marketer::class,'parent_id');
    }

    public function childMarketers()
    {
        return $this->hasMany(Marketer::class,'parent_id');
    }

    public function log()
    {
        return $this->hasMany(MarketerLog::class);
    }
    public function parents()
    {
        return $this->belongsToMany(Marketer::class,'marketer_logs','id');
    }
    public function childern()
    {
        return $this->belongsToMany(Marketer::class,'marketer_logs','parent_id');
    }
}
