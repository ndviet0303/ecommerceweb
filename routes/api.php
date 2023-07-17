<?php

use App\Http\Controllers\Auth\loginController;
use App\Http\Controllers\Auth\registerController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


Route::get("/products",[ProductController::class,'showProduct']);
Route::get("/product/{id}",[ProductController::class,'productInfo']);
Route::post("/register" , [registerController::class,'register']);
Route::post("/login" , [loginController::class,'login']);