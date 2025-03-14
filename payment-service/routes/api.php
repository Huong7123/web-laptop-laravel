<?php

use App\Http\Controllers\PaymentController;
use App\Http\Controllers\return_payment;
use Illuminate\Support\Facades\Route;

Route::post('/payment', [PaymentController::class, 'payment']);
