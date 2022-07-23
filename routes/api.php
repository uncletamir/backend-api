<?php

namespace App\Http\Controllers;

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

Route::post('/register', [RegisterController::class, 'register']);
Route::post('/login', [LoginController::class, 'login']);
Route::post('/logout', [LoginController::class, 'logout'])->middleware('auth:api');

Route::resource('/post', PostController::class)->middleware('auth:api');
Route::resource('/kategori', KategoriController::class)->middleware('auth:api');
Route::resource('/lokasi', LokasiController::class)->middleware('auth:api');
Route::resource('/inventory', InventoryController::class)->middleware('auth:api');
// Route::resource('/kategori', KategoriController::class);
Route::resource('/barang', BarangController::class)->middleware('auth:api');

