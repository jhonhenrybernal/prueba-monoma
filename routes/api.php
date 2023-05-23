<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CandidateController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AuthController;



Route::post('auth', [AuthController::class, 'auth']);
Route::group(['middleware' => ['jwt.verify']], function() {
    Route::group(['prefix' => 'lead'], function () {
        Route::get('/', [CandidateController::class, 'index']);
        Route::post('/', [CandidateController::class, 'store']);
        Route::get('/{id}', [CandidateController::class, 'show']);
    });
    Route::group(['prefix' => 'users'], function () {
        Route::get('/', [UserController::class, 'index']);
        Route::post('/', [UserController::class, 'store']);
        Route::get('/{id}', [UserController::class, 'show']);
        Route::put('/{id}', [UserController::class, 'update']);
        Route::delete('/{id}', [UserController::class, 'destroy']);
    });
});
