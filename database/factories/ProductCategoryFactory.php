<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\ProductCategory;
use Faker\Generator as Faker;

$factory->define(ProductCategory::class, function (Faker $faker) {
    return [
        'name' => $faker->word,
        'description' => $faker->sentence(8, true),
        'image' => 'https://i.picsum.photos/id/'. rand(1, 100) .'/500/500.jpg'
    ];
});
