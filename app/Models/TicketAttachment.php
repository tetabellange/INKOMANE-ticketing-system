<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TicketAttachment extends Model
{
    protected $fillable = [
        'ticket_id','user_id','original_name','file_path','file_type','file_size'
    ];

    public function ticket() {
        return $this->belongsTo(Ticket::class, 'ticket_id');
    }

    public function user() {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function getUrlAttribute(): string {
        return asset('storage/'.$this->file_path);
    }
}

