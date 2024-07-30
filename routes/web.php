<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DataKematianController;
use App\Http\Controllers\DataRumahController;
use App\Http\Controllers\KetuaRtController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PendudukController;
use App\Models\DataKematian;
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
    Route::get('/data-rumah/rekap', [DataRumahController::class, 'rekap'])->name('data-rumah-warga.rekap');
    Route::resource('/data-rumah-warga', DataRumahController::class);

    /* USER */
    Route::get('user/check', [UserController::class, 'check'])->name('user.check');
    Route::get('user/profile', [UserController::class, 'profile'])->name('user.profile');
    Route::resource('user', UserController::class);

    /* PENDUDUK */
    Route::controller(PendudukController::class)->prefix('penduduk')->group(function () {
        Route::get('', 'index')->name('penduduk.index');
        Route::get('create', 'create')->name('penduduk.create');
        Route::post('save', 'store')->name('penduduk.store');
        Route::get('edit/{uuid}', 'edit')->name('penduduk.edit');
        Route::put('update/{uuid}', 'update')->name('penduduk.update');
        Route::delete('delete/{id}', 'destroy')->name('penduduk.destroy');
        Route::get('detail/{id}', 'shoow')->name('penduduk.show');
        Route::get('rekap', 'rekap')->name('penduduk.rekap');
        Route::get('export-rekap', 'exportRekap')->name('penduduk.export-rekap');
        Route::get('surat-tidak-manpu/{id}', 'suratTidakMampu')->name('penduduk.surat-tidak-mampu');
        Route::get('export-monografi', 'exportMonografi')->name('penduduk.export-monografi');
        Route::post('data-monografi', 'dataMonografi')->name('penduduk.data-monografi');
        // EXPORT PDF EXCEL PENDUDUK
        Route::get('penduduk-export', 'pendudukExport')->name('penduduk.register-export');
    });

    /* DATA KEMATIAN */
    Route::controller(DataKematianController::class)->prefix('data-kematian')->group(function () {
        Route::get('surat-kematian/{uuid}', 'printSuratKematian')->name('data-kematian.surat-kematian');
        Route::get('print-excel', 'printExcel')->name('data-kematian.print-excel');
        Route::get('print', 'print')->name('data-kematian.print');
        Route::get('upload', 'uploadForm')->name('data-kematian.upload-form');
        Route::post('upload', 'upload')->name('data-kematian.upload');
    });
    Route::resource('data-kematian', DataKematianController::class);
});
