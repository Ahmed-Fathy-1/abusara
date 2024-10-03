<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\SuperAdmin\Domains\TenantController;
use App\Http\Controllers\SuperAdmin\Settings\SettingController;
use App\Http\Controllers\SuperAdmin\Auth\AuthController;
use App\Http\Controllers\SuperAdmin\Roles\RoleController;
use App\Http\Controllers\SuperAdmin\Users\UserController;


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


foreach (config('tenancy.central_domains') as $domain) {
    Route::domain($domain)->group(function () {
        // your actual routes

        // Route::group(['middleware' => ['role:Super Admin']], function () {

            Route::get('/', function () {
                return redirect()->route('homePage');
            });

            Route::get('/home', [HomeController::class, 'index'])->name('homePage');

            Route::get('login', [AuthController::class, "loginPage"])->name('loginPage');
            Route::post('login', [AuthController::class, "login"])->name('login');
            Route::get('forget-password', [AuthController::class, "forgetPasswordPage"])->name('forgetPasswordPage');
            Route::post('forget-password', [AuthController::class, "forgetPassword"])->name('forgetPassword');
            Route::post('check-code', [AuthController::class, "checkCode"])->name('checkCode');

            Route::group(['middleware' => ['auth']], function () {

                Route::get('profile', [AuthController::class, 'profile'])->name('profile');
                Route::put('profile-update', [AuthController::class, 'updateProfile'])->name('profile_update');
                Route::post('logout', [AuthController::class, 'logout'])->name('logout');

                //users
                Route::resource('users', UserController::class);

                //Roles
                Route::resource('roles', RoleController::class);

                //settings
                Route::resource('settings', SettingController::class);

                // tenants
                Route::resource('tenants', TenantController::class);
            });
        // });
    });
}
