<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\MahasiswaController; // Tambahkan ini

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

// Route autentikasi
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

// Route yang memerlukan autentikasi
Route::middleware('auth:sanctum')->group(function () {
    // Route logout
    Route::post('/logout', [AuthController::class, 'logout']);
    
    // Route user
    Route::get('/user', function (Request $request) {
        return $request->user();
    });

    // Route CRUD Mahasiswa
    Route::get('/mahasiswa', [MahasiswaController::class, 'index']);
    Route::post('/mahasiswa', [MahasiswaController::class, 'store']);
    Route::get('/mahasiswa/{id}', [MahasiswaController::class, 'show']);
    Route::put('/mahasiswa/{id}', [MahasiswaController::class, 'update']);
    Route::delete('/mahasiswa/{id}', [MahasiswaController::class, 'destroy']);
});