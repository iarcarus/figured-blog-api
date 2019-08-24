<?php

use App\Domain\Models\Tables\Role;
use Faker\Generator as Faker;

$factory->define(Role::class, function (Faker $faker) {
    $name = $faker->name;

    return [
        'name' => $name,
        'slug' => strtoupper($name),
    ];
});
