<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\BorrowingController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\MemberController;
use Illuminate\Support\Facades\Route;

Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [AuthController::class, 'login'])->name('login.store');
});

Route::middleware('auth')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
    Route::resource('users', UserController::class)->except(['show']);
    
    // Nabil - Dashboard & Borrowing
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::resource('borrowings', BorrowingController::class)->except(['edit', 'update', 'destroy']);
    Route::get('/borrowings/{borrowing}/return', [BorrowingController::class, 'return'])->name('borrowings.return');
    Route::post('/borrowings/{borrowing}/return', [BorrowingController::class, 'confirmReturn'])->name('borrowings.confirmReturn');
    
    // Naya - Category, Book, Member CRUD
    Route::resource('categories', CategoryController::class);
    Route::resource('books', BookController::class);
    Route::resource('members', MemberController::class);
});

Route::redirect('/', '/dashboard');
