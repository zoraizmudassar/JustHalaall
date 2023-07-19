<?php

namespace App\Http\Controllers\Restaurant;

use App\Http\Controllers\Controller;
use App\Models\Restaurant;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class ForgetPasswordController extends Controller
{
    public function forgetPassword()
    {
        return view('restaurant.auth.forget-password');
    }

    public function newPassword(Request $request)
    {
        $data = $request->validate([
            'email' => "required|email|string",
            'password' => "required|min:8|confirmed",
        ]);

        $restaurant = Restaurant::where(['email'=>$data['email']])->first();
        if ($restaurant){
            $restaurant->update([
                'password' => Hash::make($data['password']),
            ]);
            return redirect(RouteServiceProvider::RESTAURANT);
        }
        else{
            return redirect()->back()->withInput($request->all())->withErrors('data not found');
        }
    }

    public function sendFailedPasswordResponse(array $data)
    {
        return Validator::make($data, [
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
    }
}
