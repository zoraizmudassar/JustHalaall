<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\Models\User;
use Illuminate\Http\Request;
// use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Auth;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    // use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    // protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    // public function __construct()
    // {
    //     $this->middleware('guest');
    // }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    public function sendFailedRegisterResponse(array $data)
    {
        $errors =  Validator::make($data, [
            // 'name' => ['required', 'string'],
            'first_name' => ['required', 'string'],
            // 'middle_name' => ['required', 'string'],
            'last_name' => ['required', 'string'],
            'postal_code' => ['required', 'string'],
            'email' => ['required', 'string', 'email', 'unique:users'],
            'phone' => ['required', 'unique:users'],
            // 'image' => ['required'],
            'address' => ['required'],
            'password' => ['required', 'min:6'],
            // 'password_confirmation' => ['required_with:password', 'same:password', 'min:6']
        ]);
        return $errors;
    }

    public function validator(array $data)
    {
        return Validator::make($data, [
            'first_name' => ['required', 'string', 'max:255'],
            // 'middle_name' => ['required', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],
            'postal_code' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
    public function create(Request $request)
    {
        $customMsgs = [
            // 'name.required' => 'Please Provide Name',
            'first_name.required' => 'Please Provide First Name',
            // 'middle_name.required' => 'Please Provide Middle Name',
            'last_name.required' => 'Please Provide Last Name',
            'postal_code.required' => 'Please Provide Postal Code',
            'email.required' => 'Please Provide Email',
            'phone.required' => 'Please Provide Phone',
            // 'image.required' => 'Please upload profile image',
            'address.required' => 'Please Provide Address',
            'password.required' => 'Please Provide Password',
        ];
        $validator = Validator::make($request->all(),
            [
                // 'name' => 'required',
                'first_name' => 'required',
                // 'middle_name' => 'required',
                'last_name' => 'required',
                'postal_code' => 'required',
                'email' => 'required|email|unique:users',
                'phone' => 'required|unique:users',
                // 'image' => 'required',
                'address' => 'required',
                'password' => 'required|min:6',
                // 'password_confirmation' => 'required_with:password|same:password|min:6'
            ], $customMsgs
        );

        $errors = $this->sendFailedRegisterResponse($request->all());
        if($validator->fails()){
            return redirect()->back()->withInput($request->all())->withErrors($errors);
        }

        $path = '';
        $file = $request->image;
        if($request->hasFile('image')){
            $fileName = $file->getClientOriginalName();
            $explodeImage = explode('.', $fileName);
            $fileName = $explodeImage[0];
            $extension = end($explodeImage);
            $fileName = time() . "-" . $fileName . "." . $extension;
            $imageExtensions = ['JPG', 'JPEG', 'PNG', 'jpg', 'jpeg', 'png'];
            if(in_array($extension, $imageExtensions)){
                $folderName = "uploads/users";
                $file->move($folderName, $fileName);
                $path = $folderName . '/' . $fileName;

            }else{
                $notification = array(
                    'message' => 'Image should be in JPG or PNG and JPEG',
                    'alert-type' => 'info'
                );
                // return back()->with($notification);
                return redirect()->back()->withInput($request->all())->with($notification);

                // return response()->json([
                //     'status' => 301, 
                //     'message' => 'Image should be in JPG or PNG and JPEG',
                // ], 301);
            }
        }

        if($request->has('email') && $request->has('password')){
            $user = User::create([
                'name' => $request->first_name . ' ' . $request->middle_name . ' ' . $request->last_name,
                'first_name' => $request->first_name,
                'middle_name' => $request->middle_name ? $request->middle_name : '',
                'last_name' => $request->last_name,
                'postal_code' => $request->postal_code,
                'email' => $request->email,
                'phone' => $request->phone,
                'image' => $path,
                'address' => $request->address,
                'password' => Hash::make($request->password),
            ]);

            // $success['token'] = $user->createToken('JustHalaal-' . rand(0, 9))->accessToken;

            $notification = array(
                'message' => 'Registered Successfully',
                'alert-type' => 'success'
            );
            return redirect('/loginv1')->with($notification);

        }else{
            $notification = array(
                'message' => \Exception::getMessage(),
                'alert-type' => 'error'
            );
            return back()->with('error' , $notification);
        }
    }

    public function logout()
    {
        Auth::logout();
        // $notification = array(
        //     'message' => "You have been logged out",
        //     'alert-type' => 'success'
        // );
        // return back()->with('success' , $notification);
        // return redirect('/homev1')->with($notification);
        return redirect('/homev1');
    }
}