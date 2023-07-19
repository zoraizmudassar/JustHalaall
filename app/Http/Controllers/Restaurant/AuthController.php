<?php

namespace App\Http\Controllers\Restaurant;

use App\Models\Admin;
use App\Models\Restaurant;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function loginForm()
    {
        if (Auth::guard('restaurant')->check()) {
            return redirect()->route('restaurants.home');
        } else {
            return view('restaurant.auth.login');
        }
    }

    public function login(Request $request)
    {
        $this->validate($request, [
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $restaurant = Restaurant::where(['email'=>$request->email])->first();
        if(auth()->guard('restaurant')->attempt([
            'email' => $request->email,
            'password' => $request->password,
        ])) {
            if ($restaurant){
                if ($restaurant->status != 'approved'){
                    return response()->json([ 'status' => 2, 'message' => "You're not approved yet!"]);
                }
            }
            return response()->json([ 'status' => 1, 'url'=>route('restaurants.home') ,'message' => 'Welcome']);
        } else {
            return response()->json([ 'status' => 0, 'message' => 'Invalid Credentials']);
        }
    }

    public function logout(Request $request)
    {
        $this->guard()->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        if ($response = $this->loggedOut($request)) {
            return $response;
        }

        return redirect(route('restaurants.showLoginForm'));
    }

    protected function loggedOut(Request $request)
    {
        //
    }

    protected function guard()
    {
        return Auth::guard('restaurant');
    }
}
