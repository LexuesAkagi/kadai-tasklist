<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MessagesController;

Route::get('/', [TasksController::class, 'index']);
Route::resource('tasks', TasksController::class);

?>