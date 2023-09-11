<?php

use \Illuminate\Support\Facades\Route;

Route::name('api.')->middleware(['throttle:500'])->prefix('api')->group(function (){

    Route::post('login',[\TomatoPHP\TomatoCrm\Http\Controllers\APIs\AuthController::class,'login'])->name('login');
    Route::post('register',[\TomatoPHP\TomatoCrm\Http\Controllers\APIs\AuthController::class,'register'])->name('register');
    Route::post('reset',[\TomatoPHP\TomatoCrm\Http\Controllers\APIs\AuthController::class,'reset'])->name('reset');
    Route::post('resend',[\TomatoPHP\TomatoCrm\Http\Controllers\APIs\AuthController::class,'resend'])->name('resend');
    Route::post('otp',[\TomatoPHP\TomatoCrm\Http\Controllers\APIs\AuthController::class,'otp'])->name('otp');
    Route::post('password',[\TomatoPHP\TomatoCrm\Http\Controllers\APIs\AuthController::class,'password'])->name('password');

    Route::middleware(['auth:sanctum'])->group(function (){
        Route::get('profile',[\TomatoPHP\TomatoCrm\Http\Controllers\APIs\ProfileController::class,'profile'])->name('profile.user');
        Route::post('profile',[\TomatoPHP\TomatoCrm\Http\Controllers\APIs\ProfileController::class,'update'])->name('profile.update');
        Route::post('profile/password',[\TomatoPHP\TomatoCrm\Http\Controllers\APIs\ProfileController::class,'password'])->name('profile.password');
        Route::delete('profile/destroy',[\TomatoPHP\TomatoCrm\Http\Controllers\APIs\ProfileController::class,'destroy'])->name('profile.destroy');
        Route::post('profile/logout',[\TomatoPHP\TomatoCrm\Http\Controllers\APIs\ProfileController::class,'logout'])->name('profile.logout');
    });
});
