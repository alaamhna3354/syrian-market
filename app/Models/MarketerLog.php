<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MarketerLog extends Model
{
    use HasFactory;
    protected $guarded=[];

    public function marketer()
    {
        return $this->belongsTo(Marketer::class);
    }

    public function children()
    {
        return $this->hasMany(Marketer::class,'parent_id');
    }

    public function invitedBy()
    {
        return $this->belongsTo(Marketer::class,'parent_id');
    }
}
