<?php

use App\Http\Controllers\SocialLoginController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use Pnlinh\GoogleDistance\Facades\GoogleDistance;

//use App\Http\Controllers\Restaurant\RestaurantController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::get('/clear-cache', function() {
    $exitCode = Artisan::call('optimize:clear');
    return 'Done';
    // return what you want
});
Route::get('paywithpaypal', [SocialLoginController::class, 'payWithPaypal'])->name('paywithpaypal');
Route::post('paypal', [SocialLoginController::class, 'postPaymentWithpaypal'])->name('paypal');
Route::get('paypal', [SocialLoginController::class, 'getPaymentStatus'])->name('status');

Route::get('oauth/{driver}', [SocialLoginController::class, 'redirectToProvider'])->name('social.oauth');
Route::get('oauth/{driver}/callback', [SocialLoginController::class, 'handleProviderCallback'])->name('social.callback');
// Route::get('oauth/facebook/callback', [SocialLoginController::class, 'handleProviderCallback'])->name('social.callback');


Auth::routes();

Route::namespace('Restaurant')->prefix('restaurant')->as('restaurants.')->group(function () {
    Route::namespace('Auth')->group(function () {
        //        Route::get('/login', [\App\Http\Controllers\Restaurant\Auth\LoginController::class, 'showLoginForm'])->name('showLoginForm');
        //        Route::post('/login', [\App\Http\Controllers\Restaurant\Auth\LoginController::class, 'login'])->name('login');
        //        Route::post('/logout', [\App\Http\Controllers\Restaurant\Auth\LoginController::class, 'logout'])->name('logout');
        Route::get('/register', [\App\Http\Controllers\Restaurant\Auth\RegisterController::class, 'showRegistrationForm'])->name('showRegistrationForm');
        Route::post('/register', [\App\Http\Controllers\Restaurant\Auth\RegisterController::class, 'register'])->name('register');

        Route::get('/login', [\App\Http\Controllers\Restaurant\AuthController::class, 'loginForm'])->name('showLoginForm');
        Route::post('/login', [\App\Http\Controllers\Restaurant\AuthController::class, 'login'])->name('login');
        Route::post('/logout', [\App\Http\Controllers\Restaurant\AuthController::class, 'logout'])->name('logout');
    });

    Route::middleware(['Restaurant'])->group(function () {

        Route::get('/', [\App\Http\Controllers\Restaurant\RestaurantController::class, 'index'])->name('home');
        Route::get('/edit/{restaurant}', [\App\Http\Controllers\Restaurant\RestaurantController::class, 'editProfile'])->name('editProfile');
        Route::post('/update-profile', [\App\Http\Controllers\Restaurant\RestaurantController::class, 'updateProfile'])->name('updateProfile');
        Route::get('/forget-password', [\App\Http\Controllers\Restaurant\ForgetPasswordController::class, 'forgetPassword'])->name('forgetPassword');
        Route::post('/new-password', [\App\Http\Controllers\Restaurant\ForgetPasswordController::class, 'newPassword'])->name('newPassword');





        // Category Route's
        Route::namespace('Categories')->prefix('category')->as('category.')->group(function () {
            Route::get('/', [\App\Http\Controllers\Restaurant\Categories\CategoryController::class, 'index'])->name('list');
            Route::post('/store', [\App\Http\Controllers\Restaurant\Categories\CategoryController::class, 'store'])->name('store');
            Route::post('/update', [\App\Http\Controllers\Restaurant\Categories\CategoryController::class, 'update'])->name('update');
            Route::post('/delete', [\App\Http\Controllers\Restaurant\Categories\CategoryController::class, 'destroy'])->name('delete');
            Route::post('/change-status', [\App\Http\Controllers\Restaurant\Categories\CategoryController::class, 'changeStatus'])->name('changeStatus');
        });

        //    Deal Route's
        Route::namespace('Deal')->prefix('deal')->as('deal.')->group(function () {

            Route::get('/create', [App\Http\Controllers\Restaurant\Deal\DealController::class, 'create'])->name('create');
            Route::get('/pending', [App\Http\Controllers\Restaurant\Deal\DealController::class, 'pending'])->name('pending');
            Route::get('/approved', [App\Http\Controllers\Restaurant\Deal\DealController::class, 'approved'])->name('approved');
            Route::get('/rejected', [App\Http\Controllers\Restaurant\Deal\DealController::class, 'rejected'])->name('rejected');
            Route::get('/enable', [App\Http\Controllers\Restaurant\Deal\DealController::class, 'enable'])->name('enable');
            Route::get('/disable', [App\Http\Controllers\Restaurant\Deal\DealController::class, 'disable'])->name('disable');
            Route::post('/store', [\App\Http\Controllers\Restaurant\Deal\DealController::class, 'store'])->name('store');
            Route::get('/pending', [\App\Http\Controllers\Restaurant\Deal\DealController::class, 'pending'])->name('pending');
            Route::post('/update', [\App\Http\Controllers\Restaurant\Deal\DealController::class, 'update'])->name('update');
            Route::post('/change-status', [\App\Http\Controllers\Restaurant\Deal\DealController::class, 'changeStatus'])->name('changeStatus');
            Route::post('/delete', [\App\Http\Controllers\Restaurant\Deal\DealController::class, 'destroy'])->name('delete');
            Route::post('/deal-detail', [\App\Http\Controllers\Restaurant\Deal\DealController::class, 'dealDetail'])->name('dealDetail');            
        });
        //    Product Route's
        Route::namespace('Order')->prefix('order')->as('order.')->group(function () {

            Route::get('/order-all', [App\Http\Controllers\Restaurant\Order\OrderController::class, 'all'])->name('all-order');
            Route::get('/order-pending', [App\Http\Controllers\Restaurant\Order\OrderController::class, 'pending'])->name('pending-order');
            Route::get('/order-accepted', [App\Http\Controllers\Restaurant\Order\OrderController::class, 'accepted'])->name('accepted-order');
            Route::get('/order-complete', [App\Http\Controllers\Restaurant\Order\OrderController::class, 'complete'])->name('complete-order');
            Route::get('/on-way', [App\Http\Controllers\Restaurant\Order\OrderController::class, 'onWay'])->name('on-way');
            Route::get('/order-rejected', [App\Http\Controllers\Restaurant\Order\OrderController::class, 'rejected'])->name('rejected-order');
            Route::post('/order-change-status', [App\Http\Controllers\Restaurant\Order\OrderController::class, 'changeStatus'])->name('changeStatus-order');
            Route::post('/order-accepted-status', [App\Http\Controllers\Restaurant\Order\OrderController::class, 'acceptedStatus'])->name('acceptedStatus-order');
        });
        //    Product Route's
        Route::namespace('Products')->prefix('product')->as('product.')->group(function () {

            Route::get('/create', [\App\Http\Controllers\Restaurant\Products\ProductController::class, 'create'])->name('create');
            Route::get('/approved', [\App\Http\Controllers\Restaurant\Products\ProductController::class, 'approved'])->name('approved');
            Route::get('/rejected', [\App\Http\Controllers\Restaurant\Products\ProductController::class, 'rejected'])->name('rejected');
            Route::get('/pending', [\App\Http\Controllers\Restaurant\Products\ProductController::class, 'pending'])->name('pending');
            Route::post('/store', [\App\Http\Controllers\Restaurant\Products\ProductController::class, 'store'])->name('store');
            Route::post('/update', [\App\Http\Controllers\Restaurant\Products\ProductController::class, 'update'])->name('update');
            Route::post('/change-status', [\App\Http\Controllers\Restaurant\Products\ProductController::class, 'changeStatus'])->name('changeStatus');
            Route::post('/change-feature', [\App\Http\Controllers\Restaurant\Products\ProductController::class, 'changeFeature'])->name('changeFeature');
            Route::post('/delete', [\App\Http\Controllers\Restaurant\Products\ProductController::class, 'destroy'])->name('delete');
            Route::post('/product-detail', [\App\Http\Controllers\Restaurant\Products\ProductController::class, 'productDetail'])->name('productDetail');            
        });
    });
});

