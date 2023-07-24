<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use App\Models\User;
use Auth;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    // protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required',
            'password' => 'required'
        ]);

        $credentials = $request->except(['_token']);
        $user = User::where('email', $request->email)->first();
        if($user){
                if(auth()->attempt($credentials)){
                    $notification = array(
                        'message' => 'Login Successfully',
                        'alert-type' => 'success'
                    );
                    return redirect('/homev1')->with($notification);
                }
                else{
                    $notification = array(
                        'message' => 'Invalid Credentials!',
                        'alert-type' => 'error'
                    );
                    return back()->with($notification);
                }
        }
        else{
            $notification = array(
                'message' => 'User not Found',
                'alert-type' => 'error'
            );
            return back()->with($notification);
        }
    }
}
