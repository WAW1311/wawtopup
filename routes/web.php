<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\topupcontroller;
use App\Http\Controllers\handlercontroller;
use Illuminate\Support\Facades\Artisan;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/',[handlercontroller::class,'index']);
Route::get('/cek-transaksi',[handlercontroller::class,'cek']);
Route::post('/cek-transaksi',[handlercontroller::class,'trx']);
Route::post('/order/{order_id}',[handlercontroller::class,'order']);
Route::get('/order/checkout/invoice/{order_id}',[handlercontroller::class,'invoice']);

Route::get('/mobile-legends',[topupcontroller::class,'ml']);
Route::get('/mobile-legends-promo',[topupcontroller::class,'mlb']);
Route::get('/freefire',[topupcontroller::class,'freefire']);
Route::get('/pubg-mobile',[topupcontroller::class,'pubgm']);
Route::get('/genshin-impact',[topupcontroller::class,'genshin']);
Route::get('/clash-of-clans',[topupcontroller::class,'coc']);
Route::get('/valorant',[topupcontroller::class,'valorant']);
Route::get('/call-of-duty',[topupcontroller::class,'cod']);
Route::get('/honkai-impact-3',[topupcontroller::class,'hoi']);
Route::get('/arena-of-valor',[topupcontroller::class,'aov']);
Route::get('/tower-of-fantasy',[topupcontroller::class,'tof']);
Route::get('/8-ball-pool',[topupcontroller::class,'ballpool']);

Route::get('/linkstorage', function () {
    symlink('/../storage','/../public');
});
Route::get('/link', function () {
    Artisan::call('storage:link');
});