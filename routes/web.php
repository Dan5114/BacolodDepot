<?php

// routes/web.php
use App\Http\Controllers\AuthController;
use App\Http\Controllers\WarehouseItemController;

// Authentication Routes
Route::get('/login', [AuthController::class, 'login'])->name('login');
Route::post('/login', [AuthController::class, 'authenticate']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Protected Routes
Route::middleware('auth')->group(function () {
    Route::get('/', function () {
        return redirect()->route('dashboard');
    });
    
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
    
    // Warehouse Items Routes
    Route::resource('warehouse', WarehouseItemController::class);
    
    // Admin Only Routes
    Route::middleware('admin')->group(function () {
        // Add admin-specific routes here
    });
});