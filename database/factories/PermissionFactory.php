<?php

use App\Domain\Models\Tables\Permission;
use Faker\Generator as Faker;

$factory->define(Permission::class, function (Faker $faker) {
    return [
        'permission'  => $faker->word,
        'description' => $faker->sentence
    ];
});
