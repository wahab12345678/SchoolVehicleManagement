<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

// Public contact endpoint used by the coming soon page
Route::post('/contact', [\App\Http\Controllers\ContactController::class, 'store'])->name('contact.store');

Route::post('/logout', [\App\Http\Controllers\Auth\LoginController::class, 'logout'])->name('logout');
Route::middleware('guest')->group(function () {
    Route::get('/admin', [\App\Http\Controllers\AdminController::class, 'index'])->name('admin.index'); // Render login page here
    Route::get('/login', [\App\Http\Controllers\Auth\LoginController::class, 'showLoginForm'])->name('login'); // Login form
    Route::post('/login', [\App\Http\Controllers\Auth\LoginController::class, 'login'])->name('login.post'); // Post login request
});

Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::prefix('admin')->group(function () {
        Route::get('/dashboard', [\App\Http\Controllers\Admin\DashboardController::class, 'index'])->name('admin.dashboard');
        Route::prefix('category')->group(function () {
            Route::get('/', [\App\Http\Controllers\Admin\CategoryController::class, 'index'])->name('admin.category');
            Route::get('/list', [\App\Http\Controllers\Admin\CategoryController::class, 'list'])->name('admin.category.list');
            Route::post('/create', [\App\Http\Controllers\Admin\CategoryController::class, 'create'])->name('admin.category.create');
            Route::post('/update',  [\App\Http\Controllers\Admin\CategoryController::class, 'update'])->name('categories.update');
            Route::delete('/categories/{id}', [\App\Http\Controllers\Admin\CategoryController::class, 'destroy'])->name('categories.destroy');
            Route::post('/change-status', [\App\Http\Controllers\Admin\CategoryController::class, 'toggleStatus'])->name('categories.change-status');
            Route::post('/change-visibility', [\App\Http\Controllers\Admin\CategoryController::class, 'toggleVisibilityStatus'])->name('categories.change-visibility');
            Route::get('/edit/{id}', [\App\Http\Controllers\Admin\CategoryController::class,  'edit'])->name('categories.edit');
        });
        Route::resource('guardians', App\Http\Controllers\Admin\GuardianController::class)->names('admin.guardians');
    });
});
