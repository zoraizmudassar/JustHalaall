<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DeliveryCharges extends Model
{
    use HasFactory;

    protected $table = 'delivery_charges';

    protected $fillable = [
        'pick_up_location',
        'drop_location',
        'order_id',
        'delivery_charges',
        'total_commission',
        'accepted_status',
    ];
}
