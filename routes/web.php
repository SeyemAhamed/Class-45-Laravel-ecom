<?php

use App\Http\Controllers\Backend\AdminController;
use App\Http\Controllers\Backend\CategoryController;
use App\Http\Controllers\Backend\SubCategoryConotroller;
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
Route::get('/product/details', [HomeController::class, 'productDetails']);
Route::get('/product/view-cart', [HomeController::class, 'viewCart']);
Route::get('/product/checkout', [HomeController::class, 'productCheckout']);
Route::get('/shop-products', [HomeController::class, 'shopProduct']);
Route::get('/return-products', [HomeController::class, 'returnProduct']);


Auth::routes();

Route::get('/admin/login', [AdminController::class, 'login']);
Route::post('/admin/login-access', [AdminController::class, 'loginCheck']);

Route::get('/admin/dashboard', [AdminController::class, 'dashboard']);

//Cateroy Routes...
Route::get('/admin/category/list',[CategoryController::class, 'showCategory']);
Route::get('/admin/category/create',[CategoryController::class, 'createCategory']);
Route::post('/admin/category/store', [CategoryController::class, 'storeCategory']);
Route::get('/admin/category/delete/{id}',[CategoryController::class, 'deleteCategory']);
Route::get('/admin/category/edit/{id}', [CategoryController::class, 'editCategory']);
Route::post('/admin/category/update/{id}', [CategoryController::class, 'updateCategory']);

//SubCateroy Routes...
Route::get('/admin/sub-category/list',[SubCategoryConotroller::class, 'showSubCategory']);
Route::get('/admin/sub-category/create',[SubCategoryConotroller::class, 'createSubCategory']);
Route::post('/admin/sub-category/store', [SubCategoryConotroller::class, 'storeSubCategory']);
Route::get('/admin/sub-category/delete/{id}',[SubCategoryConotroller::class, 'deleteSubCategory']);
Route::get('/admin/sub-category/edit/{id}', [SubCategoryConotroller::class, 'editSubCategory']);
Route::post('/admin/sub-category/update/{id}', [SubCategoryConotroller::class, 'updateSubCategory']);