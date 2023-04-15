<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProductController;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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


// Public Api's
Route::post('/register' ,[AuthController::class , 'register']);
Route::post('/login' ,[AuthController::class , 'login']);
Route::get('/products' ,[ProductController::class , 'index']);
Route::get('/products/{id}' , [ProductController::class , 'show']);

// Authenticated Api's
Route::group(['middleware'=>['auth:sanctum']] , function (){
    Route::post('/products' , [ProductController::class , 'store']);
    Route::delete('/products/update/{id}' , [ProductController::class , 'update']);
    Route::delete('/products/delete/{id}' , [ProductController::class , 'delete']);
    Route::post('/logout' ,[AuthController::class , 'logout']);

});
Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
