<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AsetController;


Route::middleware(['web'])->group(function () {
    
});

Route::get('/', function () {
    return view('welcome');
});

Route::get('login', [AuthController::class, 'showLoginForm'])->name('login');

Route::get('masterUser', [AuthController::class, 'masterUserPage'])->name('masterUser');
Route::get('masterAset', [AsetController::class, 'masterAsetPage'])->name('masterAset');
Route::get('addAset', [AsetController::class, 'addAsetPage'])->name('addAset');
Route::get('updateAset/{id}', [AsetController::class, 'updateAsetPage'])->name('updateAset');
Route::get('viewAset/{id}', [AsetController::class, 'show'])->name('viewAset');
Route::get('viewBeforeMaint/{id}', [AsetController::class, 'viewBeforeMain'])->name('viewBeforeMaint');
Route::get('daftarAset', [AsetController::class, 'daftarAsetPage'])->name('daftarAset');
Route::get('qrGenerate/{id}', [AsetController::class, 'qrGeneratePage'])->name('qrGenerate');
Route::get('scanQr', [AsetController::class, 'scanQrPage'])->name('scanQr');
Route::get('resetPw/{id}', [AuthController::class, 'resetPwPage'])->name('resetPw');
Route::get('parameterKesehatan/{id}', [AsetController::class, 'ParameterKesehatanPage'])->name('parameterKesehatan');
