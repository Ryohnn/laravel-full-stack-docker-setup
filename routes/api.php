<?php

use App\Http\Controllers\Api\TestController;
use Illuminate\Support\Facades\Route;

Route::prefix('test')->group(function () {
    Route::get('/', [TestController::class, 'test']);
    Route::get('/users', [TestController::class, 'users']);
});
