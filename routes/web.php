<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ChatbotController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\ChatbotController as AdminChatbotController;

// Public Routes
Route::view('/', 'home.index')->name('home');
Route::view('/dashboard', 'dashboard')->name('dashboard');
Route::view('/about', 'about.index')->name('about');
Route::view('/contact', 'contact.index')->name('contact');

// Search
Route::get('/recherche', [SearchController::class, 'index'])->name('search.index');

// Chatbot API (public)
Route::post('/chatbot/message', [ChatbotController::class, 'message'])->name('chatbot.message');

// Breeze Profile Routes
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Admin Routes
Route::prefix('admin')->name('admin.')->middleware(['auth', 'admin'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/products',   fn() => view('admin.products.index'))->name('products.index');
    Route::get('/orders',     fn() => view('admin.orders.index'))->name('orders.index');
    Route::get('/users',      fn() => view('admin.users.index'))->name('users.index');
    Route::get('/categories', fn() => view('admin.categories.index'))->name('categories.index');
    Route::get('/chatbot',               [AdminChatbotController::class, 'index'])->name('chatbot.index');
    Route::post('/chatbot',              [AdminChatbotController::class, 'store'])->name('chatbot.store');
    Route::put('/chatbot/{chatbot}',     [AdminChatbotController::class, 'update'])->name('chatbot.update');
    Route::delete('/chatbot/{chatbot}',  [AdminChatbotController::class, 'destroy'])->name('chatbot.destroy');
});

// Auth Routes (Breeze)
require __DIR__.'/auth.php';
