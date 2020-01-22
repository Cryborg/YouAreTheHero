<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Story;
use Faker\Generator as Faker;
use Illuminate\Support\Str;

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

$factory->define(Story::class, function (Faker $faker, $data) {

    $return = [
        'title'        => ucfirst($faker->words(5, true)),
        'description'  => $faker->text,
        'user_id'      => $data['user_id'],
        'is_published' => true,
    ];

    return [
        'title'        => ucfirst($faker->words(5, true)),
        'description'  => $faker->text,
        'user_id'      => $data['user_id'],
        'is_published' => true,
    ];
}
);
