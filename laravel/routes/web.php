<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\StatusController;
use App\Http\Controllers\LabelController;
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
    return view('welcome');
});

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
