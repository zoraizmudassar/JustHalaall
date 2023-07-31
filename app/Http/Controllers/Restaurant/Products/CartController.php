<?php

namespace App\Http\Controllers\Restaurant\Products;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Services\API\Customer\CartService ;
use Illuminate\Http\Request;
use App\Models\Product;

class CartController extends Controller
{
    public $cartService;

    public function __construct(CartService $cartService){
        $this->cartService = $cartService;
    }
    public function cartTotal(Request $request){
        return $this->cartService->cartTotal($request);
    }
    public function cartList(Request $request){
        return $this->cartService->cartList($request);
    }

    public function addToCart(Request $request){
        return $this->cartService->addToCart($request);
    }

    public function removeFromCart(Request $request){
        return $this->cartService->removeFromCart($request);
    }

    public function wishList(Request $request){
        return $this->cartService->wishList($request);
    }

    public function addToWishList(Request $request){
        return $this->cartService->addToWishList($request);
    }

    public function removeToWishList(Request $request, $wishListId){
        return $this->cartService->removeToWishList($request,$wishListId);
    }

    public function orderList(Request $request, $order_status=''){
        return $this->cartService->orderList($request, $order_status);
    }

    public function checkout(Request $request){
        
        return $this->cartService->checkout($request);
    }

    public function stripePayment(Request $request, $amount, CartService $cartService){
        return $cartService->stripePayment($request, $amount);
    }

    public function updateOrderStatus(Request $request){
        return $this->cartService->updateOrderStatus($request);
    }

    public function getDeliveryCharges(Request $request){
        return $this->cartService->getDeliveryCharges($request);
    }
    public function getcart(){
        $cartSum = 0;
        $cartData = Cart::where('user_id',Auth()->user()->id)->get();
        $totalItem  = Cart::where('user_id',Auth()->user()->id)->sum('quantity');
        foreach($cartData as $item){
            $cartSum += $item->price * $item->quantity;
        }
        return view('web/cart',compact('cartData','totalItem','cartSum'));
    }
    public function removeCart($id){
        $cart = Cart::find($id);
        $cart->delete();
        return back();
    }
    public function updateCart(Request $request,$id){
        $cart = Cart::find($id);
        $cart->quantity = $request->qty;
        $cart->update();
        return back();
    }
    public function updateCartv1(Request $request,$id){
        $cart = Cart::find($id);
        $cart->quantity = $request->qty;
        $cart->update();
        return back();
    }

}

