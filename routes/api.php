<?php

use App\Http\Controllers\Task\TaskCreateController;
use App\Http\Controllers\Task\TaskDeleteController;
use App\Http\Controllers\Task\TaskUpdateController;
use App\Http\Controllers\User\UserLoginController;
use App\Http\Controllers\User\UserRegisterController;
use Illuminate\Support\Facades\Route;
use Laravel\Passport\Http\Controllers\AccessTokenController;



Route::post('/register', UserRegisterController::class)->name('register');
Route::post('/login', UserLoginController::class)->name('login');


Route::middleware('auth:api')->group(callback: function () {
    Route::middleware('role:admin')->group(callback: function () {
        Route::post('/task', TaskCreateController::class)->middleware('role:admin')->name('task.create');
        Route::put('/task/{id}', TaskUpdateController::class)->middleware('role:admin')->name('task.update');
        Route::delete('/task/{id}', TaskDeleteController::class)->middleware('role:admin')->name('task.delete');
    });
});


