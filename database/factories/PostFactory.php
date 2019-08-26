<?php

use App\Domain\Models\Collections\Post;
use App\Domain\Models\Tables\User;
use Faker\Generator as Faker;
use Faker\Provider\Lorem;

$factory->define(Post::class, function (Faker $faker) {
    $faker->addProvider(new Lorem($faker));

    return [
        'tittle' => $faker->sentence,
        'text'   => $faker->text(800),
        'author' => User::firstOrCreate()->toArray(),
        'tumblr' => null,
    ];
});
