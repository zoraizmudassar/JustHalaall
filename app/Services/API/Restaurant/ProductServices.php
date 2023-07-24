<?php

namespace App\Services\API\Restaurant;

use App\Models\Cart;
use App\Models\Category;
use App\Models\Deal;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\Product;
use App\Models\ProductImage;
use App\Models\Restaurant;
use App\Models\WishList;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class ProductServices
{
    public function addProduct($request)
    {

        $customMsgs = [
            'name.required' => 'Please Provide Product Name',
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
                'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            ], $customMsgs
        );
        if ($validator->fails()) {
            return response()->json(['status' => 406, 'message' => $validator->messages()->first()], 200);
        }

        $categroy = Category::where('id',$request->category_id)->first();
        if(!$categroy){

            return response()->json([ 'status' => 404  , 'message' => 'Category id Not Found'],404);
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
                $folderName = "uploads/products";
                $file->move($folderName, $fileName);
                $path = $folderName . '/' . $fileName;
                $save_image = $path;

//                if (isset($path) && !empty($path)){
//                    if(file_exists(public_path($product->images))){
//                        $img_del = unlink(public_path($product->images));
//                    }
            }
        }



        $data = Product::create([
            'restaurant_id' => Auth::id(),
            'category_id' => $request->category_id,
            'name' => $request->name,
            'description' => $request->description,
            'delivery_time' => $request->delivery_time,
            'price' => $request->price,
            'images' => $save_image,
        ]);

        return response()->json([ 'status' => 200  , 'message' => 'Product Add Successfully'],200);

    }

    public function editProduct($request)
    {
        $customMsgs = [
            'product_id.required' => 'Please Provide Product Id',
            'name.required' => 'Please Provide Product Name',
            'description.required' => 'Please Provide Description',
            'price.required' => 'Please Provide Price',
            'category_id.required' => 'Please Provide Category',
            'delivery_time.required' => 'Please Provide Description',
            'image.required' => 'Please Provide Image',
        ];
        $validator = Validator::make($request->all(),
            [
                'product_id' => 'required',
                'name' => 'required',
                'description' => 'required',
                'price' => 'required|integer|min:0',
                'category_id' => 'required',
                'delivery_time' => 'required|date_format:H:i',
                'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            ], $customMsgs
        );
        if ($validator->fails()) {
            return response()->json(['status' => 0, 'message' => $validator->messages()->first()], 200);
        }

        $product =  Product::where('restaurant_id',Auth::id())->where('id',$request->product_id)->first();
        if(!$product){
            return response()->json([ 'status' => 404  , 'message' => 'Product id does not belong to you']);
        }

        $categroy = Category::where('id',$request->category_id)->first();
        if(!$categroy){

            return response()->json([ 'status' => 404  , 'message' => 'Category id Not Found'],404);
        }

        $save_image = $product->images;
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
                $folderName = "uploads/products";
                $file->move($folderName, $fileName);
                $path = $folderName . '/' . $fileName;
                $save_image = $path;

                if (isset($path) && !empty($path)){
                    if(file_exists(public_path($product->images))){
                        $img_del = unlink(public_path($product->images));
                    }
                }
            }
        }

        $product->update([
            'name' => $request->name,
            'description' => $request->description,
            'category_id' => $request->category_id,
            'delivery_time' => $request->delivery_time,
            'price' => $request->price,
            'images' => $save_image,
        ]);

        return response()->json([ 'status' => 200  , 'message' => 'Product Detail Update Successfully']);
    }
    public function addFeaturedProduct($request)
    {
        $customMsgs = [
            'name.required' => 'Please Provide Product Name',
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
                'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            ], $customMsgs
        );
        if ($validator->fails()) {
            return response()->json(['status' => 406, 'message' => $validator->messages()->first()], 200);
        }

        $categroy = Category::where('id',$request->category_id)->first();
        if(!$categroy){

            return response()->json([ 'status' => 404  , 'message' => 'Category id Not Found'],404);
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
                $folderName = "uploads/products";
                $file->move($folderName, $fileName);
                $path = $folderName . '/' . $fileName;
                $save_image = $path;

//                if (isset($path) && !empty($path)){
//                    if(file_exists(public_path($product->images))){
//                        $img_del = unlink(public_path($product->images));
//                    }
            }
        }



        $data = Product::create([
            'restaurant_id' => Auth::id(),
            'category_id' => $request->category_id,
            'name' => $request->name,
            'is_featured' => 1,
            'description' => $request->description,
            'delivery_time' => $request->delivery_time,
            'price' => $request->price,
            'images' => $save_image,
        ]);

        return response()->json([ 'status' => 200  , 'message' => 'Featured Product Add Successfully'],200);

    }

    public function editFeaturedProduct($request)
    {
        $customMsgs = [
            'product_id.required' => 'Please Provide Product Id',
            'name.required' => 'Please Provide Product Name',
            'description.required' => 'Please Provide Description',
            'price.required' => 'Please Provide Price',
            'category_id.required' => 'Please Provide Category',
            'delivery_time.required' => 'Please Provide Description',
            'image.required' => 'Please Provide Image',
        ];
        $validator = Validator::make($request->all(),
            [
                'product_id' => 'required',
                'name' => 'required',
                'description' => 'required',
                'price' => 'required|integer|min:0',
                'category_id' => 'required',
                'delivery_time' => 'required|date_format:H:i',
                'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            ], $customMsgs
        );
        if ($validator->fails()) {
            return response()->json(['status' => 0, 'message' => $validator->messages()->first()], 200);
        }

        $product =  Product::where('restaurant_id',Auth::id())->where('id',$request->product_id)->first();
        if(!$product){
            return response()->json([ 'status' => 404  , 'message' => 'Product Id Not Found']);
        }
        if($product->is_featured == 0){

            return response()->json([ 'status' => 404  , 'message' => 'This Product is not Featured Product' ]);
        }

        $categroy = Category::where('id',$request->category_id)->first();
        if(!$categroy){

            return response()->json([ 'status' => 404  , 'message' => 'Category id Not Found'],404);
        }

        $save_image = $product->images;
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
                $folderName = "uploads/products";
                $file->move($folderName, $fileName);
                $path = $folderName . '/' . $fileName;
                $save_image = $path;

                if (isset($path) && !empty($path)){
                    if(file_exists(public_path($product->images))){
                        $img_del = unlink(public_path($product->images));
                    }
                }
            }
        }

        $product->update([
            'name' => $request->name,
            'description' => $request->description,
            'category_id' => $request->category_id,
            'delivery_time' => $request->delivery_time,
            'price' => $request->price,
            'images' => $save_image,
        ]);

        return response()->json([ 'status' => 200  , 'message' => 'Product Detail Update Successfully']);

    }

    public function productDetails($request)
    {
        $customMsgs = [
            'product_id.required' => 'Please Provide Product Id',
        ];
        $validator = Validator::make($request->all(),
            [
                'product_id' => 'required',
            ], $customMsgs
        );

        if ($validator->fails()) {
            return response()->json(['status' => 406, 'message' => $validator->messages()->first()], 406);
        }

        $product = Product::where('restaurant_id',Auth::id())->where('id',$request->product_id)->first();

//        dd($product->images);

        if(!$product){

            return response()->json(['status'=> 404, 'message'=> 'product id does not belong to You'],404);
        }
        if ($product->is_featured == 0){
//            foreach ($product->images as $proimage){
//
//                $images[]  = $proimage->image;
//            }
            $data = [
                'product_id'=> $product->id,
                'category_id'=> $product->category_id,
                'product_name'=> $product->name,
                'product_description'=> $product->description,
                'price'=> $product->price,
                'delivery_time'=> $product->delivery_time,
                'images'=> $product->getimageAttribute($product->images),
            ];


            return response()->json(['status'=> 200, 'data' => $data],200);
        }
        return response()->json(['status'=> 404, 'message'=> 'products Empty'],404);


    }

    public function productList($request)
    {

        $products = Product::where(['restaurant_id'=>Auth::id()])->get();
//        dd($products);


        if(!$products){
            return response()->json(['status'=> 404, 'message'=> 'Product not have yet!'], 404);
        }

//        $images = [];
        $records = [];
        foreach($products as $product){
            $wishlist = WishList::where('product_id',$product->id)->where('user_id',$request->user_id)->count();
            if($wishlist>0){
                $wish = 1;
            }else{
                $wish = 0;
            }
                $data = [
                    'id'=>$product->id,
                    'restaurant_id'=>$product->restaurant_id,
                    'name'=>$product->name,
                    'description'=>$product->description,
                    'price'=>$product->price,
                    'delivery_time'=>$product->delivery_time,
                    'is_featured'=>$product->is_featured,
                    'rating'=>$product->rating,
                    'images'=>asset($product->images),
                    'status'=>$product->status,
                    'wishlist'=>$wish,
                ];

            $records[] = $data;
        }

        return response()->json([ 'status' => 200 ,'data'=>$records ], 200);


    }



    public function featuredProductDetails($request)
    {
        $customMsgs = [
            'product_id.required' => 'Please Provide Product Id',
        ];
        $validator = Validator::make($request->all(),
            [
                'product_id' => 'required',
            ], $customMsgs
        );

        if ($validator->fails()) {
            return response()->json(['status' => 406, 'message' => $validator->messages()->first()], 406);
        }

        $product = Product::where('restaurant_id',Auth::id())->where('id',$request->product_id)->first();

//        dd($product->images);

        if(!$product){

            return response()->json(['status'=> 404, 'message'=> 'product does not belong to You'],404);
        }
        if ($product->is_featured == 1){

            $data = [
                'message' =>'Featured Product list',
                'product_id'=> $product->id,
                'product_name'=> $product->name,
                'product_description'=> $product->description,
                'price'=> $product->price,
                'delivery_time'=> $product->delivery_time,
                'images'=> asset($product->images),
            ];


            return response()->json(['status'=> 200, 'data' => $data],200);
        }
        return response()->json(['status'=> 404, 'message'=> 'products Empty'],200);

    }

    public function featuredProductList($request)
    {

        // $products = Product::where(['restaurant_id'=>Auth::id()])->get();
        $products = Product::all();

        if(!$products){
            return response()->json(['status'=> 404, 'message'=> 'Product not have yet!'], 404);
        }

        $images = [];
        $records = [];
        foreach($products as $product){
            if ($product->is_featured == 1){


                $data = [
                    'id'=>$product->id,
                    'restaurant_id'=>$product->restaurant_id,
                    'category_id'=>$product->category_id,
                    'name'=>$product->name,
                    'description'=>$product->description,
                    'price'=>$product->price,
                    'delivery_time'=>$product->delivery_time,
                    'rating'=>$product->rating,
                    'images'=>asset($product->images),
                    'status'=>$product->status,
                ];

                $records[] = $data;
            }
//            else{
//                return response()->json([ 'status' => 404 ,'data'=>"There is no Feature product!" ], 404);
//            }


        }
        return response()->json([ 'status' => 200 ,'data'=>$records ], 200);
    }

    public function dashBoard($request)
    {

        $orders = OrderDetail::where('restaurant_id',$request->restuarant_id)->get();

        $total_orders = [];
        $prepared = 0;
        $rtc = 0;
        $dv = 0;
        foreach ($orders as $key => $order){
            $order_no = Order::find($order->order_id);
            $total_orders[$key]['id'] = $order->id;
            $total_orders[$key]['order_id'] = $order->order_id;
            $total_orders[$key]['order_number'] = $order_no->order_no;
            $total_orders[$key]['status'] = $order_no->status;
            if ($order_no->status == 'preparing'){
                $prepared += 1;
            }
            if ($order_no->status == 'make order on way'){
                $rtc += 1;
            }
            if ($order_no->status == 'complete'){
                $dv += 1;
            }
            $total_orders[$key]['payment_method'] = $order->payment_id;

            // $carts = Cart::where('restaurant_id',Auth::id())->with('restaurant','user')->get();

            // //if ($order->cart->restaurant_id == Auth::id()){
            //     foreach($carts as $key=> $cart){
            //         $total_orders[$key]['name'] = $cart->user->name;
            //         $total_orders[$key]['number'] = $cart->user->phone;
            //     }
            // //}
        }
        $order_priodics = [
            'Preparing' => $prepared,
            'Make Order On Way' => $rtc,
            'Order Complete' => $dv,
        ];

        $data = [
            'orders' => $total_orders,
            'order_counting' => $order_priodics,
        ];

        if (!empty($total_orders)){
            return response()->json([ 'status' => 200,'data'=>$data,'message'=> 'Order lists' ], 200);
        }else{
            return response()->json([ 'status' => 404,'message'=> 'Orders NOT found'], 404);
        }

    }

    public function deleteProduct($request)
    {
        $customMsgs = [
            'product_id.required' => 'Please Provide Product Id',
        ];
        $validator = Validator::make($request->all(),
            [
                'product_id' => 'required',
            ], $customMsgs
        );

        if ($validator->fails()) {
            return response()->json(['status' => 406, 'message' => $validator->messages()->first()], 406);
        }
        $products = Product::where(['restaurant_id'=>Auth::id()])->where('id',$request->product_id)->first();

        if(!$products){
            return response()->json(['status'=> 404, 'message'=> 'Product Not Found'], 404);
        }
        if(file_exists(public_path($products->image))){
            $img_del = unlink(public_path($products->images));
        }
        $products->delete();
        return response()->json([ 'status' => 200 ,'message'=> 'Product Deleted Successfully' ], 200);

    }

    public function deleteFeaturedProduct($request)
    {

        $customMsgs = [
            'product_id.required' => 'Please Provide Product Id',
        ];
        $validator = Validator::make($request->all(),
            [
                'product_id' => 'required',
            ], $customMsgs
        );

        if ($validator->fails()) {
            return response()->json(['status' => 406, 'message' => $validator->messages()->first()], 406);
        }
        $products = Product::where(['restaurant_id'=>Auth::id()])->where('id',$request->product_id)->where('is_featured',1)->first();

        if(!$products){
            return response()->json(['status'=> 404, 'message'=> 'Product Not Found'], 404);
        }
        if(file_exists(public_path($products->image))){
            $img_del = unlink(public_path($products->images));
        }
        $products->delete();
        return response()->json([ 'status' => 200 ,'message'=> 'Product Deleted Successfully' ], 200);
    }
}

