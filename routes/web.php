<?php

use App\Http\Controllers\LoginController;
use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;

Route::middleware('auth')->group(function () {
    Route::get('/', function () {
        return view('dashboard', ['title' => '대시보드']);
    })->name('dashboard');

    Route::get('/logout', [LoginController::class, 'logout'])->name('logout');
    Route::get('/product/input', [ProductController::class, 'input'])->name('product.input');
    Route::post('/product/input', [ProductController::class, 'store'])->name('product.store');
    Route::get('/product', [ProductController::class, 'index'])->name('product');
    Route::delete('/product/{id}', [ProductController::class, 'destroy'])->name('product.delete');
});

Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login'])->name('login.process');
