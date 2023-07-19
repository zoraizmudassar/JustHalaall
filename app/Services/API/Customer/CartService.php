<?php

namespace App\Services\API\Customer;

use App\Http\Resources\OrderResource;
use App\Http\Resources\CartResource;
use App\Http\Resources\WishListResource;
use App\Http\Traits\ApiResponse;
use App\Http\Traits\ApiValidation;
use App\Models\Cart;
use App\Models\Order;
use App\Models\OrderCart;
use App\Models\OrderDetail;
use App\Models\Restaurant;
use App\Models\Product;
use App\Models\StripeInitiatePayment;
use App\Models\WishList;
use Carbon\Carbon;
use Illuminate\Support\Facades\Validator;
use Stripe\Customer;
use Stripe\EphemeralKey;
use Stripe\PaymentIntent;
use Stripe;

class CartService
{
    use ApiResponse, ApiValidation;

    public function cartList($request)
    {
        $carts = Cart::where('user_id', getApiLoggedUserId($request))
            ->where('status', Cart::PENDING_CART_STATUS)
            ->get();
        return  $this->successResponse(CartResource::collection($carts));
    }

    public function addToCart($request)
    {
        $validationStatus = $this->validateData($request, 'add_to_cart');
        if (!$validationStatus) {
            return $validationStatus;
        } else {
            $restaurant = Restaurant::find($request->restaurant_id);
            if (!$restaurant) {
                return $this->errorMessage('Hotel not found');
            }

            $product = Product::find($request->product_id);
            if (!$product) {
                return $this->errorMessage('Product not found');
            }
            $restaurant_id = $request->restaurant_id;
            $product_id = $request->product_id;
            $unit_price = $product->price;
            $quantity = $request->quantity;;
            $user_id = getApiLoggedUserId($request);



            $cart = Cart::where('user_id', $user_id)
                ->where('restaurant_id', $restaurant_id)
                ->where('product_id', $product_id)->first();
            if ($cart) {
                $cart->quantity = $cart->quantity + $quantity;
                $cart->unit_price = $unit_price;
                $cart->save();
            } else {
                $cart = new Cart();
                $cart->user_id = $user_id;
                $cart->restaurant_id = $restaurant_id;
                $cart->product_id = $product_id;
                $cart->unit_price = $unit_price;
                $cart->quantity = $quantity;
                $cart->save();
            }
            return $this->successResponse(new CartResource($cart));
        }
    }

    public function removeFromCart($request)
    {
        $validationStatus = $this->validateData($request, 'remove_from_cart');
        if (!$validationStatus) {
            return $validationStatus;
        } else {
            $user_id = getApiLoggedUserId($request);

            $cart = Cart::where('product_id', $request->product_id)->where('user_id', $request->user_id)->first();
            if (!$cart) {
                return $this->errorMessage('Cart not found');
            }
            $cart->delete();
            return $this->successResponse([], 'Remove from cart');
        }
    }

    public function wishList($request)
    {
        $user_id = getApiLoggedUserId($request);
        $wishLists = WishList::where('user_id', $user_id)->get();
        return $this->successResponse(WishListResource::collection($wishLists));
    }

    public function addToWishList($request)
    {
        $validationStatus = $this->validateData($request, 'add_to_wishlist');
        if (!$validationStatus) {
            return $validationStatus;
        } else {
            $user_id = $request->user_id;
            $restaurant_id = $request->restaurant_id;
            $product_id = $request->product_id;

            $restaurant = Restaurant::find($restaurant_id);
            if (!$restaurant) {
                return $this->errorMessage('Restaurant not exists');
            }

            $product = Product::find($product_id);
            if (!$product) {
                return $this->errorMessage('Product not exists');
            }

            $wishList = WishList::where('user_id', $user_id)->where('restaurant_id', $restaurant_id)->where('product_id', $product_id)->first();

            if (!$wishList) {
                $wishList = new WishList();
                $wishList->user_id = $user_id;
                $wishList->restaurant_id = $restaurant_id;
                $wishList->product_id = $product_id;
                $wishList->save();
            }

            return $this->successResponse(new WishListResource($wishList));
        }
    }

