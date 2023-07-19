<?php

namespace App\Services\Products;

use App\Models\Category;
use App\Models\Product;
use App\Models\ProductImage;
use Illuminate\Support\Facades\Validator;

class ProductServices
{
    public function approved($request)
    {
        $products = Product::where('status','approved')->latest()->with('restaurant')->get();
        $categories = Category::latest()->get();
        return view('admin.products.approval',compact('products','categories'));
    }

    public function pending($request)
    {
        $products = Product::where('status','pending')->latest()->with('restaurant')->get();
        $categories = Category::latest()->get();
        return view('admin.products.pending',compact('products','categories'));
    }

    public function rejected($request)
    {
        $products = Product::where('status','rejected')->latest()->with('restaurant')->get();
        $categories = Category::latest()->get();
        return view('admin.products.rejected',compact('products','categories'));
    }

    public function update($request)
    {
//        dd($request->all());
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
        $user = Product::find($request->product_id);
        $user->status = $request->status;
        $update = $user->save();

        if ($update){
            return response()->json(['status' => 200,'message'=>'Status Change Successfully.']);
        }else{
            return response()->json(['status' => 404, 'message'=>'Status NOT Change']);
        }
    }

    public function delete($request)
    {
        $product = Product::find($request->data_id);
        if ($product){
            if (isset($product->images) && (!empty($product->images) || !is_null($product->images))){    //  check DB record exists or not
                if(file_exists(public_path($product->images))){    // check images exists in directory
                    $img_del = unlink(public_path($product->images));
                    $delete = $product->delete();
                }else{
                    $delete = $product->delete();
                }
            }else{
                $delete = $product->delete();
            }
            if ($delete){
                return response()->json([ 'status' => 200, 'message' => 'Record Deleted Successfully']);
            }
            else{
                return response()->json([ 'status' => 404, 'message' => 'Record NOT Deleted']);
            }
        }
    }
}
