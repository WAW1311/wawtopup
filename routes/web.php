<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\topupcontroller;
use App\Http\Controllers\handlercontroller;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\dashboardController;
use App\Http\Controllers\PagesController;

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
Route::get('/auth/login',[LoginController::class,'index'])->name('login')->middleware('guest');
Route::post('/auth/login',[LoginController::class,'authenticate'])->name('login')->middleware('guest');

Route::get('/auth/register',[RegisterController::class,'index'])->name('register')->middleware('guest');
Route::post('/auth/register',[registerController::class,'authenticate'])->name('register')->middleware('guest');

Route::get('/admin/dashboard',[dashboardcontroller::class,'index'])->name('dashboard')->middleware('auth');

Route::get('/admin/dashboard/product',[dashboardcontroller::class,'product'])->name('product')->middleware('auth');
Route::get('/admin/dashboard/cart-user',[dashboardcontroller::class,'cart_user'])->name('cart_user')->middleware('auth');
Route::get('/admin/dashboard/history',[dashboardcontroller::class,'history'])->name('history')->middleware('auth');

Route::post('/admin/dashboard/add',[dashboardcontroller::class,'addproduct'])->name('add')->middleware('auth');
Route::post('/admin/dashboard/update',[dashboardcontroller::class,'updateproduct'])->name('update')->middleware('auth');
Route::post('/admin/dashboard/delete/{product_id}',[dashboardcontroller::class,'deleteproduct'])->name('delete')->middleware('auth');

Route::get('/logout',[LoginController::class,'logout'])->name('logout')->middleware('auth');


Route::get('/page/faq',[PagesController::class,'faq']);
Route::get('/page/contact',[PagesController::class,'contact']);
Route::get('/page/about',[PagesController::class,'about']);
Route::get('/page/privacy&policy',[PagesController::class,'privacypolicy']);
Route::get('/page/termsofservice',[PagesController::class,'termsofservice']);

Route::get('/',[handlercontroller::class,'index'])->name('home');
Route::get('/cek-transaksi',[handlercontroller::class,'cek']);
Route::post('/cek-transaksi',[handlercontroller::class,'trx']);
Route::post('/order/{order_id}',[handlercontroller::class,'order']);
Route::get('/order/invoice',[handlercontroller::class,'invoice'])->name('invoice');

Route::get('/order/{href}',[topupcontroller::class,'index'])->name('sub_product');

Route::fallback(function(){
    return redirect()->back();
});