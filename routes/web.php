<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\RoomController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\DeviceController;
use App\Http\Controllers\ComplaintController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])
    ->name('home');

/*
|--------------------------------------------------------------------------
| SEMUA USER LOGIN
|--------------------------------------------------------------------------
*/

Route::middleware(['auth'])->group(function () {

    // Semua role bisa melihat complaints
    Route::resource('complaints', ComplaintController::class);

    // Hanya teknisi yang boleh mengambil laporan
    Route::post('/complaints/{complaint}/take', [ComplaintController::class, 'take'])
        ->middleware('role:teknisi')
        ->name('complaints.take');

});

/*
|--------------------------------------------------------------------------
| ADMIN
|--------------------------------------------------------------------------
*/

Route::middleware(['auth','role:admin'])->group(function () {

    Route::get('/dashboard-admin', [DashboardController::class, 'admin'])
        ->name('dashboard.admin');

    Route::resource('rooms', RoomController::class);
    Route::resource('categories', CategoryController::class);
    Route::resource('devices', DeviceController::class);

});

/*
|--------------------------------------------------------------------------
| TEKNISI
|--------------------------------------------------------------------------
*/

Route::middleware(['auth','role:teknisi'])->group(function () {

    Route::get('/dashboard-teknisi', [DashboardController::class, 'teknisi'])
        ->name('dashboard.teknisi');

});

/*
|--------------------------------------------------------------------------
| USER
|--------------------------------------------------------------------------
*/

Route::middleware(['auth','role:user'])->group(function () {

    Route::get('/dashboard-user', [DashboardController::class, 'user'])
        ->name('dashboard.user');

});