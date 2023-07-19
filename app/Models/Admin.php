<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Admin extends Authenticatable
{
   // use HasFactory;
    use Notifiable;

    public static function getAdminFullName()
    {
        return auth()->user()->first_name.' '.auth()->user()->last_name;
    }

    protected $guard = 'admin';

    protected $guarded = [];

    protected $hidden = [
        'password' => 'remember_token'
    ];
}
