<?php

use App\Http\Controllers\TaskController;
use App\Http\Controllers\TodoListController;
use Illuminate\Support\Facades\Route;

Route::get('/', [TodoListController::class, 'index']);

Route::resources([
    'todoLists' => TodoListController::class,
    'tasks' => TaskController::class,
]);


Route::get('todoLists/{todoList}/tasks/create', [TaskController::class, 'create'])->name('tasks.create');
Route::patch('tasks/{task}/toggleCompletion', [TaskController::class, 'toggleCompletion'])->name('tasks.toggleCompletion');
