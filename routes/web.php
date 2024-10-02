<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\Auth\TenantController;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/
// Route::post('register', [TenantController::class, 'postRegister'])->name('postRegister');
// Route::get('/', [TenantController::class, 'getRegister']);
// Route::get('/charge', [TenantController::class, 'getCharge']);
// Route::post('/pay', [TenantController::class, 'pay']);

Route::post('login', [TenantController::class, 'postLogin'])->name('login');

foreach (config('tenancy.central_domains') as $domain) {
    Route::domain($domain)->group(function () {
        // your actual routes

        Route::get('/', function () {
            return view('home');
        });
        Route::get('login', [TenantController::class, 'login']);

    });
}

