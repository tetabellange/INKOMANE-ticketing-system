<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TicketCategory extends Model
{
    protected $fillable = ['name','description','color','is_active'];

    public function tickets() {
        return $this->hasMany(Ticket::class, 'category_id');
    }
}

