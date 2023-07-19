<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $table = 'products';
    protected $guarded = [];

    public function getimageAttribute($value)
    {
        if($value){
            return asset($value);
        }
        return $value;
    }

    public function restaurant()
    {
        return $this->belongsTo(Restaurant::class,'restaurant_id');
    }
    public function category()
    {
        return $this->belongsTo(Category::class,'category_id');
    }
    public function productOrder()
    {
        return $this->belongsToMany(Order::class,'id','product_id');
    }
}
