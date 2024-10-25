<?php

use App\Http\Controllers\v1\AuthController;
use App\Http\Controllers\v1\RoleController;
use App\Http\Controllers\v1\UserController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\v1\ComplaintController;

//auth controller
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);
Route::get('/logout', [AuthController::class, 'logout'])->middleware('auth:sanctum');
Route::get('/logout-all-devices', [AuthController::class, 'logoutAllDevices'])->middleware('auth:sanctum');


Route::group(['middleware' => ['auth:sanctum']], function () {
    Route::get('/user', [UserController::class, 'index']);
    Route::get('/students', [UserController::class, 'students']);
    Route::get('/user/{user}', [UserController::class, 'show'])->middleware('EnsureUserIsSelf:EnsureUserIsSelf');
    Route::put('/user/{user}', [UserController::class, 'update'])->middleware('permission:update-user');
    Route::delete('/user/{user}', [UserController::class, 'destroy'])->middleware(['permission:delete-user']);

    //check roles and permissions
    Route::get('/role', [RoleController::class, 'show']);


    //complaints
    Route::get('/complaints', [ComplaintController::class, 'index']);
    Route::get('/complaint/{complaint}', [ComplaintController::class, 'show']);
    Route::post('/complaint', [ComplaintController::class, 'store'])->withoutMiddleware(['auth:sanctum']);
    Route::delete('/complaint/{complaint}', [ComplaintController::class, 'destroy'])->middleware(['permission:delete-complaints']);
});
