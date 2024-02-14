<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;




use App\Http\Controllers\ShortLinkController;

Route::middleware(['auth','verified'])->group(function () {
    Route::get('/generate-shorten-link', [ShortLinkController::class, 'index'])->name('generate.shorten.link');
    Route::post('/generate-shorten-link', [ShortLinkController::class, 'store'])->name('generate.shorten.link.store');
    Route::get('/s/{code}', [ShortLinkController::class, 'redirect'])->name('shorten.link.redirect');
    
    Route::post('logout', [ShortLinkController::class, 'logout'])->name('logout');

});

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth','verified')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
