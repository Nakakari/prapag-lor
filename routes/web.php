<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DataRumahController;
use App\Http\Controllers\KetuaRtController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

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


Auth::routes();

Route::group(['middleware' => 'auth'], function () {

    Route::get('/', [DashboardController::class, 'index'])->name('index');

    /* KETUA RT */
    Route::resource('/ketua-rt', KetuaRtController::class);

    /* DATA RUMAH */
    Route::get('/data-rumah/rekap', [DataRumahController::class, 'rekap'])->name('data-rumah.rekap');
    Route::resource('/data-rumah', DataRumahController::class);

    /* USER */
    Route::get('user/check', [UserController::class, 'check'])->name('user.check');
    Route::get('user/profile', [UserController::class, 'profile'])->name('user.profile');
    Route::resource('user', UserController::class);
});
