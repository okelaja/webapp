<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MahasantriController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\BukuController;
use App\Http\Controllers\Controller;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('master.app');
})->middleware(['auth', 'verified'])->name('dashboard');

// jalur ini di izinkan untuk user yang sudah login dan untuk user yang yang role nya itu user dan admin
Route::middleware(['auth','roles:user,admin'])->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // buat kategori
    Route::get('/kategori', [KategoriController::class, 'index'])->middleware(['auth', 'verified'])->name('kategori');
    Route::get('/kategori/create', [KategoriController::class, 'create']) ->name('kategori.create');

    Route::post('/kategori/store', [KategoriController::class, 'store']) ->name('kategori.store');
    Route::get('/kategori/show/{id}', [KategoriController::class, 'show']) ->name('kategori.show');
    // ini file edit dan fungsi update
    Route::get('/kategori/edit/{id}', [KategoriController::class, 'edit']) ->name('kategori.edit');
    Route::put('/kategori/update/{id}', [KategoriController::class, 'update']) ->name('kategori.update');
    // fungsi delete
    Route::get('/kategori/delete/{id}', [KategoriController::class, 'destroy']) ->name('kategori.delete');

    // Bisa menggunakan route yang di bawah ini agar mengambil route yang di kategori
    // estimasinya adalah kita harus faham der
    // Route::resource('buku', BukuController::class);
});

// ini jalur khusus untuk admin
Route::middleware(['auth','roles:admin'])->group(function () {
    // buat buku
    Route::get('/buku', [BukuController::class, 'index']) ->name('buku');
    Route::get('/buku/create', [BukuController::class, 'create']) ->name('buku.create');

    Route::post('/buku/store', [BukuController::class, 'store']) ->name('buku.store');
    Route::get('/buku/show/{id}', [BukuController::class, 'show']) ->name('buku.show');

    Route::get('/buku/edit/{id}', [BukuController::class, 'edit']) ->name('buku.edit');
    Route::put('/buku/update/{id}', [BukuController::class, 'update']) ->name('buku.update');

    Route::get('/buku/delete/{id}', [BukuController::class, 'destroy']) ->name('buku.delete');

});


// Route::get('/dashboard', function () {
//     return view('dashboard');
// });

// routing dengan controller
// Route::get('/dashboard', [Controller::class, 'index']) ->name('dashboard');

Route::get('/mahasantri_petik', [MahasantriController::class, 'index']) ->name('santri');
Route::get('/mahasantri/{id}', [MahasantriController::class, 'getid']);
Route::get('/mahasantri_cari', [MahasantriController::class, 'cari'])->name('search');

//// ini jalur redirect kalo user nya role user
// Route::get('/user', function () {
//     return "Anda User Aplikasi";
// })->name('user')->middleware('auth');

// // ini jalur redirect kalo user nya role admin
// Route::get('/admin', function () {
//     return "Selamat datang Administator";
// })->name('admin')->middleware('auth');



require __DIR__.'/auth.php';