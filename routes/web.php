<?php

use App\Http\Controllers\AjaxController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\ProccessController;

Route::middleware('auth')->group(function(){
    Route::get('/', [PageController::class, 'dashboard'])->name('dashboard');
    Route::get('/home', [PageController::class, 'dashboard'])->name('dashboard');
    Route::get('/dashboard', [PageController::class, 'dashboard'])->name('dashboard');

    Route::get('/chatting', [PageController::class, 'messages'])->name('chatting');

    Route::get('/officer', [PageController::class, 'officer']);

    Route::get('/items', [PageController::class, 'item']);
    Route::post('/items', [ProccessController::class, 'handleAddItem'])->name('update.item');
    Route::post('/item/update', [ProccessController::class, 'handleUpdateItem'])->name('update.item');

    Route::get('/reports', [PageController::class, 'report']);

    Route::get('/logout', [AuthController::class, 'logout'])->name('logout');
});

Route::prefix('ajax')->group(function () {
    Route::post('/items/search', [AjaxController::class, 'searchItem'])->name('search.item');
    Route::post('/items/filter', [AjaxController::class, 'filterItem'])->name('filter.item');
});


Route::middleware('guest')->group(function(){
    Route::get('/login', [AuthController::class, 'login'])->name('login');
    Route::get('/register', [AuthController::class, 'register'])->name('register');

    Route::post('/login', [AuthController::class, 'handleLogin']);
    Route::post('/register', [AuthController::class, 'handleRegister']);

    Route::get('/broadcast-event', [PageController::class, 'handleBroad']);
});