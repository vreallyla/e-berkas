<?php

use Faker\Generator as Faker;

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| This directory should contain each of the model factory definitions for
| your application. Factories provide a convenient way to generate new
| model instances for testing / seeding your application's database.
|
*/

$factory->define(App\User::class, function (Faker $faker) {
    static $password;

    return [
        'name' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'password' => $password ?: $password = bcrypt('secret'),
        'remember_token' => str_random(10),
    ];
});

$factory->define(App\trDataJobDesc::class, function (Faker $faker) {

    return [
        'name' => $faker->unique()->randomElement($array = array ('Admin','Seksi Pelayanan','Seksi Penagihan','Seksi Umum',
            'Seksi Pemeriksaan','Seksi Waskon')),
        'desc' => $faker->unique()->sentence(9),
    ];
});
$factory->define(App\trDataPosisition::class, function (Faker $faker) {

    return [
        'name' => $faker->unique()->randomElement($array = array ('Kepala Seksi','Sekretaris','Konselling')),
        'desc' => $faker->unique()->sentence(9),
        'job_id' => 3,
    ];
});
