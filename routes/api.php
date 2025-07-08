<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SesiController;
use App\Http\Controllers\MataKuliahController;
use App\Http\Controllers\JadwalController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\MaterialTypeController;
use App\Http\Controllers\MaterialController;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// Sesi CRUD Routes
Route::apiResource('sesi', SesiController::class);

// MataKuliah CRUD Routes
Route::apiResource('matakuliah', MataKuliahController::class);

// Jadwal CRUD Routes
Route::apiResource('jadwal', JadwalController::class);

// Courses CRUD Routes
Route::apiResource('courses', CourseController::class);

// MaterialType CRUD Routes
Route::apiResource('material-types', MaterialTypeController::class);

// Material CRUD Routes
Route::apiResource('materials', MaterialController::class);