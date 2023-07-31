<?php

namespace App\Services\API\Restaurant;

use App\Models\Category;
use App\Models\Deal;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class DealServices
{
    public function addNewDeal($request)
    {
        $customMsgs = [
            'name.required' => 'Please Provide Deal Name',
            'description.required' => 'Please Provide Description',
            'price.required' => 'Please Provide Price',
            'category_id.required' => 'Please Provide Category Id',
            'delivery_time.required' => 'Please Provide Delivery Time',
            'image.required' => 'Please Provide Image',
        ];
        $validator = Validator::make($request->all(),
            [
                'name' => 'required',
                'description' => 'required',
                'price' => 'required|integer|min:0',
                'category_id' => 'required',
                'delivery_time' => 'required|date_format:H:i',
                'image' => 'required',
            ], $customMsgs
        );
        if ($validator->fails()) {
            return response()->json(['status' => false, 'message' => $validator->messages()->first()], 406);
        }

        $categroy = Category::where('id',$request->category_id)->first();
        if(!$categroy){

            return response()->json([ 'status' => false  , 'message' => 'Category id Not Found'],404);
        }
        
        $filename = null;
        if($request->image){
            $f = finfo_open();
            $mime_type = finfo_buffer($f, base64_decode($request->image) , FILEINFO_MIME_TYPE);
            $type = explode('/', $mime_type);
            $randomNumber = rand(1000000000,9999999999);
            $filename = '/uploads/deals/' .$randomNumber.'.'.$type[1];
            file_put_contents(public_path() . $filename, base64_decode($request->image));
            $filename = 'https://www.justhalaall.com/public'.$filename;
        }
        
//         $file = $request->image;
//         if ($request->hasFile('image')) {
//             $fileName = $file->getClientOriginalName();
//             $fileSize = ($file->getSize()) / 2000; //Size in kb
//             $explodeImage = explode('.', $fileName);
//             $fileName = $explodeImage[0];
//             $extension = end($explodeImage);
//             $fileName = time() . "-" . $fileName . "." . $extension;
//             $imageExtensions = ['jpg', 'jpeg', 'gif', 'png', 'heif', 'hevc', 'heic', 'PNG'];
//             if (in_array($extension, $imageExtensions)) {
//                 if ($fileSize > 2000) {
//                     return response()->json(['status' => 0, 'message' => "Image size should be less than 2 MB"]);
//                 }
//                 $folderName = "uploads/deals/";
//                 $file->move($folderName, $fileName);
//                 $path = $folderName . '/' . $fileName;
//                 $save_image = $path;

// //                if (isset($path) && !empty($path)){
// //                    if(file_exists(public_path($product->images))){
// //                        $img_del = unlink(public_path($product->images));
// //                    }
//             }
//         }



        $data = Deal::create([
            'restaurant_id' => Auth::id(),
            'category_id' => $request->category_id,
            'name' => $request->name,
            'description' => $request->description,
            'price' => $request->price,
            'delivery_time' => $request->delivery_time,
            'image' => $filename,
        ]);

        return response()->json([ 'status' => true  , 'message' => 'Deal Add Successfully'],200);

    }

    public function editDeal($request)
    {


        $customMsgs = [
            'deal_id.required' => 'Please Provide Deal Id',
            'name.required' => 'Please Provide Deal Name',
            'description.required' => 'Please Provide Description',
            'price.required' => 'Please Provide Price',
            'category_id.required' => 'Please Provide Category Id',
            'delivery_time.required' => 'Please Provide Delivery Time',
            'image.required' => 'Please Provide Image',
        ];
        $validator = Validator::make($request->all(),
            [
                'deal_id' => 'required',
                'name' => 'required',
                'description' => 'required',
                'price' => 'required|integer|min:0',
                'category_id' => 'required',
                'delivery_time' => 'required|date_format:H:i',
                'image' => 'required',
            ], $customMsgs
        );
        if ($validator->fails()) {
            return response()->json(['status' => false, 'message' => $validator->messages()->first()], 200);
        }

        $deal =  Deal::where('id',$request->deal_id)->where('restaurant_id',Auth::id())->first();
        if(!$deal){

            return response()->json(['status' => false, 'message'=> "Deal Not Found"],404);
        }
        $categroy = Category::where('id',$request->category_id)->first();

        if(!$categroy){

            return response()->json([ 'status' => false  , 'message' => 'Category id Not Found'],404);
        }
        
        $filename = null;
        if($request->image){
            $f = finfo_open();
            $mime_type = finfo_buffer($f, base64_decode($request->image) , FILEINFO_MIME_TYPE);
            $type = explode('/', $mime_type);
            $randomNumber = rand(1000000000,9999999999);
            $filename = '/uploads/deals/' .$randomNumber.'.'.$type[1];
            file_put_contents(public_path() . $filename, base64_decode($request->image));
            $filename = 'https://www.justhalaall.com/public'.$filename;
        }

        // $save_image = $deal->image;
        // $file = $request->image;

        // if ($request->hasFile('image')) {
        //     $fileName = $file->getClientOriginalName();
        //     $fileSize = ($file->getSize()) / 2000; //Size in kb
        //     $explodeImage = explode('.', $fileName);
        //     $fileName = $explodeImage[0];
        //     $extension = end($explodeImage);
        //     $fileName = time() . "-" . $fileName . "." . $extension;
        //     $imageExtensions = ['jpg', 'jpeg', 'gif', 'png', 'heif', 'hevc', 'heic', 'PNG'];
        //     if (in_array($extension, $imageExtensions)) {
        //         if ($fileSize > 2000) {
        //             return response()->json(['status' => 0, 'message' => "Image size should be less than 2 MB"]);
        //         }
        //         $folderName = "uploads/deals/";
        //         $file->move($folderName, $fileName);
        //         $path = $folderName . '/' . $fileName;
        //         $save_image = $path;

        //         if (isset($path) && !empty($path)){
        //             if(file_exists(public_path($deal->image))){
        //                 $img_del = unlink(public_path($deal->image));
        //             }
        //         }
        //     }
        // }

        $deal->update([
            'name' => $request->name,
            'category_id' => $request->category_id,
            'description' => $request->description,
            'delivery_time' => $request->delivery_time,
            'price' => $request->price,
            'image' => $filename,
        ]);

        return response()->json([ 'status' => true  , 'message' => 'Deal Update Successfully']);
    }

    public function dealDetail($request)
    {
        $customMsgs = [
            'deal_id.required' => 'Please Provide Deal ID',
        ];
        $validator = Validator::make($request->all(),
            [
                'deal_id' => 'required',
            ], $customMsgs
        );

        if ($validator->fails()) {
            return response()->json(['status' => false, 'message' => $validator->messages()->first()], 406);
        }

        $details = Deal::where('restaurant_id',Auth::id())
            ->where('id',$request->deal_id)->first();
        if (!$details){
            return response()->json(['status' => false, 'message' => "Deal not found"], 404);
        }
//        $images = [];
//        $array_images = explode('|',$details->image);
//        foreach($array_images as $image){
//            $images[] = asset($image);
//        }

        $data = [
            'id'=>$details->id,
            'restaurant_id'=>$details->restaurant_id,
            'name'=>$details->name,
            'description'=>$details->description,
            'price'=>$details->price,
            'delivery_time'=>$details->delivery_time,
            'rating'=>$details->rating,
            'images'=>asset($details->image),
            'status'=>$details->status,
        ];

        return response()->json([ 'status' => true ,'data'=>$data ], 200);
    }

    public function restaurantDealList($request)
    {

        $deals = Deal::where(['restaurant_id'=>Auth::id()])->get();


        $images = [];
        $records = [];
        foreach($deals as $deal){

//            $array_images = explode('|',$deal->image);
//            foreach($array_images as $image){
//                $images[] = asset($image);
//            }

            $data = [
                'id'=>$deal->id,
                'restaurant_id'=>$deal->restaurant_id,
                'category_id'=>$deal->category_id,
                'name'=>$deal->name,
                'description'=>$deal->description,
                'price'=>$deal->price,
                'delivery_time'=>$deal->delivery_time,
                'rating'=>$deal->rating,
                'images'=>asset($deal->image),
                'status'=>$deal->status,
            ];

            $records[] = $data;


        }
        return response()->json([ 'status' => true ,'data'=>$records ], 200);

    }

    public function deleteDeal($request)
    {
        $customMsgs = [
            'deal_id.required' => 'Please Provide Deal Id',
        ];
        $validator = Validator::make($request->all(),
            [
                'deal_id' => 'required',
            ], $customMsgs
        );

        if ($validator->fails()) {
            return response()->json(['status' => false, 'message' => $validator->messages()->first()], 406);
        }
        $products = Deal::where(['restaurant_id'=>Auth::id()])->where('id',$request->deal_id)->first();

        if(!$products){
            return response()->json(['status'=> true, 'message'=> 'Deal Not Found'], 404);
        }

        if(file_exists(public_path($products->image))){
            $img_del = unlink(public_path($products->image));
        }
        $products->delete();
        return response()->json([ 'status' => true ,'message'=> 'Deal Deleted Successfully' ], 200);
    }


}
