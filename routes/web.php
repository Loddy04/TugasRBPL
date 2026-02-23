<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', [AuthController::class, 'loginForm']);
Route::post('/login', [AuthController::class, 'login']);

Route::get('/sales', function () {
    return "Dashboard Sales";
});

Route::get('/admin', function () {
    return "Dashboard Admin";
});

Route::get('/gudang', function () {
    return "Dashboard Gudang";
});