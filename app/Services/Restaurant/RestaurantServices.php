<?php

namespace App\Services\Restaurant;

use App\Models\Restaurant;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class RestaurantServices
{
    public function approved()
    {
        $restaurants = Restaurant::where('status','approved')->latest()->get();
        return view('admin.restaurants.index',compact('restaurants'));

    }
    public function rejected()
    {
        $restaurants = Restaurant::where('status','rejected')->latest()->get();
        return view('admin.restaurants.rejected',compact('restaurants'));

    }

    public function form()
    {
        return view('admin.restaurants.form');
    }

    public function store($request)
    {

        $customMsgs = [
            'name.required' => 'Please Provide Restaurant Name',
            'email.required' => 'Please Provide Email',
            'phone.required' => 'Please Provide Phone',
            'password.required' => 'Please Provide Password',
            'address.required' => 'Please Provide Address',
            'delivery_time.required' => 'Please Provide Delivery Time',
            'delivery_charges.required' => 'Please Provide Delivery Charges',
            'aboutUs.required' => 'Please Enter Restaurant Detail',
            'latitude.required' => 'Please Enter Latitude',
            'longitude.required' => 'Please Enter Longitude',
            'start_time.required' => 'Please Provide Delivery Start Time',
            'end_time.required' => 'Please Provide Delivery End Time',
            'logo.required' => 'Please Provide Image',
        ];
        $validator = Validator::make($request->all(),
            [
                'name' => 'required',
                'email' => 'required|email|unique:restaurants',
                'phone' => 'required|integer',
                'password' => 'required|min:8',
                'address' => 'required|string',
                'delivery_time' => 'required|integer|min:1',
                'delivery_charges' => 'required|integer|min:1',
                'latitude'=>'required',
                'longitude'=>'required',
                'aboutUs'=>'required',
                'start_time' => 'required',
                'end_time' => 'required',
                'logo' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            ], $customMsgs
        );
        if ($validator->fails()) {
            return response()->json(['status' => 0, 'message' => $validator->messages()->first()], 200);
        }

        $file = $request->logo;
        if ($request->hasFile('logo')) {

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

            }
        }


        $data = Restaurant::create([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'address' => $request->address,
            'password' => Hash::make($request->password),
            'delivery_time' => $request->delivery_time,
            'delivery_charges' => $request->delivery_charges,
            'aboutUs' => $request->aboutUs,
            'start_time' => $request->start_time,
            'latitude' => $request->latitude,
            'longitude' => $request->longitude,
            'end_time' => $request->end_time,
            'logo' => !empty($path) ? $path :'',
        ]);

        return response()->json([ 'status' => 1  ,'url'=>route('admin.restaurant.pending'), 'message' => ' Restaurant Add Successfully']);
    }

    public function update($request)
    {
        $customMsgs = [
            'name.required' => 'Please Provide Restaurant Name',
            'email.required' => 'Please Provide Email',
            'phone.required' => 'Please Provide Phone',
            //'password.required' => 'Please Provide Password',
            'address.required' => 'Please Provide Address',
            'delivery_time.required' => 'Please Provide Delivery Time',
            'delivery_charges.required' => 'Please Provide Delivery Charges',
            'aboutUs.required' => 'Please Enter Restaurant Detail',
            'start_time.required' => 'Please Provide Delivery Start Time',
            'end_time.required' => 'Please Provide Delivery End Time',
            'logo.required' => 'Please Provide Image',
            'latitude.required' => 'Please Enter Latitude',
            'longitude.required' => 'Please Enter Longitude',
        ];
        $validator = Validator::make($request->all(),
            [
                'name' => 'required',
                'email' => 'required',
                'phone' => 'required',
                //'password' => 'required',
                'delivery_time' => 'required',
                'delivery_charges' => 'required',
                'latitude'=>'required',
                'longitude'=>'required',
                'aboutUs'=>'required',
                'start_time' => 'required',
                'end_time' => 'required',
                'logo' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            ], $customMsgs
        );
        if ($validator->fails()) {
            return response()->json(['status' => 0, 'message' => $validator->messages()->first()], 200);
        }

        $restaurant = Restaurant::find($request->id);

        $file = $request->logo;
        $save_image = $restaurant->logo;

        if ($request->hasFile('logo')) {

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

                if (isset($path) && !empty($path)){
                    if(file_exists(public_path($restaurant->logo))){
                        $img_del = unlink(public_path($restaurant->logo));
                    }
                }
            }
        }

        $data = $restaurant->update([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'password' => Hash::make($request->password),
            'delivery_time' => $request->delivery_time,
            'delivery_charges' => $request->delivery_charges,
            'aboutUs' => $request->aboutUs,
            'start_time' => $request->start_time,
            'end_time' => $request->end_time,
            'logo' => $save_image,
            'latitude' => $request->latitude,
            'longitude' => $request->longitude,
        ]);

        return response()->json([ 'status' => 1  , 'message' => ' Restaurant Update Successfully']);

    }

    public function destroy($request)
    {
        $restaurant = Restaurant::where(['id'=>$request->data_id])->first();
        if ($restaurant){

            if (isset($restaurant->logo) && (!empty($restaurant->logo) || !is_null($restaurant->logo))){    //  check DB record exists or not
                if(file_exists(public_path($restaurant->logo))){    // check image exists in directory
                    $img_del = unlink(public_path($restaurant->logo));
                    $restaurant->delete();
                }else{
                    $restaurant->delete();
                }
            }else{
                $restaurant->delete();
            }

            return response()->json([ 'status' => 1  , 'message' => 'Restaurant Deleted Successfully']);

        }
    }

    public function changeStatus($request)
    {

        $user = Restaurant::find($request->restaurant_id);
        $user->status = $request->status;
        $user->save();

        return response()->json(['status' => 200  ,'message'=>'Status Change Successfully.']);
    }

    public function pending($request)
    {
        $restaurants = Restaurant::where('status','pending')->latest()->get();
//        dd($restaurants);
        return view('admin.restaurants.pending',compact('restaurants'));
    }
}
