<?php

namespace App\Services\Categories;

use App\Models\Category;
use App\Models\Restaurant;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class CategoryServices
{
    public function index($request)
    {
        $categories = Category::latest()->get();
        return view('admin.categories.index',compact('categories'));
    }

    public function create($request)
    {
        return view('admin.categories.create');
    }

    public function store($request)
    {
        $customMsgs = [
            'name.required' => 'Please Provide Category Name',
            'type.required' => 'Please Provide Category Type',
            'image.required' => 'Please Provide Image',
        ];
        $validator = Validator::make($request->all(),
            [
                'name' => 'required',
                'type' => 'required',
                'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            ], $customMsgs
        );
        if ($validator->fails()) {
            return response()->json(['status' => 0, 'message' => $validator->messages()->first()], 200);
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

                $folderName = "uploads/categories";
                $file->move($folderName, $fileName);
                $path = $folderName . '/' . $fileName;

            }
        }

        $data = Category::create([
            'name' => $request->name,
            'categoryable_type' => $request->type,
            'image' => !empty($path) ? $path :'',
        ]);

        return response()->json([ 'status' => 1, 'url'=>route('admin.category.index'), 'message' => 'Category Added Successfully']);
}

    public function update($request)
    {
        $customMsgs = [
            'name.required' => 'Please Provide Category Name',
            'type.required' => 'Please Provide Category Type',
            'image.required' => 'Please Provide Image',
        ];
        $validator = Validator::make($request->all(),
            [
                'name' => 'required',
                'type' => 'required',
                'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            ], $customMsgs
        );
        if ($validator->fails()) {
            return response()->json(['status' => 0, 'message' => $validator->messages()->first()], 200);
        }

        $category = Category::find($request->category_id);

        $file = $request->image;
        $save_image = $category->image;
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

                $folderName = "uploads/categories";
                $file->move($folderName, $fileName);
                $path = $folderName . '/' . $fileName;
                $save_image = $path;

                if (isset($path) && !empty($path)){
                    if(file_exists(public_path($category->image))){
                        $img_del = unlink(public_path($category->image));
                    }
                }
            }
        }
        $data = $category->update([
            'name' => $request->name,
            'categoryable_type' => $request->type,
            'image' => $save_image,
        ]);
        return response()->json([ 'status' => 1  , 'message' => ' Category Update Successfully']);

    }

    public function destroy($request)
    {
        $category = Category::find($request->data_id);
        if ($category){

            if (isset($category->image) && (!empty($category->image) || !is_null($category->image))){    //  check DB record exists or not
                if(file_exists(public_path($category->image))){    // check image exists in directory
                    $img_del = unlink(public_path($category->image));
                    $category->delete();
                    return response()->json([ 'status' => 1  , 'message' => ' Category Delete Successfully']);

                }else{
                    $category->delete();
                    return response()->json([ 'status' => 1  , 'message' => ' Category Delete Successfully']);

                }
            }else{
                $category->delete();
                return response()->json([ 'status' => 1  , 'message' => ' Category Delete Successfully']);

            }
        }
    }

    public function changeStatus($request)
    {
        $user = Category::find($request->user_id);
        $user->status = $request->status;
        $user->save();

        return response()->json(['status' => 1  ,'message'=>'Status Change Successfully.']);
    }
}