Route::namespace("Web")->group(function () {
    /* Checkout routes */
    Route::get("checkout", [\App\Http\Controllers\Web\CheckoutController::class, "index"])->name('index');
    Route::get("checkoutv1", [\App\Http\Controllers\Web\CheckoutController::class, "indexv1"])->name('indexv1');
    Route::post("checkout-store", [\App\Http\Controllers\Web\CheckoutController::class, "Checkout"])->name('Checkout');
    // Route::get("restaurant/{slug}",[\App\Http\Controllers\Web\RestaurantController::class,"details"])->name('restaurant-detail');
    Route::get("restaurant-detail/{id}", [\App\Http\Controllers\Web\RestaurantController::class, "details"])->name('restaurant-detail');
    Route::get("orders", [\App\Http\Controllers\Web\OrderController::class, "index"])->name('orders');
    Route::get("ordersv1", [\App\Http\Controllers\Web\OrderController::class, "indexv1"])->name('ordersv1');
});
Route::get('email', function () {
    return view('web.email');
});
Route::get('about', function () {
    return view('web.about');
});
Route::get('profile', function () {
    return view('web.profile');
});
Route::get('contact', function () {
    return view('web.contact');
});
Route::get('aboutv1', function () {
    return view('website.aboutUs');
});
Route::get('contactv1', function () {
    return view('website.contactUs');
});
Route::get('signupv1', function () {
    return view('website.signup');
});
Route::get('loginv1', function () {
    return view('website.login');
});
Route::get('resendOtpv1', function () {
    return view('website.resendOtp');
});
Route::get('verifyotpv1', function () {
    return view('website.verifyotp');
});
Route::get('updatePasswordv1', function () {
    return view('website.updatePassword');
});
Route::get('detailv1', function () {
    return view('website.detail');
});
Route::get('orderv1', function () {
    return view('website.order');
});
Route::post('contact/store',[\App\Http\Controllers\ContactController::class,'store']);
Route::get('admin/contact',[\App\Http\Controllers\ContactController::class,'index']);
Route::get('userOrderPdf/{id}',[\App\Http\Controllers\Web\OrderController::class,'Pdf'])->middleware('auth');
Route::get('cart', [App\Http\Controllers\Web\CartController::class, 'index'])->name('cart')->middleware('auth');
Route::post('add-to-cart', [\App\Http\Controllers\Web\CartController::class, 'store'])->name('addToCart')->middleware('auth');
Route::post('add-to-cartv1', [\App\Http\Controllers\Web\CartController::class, 'storev1'])->name('addToCartv1')->middleware('auth');
Route::post('add-to-cartv2', [\App\Http\Controllers\Web\CartController::class, 'storev2'])->name('addToCartv2')->middleware('auth');
Route::get('remove-item/{id}', [App\Http\Controllers\Web\CartController::class, 'removeCart'])->name('removeCart')->middleware('auth');
Route::get('detail', function () {
    return view('web.detailpage');
});
//demo
Route::get('/', [\App\Http\Controllers\HomeController::class, "index"])->name('index');
Route::get('/web', [\App\Http\Controllers\HomeController::class, "index1"])->name('web');
Route::get('search', [\App\Http\Controllers\HomeController::class, "search"])->name('search');
Route::post('update-cart/{id}', [\App\Http\Controllers\Restaurant\Products\CartController::class, 'updateCart'])->name('updateCart');
Route::get('categoryproducts/{categoryId}', [\App\Http\Controllers\HomeController::class, "categoryProducts"])->name('categoryproducts');

