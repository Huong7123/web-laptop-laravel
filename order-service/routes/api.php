<?php

use Illuminate\Http\Request;
use App\Http\Controllers\OrderController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;


/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::get('/orders', [OrderController::class, 'index']);                    // Lấy tất cả đơn hàng
Route::get('/orders-details/{id}', [OrderController::class, 'getOrderById']); // xem chi tiết đơn hàng
Route::get('/orders/{id}', [OrderController::class, 'getOrderByUserId']); // Lấy đơn hàng theo user ID
Route::get('/orders-completed/{id}', [OrderController::class, 'getOrderComplete']); // Lấy đơn hàng đã mua theo user ID
Route::get('/orders-completed-admin', [OrderController::class, 'getOrderCompleteByAdmin']); // Lấy đơn hàng đã giao theo ID
Route::post('/orders', [OrderController::class, 'store']);                    // Tạo đơn hàng mới
Route::put('/orders/{id}', [OrderController::class, 'update']);               // Cập nhật trạng thái đơn hàng
Route::delete('/orders/{id}', [OrderController::class, 'destroy']);   //hủy đơn hàng
Route::get('/orders-search', [OrderController::class, 'searchOrderByCode']); //tìm kiếm đơn hàng theo mã đơn hàng



