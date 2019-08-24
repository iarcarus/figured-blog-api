<?php

use Illuminate\Support\Facades\Route;

Route::middleware(['api', 'jwt.auth'])
    ->prefix('user')
    ->group(function (): void {
    Route::get('/', 'UserController@index');
    Route::get('/{id}', 'UserController@show');
    Route::post('/', 'UserController@store');
    Route::put('/{id}', 'UserController@update');
    Route::delete('/{id}', 'UserController@destroy');
});
