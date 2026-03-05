<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\AdminOrderController;

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', [AuthController::class, 'loginForm']);
Route::post('/login', [AuthController::class, 'login']);

Route::get('/sales', function () {
    return view('inputorder');
});

Route::get('/admin', [AdminOrderController::class, 'index']);

Route::get('/gudang', function () {
    return "Dashboard Gudang";
});

Route::get('/sales', [OrderController::class, 'create']);

Route::post('/order/store', [OrderController::class, 'store']);

Route::get('/admin/orders', [AdminOrderController::class, 'index']);

Route::get('/admin/orders/{id}', [AdminOrderController::class, 'show']);

Route::post('/admin/orders/{id}/accept', [AdminOrderController::class, 'accept']);

Route::post('/admin/orders/{id}/reject', [AdminOrderController::class, 'reject']);

Route::post('/admin/orders/{id}/rekap', [AdminOrderController::class, 'rekap']);