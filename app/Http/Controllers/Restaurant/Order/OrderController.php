<?php

namespace App\Http\Controllers\Restaurant\Order;

use App\Http\Controllers\Controller;
use App\Services\RestaurantPanel\OrderServices;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function __construct()
    {
        return $this->middleware('auth:restaurant');
    }

    public function pending(Request $request,OrderServices $orderServices)
    {
        return $orderServices->pending($request);
    }

    public function accepted(Request $request,OrderServices $orderServices)
    {
        return $orderServices->accepted($request);
    }
    public function onWay(Request $request,OrderServices $orderServices)
    {
        return $orderServices->onWay($request);
    }
    public function rejected(Request $request,OrderServices $orderServices)
    {
        return $orderServices->rejected($request);
    }

    public function complete(Request $request,OrderServices $orderServices)
    {
        return $orderServices->complete($request);
    }
//
    public function changeStatus(Request $request,OrderServices $orderServices)
    {
        return $orderServices->changeStatus($request);
    }
//
    public function acceptedStatus(Request $request,OrderServices $orderServices)
    {
        return $orderServices->acceptedStatus($request);
    }

    public function orderDetails($id, OrderServices $orderServices)
    {
        return $orderServices->orderDetails($id);
    }
}
