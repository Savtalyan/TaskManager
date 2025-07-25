<?php

use App\Http\Controllers\Task\TaskCreateController;
use App\Http\Controllers\Task\TaskDeleteController;
use App\Http\Controllers\Task\TaskUpdateController;
use App\Http\Controllers\User\UserLoginController;
use App\Http\Controllers\User\UserRegisterController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Task\TaskStatusChangeController;


Route::post('/register', UserRegisterController::class)->name('register');
Route::post('/login', UserLoginController::class)->name('login');


//Route::middleware('auth:api')->group(callback: function () {
//    Route::middleware('role:admin')->group(callback: function () {
//        Route::post('/task', TaskCreateController::class)->name('task.create');
//        Route::put('/task/{id}', TaskUpdateController::class)->name('task.update');
//        Route::delete('/task/{id}', TaskDeleteController::class)->name('task.delete');
//    });
//    Route::patch('/task/{id}', TaskStatusChangeController::class)->name('task.patch');
//});


