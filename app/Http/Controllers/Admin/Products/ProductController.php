<?php

namespace App\Http\Controllers\Admin\Products;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Services\Products\ProductServices;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function __construct()
    {
        return $this->middleware('auth:admin');
    }

    public function approved(Request $request,ProductServices $productServices)
    {
        return $productServices->approved($request);
    }

    public function pending(Request $request,ProductServices $productServices)
    {
        return $productServices->pending($request);
    }

    public function rejected(Request $request,ProductServices $productServices)
    {
        return $productServices->rejected($request);
    }

    public function update(Request $request,ProductServices $productServices)
    {
        return $productServices->update($request);
    }

    public function changeStatus(Request $request,ProductServices $productServices)
    {
        return $productServices->changeStatus($request);
    }

    public function delete(Request $request,ProductServices $productServices)
    {
        return $productServices->delete($request);
    }
}
