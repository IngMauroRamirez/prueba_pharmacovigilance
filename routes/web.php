<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\MedicationController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

/*  The following routes are defined for the screens section.
    1. Login: /pharmacovigilance/login
    2. Medication Search: /pharmacovigilance/search
*/
Route::get('/pharmacovigilance/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout']);

Route::middleware('auth')->group(function(){
    Route::get('/pharmacovigilance/search', [MedicationController::class, 'showSeach'])->name('showSeach');
});