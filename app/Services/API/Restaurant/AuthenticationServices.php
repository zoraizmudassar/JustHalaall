<?php

namespace App\Services\API\Restaurant;

//use App\Model\PasswordReset;
use App\Models\PasswordReset;
use App\Models\Restaurant;
use App\Models\User;
use App\Notifications\ForgetPassword;
use Carbon\Carbon;
use http\Env\Response;
//use Illuminate\Auth\Events\PasswordReset;
//use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Auth\Notifications\ResetPassword;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Validator;
use PHPUnit\Exception;

class AuthenticationServices
{
    // register restaurant
    public function register($request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|email|unique:restaurants',
            'phone' => 'required',
            'address' => 'required',
            'password' => 'required|min:6',
            'logo' => 'required',
            'password_confirmation' => 'required_with:password|same:password|min:6'

        ]);
        if ($validator->fails()) {

            return response()->json(['status' => 406, 'message' => $validator->messages()->first()], 406);
        }

        $file = $request->logo;
        if ($request->hasFile('logo')) {

            $fileName = $file->getClientOriginalName();
            $explodeImage = explode('.', $fileName);
            $fileName = $explodeImage[0];
            $extension = end($explodeImage);
            $fileName = time() . "-" . $fileName . "." . $extension;
            $imageExtensions = ['jpg', 'jpeg', 'png'];
            if (in_array($extension, $imageExtensions)) {
                $folderName = "uploads/restaurants/logo";
                $file->move($folderName, $fileName);
                $path = $folderName . '/' . $fileName;
            } else {
                return response()->json([
                    'status' => 301, 
                    'message' => 'Image should be in JPG or PNG and JPEG',
                ], 301);
            }
        }

        if ($request->has('email') && $request->has('password')) {
            $restaurant = Restaurant::create([
                'name' => $request->name,
                'email' => $request->email,
                'phone' => $request->phone,
                'logo' => $path,
                'address' => $request->address,
                'password' => Hash::make($request->password),
            ]);

            $success['token'] = $restaurant->createToken('JustHalaal-' . rand(0, 9))->accessToken;

            $data = [
                'id' => $restaurant->id,
                'name' => $restaurant->name,
                'email' => $restaurant->email,
                'phone' => $restaurant->phone,
                'logo' => asset($path),
            ];

            return response()->json(['status' => 200, 'message' => "Registered Successfully",
                'data' => $data, 'token' => $success['token']], 200);

        } else {
            return response()->json(['status' => 404, 'message' => \Exception::getMessage()], 404);
        }

    }

    public function login($request)
    {
        $validator = Validator::make($request->all(), [

            'email' => 'required|email',
            "password" => "required",

        ]);
        if ($validator->fails()) {

            return response()->json(['status' => 406, 'message' => $validator->messages()->first()], 406);

        }


//        if (Auth::attempt(['email' => request('email'), 'password' => request('password')])) {

        $restaurant = Restaurant::where(['email' => $request->email])->first();
        if (!$restaurant) {

            return response()->json(['status' => 401, 'message' => "Invalid Login Credentials"], 401);

        }

        if (Auth::guard('restaurant')->attempt(['email' => request('email'), 'password' => request('password')])) {

            if($restaurant->status == 'approved'){

                $token = $restaurant->createToken('justHalaal-' . rand(0, 9))->accessToken;

                $data = [
                    'id' => $restaurant->id,
                    'name' => $restaurant->name,
                    'email' => $restaurant->email,
                    'phone' => $restaurant->phone,
//                'role' => $user->role->name,
                ];
                return response()->json(['status' => 200, 'message' => "Login Successfully",
                    'data' => $data, 'token' => $token], 200);
            }
            else{

                return response()->json(['status' => 201, 'message' => "You have not Approved Yet for Restaurant Account!"], 201);

            }

        } //            $user = Auth::user();


        else {
            return response()->json(['status' => 401, 'message' => "Invalid Login Credentials"], 401);

        }
    }

    public function forgetPassword($request)
    {
        $validator = Validator::make($request->all(), [

            'email' => 'required|email',
        ]);
        if ($validator->fails()) {
            return response()->json(['status' => 406, 'message' => $validator->messages()->first()], 406);
        }

        $user = Restaurant::where('email', $request->email)->first();
        if (!$user) {
            return response()->json(['status' => 404, 'message' => "Email Not Found"], 404);
        }

        $confirmation_code = mt_rand(1000, 9999);
        PasswordReset::insert([
            'email' => $request->email,
//            'created_at' => Carbon::now(),
            'token' => $confirmation_code]);

        $data = [
            'confirmation_code' => $confirmation_code,
            'email' => $user->email,
        ];
        $email = $data['email'];
        $msgData =['email'=>$data['email'],'confirmation_code'=>$data['confirmation_code']];
        // Mail::send('mail.forgetpassword',compact('msgData'),function ($message) use ($email){
        //     $message->to($email);
        //     $message->subject('Forget Password');
        // });

        return response()->json(['status' => 200, 'message' => 'OTP Code is send to your Email Address',
            'data' => $data], 200);
    }

    public function verifyOtp($request)
    {
        $validator = Validator::make($request->all(), [

            'otp' => 'required',
            'email' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json(['status' => 406, 'message' => $validator->messages()->first()], 406);
        }

        $otp = PasswordReset::where('email', $request->email)->where('token', $request->otp)
            ->first();

        if (!$otp) {
            return response()->json(['status' => 401, 'message' => "Invalid OTP Code"], 401);
        }

        $otp->delete();

        return response()->json(['status' => 200, 'message' => "OTP Verified Successfully"], 200);
    }

    public function resendOtp($request)
    {
        $customMsgs = [
            'email.required' => 'Please provide Email',
        ];
        $validator = Validator::make($request->all(),
            [
                'email' => 'required|email',
            ], $customMsgs
        );

        if ($validator->fails()) {
            return response()->json(['status' => 406, 'message' => $validator->messages()->first()], 406);
        }

        $user = Restaurant::where('email', $request->email)->first();

        if (!$user) {
            return response()->json(['status' => 401, 'message' => "Email doe's not Exist"], 401);
        }

        $email = PasswordReset::where('email', $request->email)->first();
        if (!$email) {
            return response()->json(['status' => 401, 'message' => "Email doe's not exist"], 401);
        }

        $confirmation_code = mt_rand(200000, 9999);

        $email->token = $confirmation_code;
        $email->save();
        $data = [

            'confirmation_code' => $confirmation_code,
            'email' => $user->email,
        ];
        $email = $data['email'];
        $msgData =['email'=>$data['email'],'confirmation_code'=>$data['confirmation_code']];
        Mail::send('mail.forgetpassword',compact('msgData'),function ($message) use ($email){
            $message->to($email);
            $message->subject('Forget Password');
        });

//        Notification::route('mail', env('MAIL_CLIENT'))->notify(new ForgetPassword($data));

        return response()->json(['status' => 200, 'message' => 'OTP Code is Resend to your Email Address',
            'email' => $user->email], 200);
    }

    public function changePassword($request)
    {
        $customMsgs = [
            'email.required' => 'Please Provide Email',
            'password.required' => 'Please Provide Password',
        ];
        $validator = Validator::make($request->all(),
            [
//                'email' => 'required|email',
                'password' => 'required',
                'confirmed_password' => 'required',
            ], $customMsgs
        );

        if ($validator->fails()) {
            return response()->json(['status' => 406, 'message' => $validator->messages()->first()], 406);
        }


        if ($request->confirmed_password != $request->password) {
            return response()->json(['status' => 401, 'message' => "Password does not Match"], 401);

        }
        $user = Restaurant::where('email', Auth::user()->email)->first();


        if (!$user) {
            return response()->json(['status' => 401, 'message' => "User does not Exist"], 401);
        }


        $user->password = Hash::make($request->password);
        $user->save();

        return response()->json(['status' => 200, 'message' => "Password Updated Successfully"], 200);
    }





}
