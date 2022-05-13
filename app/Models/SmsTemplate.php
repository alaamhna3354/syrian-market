<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SmsTemplate extends Model
{
    use HasFactory;
    protected $table = "email_templates";

    protected $guarded = ['id'];
    protected $casts = [
        'short_keys' => 'object'
    ];
    public function language()
    {
        return $this->belongsTo(Language::class,'language_id');
    }
}
