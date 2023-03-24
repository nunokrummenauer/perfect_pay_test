<?php

use App\Http\Controllers\PaymentController;
use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('payments.payment');
});

Route::get('/boleto', function () {
    return view('payments.boleto');
});

Route::get('/credit', function () {
    return view('payments.credit');
});

Route::controller(PaymentController::class)->prefix('/payments')->group(function () {
    Route::post('/credit-card', 'creditCard')->name('payment.credit-card');
    Route::post('/boleto', 'boleto')->name('payment.boleto');
});