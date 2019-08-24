<?php

namespace Tests;

class Fixture
{
    public static function create($model, $quantity = 1, $override = [])
    {
        if ($quantity == 1) {
            return factory($model, $quantity)->create($override)->first();
        }

        return factory($model, $quantity)->create($override);
    }

    public static function make($model, $quantity = 1, $override = [])
    {
        if($quantity == 1) {
            return factory($model, $quantity)->make($override)->first();
        }

        return factory($model, $quantity)->make($override);
    }
}
