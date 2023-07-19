<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductImage extends Model
{
    use HasFactory;
    protected $table = 'product_images';

    protected $guarded = [];

    public function getimageAttribute($value)
    {
        if($value){
            return asset($value);
        }
        return $value;
    }
    public function product()
    {
        return $this->belongsTo(Product::class,'id');
    }
}
