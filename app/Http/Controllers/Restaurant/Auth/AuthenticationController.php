<?php

namespace App\Http\Controllers\Restaurant\Auth;

use App\Http\Controllers\Controller;
use App\Services\RestaurantPanel\AuthenticationServices;
use Illuminate\Http\Request;

class AuthenticationController extends Controller
{
    public function showLoginForm(Request $request,AuthenticationServices $authenticationServices)
    {
        return $authenticationServices->showLoginForm($request);
    }
}
