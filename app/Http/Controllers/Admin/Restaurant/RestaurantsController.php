<?php

namespace App\Http\Controllers\Admin\Restaurant;

use App\Http\Controllers\Controller;
use App\Models\Restaurant;
use App\Services\Restaurant\RestaurantServices;
use Illuminate\Http\Request;

class RestaurantsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function approved(RestaurantServices $restaurantServices)
    {
        return $restaurantServices->approved();
    }
    public function restaurant(RestaurantServices $restaurantServices)
    {
        return $restaurantServices->restaurant();
    }   
    public function week(RestaurantServices $restaurantServices)
    {
        return $restaurantServices->week();
    }    
    public function report($id, RestaurantServices $restaurantServices)
    {
        return $restaurantServices->report($id);
    }    
    public function weeklyReport($start, $end, $id,  RestaurantServices $restaurantServices)
    {
        return $restaurantServices->weeklyReport($start, $end, $id);
    }        
    public function weeklyReportData(Request $request, RestaurantServices $restaurantServices)
    {
        return $restaurantServices->weeklyReportData($request);
    }
    public function changeStatus1(Request $request,RestaurantServices $restaurantServices)
    {
        return $restaurantServices->changeStatus1($request);
    }            
    public function rejected(RestaurantServices $restaurantServices)
    {
        return $restaurantServices->rejected();
    }

    public function store(Request $request,RestaurantServices $restaurantServices)
    {
        return $restaurantServices->store($request);
    }
    public function form(Request $request,RestaurantServices $restaurantServices)
    {
        return $restaurantServices->form();
    }

    public function update(Request $request,RestaurantServices $restaurantServices)
    {
        return $restaurantServices->update($request);
    }

    public function destroy(Request $request,RestaurantServices $restaurantServices)
    {
        return $restaurantServices->destroy($request);
    }

    public function changeStatus(Request $request,RestaurantServices $restaurantServices)
    {
        return $restaurantServices->changeStatus($request);
    }

    public function pending(Request $request,RestaurantServices $restaurantServices)
    {
        return $restaurantServices->pending($request);
    }
}
