<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TicketAttachment extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function supportMessage()
    {
        return $this->belongsTo(TicketMessage::class,'ticket_message_id');
    }

}
