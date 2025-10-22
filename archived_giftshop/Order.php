<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    // Allow mass assignment for these fields
    protected $fillable = [
        'customer_name',
        'customer_email',
        'total',
        'items', // you can store JSON of items
        'status', // optional: e.g., 'pending', 'completed'
    ];

    // If you want to cast the items field as JSON
    protected $casts = [
        'items' => 'array',
    ];
}
