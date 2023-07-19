<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StripeInitiatePayment extends Model
{
    use HasFactory;

    protected $fillable = [
        'paymentIntent',
        'ephemeralKey',
        'customer',
        'status',
        'amount',
        'currency',
        'payment_method_types',
    ];
}
