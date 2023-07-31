<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    public function __construct()
    {
        return $this->middleware("auth");
    }

    public function index()
    {
        $query = 'SELECT order_details.*, orders.order_no, orders.status,orders.payment_type,
        orders.order_place_date as order_date, restaurants.name as restaurant FROM orders
        JOIN order_details ON order_details.order_id = orders.id
        JOIN restaurants ON order_details.restaurant_id = restaurants.id WHERE orders.user_id = '.Auth()->user()->id.'';
        $orders = DB::select(DB::raw($query));
        return view('web.orders',compact('orders'));
    }

    public function indexv1()
    {
        $query = 'SELECT order_details.*, orders.order_no, orders.status,orders.payment_type,
        orders.order_place_date as order_date, restaurants.name as restaurant FROM orders
        JOIN order_details ON order_details.order_id = orders.id
        JOIN restaurants ON order_details.restaurant_id = restaurants.id WHERE orders.user_id = '.Auth()->user()->id.'';
        $orders = DB::select(DB::raw($query));
        return view('website.orders',compact('orders'));
    }
}
