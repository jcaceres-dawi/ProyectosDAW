<?php

use App\Http\Controllers\PptController;

use App\Http\Controllers\ChirpController;
use App\Http\Controllers\DibujoController;
use App\Http\Controllers\ExpenseController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect('/login');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::resource('chirps', ChirpController::class)
    ->only(['index', 'store', 'edit', 'update', 'destroy'])
    ->middleware(['auth', 'verified']);

// PPT
Route::middleware(['auth'])->group(function () {
    Route::get('/ppt', [PptController::class, 'index'])->name('ppt.index');
    Route::post('/ppt/jugar', [PptController::class, 'jugar'])->name('ppt.jugar');
});

Route::resource('expense', ExpenseController::class)->middleware(['auth', 'verified']);

Route::resource('dibujos', DibujoController::class);
/* Route::get('/', function () {
    return redirect()->route('dibujos.index');
}); */

require __DIR__ . '/auth.php';
