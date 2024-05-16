<?php

use App\Http\Controllers\ProjectController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\UserController;
use App\Http\Middleware\isOwner;
use Illuminate\Support\Facades\Route;


Auth::routes();

Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::resource('users', UserController::class)->middleware(isOwner::class);
Route::resource('projects', ProjectController::class);
Route::get('/projects/{id}/create-tasks', [TaskController::class, 'create'])->name('projects.create-task');
Route::get('/projects/{project_id}/{task_id}/edit', [TaskController::class, 'edit'])->name('projects.edit-task');
Route::resource('tasks',TaskController::class);
