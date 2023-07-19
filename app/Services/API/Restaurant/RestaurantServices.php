<?php

namespace App\Services\API\Restaurant;

use App\Models\AccountDetail;
use App\Models\Restaurant;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use phpseclib3\Crypt\Hash;

class RestaurantServices
{
    public function editProfile($request)
    {

        $customMsgs = [
//            'restaurant_id.required' => 'Please Provide restaurant_id',
            'name' => 'Please Provide name',
            'email' => 'Please Provide email',
            'phone' => 'Please Provide restaurant_id',
            'address' => 'Please Provide address',
            'password' => 'Please Provide address',



        ];
        $validator = Validator::make($request->all(),
            [
//                'restaurant_id' => 'required',
                'name' => '',
                'email' => 'email|unique:restaurants',
                'phone' => '',
                'address' => '',
                'password' => '',
            ], $customMsgs
        );

        if ($validator->fails()) {
            return response()->json(['status' => 406, 'message' => $validator->messages()->first()], 406);
        }

        $restaurant =  Restaurant::where('id',Auth::id())->first();
        if(!$restaurant){
            return response()->json(['status'=>'0','message'=>"restaurant_id not found"]);
        }

        $restaurant->name = $request->name ? $request->name : $restaurant->name;
        $restaurant->email = $request->email ? $request->email : $restaurant->email;
        $restaurant->phone = $request->phone ? $request->phone : $restaurant->phone;
        $restaurant->address = $request->address ? $request->address : $restaurant->address;
        $restaurant->password = $restaurant->password ? \Illuminate\Support\Facades\Hash::make($request->password):$restaurant->password;
        $restaurant->save();
        return response()->json(['status'=>200,'message'=>"Update Record Successfully"],200);





    }

    public function getProfile($request)
    {
        $customMsgs = [

            'restaurant_id.required' => 'Please Provide restaurant_id',


        ];
        $validator = Validator::make($request->all(),
            [
                'restaurant_id' => 'required',

            ],$customMsgs
        );

        if ($validator->fails()) {
            return response()->json(['status' => 406, 'message' => $validator->messages()->first()], 406);
        }

        $res = Restaurant::where('id',$request->restaurant_id)->first();
        if(!$res){
            return response()->json(['status'=>404,'message'=>"Record Not Found"],200);

        }

        return response()->json(['status'=>200,'data'=>$res,],200);

    }
    public function accountDetails($request)
    {
        $customMsgs = [
//            'restaurant_id.required' => 'Please Provide restaurant_id',
            'card_no' => 'Please Provide card_number',
            'card_expiry' => 'Please Provide card_expiry',
            'security_code' => 'Please Provide security_code',
            'first_name' => 'Please Provide first_name',
            'last_name' => 'Please Provide last_name',

        ];
        $validator = Validator::make($request->all(),
            [
//                'restaurant_id' => 'required',
                'card_no' => 'required',
                'card_expiry' => 'required|date_format:m/Y|after:yesterday',
                'security_code' => 'required|max:3',
                'first_name' => 'required|string',
                'last_name' => 'required|string',
            ],$customMsgs
        );

        if ($validator->fails()) {
            return response()->json(['status' => 406, 'message' => $validator->messages()->first()], 406);
        }

        $account = AccountDetail::where('restaurant_id',Auth::id())->first();
//        dd($account);
        if(isset($account)){
            return response()->json(['status'=> 200, 'message' => 'You have Already Add Details']);
        }

//       $date =  explode('/',$request->card_expiry);

        AccountDetail::create([
            'restaurant_id'=>Auth::id(),
            'card_no'=>$request->card_no,
            'card_expiry'=>$request->card_expiry,
            'security_code'=>$request->security_code,
            'first_name'=>$request->first_name,
            'last_name'=>$request->last_name,
//            'first_name'=>$request->first_name,
        ]);

        return response()->json(['status'=>200,'message'=>"Account Details Added Successfully"],200);



    }

    public function deleteProfile($request)
    {
        $restaurant = Restaurant::where('id',Auth::id())->first();
        if(file_exists(public_path($restaurant->logo))){
            $img_del = unlink(public_path($restaurant->logo));
        }
        $restaurant->delete();
        return response()->json(['status'=>200,'message'=>"Profile Deleted Successfully"],200);

    }

}
