<?php

use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\API\TaskController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


// Route::middleware(['auth:sanctum'])->group(function () {
Route::get('/task', [TaskController::class, 'create'])->name('task.create');
Route::get('/tasks', [TaskController::class, 'index'])->name('task.index');
Route::post('/tasks', [TaskController::class, 'store'])->name('task.store');
Route::post('/tasks/update-positions', [TaskController::class, 'updatePositions']);
Route::delete('/tasks/{id}', [TaskController::class, 'destroy'])->name('task.destroy');

// });

// Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
// Route::post('/register', [AuthController::class, 'register']);
// Route::post('/login', [AuthController::class, 'login']);
