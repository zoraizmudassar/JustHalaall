<?php

namespace App\Services\API\Restaurant;

use App\Models\Category;

class CategoryServices
{
    public function list()
    {
        $category = Category::all();
//        $category = ;
        foreach ($category as $cat){

            $data[] = [

                'category_id' => $cat->id,
                'category_name' => $cat->name,
                'category_type' => $cat->categoryable_type,
                'image' => asset($cat->image),
//                'status' => $cat->status
            ];
        }

        return response()->json([ 'status' => 200 ,'data'=>$data ], 200);
    }
}
