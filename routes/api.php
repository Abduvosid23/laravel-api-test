<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SalesController;
use App\Http\Controllers\OrdersController;
use App\Http\Controllers\WarehousesController;
use App\Http\Controllers\IncomesController;

Route::group(['middleware' => 'token.validation'], function () {

Route::get('/sales', [SalesController::class, 'index']);

Route::get('/orders', [OrdersController::class, 'index']);

Route::get('/incomes', [IncomesController::class, 'index']);

Route::get('/stocks', [WarehousesController::class, 'index']);

});
Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
