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

$factory->define(App\Models\User::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'password' => '$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm', // secret
        'remember_token' => str_random(10),
    ];
});

$factory->define(App\Models\Category::class, function (Faker $faker) {
    return [
        'name' => $faker->word,
        'description' => $faker->text(25),
    ];
});

$factory->define(App\Models\ClientType::class, function (Faker $faker) {
    return [
        'name' => $faker->word,
        'description' => $faker->text(15),
    ];
});

$factory->define(App\Models\DocumentType::class, function (Faker $faker) {
    return [
        'name' => $faker->word,
    ];
});

$factory->define(App\Models\Client::class, function (Faker $faker) {
    return [
        'first_name' => $faker->firstName,
        'last_name' => $faker->lastName,
        'client_type_id' => App\Models\ClientType::all()->random()->id,
        'document_type_id'=> App\Models\DocumentType::all()->random()->id,
        'document_number' => $faker->isbn10,
        'phone' => (int) $faker->isbn10,
        'mail' => $faker->unique()->safeEmail,
        'address' => $faker->address,
    ];
});

$factory->define(App\Models\Product::class, function (Faker $faker) {
    return [
        'barcode' => $faker->ean13,
        'name' => $faker->word,
        'description' => $faker->text(25),
        'price' => $faker->randomFloat(2,0,100),
        'stock' => $faker->numberBetween(1, $max = 20),
        'category_id' => App\Models\Category::all()->random()->id,
    ];
});

