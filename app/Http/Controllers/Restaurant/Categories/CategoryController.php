<?php

namespace App\Http\Controllers\Restaurant\Categories;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Services\Categories\CategoryServices;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CategoryController extends Controller
{
    public function __construct()
    {
        return $this->middleware('auth:restaurant');
    }

    public function index()
    {
        $categories = Category::latest()->get();
        return view('restaurant.categories.index',compact('categories'));
    }

    public function store(Request $request)
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
            return response()->json(['status' => 401, 'message' => $validator->messages()->first()], 404);
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

        return response()->json([ 'status' => 200  , 'message' => 'Category Added Successfully']);
    }

    public function update(Request $request,CategoryServices $categoryServices)
    {
        return $categoryServices->update($request);
    }

    public function destroy(Request $request,CategoryServices $categoryServices)
    {
        return $categoryServices->destroy($request);
    }

    public function changeStatus(Request $request,CategoryServices $categoryServices)
    {
        return $categoryServices->changeStatus($request);
    }
}
