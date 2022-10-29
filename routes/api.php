<?php

use App\Http\Controllers\OrderController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
// use App\Http\Controllers\Api\AuthController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/


Route::post('/register', [\App\Http\Controllers\Api\AuthController::class, 'register']);
Route::post('/login', [\App\Http\Controllers\Api\AuthController::class, 'login']);

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

//Route::group(['middleware' => ['auth:sanctum']], function() {
//	Route::get('/get-profile/{id}', [\App\Http\Controllers\Api\AuthController::class, 'getProfile']);
//api/blog/{friendly-url} OR {id}
Route::get('/get-profile/{id}', 'App\Http\Controllers\Api\AuthController@getProfile');
Route::post('/update-profile/{id}', 'App\Http\Controllers\Api\AuthController@updateProfile');
//});

Route::middleware('auth:sanctum')->group(function () {
    Route::post('/logout', [\App\Http\Controllers\Api\AuthController::class, 'logout']);
});

Route::get('/produk', [\App\Http\Controllers\Api\ProdukController::class, 'loadData']);

// order
Route::post('/order/store', [\App\Http\Controllers\Api\OrderController::class, 'store']);

Route::post('/notification', [OrderController::class, 'notification']);
