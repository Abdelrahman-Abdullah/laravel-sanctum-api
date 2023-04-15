<?php

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

Route::get('/products' ,[ProductController::class , 'index']);
Route::post('/products' , [ProductController::class , 'store']);
Route::get('/products/{id}' , [ProductController::class , 'show']);
Route::delete('/products/delete/{id}' , [ProductController::class , 'delete']);

//Route::group(['middleware'=>['auth:sanctum']] , function (){
//    Route::get('/products' ,[ProductController::class , 'index']);
//});
Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
