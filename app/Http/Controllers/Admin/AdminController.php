<?php

namespace App\Http\Controllers\Admin;

use App\Models\Admin;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function index()
    {
        return view('admin.index');
    }

    public function editProfile(Request $request,Admin $admin)
    {
        return view('admin.profile',compact('admin'));
    }

    public function updateProfile(Request $request)
    {

        $customMsgs = [
            'name.required' => 'Please Provide Name',
            'image.required' => 'Please Provide Profile Image',
        ];
        $validator = Validator::make($request->all(),
            [
                'name' => 'required',
                'password' => 'nullable|min:8|same:password_confirmation',
                'password_confirmation' => 'nullable|min:8',
                'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',

//                'gender' => "required",
            ], $customMsgs
        );

        if ($validator->fails()) {
            return response()->json(['status' => 0, 'message' => $validator->messages()->first()], 200);
        }

        $user = Admin::where('id',Auth::user()->id)->first();
        $save_image = $user->avatar;
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

                $folderName = "uploads/admin/";
                $file->move($folderName, $fileName);
                $path = $folderName . '/' . $fileName;
                $save_image = $path;

                if (isset($path) && !empty($path)){
                    if(file_exists(public_path($user->avatar))){
                        $img_del = unlink(public_path($user->avatar));
                    }
                }
            }
        }

        if($request->password != null){
            $user->password = Hash::make($request->password);
        }

//        $user->gender = $request->gender;
        $user->first_name = $request->name;
        $user->avatar = $save_image;
        $user->save();
        return response()->json([ 'status' => 1 , 'message' => 'Profile Updated Successfully']);
    }
}
