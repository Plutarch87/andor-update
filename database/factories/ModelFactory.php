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

$factory->define(App\User::class, function (Faker\Generator $faker) {
    return [
        'name' => $faker->name,
        'email' => $faker->safeEmail,
        'password' => bcrypt(str_random(10)),
        'remember_token' => str_random(10),
    ];
});

$factory->define(App\Category::class, function (Faker\Generator $faker) {
    return [    	
        'name' => $faker->firstName($gender =null|'male'|'female'),
        'remember_token' => str_random(10),
        'user_id' => function () {
            return factory(App\User::class)->create()->id;
        }
    ];
});

$factory->define(App\Item::class, function ($faker) {
    return [
        'name' => $faker->firstName($gender = null|'male'|'female'),
        'description' => $faker->paragraph,
        'price' => $faker->numberBetween($min = 1000, $max = 9000),
        'sifra' => $faker->numberBetween($min = 300, $max = 9999),
        'akcija' => $faker->boolean($chanceOfGettingTrue = 50),
        'popularno' =>$faker->boolean($chanceOfGettingTrue = 50),
        'remember_token' =>str_random(10),
        'category_id' => function () {
            return factory(App\Category::class)->create()->id;
        },
        'subcat_id' => function(){
            return factory(App\Subcat::class)->create()->id;
        },
    ];
});

$factory->define(App\Subcat::class, function ($faker) {
    return [
        'name' => $faker->firstName($gender =null|'male'|'female'),
        'remember_token' => str_random(10),        
        'category_id' => function(){
            return factory(App\Category::class)->create()->id;
        },
    ];
});

