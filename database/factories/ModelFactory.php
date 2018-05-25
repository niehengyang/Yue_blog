<?php

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| Here you may define all of your model factories. Model factories give
| you a convenient way to create models for testing and seeding your
| database. Just tell the factory how a default model should look.
|
*/

/** @var \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(App\User::class, function (Faker\Generator $faker) {
    static $password;

    return [
        'username' => str_random(6),
        'nickname' => $faker->name,
        'name' => $faker->name,
        'email' => $faker->safeEmail,
        'password' => bcrypt('123456'),
        'admin_lastloginip' => $faker->localIpv4,
        'admin_lastlogintime' => \Carbon\Carbon::now()->toDateTimeString(),
    ];
});

$factory->define(App\Model\classification::class, function (Faker\Generator $faker) {
    return [
        'name' => $faker->name,
        'describe' => str_random(30),
    ];
});

