<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use PDF;
use Carbon\Carbon;

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
        // $orders = DB::table('orders')
        // ->join('order_details', 'order_details.order_id', '=', 'orders.id')
        // ->join('restaurants', 'order_details.restaurant_id', '=', 'restaurants.id')
        // ->select('order_details.*', 'orders.order_no', 'orders.status', 'orders.payment_type', 'orders.order_place_date as order_date', 'restaurants.name as restaurant')
        // ->where('orders.user_id', Auth::user()->id)
        // ->get();

        $orders = Order::where('user_id',Auth()->user()->id)->where('status', '!=' , 'deleted')->with('orderDetails')->get();
        return view('website.order',compact('orders'));
    }

    public function Pdf($id)
    {
        $orders = Order::where('id', $id)->with('orderDetails')->get();
        $carbonDate = Carbon::parse($orders[0]['order_place_date']);
        $formattedDate = $carbonDate->format('j M Y');
        $data = [
            'name' => $orders[0]['name'],
            'restaurant_name' => $orders[0]['orderDetails']['restaurant_name']['name'],
            'email' => $orders[0]['email'],
            'address' => $orders[0]['address'],
            'phone' => $orders[0]['phone'],
            'order_no' => $orders[0]['order_no'],
            'order_place_date' => $formattedDate,
            'discount' => $orders[0]['discount'],
            'total' => $orders[0]['total'],
            'status' => $orders[0]['status'],
            'item' => $orders[0]->orderDetails->product_name['name'],
        ];
        $pdf = PDF::loadView('myPDF', $data);
        $time = now()->format('H_i_s');
        return $pdf->download($orders[0]['order_no'].' Halaall Food.pdf');
    }

    public function clearOrderHistory(){
        $orders1 = Order::where('user_id', Auth()->user()->id)->where('status', '!=', 'deleted')->get();
            if(count($orders1) > 0){
                 $orders = Order::where('user_id', Auth()->user()->id)->update(['status' => 'deleted']);
                  return response()->json([
                    'status' => true,
                    'message' => 'Order history cleared successfully',
                ], 200);
            } 
            else{
                return response()->json([
                    'status' => false,
                    'message' => 'No Order Found',
                ], 404);
            }
    }
}
