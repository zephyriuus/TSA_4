<?php

use App\Http\Controllers\TaskController;
use App\Models\Task;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    $tasks = Task::where('is_archived', false)
        ->whereDate('task_date', today())
        ->orderBy('task_date')
        ->get();

    return view('home.index', compact('tasks'));
})->name('home');

Route::get('/tasks', [TaskController::class, 'index'])
    ->name('tasks.index');

Route::get('/about', [TaskController::class, 'about'])
    ->name('about');

Route::middleware('auth')->group(function () {
    Route::get('/tasks/create', [TaskController::class, 'create'])
        ->name('tasks.create');

    Route::post('/tasks', [TaskController::class, 'store'])
        ->name('tasks.store');

    Route::get('/tasks/{task}/edit', [TaskController::class, 'edit'])
        ->name('tasks.edit');

    Route::put('/tasks/{task}', [TaskController::class, 'update'])
        ->name('tasks.update');

    Route::delete('/tasks/{task}', [TaskController::class, 'destroy'])
        ->name('tasks.destroy');
});

require __DIR__.'/auth.php';