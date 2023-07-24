<?php

namespace App\Services\API\Customer;

use App\Models\PasswordReset;
use App\Models\Restaurant;
use App\Models\User;
use App\Notifications\ForgetPassword;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\Http\Traits\Firebase;
use Illuminate\Support\Facades\Mail;

class AuthenticationServices
{
    use Firebase;
    
    public function register($request)
    {
        $customMsgs = [
            'name.required' => 'Please Provide Name',
            'email.required' => 'Please Provide Email',
            'phone.required' => 'Please Provide Phone',
            // 'image.required' => 'Please upload profile image',
            'address.required' => 'Please Provide Address',
            'password.required' => 'Please Provide Password',
            'fcm_token.required' => 'Please Provide FCM Token',
        ];
        $validator = Validator::make($request->all(),
            [
                'name' => 'required',
                'email' => 'required|email|unique:users',
                'phone' => 'required|integer|unique:users',
                // 'image' => 'required',
                'address' => 'required',
                'password' => 'required|min:6',
                // 'password_confirmation' => 'required_with:password|same:password|min:6',
                'fcm_token' => 'required'
            ], $customMsgs
        );

        if ($validator->fails()) {
            return response()->json(['status' => 406, 'message' => $validator->messages()->first()], 406);
        }
        
        $filename = null;
        if($request->image){
            $f = finfo_open();
            $mime_type = finfo_buffer($f, base64_decode($request->image) , FILEINFO_MIME_TYPE);
            $type = explode('/', $mime_type);
            $randomNumber = rand(1000000000,9999999999);
            $filename = '/uploads/users/' .$randomNumber.'.'.$type[1];
            file_put_contents(public_path() . $filename, base64_decode($request->image));
            $filename = 'https://www.justhalaall.com/public'.$filename;
        }

        // $file = $request->image;
        // if ($request->hasFile('image')) {
        //     $fileName = $file->getClientOriginalName();
        //     $explodeImage = explode('.', $fileName);
        //     $fileName = $explodeImage[0];
        //     $extension = end($explodeImage);
        //     $fileName = time() . "-" . $fileName . "." . $extension;
        //     $imageExtensions = ['jpg', 'jpeg', 'png'];
        //     if (in_array($extension, $imageExtensions)) {
        //         $folderName = "uploads/users";
        //         $file->move($folderName, $fileName);
        //         $path = $folderName . '/' . $fileName;

        //     } else {
        //         return response()->json([
        //             'status' => 301, 
        //             'message' => 'Image should be in JPG or PNG and JPEG',
        //         ], 301);
        //     }
        // }

        if ($request->has('email') && $request->has('password')) {
            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'phone' => $request->phone,
                'image' => $filename,
                'address' => $request->address,
                'password' => Hash::make($request->password),
                'fcm_token' => $request->fcm_token
            ]);

            $success['token'] = $user->createToken('JustHalaal-' . rand(0, 9))->accessToken;

            $data = [
                'id' => $user->id,
                'name' => $user->name,
                'email' => $user->email,
                'phone' => $user->phone,
                // 'image' => asset($path),
                'image' => $user->image,
                'fcm_token' => $request->fcm_token
            ];
            
            return response()->json(['status' => true, 'message' => "Registered Successfully"], 200);

