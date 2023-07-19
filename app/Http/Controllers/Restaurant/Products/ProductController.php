<?php

namespace App\Http\Controllers\Restaurant\Products;

use App\Http\Controllers\Controller;
use App\Services\RestaurantPanel\ProductServices;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:restaurant');
    }
    public function create(Request $request,ProductServices $productServices)
    {
        return $productServices->create($request);
    }
    public function rejected(Request $request,ProductServices $productServices)
    {
        return $productServices->rejected($request);
    }

        public function approved(Request $request,ProductServices $productServices)
        {
            return $productServices->approved($request);
        }
        public function pending(Request $request,ProductServices $productServices)
        {
            return $productServices->pending($request);
        }

    public function store(Request $request,ProductServices $productServices)
    {
        return $productServices->store($request);
        }
        public function update(Request $request,ProductServices $productServices)
        {
            return $productServices->update($request);
        }

        public function changeStatus(Request $request,ProductServices $productServices)
        {
            return $productServices->changeStatus($request);
        }

    public function destroy(Request $request,ProductServices $productServices)
    {
        return $productServices->destroy($request);
        }
}
