<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\handlercontroller;
use App\Http\Controllers\Controller;

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
Route::post('/notification/callback',[handlercontroller::class,'webhooks']);
Route::get('v1/cek-username/{game_id}',[handlercontroller::class,'checkusername']);

Route::get('v2/cek-username/{game_id}',[handlercontroller::class,'checkign']);

Route::get('/get-data',[Controller::class,'get_data']);

Route::get('/link', function () {
    $target = storage_path('app/public');
    $link = $_SERVER['DOCUMENT_ROOT'].'/storage';
    symlink($target,$link);
    return "berhasil symlink";
});