<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ChatbotController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\WishlistController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\ChatbotController as AdminChatbotController;
use App\Http\Controllers\Admin\CategoryController as AdminCategoryController;
use App\Http\Controllers\Admin\ProductController as AdminProductController;
use App\Http\Controllers\Admin\OrderController as AdminOrderController;
use App\Http\Controllers\Admin\UserController as AdminUserController;
use App\Http\Controllers\Admin\ContactMessageController as AdminContactMessageController;

// Public Routes
Route::view('/', 'home.index')->name('home');
Route::view('/dashboard', 'dashboard')->name('dashboard');
Route::view('/about', 'about.index')->name('about');
Route::get('/contact', [ContactController::class, 'index'])->name('contact');
Route::post('/contact', [ContactController::class, 'store'])->name('contact.store');
Route::get('/promotions', [SearchController::class, 'promotions'])->name('promotions');

// Search
Route::get('/recherche', [SearchController::class, 'index'])->name('search.index');

// Chatbot API (public)
Route::post('/chatbot/message', [ChatbotController::class, 'message'])->name('chatbot.message');

// Authenticated Client Routes (Breeze + Cart + Order + Wishlist)
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Panier (Cart)
    Route::get('/panier', [CartController::class, 'index'])->name('cart.index');
    Route::post('/panier/ajouter', [CartController::class, 'store'])->name('cart.store');
    Route::patch('/panier/modifier/{cartItem}', [CartController::class, 'update'])->name('cart.update');
    Route::delete('/panier/supprimer/{cartItem}', [CartController::class, 'destroy'])->name('cart.destroy');

    // Commandes (Orders)
    Route::get('/commande/valider', [OrderController::class, 'checkout'])->name('orders.checkout');
    Route::post('/commande/valider', [OrderController::class, 'store'])->name('orders.store');
    Route::get('/historique-demandes', [OrderController::class, 'index'])->name('orders.index');
    Route::get('/historique-demandes/{orderRequest}', [OrderController::class, 'show'])->name('orders.show');

    // Wishlist (Favoris)
    Route::get('/wishlist', [WishlistController::class, 'index'])->name('wishlist.index');
    Route::post('/wishlist/toggle/{product}', [WishlistController::class, 'toggle'])->name('wishlist.toggle');
});

// Admin Routes
Route::prefix('admin')->name('admin.')->middleware(['auth', 'admin'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    
    // Resourceful CRUD Admin routes
    Route::resource('/products', AdminProductController::class)->names('products');
    Route::resource('/categories', AdminCategoryController::class)->names('categories');
    Route::resource('/orders', AdminOrderController::class)->only(['index', 'show', 'update'])->names('orders');
    Route::resource('/users', AdminUserController::class)->only(['index', 'update', 'destroy'])->names('users');
    Route::resource('/contact-messages', AdminContactMessageController::class)->only(['index', 'show', 'destroy'])->names('contact-messages');

    // Chatbot Knowledge Base CRUD
    Route::get('/chatbot',               [AdminChatbotController::class, 'index'])->name('chatbot.index');
    Route::post('/chatbot',              [AdminChatbotController::class, 'store'])->name('chatbot.store');
    Route::put('/chatbot/{chatbot}',     [AdminChatbotController::class, 'update'])->name('chatbot.update');
    Route::delete('/chatbot/{chatbot}',  [AdminChatbotController::class, 'destroy'])->name('chatbot.destroy');
});

// Auth Routes (Breeze)
require __DIR__.'/auth.php';
