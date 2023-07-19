<?php

namespace App\Http\Controllers\Admin\Deals;

use App\Http\Controllers\Controller;
use App\Services\Deals\DealServices;
use Illuminate\Http\Request;

class DealController extends Controller
{
    public function __construct()
    {
        return $this->middleware('auth:admin');
    }
    public function form(Request $request,DealServices $dealServices)
    {
        return $dealServices->form($request);
    }

    public function approved(Request $request,DealServices $dealServices)
    {
        return $dealServices->approved($request);
    }
    public function rejected(Request $request,DealServices $dealServices)
    {
        return $dealServices->rejected($request);
    }
    public function pending(Request $request,DealServices $dealServices)
    {
        return $dealServices->pending($request);
    }


    public function changeStatus(Request $request,DealServices $dealServices)
    {
        return $dealServices->changeStatus($request);
    }

    public function destroy(Request $request,DealServices $dealServices)
    {
        return $dealServices->destroy($request);
    }
}
