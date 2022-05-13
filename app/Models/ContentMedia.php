<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ContentMedia extends Model
{
    use HasFactory;
    protected $casts = [
        'description' => 'object'
    ];

    public function content()
    {
        return $this->belongsTo(Content::class, 'content_id', 'id');
    }
}
