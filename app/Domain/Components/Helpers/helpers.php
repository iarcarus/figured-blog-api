<?php

if (!function_exists('logged_user')) {

    function logged_user(): ?\App\Domain\Models\Tables\User
    {
        return Illuminate\Support\Facades\Auth::user();
    }
}
