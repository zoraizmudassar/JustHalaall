<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Auth;
use Illuminate\Support\Facades\Validator;
use PHPUnit\Exception;

class ProfileController extends Controller
{
    public function sendFailedRegisterResponse(array $data)
    {
        $errors =  Validator::make($data, [
            'name' => ['required', 'string'],
            'phone' => ['required', 'unique:users'],
            'address' => ['required'],
        ]);
        return $errors;
    }

    public function update(Request $request)
    {
        $customMsgs = [
            'name.required' => 'Please Provide Name',
            'phone.required' => 'Please Provide Phone',
            'address.required' => 'Please Provide Address',
        ];
        $validator = Validator::make($request->all(),
            [
                'name' => 'required',
                'phone' => 'required|unique:users',
                'address' => 'required',
            ], $customMsgs
        );

        $errors = $this->sendFailedRegisterResponse($request->all());
        if($validator->fails()){
            return redirect()->back()->withInput($request->all())->withErrors($errors);
        }

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
                return back()->with($notification);

                // return response()->json([
                //     'status' => 301, 
                //     'message' => 'Image should be in JPG or PNG and JPEG',
                // ], 301);
            }
        }

        if($request->has('name') && $request->has('id')){
            $user = User::where('id', $request->id)->update([
                'name' => $request->name,
                'phone' => $request->phone,
                'address' => $request->address
            ]);

            // $success['token'] = $user->createToken('JustHalaal-' . rand(0, 9))->accessToken;

            $notification = array(
                'message' => 'Updated Successfully',
                'alert-type' => 'success'
            );
            return back()->with('success' , $notification);

        }else{
            $notification = array(
                'message' => \Exception::getMessage(),
                'alert-type' => 'error'
            );
            return back()->with('error' , $notification);
        }
    }

    public function updatePassword(Request $request)
    {
        if(!(Hash::check($request->get('old_password'), Auth::user()->password))){
            return redirect()->back()->with("error","Your current password does not matches with the password.");
        }

        if(strcmp($request->get('old_password'), $request->get('new_password')) == 0){
            return redirect()->back()->with("error","New Password cannot be same as your current password.");
        }
        $user = Auth::user();
        $user->password = Hash::make($request->get('new_password'));
        $user->save();
        if($user->save()){
            $notification = array(
                'message' => 'Password Successfully Changed',
                'alert-type' => 'success'
            );
            return redirect()->back()->with($notification);
        }
        else{
            $notification = array(
                'message' => 'Operation Failed. Please try again',
                'alert-type' => 'error'
            );
            return redirect()->back()->with($notification);
        }
    }
}
