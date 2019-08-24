<?php

use Illuminate\Support\Facades\Route;

Route::middleware(['api'])
    ->prefix('auth')
    ->group(function (): void {
    Route::post('login', 'AuthController@login')->name('login');
    Route::post('logout', 'AuthController@logout');
    Route::post('refresh', 'AuthController@refresh');
    Route::post('me', 'AuthController@me');
});
