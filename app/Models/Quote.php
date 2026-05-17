<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Quote extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'email',
        'phone',
        'service_type',
        'custom_service_type',
        'details',
        'selected_materials',
        'price_quote',
        'size',
        'custom_size',
        'inspiration_image',
        'status',
        'token',
        'token_expires_at',
        'amount_paid',
        'deposit_percentage',
        'payment_type',
        'paid_at',
    ];

    protected $casts = [
        'token_expires_at' => 'datetime',
        'paid_at' => 'datetime',
    ];
}
