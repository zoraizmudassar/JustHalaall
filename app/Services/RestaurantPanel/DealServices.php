<?php

namespace App\Services\RestaurantPanel;

use App\Models\Deal;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class DealServices
{
    public function create($request)
    {
        return view('restaurant.deals.create');
    }
//    public function approved($request)
//    {
//        $deals = Deal::where('restaurant_id',Auth::id())->where('status','approved')->latest()->with('restaurant')->get();
//        return view('restaurant.deals.index',compact('deals'));
//    }
//    public function rejected($request)
//    {
//        $deals = Deal::where('restaurant_id',Auth::id())->where('status','rejected')->latest()->with('restaurant')->get();
//        return view('restaurant.deals.rejected',compact('deals'));
//    }
//    public function pending($request)
//    {
//        $deals = Deal::where('restaurant_id',Auth::id())->where('status','pending')->latest()->with('restaurant')->get();
//        return view('restaurant.deals.pending',compact('deals'));
//    }
    public function enable($request)
    {
        $deals = Deal::where('restaurant_id',Auth::id())->where(['status'=>"1"])->latest()->with('restaurant')->get();
        return view('restaurant.deals.enable',compact('deals'));
    }
    public function disable($request)
    {
        $deals = Deal::where('restaurant_id',Auth::id())->where(['status'=>"0"])->latest()->with('restaurant')->get();
        return view('restaurant.deals.disable',compact('deals'));
    }

    public function store($request)
    {
        $customMsgs = [
            'name.required' => 'Please Provide Deal Name',
            'description.required' => 'Please Provide Description',
            'price.required' => 'Please Provide Price',
            'category_id.required' => 'Please Provide Category',
            'delivery_time.required' => 'Please Provide Delivery Time',
            'image.required' => 'Please Provide Image',
        ];
        $validator = Validator::make($request->all(),
            [
                'name' => 'required',
                'description' => 'required',
                'price' => 'required|integer|min:0',
                'category_id' => 'required',
                'delivery_time' => 'required',
                'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            ], $customMsgs
        );
        if ($validator->fails()) {
            return response()->json(['status' => 404, 'message' => $validator->messages()->first()]);
        }
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
                $folderName = "uploads/deals/";
                $file->move($folderName, $fileName);
                $path = $folderName . '/' . $fileName;
                $save_image = $path;

            }
        }

        $data = Deal::create([
            'restaurant_id' => Auth::id(),
            'category_id' => $request->category_id,
            'name' => $request->name,
            'description' => $request->description,
            'price' => $request->price,
            'delivery_time' => $request->delivery_time,
            'image' => $save_image,
        ]);

        if ($data){
            return response()->json([ 'status' => 200, 'url'=>route('restaurants.deal.pending'), 'message' => ' Deal Added Successfully']);
        }else{
            return response()->json([ 'status' => 404, 'message' => ' Deal NOT Added']);
        }
    }

    public function pending($request)
    {
        $deals = Deal::where('restaurant_id',Auth::id())->get();
        return view('restaurant.deals.pending',compact('deals'));
    }
    public function changeStatus($request)
    {

        $deal = Deal::find($request->deal_id);
        $deal->status = $request->status;
        $save = $deal->save();

        if ($save){
            return response()->json(['status' => 1,'message'=>'Status Change Successfully']);
        }else{
            return response()->json(['status' => 0,'message'=>'Status NOT Change']);
        }

    }
    public function update($request)
    {


        $customMsgs = [
            'name.required' => 'Please Provide Product Name',
            'description.required' => 'Please Provide Description',
            'price.required' => 'Please Provide Price',
            'category_id.required' => 'Please Provide Category',
            'delivery_time.required' => 'Please Provide Delivery Time',
            'image.required' => 'Please Provide Image',
        ];
        $validator = Validator::make($request->all(),
            [
                'name' => 'required',
                'description' => 'required',
                'price' => 'required|integer|min:0',
                'category_id' => 'required',
                'delivery_time' => 'required|integer|min:0',
                'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            ], $customMsgs
        );
        if ($validator->fails()) {
            return response()->json(['status' => 0, 'message' => $validator->messages()->first()], 200);
        }

        $product =  Deal::findOrFail($request->product_id);

        $save_image = $product->image;
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
                $folderName = "uploads/deals/";
                $file->move($folderName, $fileName);
                $path = $folderName . '/' . $fileName;
                $save_image = $path;

                if (isset($path) && !empty($path)){
                    if(file_exists(public_path($product->image))){
                        $img_del = unlink(public_path($product->image));
                    }
                }
            }
        }

        $product->update([
            'name' => $request->name,
            'category_id' => $request->category_id,
            'description' => $request->description,
            'delivery_time' => $request->delivery_time,
            'price' => $request->price,
            'image' => $save_image,
        ]);

        return response()->json([ 'status' => 200  , 'message' => 'Deal Update Successfully']);
    }
    public function destroy($request)
    {
        $product = Deal::where(['id' => $request->data_id])->first();
        if ($product) {

            if (isset($product->image) && (!empty($product->image) || !is_null($product->image))) {    //  check DB record exists or not
                if (file_exists(public_path($product->image))) {    // check image exists in directory
                    $img_del = unlink(public_path($product->image));
                    $product->delete();
                } else {
                    $product->delete();
                }
            } else {
                $product->delete();
            }

            return response()->json(['status' => 1, 'message' => 'Deal Deleted Successfully']);
        }
    }
}
