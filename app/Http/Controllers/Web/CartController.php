<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\Product;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function index(){
        $cartSum = 0;
        $cartData = Cart::where('user_id',Auth()->user()->id)->get();
        $totalItem  = Cart::where('user_id',Auth()->user()->id)->sum('quantity');
        foreach($cartData as $item){
            $cartSum += $item->unit_price * $item->quantity;
        }
        return view('web/cart',compact('cartData','totalItem','cartSum'));
    }

    public function indexv1(){
        $cartSum = 0;
        $cartData = Cart::where('user_id',Auth()->user()->id)->get();
        $totalItem  = Cart::where('user_id',Auth()->user()->id)->sum('quantity');
        foreach($cartData as $item){
            $cartSum += $item->unit_price * $item->quantity;
        }
        return view('website.cart',compact('cartData','totalItem','cartSum'));
    }

    public function store(Request $request){
        $check = Cart::where('user_id',Auth()->user()->id)->where('product_id',$request->product_id)->first();
        $product = Product::find($request->product_id);
        if(isset($check)){
            $check->quantity = $check->quantity+1;
            $check->update();
            return back();
        }else{
            $cart = new Cart;
            $cart->user_id = Auth()->user()->id;
            $cart->restaurant_id = $product->restaurant_id;
            $cart->product_id = $request->product_id;
            $cart->unit_price = $product->price;
            $cart->quantity = 1;
            $cart->status = 'pending';
            $cart->save();
            return response();
        }
    }

    public function storev1(Request $request){
        $check = Cart::where('user_id',Auth()->user()->id)->where('product_id',$request->product_id)->first();
        $product = Product::find($request->product_id);
        if(isset($check)){
            $check->quantity = $check->quantity+1;
            $check->update();
            return back();
        }else{
            $cart = new Cart;
            $cart->user_id = Auth()->user()->id;
            $cart->restaurant_id = $product->restaurant_id;
            $cart->product_id = $request->product_id;
            $cart->unit_price = $product->price;
            $cart->quantity = 1;
            $cart->status = 'pending';
            $cart->save();
            return response();
        }
    }

    public function removeCart($id){
        $cart = Cart::find($id);
        $cart->delete();
        return back();
    }

    public function removeCartv1($id){
        $cart = Cart::find($id);
        $cart->delete();
        return back();
    }
}
