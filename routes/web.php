<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\OrderController;


// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', [AuthController::class, 'loginForm']);
Route::post('/login', [AuthController::class, 'login']);

Route::get('/sales', function () {
    return view('inputorder');
});

Route::get('/admin', function () {
    return "Dashboard Admin";
});

Route::get('/gudang', function () {
    return "Dashboard Gudang";
});

Route::get('/sales', [OrderController::class, 'create']);

Route::post('/order/store', [OrderController::class, 'store']);