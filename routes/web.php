<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\ProdukController;
use App\Http\Controllers\ChangePasswordController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\BerandaController;
use Illuminate\Support\Facades\Auth;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::group(['middleware' => 'guest'], function() {
    Route::get('/lupa-password', [AuthController::class, 'getForgetPassword'])->name('getForgetPassword');
    Route::get('/login', [AuthController::class, 'getLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'doLogin']);
    Route::get('/register', [AuthController::class, 'getRegister']);
    Route::post('/register', [AuthController::class, 'doRegister']);
});
Route::get('/logout', [AuthController::class, 'doLogout'])->middleware('auth');




//ganti password
Route::resource('change-password', ChangePasswordController::class)->middleware('auth');

//update profile
Route::patch('/profile-update', [UsersController::class, 'updateProfile'])->name('user.profile-update')->middleware('auth');

//get profile
Route::get('/profile', [UsersController::class, 'getProfile'])->middleware('auth');

// User
Route::resource('user', UsersController::class)->middleware('can:isAdmin');

// produk
Route::resource('produk', ProdukController::class)->middleware('can:isAdmin');

// order
Route::group(['prefix' => 'order'], function() {
    Route::patch('/{order}/update-status', [OrderController::class, 'updateStatus'])->middleware('can:isAdmin');
    Route::get('/{order}/print', [OrderController::class, 'print'])->name('order.print')->middleware('auth');

});

Route::resource('order', OrderController::class);


Route::get('/', function () {
    if (Auth::check()){
        return redirect('/beranda');
    }
    //return view('welcome');
    return redirect('/login');
});


Route::resource('beranda', BerandaController::class)->middleware('auth');


