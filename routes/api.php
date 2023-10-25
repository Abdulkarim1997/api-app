<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\PassportAuthController;

Route::post("register", [PassportAuthController::class, 'register']);
Route::post("login", [PassportAuthController::class, 'login']);

Route::middleware(['auth:api'])->group(function () {

    Route::get("userinfo", [PassportAuthController::class, 'userInfo']);
    Route::resource("products", ProductController::class);
});



