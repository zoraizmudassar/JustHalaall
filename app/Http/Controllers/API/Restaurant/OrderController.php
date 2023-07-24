<?php

namespace App\Http\Controllers\API\Restaurant;

use App\Http\Controllers\Controller;
use App\Services\API\Restaurant\OrderServices;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function pendingOrders(OrderServices $orderServices, Request $request)
    {
        return $orderServices->pendingOrders($request);
    }
    public function orderDetail(OrderServices $orderServices, Request $request)
    {
        return $orderServices->orderDetail($request);
    }
    public function orderList(OrderServices $orderServices, Request $request)
    {
        return $orderServices->orderList($request);
    }
    public function history(OrderServices $orderServices, Request $request)
    {
        return $orderServices->history($request);
    }
    public function historyOnlinePayment(OrderServices $orderServices, Request $request)
    {
        return $orderServices->historyOnlinePayment($request);
    }
    public function historyCOD(OrderServices $orderServices, Request $request)
    {
        return $orderServices->historyCOD($request);
    }

    public function orderAccept(Request $request,OrderServices $orderServices)
    {
        return $orderServices->orderAccept($request);
    }
    public function onWay(Request $request,OrderServices $orderServices)
    {
        return $orderServices->onWay($request);
    }
    public function orderReject(Request $request,OrderServices $orderServices)
    {
        return $orderServices->orderReject($request);
    }
    public function orderStatusChange(Request $request,OrderServices $orderServices)
    {
        return $orderServices->orderStatusChange($request);
    }
}
