<?php

namespace App\Models;

use App\Http\Traits\Translatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ContentDetails extends Model
{
    use HasFactory;
    use Translatable;

    protected $guarded = ['id'];

    protected $casts = [
        'description' => 'object'
    ];



    public function content()
    {
        return $this->belongsTo(Content::class, 'content_id', 'id');
    }

}
