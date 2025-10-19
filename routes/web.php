<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\{
    RegisterController, AdminRegisterController, LoginController, LandingController,
    AdminController, ClientController, ProductController, AdminProductController,
    AdminUserController, ChatbotController
};

// --- Public Routes ---
Route::get('/', fn() => view('landing_public'));
Route::get('/landing', [LandingController::class, 'index'])->name('landing');

Route::get('/signup', [RegisterController::class, 'show'])->name('register.form');
Route::post('/signup', [RegisterController::class, 'store'])->name('register.store');

Route::prefix('admin')->group(function () {
    Route::get('/register', [AdminRegisterController::class, 'show'])->name('admin.register.form');
    Route::post('/register', [AdminRegisterController::class, 'store'])->name('admin.register.store');
});

Route::get('/login', [LoginController::class, 'show'])->name('login.form');
Route::post('/login', [LoginController::class, 'login'])->name('login');
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

// --- Authenticated Users (Products + Chatbot) ---
Route::middleware('auth')->group(function () {
    Route::get('/products', [ProductController::class, 'index'])->name('products.index');
    Route::prefix('chatbot')->group(function () {
        Route::get('/', [ChatbotController::class, 'index'])->name('chatbot');
        Route::post('/send', [ChatbotController::class, 'send'])->name('chatbot.send');
        Route::get('/{id}', [ChatbotController::class, 'showConversation'])->name('chatbot.show');
        Route::post('/new', [ChatbotController::class, 'newSession'])->name('chatbot.new');
        Route::post('/{id}/rename', [ChatbotController::class, 'rename'])->name('chatbot.rename');
        Route::delete('/{id}', [ChatbotController::class, 'deleteSession'])->name('chatbot.delete');
    });
});

// --- Admin Routes ---
Route::middleware(['auth', \App\Http\Middleware\AdminMiddleware::class])
    ->prefix('admin')->group(function () {
        Route::get('/', [AdminController::class, 'index'])->name('admin.dashboard');
        Route::get('/profile', [AdminController::class, 'profile'])->name('admin.profile');
        Route::put('/profile', [AdminController::class, 'updateProfile'])->name('admin.updateProfile');
        Route::post('/change-password', [AdminController::class, 'changePassword'])->name('admin.changePassword');
        Route::post('/logout', [AdminController::class, 'logout'])->name('admin.logout');
        Route::get('/export', [AdminController::class, 'export'])->name('admin.export');

        Route::prefix('products')->group(function () {
            Route::get('/', [AdminProductController::class, 'index'])->name('admin.products');
            Route::post('/', [AdminProductController::class, 'store'])->name('admin.products.store');
            Route::put('/{product}', [AdminProductController::class, 'update'])->name('admin.products.update');
            Route::delete('/{product}', [AdminProductController::class, 'destroy'])->name('admin.products.destroy');
        });

        Route::prefix('manage-users')->group(function () {
            Route::get('/', [AdminUserController::class, 'index'])->name('users.index');
            Route::put('/{user}', [AdminUserController::class, 'update'])->name('users.update');
            Route::delete('/{user}', [AdminUserController::class, 'destroy'])->name('users.destroy');
        });
    });

// --- Client Routes ---
Route::middleware(['auth', \App\Http\Middleware\ClientMiddleware::class])
    ->prefix('client')->group(function () {
        Route::get('/', [ClientController::class, 'index'])->name('client.dashboard');
        Route::get('/landing', [ClientController::class, 'landing'])->name('client.landing');
        Route::get('/profile', [ClientController::class, 'show'])->name('client.profile');
        Route::get('/profile/edit', [ClientController::class, 'edit'])->name('client.profile.edit');
        Route::put('/profile/update', [ClientController::class, 'updateProfile'])->name('client.updateProfile');
        Route::post('/change-password', [ClientController::class, 'changePassword'])->name('client.changePassword');
        Route::post('/logout', [ClientController::class, 'logout'])->name('client.logout');
    });
