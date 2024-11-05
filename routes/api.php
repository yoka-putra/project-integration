<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AreaController;
use App\Http\Controllers\OutletController;
use App\Http\Controllers\AsetController;
use App\Http\Controllers\KlasifikasiController;
use App\Http\Controllers\JadwalMaintenanceController;


Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout']);

Route::group(['middleware' => 'auth:api'], function () {

    //user
    Route::post('/register', [AuthController::class, 'register']);
    Route::get('/me', [AuthController::class, 'me']);
    Route::get('/users/get', [AuthController::class, 'getAllUsers']);
    Route::get('/users/get/{id}', [AuthController::class, 'getUsers']);
    Route::delete('/users/delete/{id}', [AuthController::class, 'deleteUsers']);
    Route::post('/users/search', [AuthController::class, 'searchUsers']);
    Route::put('/users/edit/{id}', [AuthController::class, 'updateUsers']);
    Route::post('users/reset-password/{id}', [AuthController::class, 'resetPassword']);

    //aset
    Route::get('/asets/get', [AsetController::class, 'getAsetAll']);
    Route::get('/asets/get/{id}', [AsetController::class, 'getAset']);
    Route::post('/asets/create', [AsetController::class, 'createAset']);
    Route::put('/asets/update/{id}', [AsetController::class, 'updateAset']);
    Route::delete('/asets/delete/{id}', [AsetController::class, 'deleteAset']);
    Route::post('/asets/search', [AsetController::class, 'searchAset']);
    Route::put('/asets/update/status/{id}', [AsetController::class, 'updateAsetStatus']);

    //area
    Route::post('/area/create', [AreaController::class, 'createArea']);
    Route::put('/area/update/{id}', [AreaController::class, 'updateArea']);
    Route::delete('area/delete/{id}', [AreaController::class, 'deleteArea']);
    Route::get('/area/get/all', [AreaController::class, 'getAreaAll']);
    Route::get('area/get/{id}', [AreaController::class, 'getArea']);

    //klasifikasi
    Route::post('/klasifikasi/create', [KlasifikasiController::class, 'createKlasifikasi']);
    Route::get('/klasifikasi/getAll', [KlasifikasiController::class, 'getKlasifikasiAll']);
    Route::get('/klasifikasi/get/{id}', [KlasifikasiController::class, 'getKlasifikasi']);

    //outlet
    Route::get('/outlets/getAll', [OutletController::class, 'getOutletAll']);
    Route::post('/outlet/create', [OutletController::class, 'createOutlet']);
    Route::get('/outlets/get/{id}', [OutletController::class, 'getOutlet']);
    Route::put('/outlets/update/{id}', [OutletController::class, 'updateOutlet']);
    Route::delete('/outlets/delete/{id}', [OutletController::class, 'deleteOutlet']);

    //maintenance
    Route::post('/create/jadwal', [JadwalMaintenanceController::class, 'Jadwal']);
});

// Route::controller(AuthController::class)->group(function () {
// Route::post('/register', 'register');
// Route::post('/login', 'login');
// Route::post('/logout', 'logout');
// Route::get('/me', 'me'); // Mendapatkan data user yang sedang login
//});

// Route yang membutuhkan autentikasi JWT
// Route::middleware(['jwt.auth'])->group(function () {
//     Route::get('areas', [AreaController::class, 'index']);
//     Route::post('areas', [AreaController::class, 'store']);
//     Route::get('areas/{id}', [AreaController::class, 'show']);
//     Route::put('areas/{id}', [AreaController::class, 'update']);
//     Route::delete('areas/{id}', [AreaController::class, 'destroy']);
    
// });

// Route::middleware(['jwt.auth'])->group(function () {
//     Route::get('/user', function () {
//         return auth()->user();
//     });
// });

