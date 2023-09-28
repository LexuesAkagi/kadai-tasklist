<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TasksController;
use App\Http\Controllers\RouteServiceProvider;

Route::get('/', function () {
    return view('dashboard');})->name('welcome');

Route::get('/dashboard', function () {
    return view('tasks.index');
    }
    )
    ->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::get('/tasks/index', [TasksController::class, 'index'])->name('tasks.index');
    Route::resource('tasks', TasksController::class);
});

require __DIR__.'/auth.php';
