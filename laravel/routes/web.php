<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\StatusController;
use App\Http\Controllers\LabelController;
use App\Http\Controllers\TaskController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('main');
});

Route::get('/tasks', [TaskController::class, 'index'])->name('task.index');
Route::get('/tasks/create', [TaskController::class, 'create'])->name('task.create');
Route::POST('/tasks', [TaskController::class, 'store'])->name('task.store');
Route::get('/tasks/{id}/edit', [TaskController::class, 'edit'])->name('task.edit');
Route::patch('/tasks/{id}', [TaskController::class, 'update'])->name('task.update');
Route::delete('/tasks/{id}', [TaskController::class, 'destroy'])->name('task.destroy');

Route::get('/task_statuses', [StatusController::class, 'index'])->name('status.index');
Route::get('/task_statuses/create', [StatusController::class, 'create'])->name('status.create');
Route::POST('/task_statuses', [StatusController::class, 'store'])->name('status.store');
Route::get('/task_statuses/{id}/edit', [StatusController::class, 'edit'])->name('status.edit');
Route::patch('/task_statuses/{id}', [StatusController::class, 'update'])->name('status.update');
Route::delete('/task_statuses/{id}', [StatusController::class, 'destroy'])->name('status.destroy');

Route::get('/labels', [LabelController::class, 'index'])->name('label.index');
Route::get('/labels/create', [LabelController::class, 'create'])->name('label.create');
Route::POST('/labels', [LabelController::class, 'store'])->name('label.store');
Route::get('/labels/{id}/edit', [LabelController::class, 'edit'])->name('label.edit');
Route::patch('/labels/{id}', [LabelController::class, 'update'])->name('label.update');
Route::delete('/labels/{id}', [LabelController::class, 'destroy'])->name('label.destroy');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