Route::get('/details/{id}', [\App\Http\Controllers\Restaurant\Order\OrderController::class, "orderDetails"])->name('restaurant.order.orderDetails');

Route::get("distance", function () {
    $distance = google_distance('32.1877,74.1945', '31.4504,73.1350');
    printAll($distance / 1000);
});

//AuthenticationV1
Route::post('/userRegister', [\App\Http\Controllers\Auth\RegisterController::class, 'create'])->name('userRegister');
Route::post('/userLogin', [\App\Http\Controllers\Auth\LoginController::class, 'login'])->name('userLogin');
Route::post('/updateProfile', [\App\Http\Controllers\Auth\ProfileController::class, 'update'])->name('updateProfile');
Route::post('/updatePassword', [\App\Http\Controllers\Auth\ProfileController::class, 'updatePassword'])->name('updatePassword');
Route::get('forgot-password', [App\Http\Controllers\Auth\ForgotPasswordController::class, 'forgotPassword'])->name('forgot-password');
Route::post('forgotPassword', [App\Http\Controllers\Auth\ForgotPasswordController::class, 'forgot_Password'])->name('forgotPassword');
Route::post('verify_otp', [App\Http\Controllers\Auth\ForgotPasswordController::class, 'verifyOtp'])->name('verify_otp');
Route::post('update_password', [App\Http\Controllers\Auth\ForgotPasswordController::class, 'changeForgetPassword'])->name('update_password');
Route::post('/logout', [\App\Http\Controllers\Auth\RegisterController::class, 'logout'])->name('logout');