    public function removeToWishList($request, $wishListId)
    {
        $wishList = WishList::find($wishListId);
        if (!$wishList) {
            return $this->errorMessage('Wishlist not exists');
        }
        $wishList->delete();

        return $this->successResponse([], 'Wishlist remove');
    }

    public function orderList($request, $order_status = '')
    {
        $orderList = new Order();
        if ($order_status != '') {
            $orderList = $orderList->where('status_id', getOrderStatusId($order_status));
        }
        $orderList = $orderList->where('user_id', getApiLoggedUserId($request))->get();
        return $this->successResponse(OrderResource::collection($orderList));
    }

    public function checkout($request)
    {
        $validationStatus = $this->validateData($request, 'checkout');

        if (!$validationStatus) {
            return $validationStatus;
        } else {

            $cart = Cart::where('user_id', $request->user_id)->get();
            $sub_total = 0;
            $order = new Order;
            $order->name = $request->name;
            $order->email = $request->email;
            $order->phone = $request->phone;
            $order->address = $request->address;
            $order->order_no = 'Order' . random_int(1000, 9999);
            $order->order_place_date = Carbon::now()->format('Y-m-d');
            $order->payment_status = 'pending';
            $order->charge_id = $request->shipping_option;
            $order->payment_type = $request->paymentMethod;
            $order->user_id = $request->user_id;

            $order->shipping_charge = $request->shipping_charge;
            $order->address2 = $request->address2;
            $order->country = $request->country;
            $order->state = $request->state;
            $order->city = $request->city;
            $order->zipcode = $request->zipcode;
            $order->same = $request->same;
            $order->discount = 0;
            $order->coupon_discount = 0;
            $order->tax = 0;
            $order->total = $request->total;
            $order->save();

            foreach ($cart as $item) {
                $order_detail = new OrderDetail;
                $order_detail->order_id = $order->id;
                $order_detail->product_id = $item->product_id;
                $order_detail->sub_total = $item->quantity * $item->unit_price;
                $order_detail->total = $item->quantity * $item->unit_price;
                $order_detail->restaurant_id = $item->restaurant_id;
                $order_detail->commission_percent = 11;
                $order_detail->payment_status = 'pending';
                $order_detail->delivery_charges = 0;
                $order_detail->total_commission = (($item->quantity * $item->unit_price) / 100) * 11;
                $order_detail->payment_id = $request->paymentMethod;
                $order_detail->save();
            }
            if ($request->paymentMethod == 'card') {
                $stripe = new \Stripe\StripeClient(
                    'pk_test_51KT26VDuKSCrfM2pauObEL6P9pEphtZN4W0eOtz79NTcFlEVp8Yub37AgWxBnhXbFizoQQHe6UsmOqlpgotFutWq00L3bdQIgV'
                );
                $token = $stripe->tokens->create([
                    'card' => [
                        'number' => $request->card_no,
                        'exp_month' => $request->exp_month,
                        'exp_year' => $request->exp_year,
                        'cvc' => $request->cvc,
                    ],
                ]);
                Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));
                Stripe\Charge::create([
                    "amount" => $request->total * 100,
                    "currency" => "gbp",
                    "source" => $token->id,
                    "description" => "This order payment"
                ]);
            }
            $cart_empty = Cart::where('user_id', $request->user_id)->delete();


            // $cartItems = $request->cart;

            // $date = Carbon::now();
            // $order = new Order();
            // $order->name = $request->name;
            // $order->email = $request->email;
            // $order->phone = $request->phone;
            // $order->address = $request->address;
            // $order->payment_type = $request->payment_type;
            // $order->payment_status = $request->payment_status;
            // $order->stripe_payment_id = $request->stripe_id ?? 0;
            // $order->user_id = getApiLoggedUserId($request);
            // $order->status_id = 1;
            // $order->save();

