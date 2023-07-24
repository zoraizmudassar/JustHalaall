<?php

namespace App\Services\API\Customer;

use App\Models\Cart;
use App\Models\Category;
use App\Models\Restaurant;
use App\Models\Product;
use App\Models\Deal;
use App\Models\User;
use App\Models\WishList;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class CustomerService
{
    public function getDashboard()
    {
        $category = Category::where('status', 1)->get();
        $restaurant = Restaurant::where('status', 'approved')->get();
        // $featuredProducts = Product::where('status','approved')->inRandomOrder()->limit(5)->get();
        $featuredProducts = Product::where('status', 'approved')->where('is_available', 1)->where('is_featured', 1)->get();        
        return response()->json([
            'status' => true,
            'category' => $category,
            'restaurant' => $restaurant,
            'featuredProducts' => $featuredProducts,
        ], 200);
    }

    public function getRestaurant()
    {
        $restaurant = Restaurant::where('status', 'approved')->get();
        return response()->json([
            'status' => true,
            'data' => $restaurant,
        ], 200);
    }

    public function searchRestaurant($request)
    {
        $validator = Validator::make($request->all(), [
            'restaurant_name' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 400,
                'message' => $validator->messages()->first()
            ], 400);
        } else {
            $restaurant = Restaurant::where('name', $request->restaurant_name)->get();
            return response()->json([
                'status' => 200,
                'data' => $restaurant
            ], 200);
        }
    }

    public function restaurantDetail($request)
    {
        $validator = Validator::make($request->all(), [
            'restaurant_id' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'message' => $validator->messages()->first()
            ], 400);
        } else {
            $restaurant = Restaurant::where('id', $request->restaurant_id)->get();
            return response()->json([
                'status' => true,
                'data' => $restaurant
            ], 200);
        }
    }

    public function restaurantProducts($request)
    {
        $validator = Validator::make($request->all(), [
            'restaurant_id' => 'required',
            'user_id' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 400,
                'message' => $validator->messages()->first()
            ], 400);
        } else {
            $restaurant = Restaurant::where('id', $request->restaurant_id)->get();
            if (!$restaurant) {
                return response()->json([
                    'status' => 200,
                    'data' => $restaurant
                ], 200);
            } else {
                $products = Product::where('status','approved')->where('restaurant_id', $request->restaurant_id)->get();
                $records = [];
                foreach ($products as $product) {
                    $wishlist = WishList::where('product_id', $product->id)->where('user_id', $request->user_id)->count();
                    if ($wishlist > 0) {
                        $wish = 1;
                    } else {
                        $wish = 0;
                    }
                    $data = [
                        'id' => $product->id,
                        'restaurant_id' => $product->restaurant_id,
                        'name' => $product->name,
                        'description' => $product->description,
                        'price' => $product->price,
                        'delivery_time' => $product->delivery_time,
                        'is_featured' => $product->is_featured,
                        'rating' => $product->rating,
                        'images' => asset($product->images),
                        'status' => $product->status,
                        'wishlist' => $wish,
                    ];

                    $records[] = $data;
                }
                return response()->json([
                    'status' => 200,
                    'data' => $records
                ], 200);
            }
        }
    }

    public function restaurantFeaturedProducts($request)
    {
        $validator = Validator::make($request->all(), [
            'restaurant_id' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 400,
                'message' => $validator->messages()->first()
            ], 400);
        } else {
            $restaurant = Restaurant::where('id', $request->restaurant_id)->get();
            if (!$restaurant) {
                return response()->json([
                    'status' => 200,
                    'data' => $restaurant
                ], 200);
            } else {
                $products = Product::where('status','approved')->where('restaurant_id', $request->restaurant_id)->inRandomOrder()->limit(5)->get();
                $records = [];
                foreach ($products as $product) {
                    $wishlist = WishList::where('product_id', $product->id)->where('user_id', $request->user_id)->count();
                    if ($wishlist > 0) {
                        $wish = 1;
                    } else {
                        $wish = 0;
                    }
                    $data = [
                        'id' => $product->id,
                        'restaurant_id' => $product->restaurant_id,
                        'name' => $product->name,
                        'description' => $product->description,
                        'price' => $product->price,
                        'delivery_time' => $product->delivery_time,
                        'is_featured' => $product->is_featured,
                        'rating' => $product->rating,
                        'images' => asset($product->images),
                        'status' => $product->status,
                        'wishlist' => $wish,
                    ];

                    $records[] = $data;
                }
                return response()->json([
                    'status' => 200,
                    'data' => $records
                ], 200);
            }
        }
    }

    public function restaurantDeals($request)
    {
        $validator = Validator::make($request->all(), [
            'restaurant_id' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 400,
                'message' => $validator->messages()->first()
            ], 400);
        } else {
            $restaurant = Restaurant::where('id', $request->restaurant_id)->get();
            if (!$restaurant) {
                return response()->json([
                    'status' => 200,
                    'data' => $restaurant
                ], 200);
            } else {
                $restaurantDeals = Deal::where('restaurant_id', $request->restaurant_id)->get();
                return response()->json([
                    'status' => 200,
                    'data' => $restaurantDeals
                ], 200);
            }
        }
    }

    public function searchFood($request)
    {
        $validator = Validator::make($request->all(), [
            'food_name' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 400,
                'message' => $validator->messages()->first()
            ], 400);
        } else {
            $products = Product::where('status','approved')->where('name', 'LIKE', '%' . $request->food_name . '%')->get();
            return response()->json([
                'status' => 200,
                'data' => $products
            ], 200);
        }
    }

    public function restaurantProductDetail($request)
    {
        $validator = Validator::make($request->all(), [
            'product_id' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 400,
                'message' => $validator->messages()->first()
            ], 400);
        } else {
            $productDeatil = Product::where('status','approved')->where('id', $request->product_id)->get();
            return response()->json([
                'status' => 200,
                'data' => $productDeatil
            ], 200);
        }
    }

    public function restaurantDealDetail($request)
    {
        $validator = Validator::make($request->all(), [
            'deal_id' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 400,
                'message' => $validator->messages()->first()
            ], 400);
        } else {
            $dealDetail = Deal::where('id', $request->deal_id)->get();
            return response()->json([
                'status' => 200,
                'data' => $dealDetail
            ], 200);
        }
    }

    public function categoryList($request)
    {
        $validator = Validator::make($request->all(), [
            'category_id' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 400,
                'message' => $validator->messages()->first()
            ], 400);
        } else {
            $category = Category::where('id', $request->category_id)->get();
            if (!$category) {
                return response()->json([
                    'status' => 200,
                    'data' => $category
                ], 200);
            } else {
                $categoryProducts = Product::where('category_id', $request->category_id)->get();
                return response()->json([
                    'status' => 200,
                    'data' => $categoryProducts
                ], 200);
            }
        }
    }

    public function getProfile($request)
    {
        $validator = Validator::make($request->all(), [
            'user_id' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'message' => $validator->messages()->first()
            ], 400);
        } else {
            $user = User::find($request->user_id);
            return response()->json([
                'status' => true,
                'data' => $user
            ], 200);
        }
    }

    public function updateProfile($request)
    {
        if ($request->user_id) {
            $user = User::where('id', $request->user_id)->get();
            if (count($user) <= 0) {
                return response()->json([
                    'status' => 200,
                    'data' => $user
                ], 200);
            } else {
                $validator = Validator::make($request->all(), [
                    'user_id' => 'required',
                    'name' => '',
                    // 'email' => [
                    //     'required',
                    //     Rule::unique('users')->ignore($request->user_id)
                    // ],
                    'phone' => [
                        'required',
                        Rule::unique('users')->ignore($request->user_id)
                    ],
                    'image' => '',
                    'address' => '',
                    'password' => 'min:6',
                ]);
                if ($validator->fails()) {
                    return response()->json([
                        'status' => false,
                        'message' => $validator->messages()->first()
                    ], 400);
                } else {
                    $user = User::where('id', $request->user_id)->first();
                    $file = $request->image;
                    $filename = '';
                    if($file){
                        $f = finfo_open();
                        $mime_type = finfo_buffer($f, base64_decode($request->image) , FILEINFO_MIME_TYPE);
                        $type = explode('/', $mime_type);
                        $randomNumber = rand(1000000000,9999999999);
                        $filename = '/uploads/users/' .$randomNumber.'.'.$type[1];
                        file_put_contents(public_path() . $filename, base64_decode($request->image));
                        $filename = 'https://www.justhalaall.com/public'.$filename;
                    }
                    // if ($file) {
                    //     if ($request->hasFile('image')) {
                    //         $fileName = $file->getClientOriginalName();
                    //         $explodeImage = explode('.', $fileName);
                    //         $fileName = $explodeImage[0];
                    //         $extension = end($explodeImage);
                    //         $fileName = time() . "-" . $fileName . "." . $extension;
                    //         $imageExtensions = ['jpg', 'jpeg', 'png'];
                    //         if (in_array($extension, $imageExtensions)) {
                    //             $folderName = "uploads/users";
                    //             $file->move($folderName, $fileName);
                    //             $path = $folderName . '/' . $fileName;
                    //         } else {
                    //             return response()->json([
                    //                 'status' => 301,
                    //                 'message' => 'Image should be in JPG or PNG and JPEG',
                    //             ], 301);
                    //         }
                    //     }
                    // }
                    $userImage = $filename != '' ? $filename : $user->image;
                    $user->name = $request->name ? $request->name : $user->name;
                    $user->phone = $request->phone ? $request->phone : $user->phone;
                    $user->email = $request->email ? $request->email : $user->email;
                    $user->password = $request->password ? Hash::make($request->password) : $user->password;
                    $user->address = $request->address ? $request->address : $user->address;
                    $user->image = $userImage;
                    $updateUser = $user->save();
                    if (!$updateUser) {
                        return response()->json([
                            'status' => false,
                            'message' => 'Server Error'
                        ], 500);
                    } else {
                        $data = [
                            'id' => $user->id,
                            'name' => $user->name,
                            'email' => $user->email,
                            'phone' => $user->phone,
                            'image' => asset($filename),
                            'address' => $user->address,
                            // 'password' => $user->password,
                            // 'created_at' => $user->created_at,
                            // 'updated_at' => $user->updated_at,
                        ];
                        return response()->json([
                            'status' => true,
                            'message' => 'Profile updated successfully',
                            'data' => $data,
                        ], 200);
                    }
                }
            }
        }
    }

    public function categoryProducts($request)
    {
        $validator = Validator::make($request->all(), [
            'category_id' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'message' => $validator->messages()->first()
            ], 400);
        } else {
            $categoryProductList = Product::where('status','approved')->where('category_id', $request->category_id)->get();
            if (!$categoryProductList) {
                return response()->json([
                    'status' => true,
                    'data' => $categoryProductList
                ], 200);
            } else {
                $categoryProductList = Product::where('status','approved')->where('category_id', $request->category_id)->get();
                return response()->json([
                    'status' => true,
                    'data' => $categoryProductList
                ], 200);
            }
        }
    }

    public function cartList($request)
    {
        $user_id = $request->user()->id;
        $carts = Cart::where('user_id', $user_id)->get();
        return response()->json([
            'status' => 200,
            'data' => $carts
        ], 200);
    }

    public function addToCart($request)
    {
        $validator = Validator::make($request->all(), [
            'restaurant_id' => 'required',
            'product_id' => 'required',
            'unit_price' => 'required',
            'quantity' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 400,
                'message' => $validator->messages()->first()
            ], 400);
        } else {
            $restaurant_id = $request->restaurant_id;
            $product_id = $request->product_id;
            $unit_price = $request->unit_price;
            $quantity = $request->quantity;
            $user_id = $request->user()->id;
            $restaurant = Restaurant::find($restaurant_id);
            if (!$restaurant) {
                return response()->json([
                    'status' => 404,
                    'data' => 'Hotel not found'
                ], 404);
            }

            $product = Product::find($product_id);
            if (!$product) {
                return response()->json([
                    'status' => 404,
                    'data' => 'Product not found'
                ], 404);
            }
            $cart = Cart::where('user_id', $user_id)
                ->where('restaurant_id', $restaurant_id)
                ->where('product_id', $product_id)->first();
            if ($cart) {
                $cart->quantity = $quantity;
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
            return response()->json([
                'status' => 200,
                'data' => $cart
            ], 200);
        }
    }

    public function removeFromCart($request)
    {
        $validator = Validator::make($request->all(), [
            'cart_id' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 400,
                'message' => $validator->messages()->first()
            ], 400);
        } else {
            $user_id = $request->user()->id;
            $cart_id = $request->cart_id;
            $cart = Cart::where('id', $cart_id)->where('user_id', $user_id)->first();
            if ($cart) {
                $cart->delete();
                return response()->json([
                    'status' => 200,
                    'data' => 'Remove from cart'
                ], 200);
            } else {
                return response()->json([
                    'status' => 404,
                    'data' => 'Cart not found'
                ], 404);
            }
        }
    }
}
