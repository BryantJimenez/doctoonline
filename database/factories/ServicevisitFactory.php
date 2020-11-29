<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */
use Faker\Generator as Faker;

$factory->define(App\ServiceVisit::class, function (Faker $faker) {
    return [
        'service_id' => $faker->randomElement(['1', '2', '3']),
        'visit_id' => $faker->unique()->numberBetween($min=1, $max=500) 
    ];
});
