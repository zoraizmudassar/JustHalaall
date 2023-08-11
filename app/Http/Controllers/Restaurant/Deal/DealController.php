<?php

namespace App\Http\Controllers\Restaurant\Deal;

use App\Http\Controllers\Controller;
use App\Services\RestaurantPanel\DealServices;
use Illuminate\Http\Request;

class DealController extends Controller
{
    public function __construct()
    {
        return $this->middleware('auth:restaurant');
    }

    public function create(Request $request,DealServices $dealServices)
    {
        return $dealServices->create($request);
    }

    public function store(Request $request,DealServices $dealServices)
    {
        return $dealServices->store($request);
    }

    public function pending(Request $request,DealServices $dealServices)
    {
        return $dealServices->pending($request);
    }

    public function approved(Request $request,DealServices $dealServices)
    {
        return $dealServices->approved($request);
    }

    public function rejected(Request $request,DealServices $dealServices)
    {
        return $dealServices->rejected($request);
    }

    public function enable(Request $request,DealServices $dealServices)
    {
        return $dealServices->enable($request);
    }

    public function disable(Request $request,DealServices $dealServices)
    {
        return $dealServices->disable($request);
    }

    public function dealDetail(Request $request,DealServices $dealServices)
    {
        return $dealServices->dealDetail($request);
    }
    
    public function changeStatus(Request $request,DealServices $dealServices)
    {
        return $dealServices->changeStatus($request);
    }
    public function update(Request $request,DealServices $dealServices)
    {
        return $dealServices->update($request);
    }
    public function destroy(Request $request,DealServices $dealServices)
    {
        return $dealServices->destroy($request);
    }
}
