<?php

namespace App\Http\Controllers\Restaurant;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Models\Restaurant;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class RestaurantController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:restaurant');
    }

    public function index()
    {
        $orders = Order::latest()->with('user','orderDetails')->get();
        return view('restaurant.index',compact('orders'));
    }

    public function editProfile(Request $request,Restaurant $restaurant)
    {
        return view('restaurant.profile',compact('restaurant'));
    }

    public function forgetPassword(Request $request,Restaurant $restaurant)
    {
        return view('restaurant.profile',compact('restaurant'));
    }

    public function updateProfile(Request $request,Restaurant $restaurant)
    {
        $customMsgs = [
            'name.required' => 'Please Provide Name',
            'image.required' => 'Please Provide Profile Image',
        ];
        $validator = Validator::make($request->all(),
            [
                'name' => 'required',
                'latitude' => 'required',
                'longitude' => 'required',
                'password' => 'nullable|min:8|same:password_confirmation',
                'password_confirmation' => 'nullable|min:8',
                'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',

//                'gender' => "required",
            ], $customMsgs
        );

        if ($validator->fails()) {
            return response()->json(['status' => 0, 'message' => $validator->messages()->first()], 200);
        }

        $user = Restaurant::where('id',Auth::id())->first();
        $save_image = $user->logo;
        $file = $request->image;
        if ($request->hasFile('image')) {

            $fileName = $file->getClientOriginalName();
            $fileSize = ($file->getSize()) / 2000; //Size in kb
            $explodeImage = explode('.', $fileName);
            $fileName = $explodeImage[0];
            $extension = end($explodeImage);
            $fileName = time() . "-" . $fileName . "." . $extension;
            $imageExtensions = ['jpg', 'jpeg', 'gif', 'png', 'heif', 'hevc', 'heic', 'PNG'];
            if (in_array($extension, $imageExtensions)) {
                if ($fileSize > 2000) {
                    return response()->json(['status' => 0, 'message' => "Image size should be less than 2 MB"]);
                }

                $folderName = "uploads/restaurants/logo";
                $file->move($folderName, $fileName);
                $path = $folderName . '/' . $fileName;
                $save_image = $path;

                // if (isset($path) && !empty($path)){
                //     if(file_exists(public_path($user->logo))){
                //         $img_del = unlink(public_path($user->logo));
                //     }
                // }
            }
        }

        if($request->password != null){
            $user->password = Hash::make($request->password);
        }

//        $user->gender = $request->gender;
        $user->name = $request->name;
        $user->email = $request->email;
        $user->logo = $save_image;
        $user->latitude = $request->latitude;
        $user->longitude = $request->longitude;
        $user->save();
        return response()->json([ 'status' => 1 , 'message' => 'Profile Updated Successfully']);
    }
}
