<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Passport\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Restaurant extends Authenticatable
{
    use HasApiTokens,HasFactory,Notifiable;
    protected $guard = 'restaurant';
    protected $table = 'restaurants';
    protected $guarded=[];

    public static function getRestaurantFullName()
    {
        return auth()->user()->name;
    }

    public function deals()
    {
        return $this->hasMany(Deal::class,'restaurant_id');
    }

    public function carts()
    {
        return $this->hasMany(Cart::class,'restaurant_id','id');
    }

    public function products()
    {
        return $this->hasMany(Product::class,'restaurant_id');
    }
    public function Orders()
    {
        return $this->belongsToMany(Order::class);
    }

    protected $hidden = [
        'password' => 'remember_token'
    ];
}
