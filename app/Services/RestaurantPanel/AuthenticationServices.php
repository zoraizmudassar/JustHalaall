<?php

namespace App\Services\RestaurantPanel;

class AuthenticationServices
{
    public function showLoginForm($request)
    {
       return view('restaurant.auth.login');
}
}
