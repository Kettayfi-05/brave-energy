<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Admin\DashboardController;

// ─── Public Routes ────────────────────────────────────────────────────────────
Route::get('/', function () {
    return view('welcome');
});

// ─── Breeze Profile Routes (auth users) ───────────────────────────────────────
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// ─── Admin Routes ─────────────────────────────────────────────────────────────
Route::prefix('admin')->name('admin.')->middleware(['auth', 'admin'])->group(function () {

    // Dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Placeholder routes – full controllers will be added later
    Route::get('/products',   fn() => view('admin.products.index'))->name('products.index');
    Route::get('/orders',     fn() => view('admin.orders.index'))->name('orders.index');
    Route::get('/users',      fn() => view('admin.users.index'))->name('users.index');
    Route::get('/categories', fn() => view('admin.categories.index'))->name('categories.index');
    Route::get('/chatbot',    fn() => view('admin.chatbot.index'))->name('chatbot.index');
});

// ─── Auth Routes (Breeze) ─────────────────────────────────────────────────────
require __DIR__.'/auth.php';
