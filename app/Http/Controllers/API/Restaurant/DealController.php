<?php

namespace App\Http\Controllers\API\Restaurant;

use App\Http\Controllers\Controller;
use App\Services\API\Restaurant\DealServices;
use Illuminate\Http\Request;

class DealController extends Controller
{
    public function addNewDeal(Request $request,DealServices $dealServices)
    {
        return $dealServices->addNewDeal($request);
    }

    public function editDeal(Request $request,DealServices $dealServices)
    {
        return $dealServices->editDeal($request);
    }
    public function dealDetail(Request $request,DealServices $dealServices)
    {
        return $dealServices->dealDetail($request);
    }
    public function restaurantDealList(Request $request,DealServices $dealServices)
    {
        return $dealServices->restaurantDealList($request);
    }
//
    public function deleteDeal(Request $request,DealServices $dealServices)
    {
        return $dealServices->deleteDeal($request);
    }
}
