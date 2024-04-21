<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoryApiController;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


Route::get('/all-category', [CategoryApiController::class, 'getAllCategory'])->name('all-category');
Route::get('/get-all-recent-product', [CategoryApiController::class, 'getAllRecentProduct'])->name('get-all-recent-product');
Route::get('/get-all-trading-product', [CategoryApiController::class, 'getAllTradingProduct'])->name('get-all-trading-product');

