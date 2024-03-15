<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;

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

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/',[HomeController::class, 'index']);
Route::get('/product/deetails',[HomeController::class,'productDetails']);
Route::get('/product/view-cart',[HomeController::class, 'viewCart']);
Route::get('/product/checkout',[HomeController::class, 'productCheckout']);
Route::get('/shop-products',[HomeController::class, 'shopProducts']);
Route::get('/return-products',[HomeController::class, 'returnProducts']);
Route::get('/privacy-Policy',[HomeController::class, 'privacyPolicy']);
