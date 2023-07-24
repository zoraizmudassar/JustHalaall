<?php
namespace App\Http\Traits;

use Illuminate\Support\Facades\Validator;

trait ApiValidation {
    public $validationArray = array(
        'cart_list'=> [
            'latitude' => 'required',
            'longitude' => 'required',
            'user_id' => 'required',
            ],
        'add_to_cart'=> [
            'restaurant_id' => 'required',
            'product_id' => 'required',
            'unit_price' => 'required',
            'quantity' => 'required',
            ],
        'remove_from_cart'=> [
            'cart_id' => 'required',
            ],
        "add_to_wishlist"=> [
            'restaurant_id' => 'required',
            'product_id' => 'required',
            ],
        "checkout" => [
            'name' => 'required',
            'email' => 'required',
            'phone' => 'required',
            'address' => 'required',
            'payment_type' => 'required',
        ],
         'update_order_status'=>[
             'order_id' => 'required',
             'order_status' => 'required',
         ],
         'get_delivery_charges'=>[
             'cart' => 'required|array',
             'latitude' => 'required',
             'longitude' => 'required',
         ]
    );

    public function validateData($request, $validation){
        $validator = Validator::make($request->all(),$this->validationArray[$validation]);
        if ($validator->fails()) {
            return response()->json([
                'status' => 400,
                'message' => $validator->messages()->first()
            ], 400);
        } else {
            return true;
        }
    }
}
