<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderStatus extends Model
{
    use HasFactory;

    protected $table = "statuses";

    protected $guarded = [];

    public function order()
    {
        $this->belongsTo(Order::class,'order_id','id');
    }
}
