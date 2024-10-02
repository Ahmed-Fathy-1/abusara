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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});









