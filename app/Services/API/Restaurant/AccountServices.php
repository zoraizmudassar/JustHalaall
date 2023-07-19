<?php

namespace App\Services\API\Restaurant;

use App\Models\AccountDetail;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class AccountServices
{
    public function editAccount($request)
    {
        $todayDate = date('m/Y');
        $customMsgs = [
            'card_number.required' => 'Please Provide Card Number',
            'card_expiry.required' => 'Please Provide Card Expiry',
            'security_code.required' => 'Please Provide Card CVC',
            'first_name.required' => 'Please Provide First Name',
            'last_name.required' => 'Please Provide Last Name',
//            'image.required' => 'Please Provide Image',
        ];
        $validator = Validator::make($request->all(),
            [
                'card_number' => ['numeric','min:16'],
                'card_expiry' => 'date_format:m/Y|after_or_equal:'.$todayDate,
                'security_code' => 'max:3',
                'first_name' => '',
                'last_name' => '',
//                'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            ], $customMsgs
        );
        if ($validator->fails()) {
            return response()->json(['status' => 406, 'message' => $validator->messages()->first()], 200);
        }

        $account = AccountDetail::where('restaurant_id',Auth::id())->first();
        if(!$account){
            return response()->json(['status' => 404,'message'=> 'You have not yet save Your Account Details'],404);
        }

        $account->update([
            'card_no'=> $request->card_number,
            'card_expiry' => $request->card_expiry,
            'security_code' => $request->security_code,
            'first_name' => $request->first_name,
            'last_name' => $request->last_name
        ]);
        return response()->json(['status' => 200,'message'=> 'Account Details Update Successfully'],200);

    }
}
