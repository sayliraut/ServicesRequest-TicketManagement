<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\TicketController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Category Management Routes
Route::get('/categories', [CategoryController::class, 'index'])->name('categories.index');
Route::get('/categories/list', [CategoryController::class, 'list'])->name('categories.list');
Route::get('/categories/loadajax', [CategoryController::class, 'loadAjax'])->name('categories.loadajax');
Route::get('/categories/create', [CategoryController::class, 'create'])->name('categories.create');
Route::post('/categories/store', [CategoryController::class, 'store'])->name('categories.store');
Route::get('/categories/{category}/edit', [CategoryController::class, 'edit'])->name('categories.edit');
Route::put('/categories/{category}', [CategoryController::class, 'update'])->name('categories.update');
Route::delete('/categories/{category}', [CategoryController::class, 'destroy'])->name('categories.destroy');
Route::post('/categories/{category}/toggle', [CategoryController::class, 'toggle'])->name('categories.toggle');

// Service Request Routes (User)
Route::middleware('auth')->group(function () {
    Route::get('/requests/create', [TicketController::class, 'create'])->name('tickets.create');
    Route::post('/requests/store', [TicketController::class, 'store'])->name('tickets.store');
    Route::get('/requests', [TicketController::class, 'index'])->name('tickets.index');
    Route::get('/requests/{ticket}', [TicketController::class, 'show'])->name('tickets.show');
});

// Service Request Routes (Admin/Agent)
Route::middleware('auth')->group(function () {
    Route::get('/admin/requests', [TicketController::class, 'adminIndex'])->name('tickets.admin-index');
    Route::put('/admin/requests/{ticket}/status', [TicketController::class, 'updateStatus'])->name('tickets.update-status');
});

require __DIR__.'/auth.php';
