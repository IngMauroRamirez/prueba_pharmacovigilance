<?php

use App\Http\Controllers\Api\AlertController;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\CustomerController;
use App\Http\Controllers\Api\MedicationController;
use App\Http\Controllers\Api\OrderController;

Route::middleware('web','auth')->group(function(){
    Route::get('/medications/search', [MedicationController::class, 'search']);
    Route::get('/orders/{id}/{lot_number}', [OrderController::class, 'show_order']);
    Route::get('/customers/{id}', [CustomerController::class, 'show_customer']);
    Route::post('/alerts/send', [AlertController::class, 'send_alert']);
});