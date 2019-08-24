<?php

namespace App\Domain\Providers\Validation;

use Illuminate\Support\ServiceProvider;

class ForbiddenValidationProvider extends ServiceProvider
{

    public function boot()
    {
        $this->app['validator']->extend('forbidden', function () {
            return false;
        });
    }

    public function register()
    {
        //
    }
}
