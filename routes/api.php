<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BiodataController;
use App\Http\Controllers\JurusanController;
use App\Http\Controllers\PendidikanController;
use App\Http\Controllers\RiwayatPendidikanController;

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::middleware('token')->group(function () {
    Route::get('/biodata', [BiodataController::class, 'get']);
    Route::post('/biodata', [BiodataController::class, 'create']);
    Route::patch('/biodata/{id}', [BiodataController::class, 'update']);
    Route::delete('/biodata/{id}', [BiodataController::class, 'delete']);

    Route::get('/pendidikan', [PendidikanController::class, 'get']);
    Route::post('/pendidikan', [PendidikanController::class, 'create']);
    Route::patch('/pendidikan/{id}', [PendidikanController::class, 'update']);
    Route::delete('/pendidikan/{id}', [PendidikanController::class, 'delete']);

    Route::get('/jurusan', [JurusanController::class, 'get']);
    Route::post('/jurusan', [JurusanController::class, 'create']);
    Route::patch('/jurusan/{id}', [JurusanController::class, 'update']);
    Route::delete('/jurusan/{id}', [JurusanController::class, 'delete']);
    
    Route::get('/riwayat', [RiwayatPendidikanController::class, 'get']);
    Route::post('/riwayat', [RiwayatPendidikanController::class, 'create']);
    Route::patch('/riwayat/{id}', [RiwayatPendidikanController::class, 'update']);
    Route::delete('/riwayat/{id}', [RiwayatPendidikanController::class, 'delete']);
});
