<?php

use App\Http\Controllers\api\AuthController;
use App\Http\Controllers\api\BookCategoryController;
use App\Http\Controllers\api\BookController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::prefix('auth')->group(function () {
    Route::post('/login',[AuthController::class,'Login']);
});

Route::middleware('auth:sanctum')->group(function() {
    Route::resource('book-category', BookCategoryController::class);
    Route::resource('book', BookController::class);
});