//DashboardV1
Route::get('/homev1', [\App\Http\Controllers\HomeController::class, "getDashboard"])->name('homev1');
Route::get('categoryproductsv1/{categoryId}', [\App\Http\Controllers\HomeController::class, "categoryProductsv1"])->name('categoryproductsv1');
Route::get("restaurant-detailv1/{id}", [\App\Http\Controllers\Web\RestaurantController::class, "detailsv1"])->name('restaurant-detailv1');

//Cartv1
Route::get('cartv1', [App\Http\Controllers\Web\CartController::class, 'indexv1'])->name('cartv1')->middleware('auth');
Route::post('update-cartv1/{id}', [\App\Http\Controllers\Restaurant\Products\CartController::class, 'updateCartv1'])->name('updateCart');
Route::get('remove-itemv1/{id}', [App\Http\Controllers\Web\CartController::class, 'removeCartv1'])->name('removeCart')->middleware('auth');

Route::get("map", function () {

    $addressFrom = '32.1877,74.1945';
    $addressTo = '31.4504,73.1350';
    $unit = '';
    // Google API key
    $apiKey = 'Your_Google_API_Key';

    // Change address format
    $formattedAddrFrom    = str_replace(' ', '+', $addressFrom);
    $formattedAddrTo     = str_replace(' ', '+', $addressTo);

    // Geocoding API request with start address
    $geocodeFrom = file_get_contents('https://maps.googleapis.com/maps/api/geocode/json?address=' . $formattedAddrFrom . '&sensor=false&key=' . $apiKey);
    $outputFrom = json_decode($geocodeFrom);
    if (!empty($outputFrom->error_message)) {
        return $outputFrom->error_message;
    }

    // Geocoding API request with end address
    $geocodeTo = file_get_contents('https://maps.googleapis.com/maps/api/geocode/json?address=' . $formattedAddrTo . '&sensor=false&key=' . $apiKey);
    $outputTo = json_decode($geocodeTo);
    if (!empty($outputTo->error_message)) {
        return $outputTo->error_message;
    }

    // Get latitude and longitude from the geodata
    $latitudeFrom    = $outputFrom->results[0]->geometry->location->lat;
    $longitudeFrom    = $outputFrom->results[0]->geometry->location->lng;
    $latitudeTo        = $outputTo->results[0]->geometry->location->lat;
    $longitudeTo    = $outputTo->results[0]->geometry->location->lng;

    // Calculate distance between latitude and longitude
    $theta    = $longitudeFrom - $longitudeTo;
    $dist    = sin(deg2rad($latitudeFrom)) * sin(deg2rad($latitudeTo)) +  cos(deg2rad($latitudeFrom)) * cos(deg2rad($latitudeTo)) * cos(deg2rad($theta));
    $dist    = acos($dist);
    $dist    = rad2deg($dist);
    $miles    = $dist * 60 * 1.1515;

    // Convert unit and return distance
    $unit = strtoupper($unit);
    if ($unit == "K") {
        return round($miles * 1.609344, 2) . ' km';
    } elseif ($unit == "M") {
        return round($miles * 1609.344, 2) . ' meters';
    } else {
        return round($miles, 2) . ' miles';
    }
});
