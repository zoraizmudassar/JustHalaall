<?php

namespace App\Services\RestaurantPanel;

use App\Models\Product;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class ProductServices
{
    public function create($request)
    {
        return view('restaurant.products.create');
    }
    public function rejected($request)
    {
        $products = Product::where('restaurant_id',Auth::id())->where('status','rejected')->latest()->with('restaurant')->get();
        $status = 'Rejected';
        return view('restaurant.products.pending',compact('products','status'));
    }
    public function approved($request)
    {
        $products = Product::where('restaurant_id',Auth::id())->where('status','approved')->latest()->with('restaurant')->get();
        $status = 'Approved';
        return view('restaurant.products.pending',compact('products','status'));
    }
    public function pending($request)
    {
        $products = Product::where('restaurant_id',Auth::id())->where('status','pending')->latest()->with('restaurant')->get();
        $status = 'Pending';
        return view('restaurant.products.pending',compact('products','status'));
    }

    public function store($request)
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
                'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            ], $customMsgs
        );
        if ($validator->fails()) {
            return response()->json(['status' => 0, 'message' => $validator->messages()->first()], 200);
        }
        $path = '';
        $file = $request->image;
        if($request->hasFile('image')){
            $fileName = $file->getClientOriginalName();
            $explodeImage = explode('.', $fileName);
            $fileName = $explodeImage[0];
            $extension = end($explodeImage);
            $fileName = time() . "-" . $fileName . "." . $extension;
            $imageExtensions = ['JPG', 'JPEG', 'PNG', 'jpg', 'jpeg', 'png'];
            if(in_array($extension, $imageExtensions)){
                $folderName = "uploads/products";
                $file->move($folderName, $fileName);
                $path = $folderName . '/' . $fileName;

            }else{
                $notification = array(
                    'message' => 'Image should be in JPG or PNG and JPEG',
                    'alert-type' => 'info'
                );
                return redirect()->back()->withInput($request->all())->with($notification);
            }
        }

        $data = Product::create([
            'restaurant_id' => Auth::id(),
            'category_id' => $request->category_id,
            'name' => $request->name,
            'description' => $request->description,
            'delivery_time' => $request->delivery_time,
            'price' => $request->price,
            'images' => $path,
        ]);
        $notification = array(
            'message' => 'Product Created Successfully',
            'alert-type' => 'success'
        );
        if($data){
            $returnArray = array(
                'value' => 1,
                'url' => route('restaurants.product.pending')
            );
            return response()->json($returnArray);
        }
        else{
            $value = 0;
            return response()->json($value);
        }
        return redirect()->route('restaurants.product.pending')->with($notification); 

    }




    public function update($request)
    {

//dd($request->all());
        $customMsgs = [
            'name.required' => 'Please Provide Product Name',
            'description.required' => 'Please Provide Description',
            'price.required' => 'Please Provide Price',
            'category_id.required' => 'Please Provide Category',
            'delivery_time.required' => 'Please Provide Description',
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

        $product =  Product::findOrFail($request->product_id);

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

    public function changeStatus($request)
    {
        $user = Product::find($request->user_id);
        $user->is_available = $request->status;
        $user->save();

        return response()->json(['status' => 1  ,'message'=>'Status Change Successfully.']);

    }

    public function changeFeature($request)
    {
        $user = Product::find($request->user_id);
        $user->is_featured = $request->status;
        $user->save();
        return response()->json(['status' => 1  ,'message'=>'Feature Status Change Successfully.']);
    }

    public function productDetail($request)
    {
        dd($request->all());
        $data = Product::find($request->id);
        return response()->json(['status' => 1  ,'data'=> $data]);
    }

    public function destroy($request)
    {
        $product = Product::where(['id' => $request->data_id])->first();
        if ($product) {

            if (isset($product->images) && (!empty($product->images) || !is_null($product->images))) {    //  check DB record exists or not
                if (file_exists(public_path($product->images))) {    // check image exists in directory
                    $img_del = unlink(public_path($product->images));
                    $product->delete();
                    return response()->json(['status' => 1, 'message' => 'Product Deleted Successfully']);

                } else {
                    $product->delete();
                    return response()->json(['status' => 1, 'message' => 'Product Deleted Successfully']);

                }
            } else {
                $product->delete();
                return response()->json(['status' => 1, 'message' => 'Product Deleted Successfully']);

            }

//            return response()->json(['status' => 200, 'message' => 'Product Deleted Successfully']);
        }
    }
}
