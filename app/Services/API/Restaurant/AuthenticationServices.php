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
use App\Http\Traits\Firebase;

class AuthenticationServices
{
    use Firebase;
    // register restaurant
    public function register($request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required',
            'phone' => 'required',
            'address' => 'required',
            'latitude' => 'required',
            'longitude' => 'required',
            'longitude' => 'required',
            'password' => 'required|min:6',
            // 'password_confirmation' => 'required_with:password|same:password|min:6',
            'fcm_token' => 'required',
            'delivery_charges'=>'required'

        ]);
        if ($validator->fails()) {

            return response()->json(['status' => false, 'message' => $validator->messages()->first()], 406);
        }
        $check = Restaurant::where('email',$request->email)->first();
        if (isset($check)) {

            return response()->json(['status' => false, 'message' => 'Email already exit!'], 406);
        }

        $filename = null;
        if($request->logo){
            $f = finfo_open();
            $mime_type = finfo_buffer($f, base64_decode($request->image) , FILEINFO_MIME_TYPE);
            $type = explode('/', $mime_type);
            $randomNumber = rand(1000000000,9999999999);
            $filename = '/uploads/restaurants/' .$randomNumber.'.'.$type[1];
            file_put_contents(public_path() . $filename, base64_decode($request->image));
            $filename = 'https://www.justhalaall.com/public'.$filename;
        }

        if ($request->has('email') && $request->has('password')) {
            $restaurant = Restaurant::create([
                'name' => $request->name,
                'email' => $request->email,
                'phone' => $request->phone,
                'latitude' => $request->latitude,
                'longitude' => $request->longitude,
                'logo' => $filename,
                'address' => $request->address,
                'password' => Hash::make($request->password),
                'fcm_token' => $request->fcm_token,
                'delivery_charges' => $request->delivery_charges
            ]);

            $success['token'] = $restaurant->createToken('JustHalaal-' . rand(0, 9))->accessToken;

            $data = [
                'id' => $restaurant->id,
                'name' => $restaurant->name,
                'email' => $restaurant->email,
                'phone' => $restaurant->phone,
                'latitude' => $request->latitude,
                'longitude' => $request->longitude,
                'logo' => $request->logo,
                'fcm_token' => $restaurant->fcm_token,
                'delivery_charges' => $restaurant->delivery_charges
            ];
            
                return response()->json(['status' => true, 'message' => "Registered Successfully"], 200);

            // return response()->json(['status' => 200, 'message' => "Registered Successfully",
            //     'data' => $data, 'token' => $success['token']], 200);

        } else {
            return response()->json(['status' => false, 'message' => \Exception::getMessage()], 404);
        }

    }

    public function login($request)
    {
        $validator = Validator::make($request->all(), [

            'email' => 'required|email',
            'password' => 'required',
            'fcm_token'=>'required'

        ]);
        if ($validator->fails()) {

            return response()->json(['status' => false, 'message' => $validator->messages()->first()], 406);

        }


//        if (Auth::attempt(['email' => request('email'), 'password' => request('password')])) {

        $restaurant = Restaurant::where(['email' => $request->email])->first();
        if (!$restaurant) {

            return response()->json(['status' => false, 'message' => "Invalid Login Credentials"], 401);

        }

        if (Auth::guard('restaurant')->attempt(['email' => request('email'), 'password' => request('password')])) {

            if($restaurant->status == 'approved'){
                $restaurant_update = Restaurant::find($restaurant->id);
                // $restaurant_update->fcm_token = $request->input('fcm_token');
                // $restaurant_update->update();
                $token = $restaurant_update->createToken('justHalaal-' . rand(0, 9))->accessToken;

                $data = [
                    'id' => $restaurant_update->id,
                    'name' => $restaurant_update->name,
                    'email' => $restaurant_update->email,
                    'phone' => $restaurant_update->phone,
                    'fcm_token' => $restaurant_update->fcm_token,
                    'latitude' => $restaurant_update->latitude,
                    'longitude' => $restaurant_update->longitude,
                    'logo' => asset($restaurant_update->logo),
                    'delivery_charges' => $restaurant_update->delivery_charges,
                    'fcm_token' => $restaurant_update->fcm_token,
//                'role' => $user->role->name,
                ];
                return response()->json(['status' => true, 'message' => "Login Successfully",
                    'data' => $data, 'token' => $token], 200);
            }
            else{

                return response()->json(['status' => false, 'message' => "You have not Approved Yet for Restaurant Account!"], 201);

            }

        } //            $user = Auth::user();


        else {
            return response()->json(['status' => false, 'message' => "Invalid Login Credentials"], 401);

        }
    }

    public function forgetPassword($request)
    {
        $validator = Validator::make($request->all(), [

            'email' => 'required|email',
        ]);
        if ($validator->fails()) {
            return response()->json(['status' => false, 'message' => $validator->messages()->first()], 406);
        }
        $user = Restaurant::where('email', $request->email)->first();

        if (!isset($user)) {
            return response()->json(['status' => false, 'message' => "Email doe's not Exist"], 401);
        }
        $confirmation_code = mt_rand(2000, 9999);
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
        Mail::send('mail.forgetpassword',compact('msgData'),function ($message) use ($email){
            $message->to($email);
            $message->subject('Forget Password');
        });

        return response()->json(['status' => true, 'message' => 'Otp send to your email!',
            'data' => $data], 200);
    }

    public function verifyOtp($request)
    {
        $validator = Validator::make($request->all(), [

            'otp' => 'required',
            'email' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json(['status' => false, 'message' => $validator->messages()->first()], 406);
        }

        $otp = PasswordReset::where('email', $request->email)->where('token', $request->otp)
            ->first();

        if (!$otp) {
            return response()->json(['status' => false, 'message' => "Invalid OTP Code"], 401);
        }

        $otp->delete();

        return response()->json(['status' => true, 'message' => "OTP Verified Successfully"], 200);
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
            return response()->json(['status' => false, 'message' => $validator->messages()->first()], 406);
        }

        $user = Restaurant::where('email', $request->email)->first();

        if (!isset($user)) {
            return response()->json(['status' => false, 'message' => "Email doe's not Exist"], 401);
        }

        $email = PasswordReset::where('email', $request->email)->first();
        if (!$email) {
            return response()->json(['status' => false, 'message' => "Email doe's not exist"], 401);
        }

        $confirmation_code = mt_rand(2000, 9999);

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

        return response()->json(['status' => true, 'message' => 'OTP Code is Resend to your Email Address',
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
                'email' => 'required|email',
                'password' => 'required',
                // 'confirmed_password' => 'required',
            ], $customMsgs
        );

        if ($validator->fails()) {
            return response()->json(['status' => false, 'message' => $validator->messages()->first()], 406);
        }


        // if ($request->confirmed_password != $request->password) {
        //     return response()->json(['status' => 401, 'message' => "Password does not Match"], 401);

        // }
        $user = Restaurant::where('email', $request->email)->first();


        if (!$user) {
            return response()->json(['status' => false, 'message' => "User does not Exist"], 401);
        }


        $user->password = Hash::make($request->password);
        $user->save();

        return response()->json(['status' => true, 'message' => "Password Updated Successfully"], 200);
    }





}
