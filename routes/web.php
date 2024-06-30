<?php

use App\Http\Controllers\PresetController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProjectController;
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
     * Projects
     */
    Route::get('project', [ProjectController::class, 'index'])->name('project.index');

    Route::get('project/create', [ProjectController::class, 'create'])->name('project.create');
    Route::post('project', [ProjectController::class, 'store'])->name('project.store');
    Route::put('project/{id}', [ProjectController::class, 'update'])->name('project.update');

    Route::get('project/edit/{id}', [ProjectController::class, 'edit'])->name('project.edit');
    Route::delete('project/{id}', [ProjectController::class, 'destroy'])->name('project.destroy');

    /**
     * Preset
     */
    Route::get('preset', [PresetController::class, 'index'])->name('preset.index');


    /**
     * File list
     */
    Route::get('study/{id}/files', [StudyFiles::class, 'index'])->name('files.index');

    /**
     * Study page
     */
    Route::get('study/{id}', [StudyController::class, 'index'])->name('study.index');
});




require __DIR__ . '/auth.php';
