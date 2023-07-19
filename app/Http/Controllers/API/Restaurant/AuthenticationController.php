<?php

namespace App\Http\Controllers\API\Restaurant;

use App\Http\Controllers\Controller;
use App\Services\API\Restaurant\AuthenticationServices;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthenticationController extends Controller
{
    public function register(Request $request,AuthenticationServices $authenticationServices)
    {

        return $authenticationServices->register($request);
    }

    public function forgetPasswordEmail()
    {
        return view('mail.forgetpassword');
    }
    public function login(Request $request,AuthenticationServices $authenticationServices)
    {

        return $authenticationServices->login($request);
    }

    public function forgetPassword(Request $request,AuthenticationServices $authenticationServices)
    {
        return $authenticationServices->forgetPassword($request);
    }

    public function verifyOtp(Request $request,AuthenticationServices $authenticationServices)
    {
        return $authenticationServices->verifyOtp($request);
    }

    public function resendOtp(Request $request,AuthenticationServices $authenticationServices)
    {
        return $authenticationServices->resendOtp($request);
    }

    public function changePassword(Request $request,AuthenticationServices $authenticationServices)
    {

        return $authenticationServices->changePassword($request);
    }

    public function editProfile(Request $request)
    {

    }

}
