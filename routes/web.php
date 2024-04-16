<?php

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Auth\SmsVerificationController;
use App\Http\Controllers\CartsController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

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

Auth::routes();
Route::fallback(function (){
    return view('blank');
});

Route::get('/',[HomeController::class,'index'])->name('homepage');
Route::post('/user-register',  [SmsVerificationController::class, 'check'])->name('user.register');
Route::post('/user-verify',  [SmsVerificationController::class, 'verify'])->name('user.verify');

Route::get('/category/{title}/{name?}',[\App\Http\Controllers\CategoryController::class,'index'])->name('category.show');
Route::get('/home',[HomeController::class,'home'])->name('home');
Route::post('product/add/cart/{id}',[CartsController::class, 'index'])->name('product.add.cart');
Route::post('product/delete/cart/{id}',[CartsController::class, 'destroy'])->name('product.delete.cart');
Route::post('product/add/wishlist/{id}',[CartsController::class, 'wishlist'])->name('product.add.wishlist');
Route::post('product/delete/wishlist/{id}',[CartsController::class, 'delete_wishlist'])->name('product.delete.wishlist');
Route::get('product/carts',[CartsController::class, 'show_carts'])->name('product.show.carts');
Route::get('/wishlists',[CartsController::class, 'show_wishlist'])->name('product.show.wishlist');
Route::get('/product/checkout',[CartsController::class,'checkout'])->name('checkout');
Route::post('/product/orders',[CartsController::class,'orders_store'])->name('order_store');
Route::get('/my/orders',[CartsController::class, 'myOrders'])->name('my.orders');
Route::post('/chat/send-message', [HomeController::class, 'store'])->name('chat.send');

Route::resource('/blog',\App\Http\Controllers\BlogController::class)->middleware('auth');


