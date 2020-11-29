<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */
use Faker\Generator as Faker;

$factory->define(App\Visit::class, function (Faker $faker) {
    return [
    	'visitor' => $faker->ipv4,
    	'device' =>  $faker->randomElement(['Escritorio', 'Teléfono', 'Tablet']),
    	'created_at' => Carbon\Carbon::create(2020, $faker->month, $faker->dayOfMonth)
    ];
});
