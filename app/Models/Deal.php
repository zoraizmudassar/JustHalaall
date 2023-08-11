<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Deal extends Model
{
    use HasFactory;
    protected $guarded = [];
    protected $table = 'deals';

    public function restaurant()
    {
       return  $this->belongsTo(Restaurant::class,'restaurant_id');
    }
    
    public function category()
    {
        return $this->belongsTo(Category::class,'category_id');
    }

    public function getimagesAttribute($value)
    {
        $image_path = [];
        if(is_array($value)){
            return $image_path;
        }
        return $image_path;
    }
}
