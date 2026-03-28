<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\CustomerController;
use App\Http\Controllers\Api\MedicationController;
use App\Http\Controllers\Api\OrderController;

Route::post('/login', [AuthController::class, 'login']);

Route::middleware('auth')->group(function(){
    Route::get('/medications/search', [MedicationController::class, 'search']);
    Route::get('/orders/{id}', [OrderController::class, 'show_order']);
    Route::get('/customers/{id}', [CustomerController::class, 'show_customer']);
});
    