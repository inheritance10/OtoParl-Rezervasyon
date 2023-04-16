<?php

use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use App\Http\Controllers\UserController;
use App\Http\Controllers\Frontend\HomeController;
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


Route::group(['middleware' => 'auth'], function (){
    Route::get('/otoparkcim', [HomeController::class,'index'])->name('home');
    Route::get('/get-park-place/{id}/{floor}', [HomeController::class,'getParkPlace'])->name('get-park-place');
    Route::get('/reservation/{id}/{date}', [HomeController::class,'reservation'])->name('reservation');
    Route::post('/date-reservation-confirm', [HomeController::class,'dateReservationConfirm'])->name('date-reservation-confirm');
    Route::post('/hour-reservation-confirm', [HomeController::class,'hourReservationConfirm'])->name('hour-reservation-confirm');
    Route::post('/dateQuery', [HomeController::class,'dateQuery'])->name('dateQuery');
});

Route::prefix('/')->group(function () {
    Route::get('/', [UserController::class,'login'])->name('signin');
    Route::post('/loginPost', [UserController::class,'loginPost'])->name('loginPost');
    Route::post('/logout', [UserController::class,'logout'])->name('logout');
    Route::get('/register', [UserController::class,'register'])->name('register');
    Route::post('/registerPost', [UserController::class,'registerPost'])->name('registerPost');
});


