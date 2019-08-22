<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */
use App\Models\User;
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

$factory->define(User::class, function (Faker $faker) {

	$gender = $faker->randomElement(['male', 'female']);

    return [
        'name' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'gender' => $gender,
        'dob' =>  $faker->dateTimeBetween('1990-01-01', '2012-12-31')->format('Y-m-d'),
        'age' => $faker->numberBetween($min = 20, $max = 100),
        'user_type_id' => $faker->numberBetween($min = 1, $max = 3),
        //'email_verified_at' => now(),
        'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
        'remember_token' => Str::random(10),
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