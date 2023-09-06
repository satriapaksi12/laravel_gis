<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\LocationController;
use Illuminate\Support\Facades\Route;

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
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/lokasi', [LocationController::class, 'index'])->name('lokasi.index');
    Route::get('/lokasi/create', [LocationController::class, 'create'])->name('lokasi.create');
    Route::post('/lokasi', [LocationController::class, 'store'])->name('lokasi.store');
    Route::post('/lokasi/{id}', [LocationController::class, 'destroy'])->name('lokasi.delete');

});


Route::get('/track_lokasi', function () {
    return view('TrackLokasi');
})->middleware(['auth', 'verified'])->name('track_lokasi');



// Rute untuk menampilkan formulir dan menyimpan data lokasi

require __DIR__.'/auth.php';
