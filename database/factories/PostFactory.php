<?php

use App\Domain\Models\Collections\Post;
use App\Domain\Models\Tables\User;
use Faker\Generator as Faker;
use Faker\Provider\en_US\Text;

$factory->define(Post::class, function (Faker $faker) {
    $faker->addProvider(new Text($faker));

    $text = $faker->text(200);

    $author = User::firstOrCreate();

    return [
        'tittle'     => $faker->title,
        'short_text' => substr($text, 0, 20),
        'text'       => $text,
        'author_id'  => $author->id,
        'tumblr'     => null,
    ];
});
