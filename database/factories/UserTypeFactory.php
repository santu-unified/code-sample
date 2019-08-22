<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */
use App\Models\UserTypes;
use Illuminate\Support\Str;
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

$factory->define(UserTypes::class, function (Faker $faker) {

	$type = $faker->randomElement(['Admin', 'Customer','Sub Admin']);

    return [
        'type_name' => $type
    ];
});

// randomDigit // 7
// randomDigitNotNull // 5
// randomNumber($nbDigits = NULL) // 79907610
// randomFloat($nbMaxDecimals = NULL, $min = 0, $max = NULL) // 48.8932
// numberBetween($min = 1000, $max = 9000) // 8567
// randomLetter // 'b'
// randomElements($array = array ('a','b','c'), $count = 1) // array('c')
// randomElement($array = array ('a','b','c')) // 'b'
// numerify($string = '###') // '609'
// lexify($string = '????') // 'wgts'
// bothify($string = '## ??') // '42 jz'