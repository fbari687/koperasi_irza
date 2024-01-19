<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ApiController;
use Laravel\Passport\Http\Controllers\AccessTokenController;
use Laravel\Passport\Http\Controllers\AuthorizationController;

Route::post('/login', [AuthController::class, 'handleApiLogin']);

// Otentikasi dan otorisasi OAuth2
Route::post('/oauth/token', [AccessTokenController::class, 'issueToken']);
Route::post('/oauth/authorize', [AuthorizationController::class, 'authorize']);

// Perlu Bearer Token
Route::group(['middleware' => 'auth:api'], function () {
    Route::get('/user-profile', function () {
        return response()->json(auth()->user());
    });

    Route::get('/item/{id}', [ApiController::class, 'item']);
    Route::get('/items', [ApiController::class, 'items']);
});
