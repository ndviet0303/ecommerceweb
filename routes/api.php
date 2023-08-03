<?php

use App\Http\Controllers\AdminController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Auth\funcController;
use App\Http\Controllers\Auth\loginController;
use App\Http\Controllers\Auth\registerController;
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


Route::get("/products", [ProductController::class, 'showProduct']);
Route::get("/Allproducts", [ProductController::class, 'showAllProduct']);
Route::get("/product/{id}", [ProductController::class, 'productInfo']);
Route::get("/getProductType", [funcController::class, 'getProductType']);
Route::post("/register", [registerController::class, 'register']);
Route::post("/login", [loginController::class, 'login']);
Route::middleware('auth:sanctum')->group(function () {
    Route::get('/check-login', [loginController::class, 'checkLogin']);
    Route::post('/logout', [loginController::class, 'logout']);
    Route::post('/change-password', [AuthController::class, 'changePassword']);
    Route::post('/user', [AuthController::class, 'user']);
    Route::post('/paid', [funcController::class, 'paid']);

    Route::middleware('admin')->prefix('admin')->group(function () {
        Route::get('products', [AdminController::class, 'products']);
        Route::post('product/add', [AdminController::class, 'productAdd']);
    });
});
