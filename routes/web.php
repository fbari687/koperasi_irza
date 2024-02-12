<?php

use App\Events\HelloEvent;
use App\Http\Controllers\AjaxController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\KasirController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\ProccessController;
use App\Models\User;
use Illuminate\Support\Facades\Broadcast;

// Route::get('/send-event', function () {
//     $response = $this->client->get('https://api.quotable.io/random?minLength=150');
//     $data = json_decode($response->getBody()->getContents(), true);
//     Broadcast(new HelloEvent($text));
// });

Route::get('/send-event', [PageController::class, 'testEvent']);

Route::middleware('auth')->group(function () {
    Route::get('/', [PageController::class, 'dashboard'])->name('dashboard');
    Route::get('/home', [PageController::class, 'dashboard'])->name('dashboard');
    Route::get('/dashboard', [PageController::class, 'dashboard'])->name('dashboard');

    Route::get('/chatting', [PageController::class, 'messages'])->name('chatting');

    Route::get('/officer', [PageController::class, 'officer']);


    Route::get('/classes', [PageController::class, 'classes']);

    Route::get('/items', [PageController::class, 'item']);
    Route::get("/item/{id}", [PageController::class, 'getOneItem']);

    Route::get('/items/get', [PageController::class, 'getItems']);
    Route::get('/items/{id}', [PageController::class, 'itemView']);
    Route::post('/items', [PageController::class, 'itemAdd'])->name('items.add');
    Route::put('/items', [PageController::class, 'itemEdit'])->name('item.edit');
    Route::delete('/items/{id}', [PageController::class, 'itemDelete']);

    Route::get('/transactions', [PageController::class, 'transactionView']);


    Route::post('/test-api', [PageController::class, 'testAddApi'])->name('testAddApi');
    Route::put('/test-api/{id}', [PageController::class, 'testPutApi'])->name('testPutApi');
    Route::delete('/test-api/{id}', [PageController::class, 'testDeleteApi'])->name('testDeleteApi');
    Route::get('/test-api/{id}', [PageController::class, 'testViewApi'])->name('testViewApi');
    Route::post('/test-api/delete', [PageController::class, 'testDelWhichApi'])->name('testDelWhichApi');



    Route::get('/cashier', [KasirController::class, 'index']);
    Route::post('/cashier', [KasirController::class, 'submit'])->name('cashier.submit');







    // Route::post('/items', [ProccessController::class, 'handleAddItem'])->name('update.item');
    // Route::post('/item/update', [ProccessController::class, 'handleUpdateItem'])->name('update.item');

    Route::get('/reports', [PageController::class, 'report']);

    Route::get('/profile', [PageController::class, 'profile']);
    Route::put('/profile', [PageController::class, 'editProfile'])->name("editProfile");
    Route::put('/change-photo-profile', [PageController::class, 'changePhotoProfile'])->name("changePhotoProfile");

    Route::get('/logout', [AuthController::class, 'logout'])->name('logout');
});

Route::prefix('ajax')->group(function () {
    Route::post('/items/search', [AjaxController::class, 'searchItem'])->name('search.item');
    Route::post('/items/filter', [AjaxController::class, 'filterItem'])->name('filter.item');
});


Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'login'])->name('login');
    Route::get('/register', [AuthController::class, 'register'])->name('register');

    Route::post('/login', [AuthController::class, 'handleLogin']);
    Route::post('/register', [AuthController::class, 'handleRegister']);

    // Route::get('/broadcast-event', [PageController::class, 'handleBroad']);
});
