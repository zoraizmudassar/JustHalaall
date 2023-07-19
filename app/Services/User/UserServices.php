<?php


namespace App\Services\User;


use App\Models\Restaurant;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UserServices
{
    public function form()
    {
        return view('admin.users.form');
    }
    public function active()
    {
        $users = User::where('is_verified',1)->latest()->get();
        return view('admin.users.index',compact('users'));
    }
    public function inActive()
    {
        $users = User::where('is_verified',0)->latest()->get();
        return view('admin.users.inactive',compact('users'));
    }

    public function store($request)
    {
        $customMsgs = [
            'name.required' => 'Please Provide User Name',
            'email.required' => 'Please Provide Email',
            'phone.required' => 'Please Provide Phone',
            'password.required' => 'Please Provide Password',
            'address.required' => 'Please Provide Address',
            'avatar.required' => 'Please Provide Image',
        ];
        $validator = Validator::make($request->all(),
            [
                'name' => 'required',
                'email' => 'required|email|unique:users',
                'phone' => 'required',
                'password' => 'required|min:8',
                'address' => 'required|string',
                'avatar' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            ], $customMsgs
        );
        if ($validator->fails()) {
            return response()->json(['status' => 404, 'message' => $validator->messages()->first()]);
        }

        $file = $request->avatar;
        if ($request->hasFile('avatar')) {

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

                $folderName = "uploads/users";
                $file->move($folderName, $fileName);
                $path = $folderName . '/' . $fileName;

            }
        }

        $data = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'address' => $request->address,
            'password' => Hash::make($request->password),
            'avatar' => !empty($path) ? $path :'',
        ]);
        if ($data){
            return response()->json([ 'status' => 200, 'url'=> route('admin.user.inActive'), 'message' => 'User Add Successfully']);
        }else{
            return response()->json([ 'status' => 404, 'message' => 'User NOT Add']);
        }

    }

    public function update($request)
    {


        $customMsgs = [
            'name.required' => 'Please Provide User Name',
            'email.required' => 'Please Provide Email',
            'phone.required' => 'Please Provide Phone',
            'address.required' => 'Please Provide Address',
            'avatar.required' => 'Please Provide Image',
        ];
        $validator = Validator::make($request->all(),
            [
                'name' => 'required',
                'email' => 'required|email',
                'phone' => 'required|integer',
                'address' => 'required|string',
                'avatar' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            ], $customMsgs
        );
        if ($validator->fails()) {
            return response()->json(['status' => 404, 'message' => $validator->messages()->first()]);
        }

        $user = User::find($request->id);
        $save_image = $user->avatar;
        $file = $request->avatar;
        if ($request->hasFile('avatar')) {

            $fileName = $file->getClientOriginalName();
            $fileSize = ($file->getSize()) / 2000; //Size in kb
            $explodeImage = explode('.', $fileName);
            $fileName = $explodeImage[0];
            $extension = end($explodeImage);
            $fileName = time() . "-" . $fileName . "." . $extension;
            $imageExtensions = ['jpg', 'jpeg', 'gif', 'png', 'heif', 'hevc', 'heic', 'PNG'];
            if (in_array($extension, $imageExtensions)) {
                if ($fileSize > 2000) {
                    return response()->json(['status' => 404, 'message' => "Image size should be less than 2 MB"]);
                }

                $folderName = "uploads/users";
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

        $data = $user->update([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'address' => $request->address,
            'avatar' => $save_image,
        ]);

        if ($data){
            return response()->json([ 'status' => 200, 'message' => ' Record Update Successfully']);
        }else{
            return response()->json([ 'status' => 404, 'message' => ' Record NOT Update']);
        }

    }

    public function destroy($request)
    {
        $user = User::find($request->data_id);

        if ($user){

            if (isset($user->avatar) && (!empty($user->avatar) || !is_null($user->avatar))){    //  check DB record exists or not
                if(file_exists(public_path($user->avatar))){    // check avatar exists in directory
                    $img_del = unlink(public_path($user->avatar));
                    $user->delete();
                }else{
                    $user->delete();
                }
            }else{
                $user->delete();
            }
            return response()->json([ 'status' => 1  , 'message' => 'Record Deleted Successfully']);

        }
//        return response()->json([ 'status' => 1  , 'message' => ' Record Deleted Successfully']);

    }

    public function changeStatus($request)
    {
        $user = User::find($request->user_id);
        $user->is_verified = $request->status;
        $user->save();

        return response()->json(['status' => 1  ,'message'=>'Status Change Successfully.']);
    }
}
