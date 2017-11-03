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
        'email' => $faker->unique()->safeEmail,
        'password' => $password ?: $password = bcrypt('123456'),
        'remember_token' => str_random(10),
    ];
});
$factory->define(App\Role::class, function ($faker) {
    return [
        'name' => 'partner',
    ];
});

$factory->define(App\Profile::class, function (Faker $faker) {
    static $password;

    return [
        'user_id'=> 1,
        'applicant_name'=> $faker->firstName,
        'first_surname'=>$faker->lastName,
        'second_surname'=>$faker->lastName,
        'position_held'=> $faker->word,
        'phone'=> $faker->phoneNumber
      
    ];
});

$factory->define(App\Company::class, function (Faker $faker) {
    static $password;

    return [
        'company_name'=> $faker->firstName,
        'identification_number'=> 12345678,
        'phones'=> $faker->phoneNumber,
        'physical_address'=> $faker->address,
        'country'=> $faker->country,
        'towns'=> $faker->city,
        'web_address'=> '',
        'legal_name'=> $faker->firstName,
        'legal_first_surname'=> $faker->lastName,
        'legal_second_surname'=> $faker->lastName,
        'legal_email'=> $faker->email,
        'activity' => 1, //1 consumer / 2 supplier
        'private_code' => $faker->word
      
    ];
});

$factory->define(App\Country::class, function (Faker $faker) {
    static $password;

    return [
        'name'=> $faker->country,
        'code'=> $faker->countryCode,
        'currency'=> $faker->currencyCode
        
      
    ];
});
