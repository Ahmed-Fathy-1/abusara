<?php

use App\Http\Controllers\Admin\API\V1\Auth\ApiAuthController;
use App\Http\Controllers\Admin\API\V1\Dashboard\ApiCategoryController;
use App\Http\Controllers\Admin\API\V1\Dashboard\ApiDashboardController;
use App\Http\Controllers\Api\Admin\Banner\BannerAdminController;
use App\Http\Controllers\Api\Admin\CashierController;
use App\Http\Controllers\Api\Admin\CategoryController;
use App\Http\Controllers\Api\Admin\CouponController;
use App\Http\Controllers\Api\Admin\DahboardController;
use App\Http\Controllers\Api\Admin\InvoiceController;
use App\Http\Controllers\Api\Admin\OrderController;
use App\Http\Controllers\Api\Admin\ProductController;
use App\Http\Controllers\Api\Admin\SettingController;
use App\Http\Controllers\Api\public\Auth\AuthController;
use App\Http\Controllers\Api\public\Banner\BannerController;
use App\Http\Controllers\Api\public\Cart\CartController;
use App\Http\Controllers\Api\public\checkout\AddressController;
use App\Http\Controllers\Api\public\checkout\CheckoutController;
use App\Http\Controllers\Api\public\Data\PublicDataController;
use App\Http\Controllers\Api\public\Fav\FavController;
use App\Http\Controllers\Api\public\Shipping\ShippingController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

/*Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});*/

/* Admin Routes*/

Route::group(['prefix' => "admin"],function() {
    Route::group(['prefix' => "auth"], function () {
        Route::post('login', [ApiAuthController::class, 'login']);
    });

    Route::middleware(['api_auth', 'administrator'])->group(function () {
        Route::get('dashboard', [ApiDashboardController::class, 'index']);
//        Route::group(['prefix' => "banners"], function () {
//            Route::get('/', [BannerAdminController::class, 'index']);
//            Route::post('store', [BannerAdminController::class, 'store']);
//            Route::put('update', [BannerAdminController::class, 'update']);
//            Route::delete('delete/{id}', [BannerAdminController::class, 'destroy']);
//        });

    Route::group(['prefix' => "category"],function(){
       Route::get('/',[ApiCategoryController::class,'index']);
       Route::get('/{id}',[ApiCategoryController::class,'show']);
       Route::post('store',[ApiCategoryController::class,'store']);
       Route::put('update/{id}',[ApiCategoryController::class,'update']);
       Route::delete('delete/{id}',[ApiCategoryController::class,'destroy']);
    });

//    //product
//    Route::group(['prefix' => 'products'],function(){
//       Route::get('/',[ProductController::class,'index']);
//       Route::post('store',[ProductController::class,'store']);
//       Route::post('update/{id}',[ProductController::class,'update']);
//       Route::delete('delete/{id}',[ProductController::class,'destroy']);
//    });

//    //coupon
//    Route::group(['prefix' => 'coupon'],function(){
//        Route::get('/',[CouponController::class,'index']);
//       Route::post('store',[CouponController::class,'store']);
//       Route::put('update/{id}',[CouponController::class,'update']);
//       Route::delete('delete/{id}',[CouponController::class,'destroy']);
//    });

//    // cashier
//    Route::group(['prefix' => "cashier"],function (){
//        Route::get('test',[CashierController::class,'index']);
//       Route::post('store',[CashierController::class,'store']);
//    });

//    // orders
//    Route::group(['prefix' => 'orders'],function(){
//        Route::get('/',[OrderController::class,'index']);
//    });
//    // customers
//    Route::group(['prefix' => 'customers'],function (){
//        Route::get('/',[InvoiceController::class,'index']);
//        Route::get('{id}',[InvoiceController::class,'show']);
//    });

        //Route::apiResource('role')
        //settings
//    Route::group(['prefix' => 'setting'],function(){
//        Route::get('/',[SettingController::class,'index']);
//        Route::put('update',[SettingController::class,'update']);
//    });
//    });
//
    });


});
// User Auth
Route::group(['middleware' => 'api_auth'],function (){
    // change Password
    Route::post('change-password',[AuthController::class,'changePassword']);
        //cart
    Route::group(['prefix' => "cart"],function(){
       Route::get('/',[CartController::class,'index']);
       Route::post('cart-storage',[CartController::class,'cartStorage']);
       Route::post('add/{id}',[CartController::class,'store']);
     //  Route::post('increase-decrease/{id}',[CartController::class,'update']);
       Route::delete('delete',[CartController::class,'destroy']);
       Route::delete('delete-all',[CartController::class,'destroyAll']);
    });
    // favourites
    Route::group(['prefix' => 'favourites'],function(){
        Route::get('/',[FavController::class,'index']);
        Route::post('store/{id}',[FavController::class,'store']);
        Route::delete('delete/{id}',[FavController::class,'destroy']);
    });

    Route::group(['prefix' => "checkout"],function(){
        //address
        Route::group(['prefix' => "address"],function(){
            Route::get('/',[AddressController::class,'index']);
            Route::post('store',[AddressController::class,'store']);
            Route::post('select/{id}',[AddressController::class,'select']);
            Route::delete('delete/{id}',[AddressController::class,'destroy']);
        });

        //coupon
        Route::group(['prefix'=>'coupon'],function(){
           Route::post('enter',[CheckoutController::class,'coupon']);
        });

        //delivery Cost
        Route::group(['prefix' => 'delivery'],function (){
            Route::get('/',[ShippingController::class,'delivery']);
            Route::post('cost',[ShippingController::class,'deliveryCost']);
        });

        //orders
        Route::group(['prefix' => "orders"],function(){
            Route::get('/',[CheckoutController::class,'index']);
            Route::post('store',[CheckoutController::class,'order']);
            Route::post('stripe-payment/{id}',[CheckoutController::class,'createStripePaymentIntern']);
            Route::get('summery/{id}',[CheckoutController::class,'summery']);
        });
    });
});


    //public data
    Route::group(['prefix' => "auth"],function (){
        Route::post('register',[AuthController::class,'register']);
        Route::post("login",[AuthController::class, "login" ]);
    });

    Route::group(['prefix' => "category"],function(){
        Route::get('/',[PublicDataController::class,'category']);
        Route::get('{id:slug_url}',[PublicDataController::class,'categoryShow']);
    });


    Route::get('units',[PublicDataController::class,'units']);

    Route::group(['prefix' => "products"],function (){
        Route::get('{id:slug_url}',[PublicDataController::class,'showProduct']);
        Route::get('search/filter',[PublicDataController::class,'search']);
    });

    Route::post('cart-storage',[CartController::class,'cartStorage']);

    Route::group(['prefix' => 'banner'],function(){
        Route::get('/',[BannerController::class,'index']);
    });

    Route::group(['prefix' => 'offers'],function(){
        Route::get('/',[BannerController::class,'offers']);
    });

    Route::group(['prefix' => 'footer'],function(){
        Route::get('/',[PublicDataController::class,'footer']);
    });







