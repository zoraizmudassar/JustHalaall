<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\SendsPasswordResetEmails;
use Illuminate\Support\Facades\Validator;
use App\Models\PasswordReset;
use App\Notifications\ForgetPassword;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Models\User;
use Auth;

class ForgotPasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset emails and
    | includes a trait which assists in sending these notifications from
    | your application to your users. Feel free to explore this trait.
    |
    */

    use SendsPasswordResetEmails;

    public function forgotPassword()
    {
        return view('website.forgotPassword');
    }
    
    public function forgot_Password(Request $request)
    {
        $validator = Validator::make($request->all(), [

            'email' => 'required|email',
        ]);
        if ($validator->fails()) {
            $notification = array(
                'message' => $validator->messages()->first(),
                'alert-type' => 'error'
            );
            return back()->with($notification);

            // return response()->json([
            //     'status' => 406, 'message' => $validator->messages()->first()
            // ], 406);
        }

        $user = User::where('email', $request->email)->first();
        if (!$user) {
            $notification = array(
                'message' => 'Email does not exist',
                'alert-type' => 'error'
            );
            return back()->with($notification);

            // return response()->json([
            //     'status' => 404, 
            //     'message' => "Email Not Found"
            // ], 404);
        }

        $confirmation_code = mt_rand(1000, 9999);
        PasswordReset::insert([
            'email' => $request->email,
            'token' => $confirmation_code]);

        $data = [
            'confirmation_code' => $confirmation_code,
            'email' => $user->email,
        ];
        // Notification::route('mail', env('MAIL_CLIENT'))->notify(new ForgetPassword($data));
        $email = $data['email'];
        $msgData =['email'=>$data['email'],'confirmation_code'=>$data['confirmation_code']];
        Mail::send('mail.forgetpassword',compact('msgData'),function ($message) use ($email){
            $message->to($email);
            $message->subject('Forget Password');
        });
        $notification = array(
            'message' => 'OTP Code is send to your Email Address',
            'alert-type' => 'success'
        );
        return redirect('/verifyotpv1')->with($notification);

        // return view('website.verifyotp');
        // return response()->json([
        //     'status' => 200, 
        //     'data' => $data,
        //     'message' => 'OTP Code is send to your Email Address',
            
        // ], 200);
    }

    public function verifyOtp(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'otp' => 'required',
            'email' => 'required',
        ]);

        if ($validator->fails()) {

            $notification = array(
                'message' => $validator->messages()->first(),
                'alert-type' => 'error'
            );
            return back()->with($notification);

            // return response()->json([
            //     'status' => 406, 'message' => $validator->messages()->first()
            // ], 406);
        }

        $otp = PasswordReset::where('email', $request->email)->where('token', $request->otp)->first();

        if (!$otp) {
            $notification = array(
                'message' => 'Invalid OTP Code',
                'alert-type' => 'error'
            );
            return back()->with($notification);

            // return response()->json([
            //     'status' => 401, 
            //     'message' => "Invalid OTP Code"
            // ], 401);
        }

        // $otp->delete();
        $notification = array(
            'message' => 'OTP Verified Successfully',
            'alert-type' => 'success'
        );
        return redirect('/updatePasswordv1')->with($notification);
        // return view('website.updatePassword')->with($notification);

        return response()->json([
            'status' => 200, 'message' => 
            "OTP Verified Successfully"
        ], 200);
    }

    
    public function changeForgetPassword(Request $request) 
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required',
            'new_password' => 'required|min:6',
            'password_confirmation' => 'required|same:new_password|min:6'
        ]);

        if ($validator->fails()) {
            $notification = array(
                'message' => $validator->messages()->first(),
                'alert-type' => 'error'
            );
            return back()->with($notification);

            // return response()->json([
            //     'status' => 406, 
            //     'message' => $validator->messages()->first()
            // ], 406);
        } else {
            $email = PasswordReset::where('email', $request->email)->first();
            if (!$email) {
                $notification = array(
                    'message' => 'Email does not exist',
                    'alert-type' => 'error'
                );
                return back()->with($notification);
                // return response()->json([
                //     'status' => 404, 
                //     'message' => "Email does not exist"
                // ], 404);
            } else {
                $userData = User::where('email', $request->email)->select('email', 'password')->first();
                if(!$userData) {
                    $notification = array(
                        'message' => "Admin deleted your account",
                        'alert-type' => 'error'
                    );
                    return back()->with($notification);
                    // return response()->json([
                    //     'status' => 404, 
                    //     'message' => "Admin deleted your account",
                    // ], 404);
                } else {
                    $userData->password = Hash::make($request->new_password);
                    $updatePassword = User::where('email', $request->email)->update([
                        'password' => $userData->password
                    ]);
                    if($updatePassword) {
                        // return response()->json([
                        //     'status' => 200, 
                        //     'message' => "Password Updated Successfully"
                        // ], 200);
                        $notification = array(
                            'message' => 'Password Updated Successfully',
                            'alert-type' => 'success'
                        );
                        return redirect('/loginv1')->with($notification);
                    } else {
                        $notification = array(
                            'message' => 'Server Error',
                            'alert-type' => 'error'
                        );
                        return back()->with($notification);

                        // return response()->json([
                        //     'status' => 500, 
                        //     'message' =>  "Server Error"
                        // ], 200);
                    }
                }
            }
        }
    }
}
