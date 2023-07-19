<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderDetail extends Model
{
    use HasFactory;

    protected $table = "order_details";

    protected $guarded = [];

    public function order()
    {
        return $this->belongsTo(Order::class,'order_id');
    }
    public function restaurant_name()
    {
        return $this->belongsTo(Restaurant::class,'restaurant_id');
    }
    public function product_name()
    {
        return $this->belongsTo(Product::class,'product_id');
    }
}
