<?php

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

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::get('/product/{id}', [\App\Http\Controllers\API\ProductController::class, 'show']);
Route::get('/product', [\App\Http\Controllers\API\ProductController::class, 'index']);
Route::post('/product', [\App\Http\Controllers\API\ProductController::class, 'store']);
Route::put('/product/{id}', [\App\Http\Controllers\API\ProductController::class, 'update']);
Route::delete('/product/{id}', [\App\Http\Controllers\API\ProductController::class, 'destroy']);