            // $order_cart = array();
            // foreach ($cartItems as $cart) {
            //     $cartInfo = Cart::find($cart['cart_id']);
            //     $commission = ((($cartInfo->unit_price * $cartInfo->quantity) / 100) * 11);
            //     $temp = array();
            //     $temp['cart_id'] = $cart['cart_id'];
            //     $temp['delivery_charges'] = $cart['delivery_charges'] ?? 0;
            //     $temp['retaurant_id'] = $cart['restaurant_id'];
            //     $temp['commission'] = $commission ?? 0;
            //     $temp['order_id'] = $order->id;
            //     $temp['created_at'] = $date;
            //     $temp['updated_at'] = $date;
            //     $order_cart[] = $temp;

            //     Cart::find($cart['cart_id'])->update([
            //         'status' => Cart::ORDER_CART_STATUS
            //     ]);
            // }

            // OrderCart::insert($order_cart);


            // OrderDetail::create([
            //     'order_id' => $order->id,
            //     'delivery_charges' => "0",
            //     'sub_total' => $order->totalAmount(),
            //     'total' => $order->totalAmount(),
            // ]);
            return $this->successResponse($order);
        }
    }

    public function stripePayment($request, $amount)
    {
        Stripe\Stripe::setApiKey('sk_test_51K8R9YHPpBmXqUZOAWWGydpJuH1B6NI0gPzZjHCw9TmlXd36LHbcZuIzbj8SoI99ZZT25rBmdIp4Vz3bvem4vRIg00x9zsyDFn');
        $customer = Customer::create();

        $ephemeralKey = EphemeralKey::create(
            ['customer' => $customer->id],
            ['stripe_version' => '2020-08-27']
        );

        $paymentIntent = PaymentIntent::create([
            'amount' => $amount * 100,
            'currency' => 'usd',
            'customer' => $customer->id,
            'payment_method_types' => ['card'],
        ]);

        $stripe_payment = new StripeInitiatePayment();
        $stripe_payment->paymentIntent = $paymentIntent->client_secret;
        $stripe_payment->ephemeralKey = $ephemeralKey->secret;
        $stripe_payment->customer = $customer->id;
        $stripe_payment->user_id = $request->user()->id;
        $stripe_payment->amount = $amount;
        $stripe_payment->currency = 'usd';
        $stripe_payment->payment_method_types = 'card';
        $stripe_payment->save();

        return response([
            'paymentIntent' => $paymentIntent->client_secret,
            'ephemeralKey' => $ephemeralKey->secret,
            'customer' => $customer->id,
            'stripe_id' => $stripe_payment->id
        ]);
    }

    public function updateOrderStatus($request)
    {
        $validationStatus = $this->validateData($request, 'update_order_status');
        if (!$validationStatus) {
            return $validationStatus;
        } else {
            $order = Order::find($request->order_id);
            if (!$order) {
                return $this->errorMessage('Order not exists');
            }
            $order->status_id = getOrderStatusId($request->order_status);
            $order->cancel_reason = $request->cancel_reason;
            $order->save();
            $order = new OrderResource($order);
            return $this->successResponse($order);
        }
    }

    public function getDeliveryCharges($request)
    {
        $validationStatus = $this->validateData($request, 'get_delivery_charges');
        if (!$validationStatus) {
            return $validationStatus;
        } else {
            $cartItems = $request->cart;
            $origin_latitude = $request->latitude;
            $origin_longitude = $request->longitude;
            $origin = $origin_latitude . ',' . $origin_longitude;
            $deliveryCharges = array();
            foreach ($cartItems as $cartItem) {
                $cart = Cart::find($cartItem['cart_id']);
                $restaurant = Restaurant::find($cart->restaurant_id);
                $destination_latitude = $restaurant->latitude;
                $destination_longitude = $restaurant->longitude;
                $destination = $destination_latitude . ',' . $destination_longitude;
                $delivery_charges = getDistanceBetweenTwoCoOrdinates($origin, $destination);
                $temp = array();
                $temp['cart_id'] = $cartItem['cart_id'];
                $temp['delivery_charges'] = $delivery_charges * $restaurant->delivery_charges;
                $deliveryCharges[] = $temp;
            }
            return $this->successResponse($deliveryCharges);
        }
    }
}
