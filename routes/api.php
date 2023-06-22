<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProductGroupController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\OrderProductController;
use App\Http\Controllers\ProductController;
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


Route::post('/register', [AuthController::class, 'register'])->name('register');
Route::post('/login', [AuthController::class, 'login'])->name('login');

Route::group(['middleware'=>['auth:sanctum']], function (){
    //Auth
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
    Route::post('/changepassword', [AuthController::class, 'changePassword'])->name('changePassword');
    //product group
    Route::post('/createproductgroup', [ProductGroupController::class, 'create'])->name('createproductgroup');

    //order
    Route::post('/createorder', [OrderController::class, 'create'])->name('createorder');
    //order_product
    Route::post('/createorderproduct/{order_id}', [OrderProductController::class, 'create'])->name('createorderproduct');



});
//product
Route::get('/product', [ProductController::class, 'showAll'])->name('showallproduct');
Route::delete('/productdelete/{id}', [ProductController::class, 'delete'])->name('delete');
Route::post('/productupdate/{id}', [ProductController::class, 'update'])->name('update');
Route::post('/createproduct', [ProductController::class, 'create'])->name('create');
//product group
Route::get('/productgroup', [ProductGroupController::class, 'showAll'])->name('showallproductgroup');
Route::delete('/productgroupdelete/{id}', [ProductGroupController::class, 'delete'])->name('delete');
Route::post('/editproductgroup/{id}', [ProductGroupController::class, 'update'])->name('update');