            // return response()->json(['status' => true, 'message' => "Registered Successfully",
            //     'data' => $data, 'token' => $success['token']], 200);

        } else {
            return response()->json(['status' => 404, 'message' => \Exception::getMessage()], 404);
        }
    }

    public function login(Request $request)
    {
        
        // return response()->json(['status' => 200, 'message' => "Customer login Api"], 200);
        $customMsgs = [
            'email.required' => 'Please Provide Email',
            'password.required' => 'Please Provide Password',
        ];
        $validator = Validator::make($request->all(),
            [
                'email' => 'required|email',
                'password' => 'required',
                'fcm_token' => 'required',

            ], $customMsgs
        );

        if ($validator->fails()) {
            return response()->json(['status' => 406, 'message' => $validator->messages()->first()], 406);
        }

        if (Auth::guard('web')->attempt(['email' => $request->email, 'password' => $request->password])) {

            $user = User::where(['email' => Auth::user()->email])->first();
            $user->fcm_token = $request->fcm_token;
            $user->update();
            $token = $user->createToken('justHalaal-' . rand(0, 9))->accessToken;

            $data = [
                'id' => $user->id,
                'name' => $user->name,
                'email' => $user->email,
                'phone' => $user->phone,
                'address' => $user->address,                
                'image' => $user->image,
                // 'role' => $user->role->name,
                'fcm_token' => $user->fcm_token
            ];
            return response()->json(['status' => true, 'message' => "Login Successfully",
                'data' => $data, 'token' => $token], 200);

        } else {
            return response()->json(['status' => 401, 'message' => "Invalid Login Credentials"], 401);

        }
    }

    public function forgetPassword($request)
    {
        $validator = Validator::make($request->all(), [

            'email' => 'required|email',
        ]);
        if ($validator->fails()) {
            return response()->json([
                'status' => 406, 'message' => $validator->messages()->first()
            ], 406);
        }

        $user = User::where('email', $request->email)->first();
        if (!$user) {
            return response()->json([
                'status' => 404, 
                'message' => "Email Not Found"
            ], 404);
        }

        $confirmation_code = mt_rand(1000, 9999);
        PasswordReset::insert([
            'email' => $request->email,
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
        return response()->json([
            'status' => true, 
            'data' => $data,
            'message' => 'OTP Code is send to your Email Address',
            
        ], 200);
    }

    public function verifyOtp($request)
    {
        $validator = Validator::make($request->all(), [

            'otp' => 'required',
            'email' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 406, 'message' => $validator->messages()->first()
            ], 406);
        }

        $otp = PasswordReset::where('email', $request->email)->where('token', $request->otp)->first();

        if (!$otp) {
            return response()->json([
                'status' => 401, 
                'message' => "Invalid OTP Code"
            ], 401);
        }

        $otp->delete();

        return response()->json([
            'status' => true, 'message' => 
            "OTP Verified Successfully"
        ], 200);
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

        $user = User::where('email', $request->email)->first();

        if (!$user) {
            return response()->json(['status' => 404, 'message' => "Email doe's not Exist"], 404);
        }

        $email = PasswordReset::where('email', $request->email)->first();
        if (!$email) {
            return response()->json(['status' => 404, 'message' => "Email does not exist"], 404);
        }

        $confirmation_code = mt_rand(1000, 9999);

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
            return response()->json(['status' => 406, 'message' => $validator->messages()->first()], 406);
        }


        // if ($request->confirmed_password != $request->password) {
        //     return response()->json(['status' => 401, 'message' => "Password does not Match"], 401);

        // }
        $user = User::where('email', $request->email)->first();


        if (!$user) {
            return response()->json(['status' => 401, 'message' => "User does not Exist"], 401);
        }


        $user->password = Hash::make($request->password);
        $user->save();

        return response()->json(['status' => true, 'message' => "Password Updated Successfully"], 200);
    }

    public function changeForgetPassword($request) {
        $validator = Validator::make($request->all(), [
            'email' => 'required',
            'new_password' => 'required|min:6',
            // 'password_confirmation' => 'required|same:new_password|min:6'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 406, 
                'message' => $validator->messages()->first()
            ], 406);
        } else {
            $email = PasswordReset::where('email', $request->email)->first();
            if (!$email) {
                return response()->json([
                    'status' => 404, 
                    'message' => "Email does not exist"
                ], 404);
            } else {
                $userData = User::where('email', $request->email)->select('email', 'password')->first();
                if(!$userData) {
                    return response()->json([
                        'status' => 404, 
                        'message' => "Admin deleted your account",
                    ], 404);
                } else {
                    $userData->password = Hash::make($request->new_password);
                    $updatePassword = User::where('email', $request->email)->update([
                        'password' => $userData->password
                    ]);
                    if($updatePassword) {
                        return response()->json([
                            'status' => true, 
                            'message' => "Password Updated Successfully"
                        ], 200);
                    } else {
                        return response()->json([
                            'status' => 500, 
                            'message' =>  "Server Error"
                        ], 200);
                    }
                }
            }
        }
    }
}
