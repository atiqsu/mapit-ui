<?php

use App\Http\Controllers\PresetController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\StudyController;
use App\Http\Controllers\StudyFiles;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');


    /**
     * Studies
     */
    Route::get('study', [StudyController::class, 'index'])->name('study.index');

    Route::get('study/create', [StudyController::class, 'create'])->name('studies.create');
    Route::post('study', [StudyController::class, 'store'])->name('studies.store');
    Route::put('study/{id}', [StudyController::class, 'update'])->name('studies.update');

    Route::get('study/edit/{id}', [StudyController::class, 'edit'])->name('studies.edit');
    Route::delete('study/{id}', [StudyController::class, 'destroy'])->name('studies.destroy');

    /**
     * Preset
     */
    Route::get('preset', [PresetController::class, 'index'])->name('preset.index');


    /**
     * File list
     */
    Route::get('files', [StudyFiles::class, 'index'])->name('files.index');

});




require __DIR__.'/auth.php';
