<?php

use App\Http\Controllers\MahasiswaController;
use App\Http\Controllers\MahasiswaDbController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::resource('/mahasiswa', MahasiswaController::class);

Route::get(
    '/db/mahasiswa/list', [MahasiswaDbController::class, 'show']
);
Route::get(
    '/db/mahasiswa/{id}', [MahasiswaDbController::class, 'index']
);
Route::post(
    '/db/mahasiswa/save', [MahasiswaDbController::class, 'store']
);
Route::delete(
    '/db/mahasiswa/{id}', [MahasiswaDbController::class, 'destroy']
);
