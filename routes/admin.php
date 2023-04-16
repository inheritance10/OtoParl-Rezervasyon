<?php


use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Backend\DefaultController;
use App\Http\Controllers\Backend\CarParkController;
use App\Http\Controllers\Backend\CarParkPlaceController;

Route::prefix('/admin')->group(function () {
    Route::get('/', [DefaultController::class,'index'])->name('dasboard');
    Route::get('/car-park-info', [CarParkController::class,'index'])->name('car-park-info');
    Route::get('/car-park-edit/{id}', [CarParkController::class,'edit'])->name('car-park-edit');
    Route::get('/car-park-add', [CarParkController::class,'add'])->name('car-park-add');
    Route::post('/car-park-create', [CarParkController::class,'store'])->name('car-park-create');
    Route::post('/car-park-update', [CarParkController::class,'update'])->name('car-park-update');
    Route::get('/car-park-delete', [CarParkController::class,'delete'])->name('car-park-delete');

    Route::get('car-park-place', [CarParkPlaceController::class, 'index'])->name('car-park-place');

});
