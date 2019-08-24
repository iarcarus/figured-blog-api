<?php

use App\Domain\Models\Tables\Role;
use App\Domain\Models\Tables\User;
use Faker\Generator as Faker;

$factory->define(User::class, function (Faker $faker) {
    $role = Role::firstOrCreate();

    return [
        'name'           => $faker->name,
        'email'          => $faker->unique()->safeEmail,
        'password'       => bcrypt('Figured@2019'),
        'role_id'        => $role->id,
        'last_access'    => null,
        'login_attempts' => 0
    ];
});
