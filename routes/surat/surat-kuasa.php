<?php

use App\Http\Controllers\Surat\SuratKuasaController;
use Illuminate\Support\Facades\Route;

Route::prefix('surat-kuasa')->group(function () {
    Route::get('/export-register', [SuratKuasaController::class, 'export'])
        ->name('surat-kuasa.report-export');
    Route::get('/cetak/{id}', [SuratKuasaController::class, 'cetak'])
        ->name('surat-kuasa.cetak');
});

Route::resource('surat-kuasa', SuratKuasaController::class);
