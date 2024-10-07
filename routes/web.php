<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StripePaymentController;
  
Route::controller(StripePaymentController::class)->group(function(){
    Route::get('stripe', 'index');
    Route::post('stripe', 'stripe')->name('stripe.post');
});

Route::get('/', function () {
    return view('welcome');
});
