<?php

namespace App\Http\Controllers\API\Restaurant;

use App\Http\Controllers\Controller;
use App\Services\API\Restaurant\ProductServices;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function addProduct(Request $request,ProductServices $productServices)
    {
        return $productServices->addProduct($request);
    }

    public function editProduct(Request $request,ProductServices $productServices)
    {
        return $productServices->editProduct($request);
    }

    public function productDetails(Request $request,ProductServices $productServices)
    {
        return $productServices->productDetails($request);
    }

    public function productList(Request $request,ProductServices $productServices)
    {
        return $productServices->productList($request);
    }
    public function addFeaturedProduct(Request $request,ProductServices $productServices)
    {
        return $productServices->addFeaturedProduct($request);
    }

    public function editFeaturedProduct(Request $request,ProductServices $productServices)
    {
        return $productServices->editFeaturedProduct($request);
    }
    public function featuredProductDetails(Request $request,ProductServices $productServices)
    {
        return $productServices->featuredProductDetails($request);
    }

    public function dashBoard(Request $request,ProductServices $productServices)
    {
        return $productServices->dashBoard($request);
    }

    public function featuredProductList(Request $request,ProductServices $productServices)
    {

        return $productServices->featuredProductList($request);
    }

    public function deleteProduct(Request $request,ProductServices $productServices)
    {
        return $productServices->deleteProduct($request);
    }

    public function deleteFeaturedProduct(Request $request,ProductServices $productServices)
    {
        return $productServices->deleteFeaturedProduct($request);
    }

}
