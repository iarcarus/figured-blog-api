<?php

use Illuminate\Support\Facades\Route;

Route::middleware(['api', 'jwt.auth'])
    ->prefix('post')
    ->group(function (): void {
        Route::post('/', 'PostController@store');
        Route::put('/{id}', 'PostController@update');
        Route::delete('/{id}', 'PostController@destroy');
    });


Route::middleware(['api'])
    ->prefix('post')
    ->group(function (): void {
        Route::get('/', 'PostController@index');
        Route::get('/{id}', 'PostController@show');
    });

