<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmailTemplate extends Model
{
    use HasFactory;
    protected $guarded = ['id'];
    protected $casts = [
        'short_keys' => 'object'
    ];

    public function language()
    {
        return $this->belongsTo(Language::class,'language_id');
    }
}
