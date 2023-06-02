<?php

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

use Illuminate\Support\Facades\Route;
use Modules\MPesa\Http\Controllers\MPesaController;

// Route::get('/m/token',[MPesaController::class,'token']);

Route::group(['middleware' => ['isActive', 'IsInstalled', 'switch_languages', 'auth']], function () {
    Route::post('payvia/mpesa',[MPesaController::class,'pay'])->name('payvia.mpesa');
    Route::post('mpesa/verifypay/{checkoutid}',[MPesaController::class,'verifypay'])->name('verify.mpesa');
});

Route::group(['middleware' => ['web', 'IsInstalled', 'isActive', 'auth', 'is_admin', 'switch_languages', 'TwoFactor']], function () {

    Route::get('admin/mpesa/payment/show/settings', [MPesaController::class, 'getSettings'])->name('mpesa.payment.get.setting');
    Route::post('update/mpesa/payment/settings', [MPesaController::class, 'updatesettings'])->name('mpesa.payment.settings');

});
