<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\handlercontroller;
use App\Http\Controllers\Controller;
use App\Http\Controllers\TripayController;
use App\Http\Controllers\VipPaymentController;

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
Route::post('/notification/callback',[TripayController::class,'callback'])->name('callback');
Route::get('/v1/cek-username/{game_id}',[handlercontroller::class,'checkusername']);

Route::get('/v2/cek-username',[VipPaymentController::class,'checkign']);

Route::get('/link', function () {
    $target = storage_path('app/public');
    $link = $_SERVER['DOCUMENT_ROOT'].'/storage';
    symlink($target,$link);
    return "berhasil symlink";
});

Route::get('/get-data',[VipPaymentController::class,'GetProfile']);

Route::get('/fee-calculate',[TripayController::class,'FeeCalculate']);

Route::get('/ip-public', function (Request $request) {
    $clientIP = $request->ip();
    return "IP publik klien: " . $clientIP;
});