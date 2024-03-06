<?php

use App\Http\Controllers\API\ApiBuku;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\ApiKategori;


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

// Kategori
Route::get('/kategori', [ApiKategori::class, 'getData']);
Route::post('/kategori/store', [ApiKategori::class, 'store']);
Route::get('/kategori/show/{id}', [ApiKategori::class, 'show']);
Route::get('/kategori/edit/{id}', [ApiKategori::class, 'edit']);
Route::post('/kategori/update/{id}', [ApiKategori::class, 'update']);
Route::delete('/kategori/delete/{id}', [ApiKategori::class, 'destroy']);

// Buku
Route::get('/buku', [ApiBuku::class, 'getData']);
Route::post('/buku/store', [ApiBuku::class, 'store']);
Route::get('/buku/show/{id}', [ApiBuku::class, 'show']);
Route::get('/buku/edit/{id}', [ApiBuku::class, 'edit']);
Route::post('/buku/update/{id}', [ApiBuku::class, 'update']);
Route::delete('/buku/delete/{id}', [ApiBuku::class, 'destroy']);
