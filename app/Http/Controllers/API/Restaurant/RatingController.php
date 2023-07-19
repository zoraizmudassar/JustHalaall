<?php

namespace App\Http\Controllers\API\Restaurant;

use App\Http\Controllers\Controller;
use App\Models\Review;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

class RatingController extends Controller
{
    public function index(Request $request){
        $customMsgs = [
            'restaurant_id' => 'Please Provide restuarant id',
        ];
        $validator = Validator::make(
            $request->all(),
            [
                'restaurant_id' => 'required',
            ],
            $customMsgs
        );
        if ($validator->fails()) {
            return response()->json(['status' => 406, 'message' => $validator->messages()->first()], 406);
        }
        $rating = Review::where('restaurant_id',$request->restaurant_id)->get();
        if(count($rating)>0){ $rate = $rating->sum('rating')/count($rating); }else { $rate =0; }
        return response()->json(['status'=>200,'rating'=>$rate,'data'=>$rating],200);
    }
    public function store(Request $request)
    {
        $customMsgs = [
            'restaurant_id' => 'Please Provide restuarant id',
            'rating' => 'Please Provide rating',
            'user_id' => 'Please Provide user id',
        ];
        $validator = Validator::make(
            $request->all(),
            [
                'restaurant_id' => '',
                'rating' => '',
                'user_id' => '',
            ],
            $customMsgs
        );
        if ($validator->fails()) {
            return response()->json(['status' => 406, 'message' => $validator->messages()->first()], 406);
        }
        $review = new Review;
        $review->user_id = $request->user_id;
        $review->restaurant_id = $request->restaurant_id;
        $review->rating = $request->rating;
        $review->comment = $request->comment;
        $review->save();
        return response()->json(['status' => 200, 'message' => "Rating save Successfully"], 200);
    }
}
