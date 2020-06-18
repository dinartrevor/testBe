<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Category;
use App\SubCategory;
use App\Product;
use Faker\Generator as Faker;

$factory->define(Category::class, function (Faker $faker) {
    return [
        'name' => $faker->sentence,
    ];
});
$factory->define(SubCategory::class, function (Faker $faker) {
    return [
        'category_id' => function() {
            return factory(Category::class)->create()->id;
        },
        'parent' => $faker->shuffle('hello, world'),
    ];
});

$factory->define(Product::class, function (Faker $faker) {
    
    return [
        'title' => $faker->name,
        'brands' => $faker->randomElement(['Honda', 'Yamaha', 'Kawasaki', 'Suzuki']),
        'gender' => $faker->randomElement(['Male', 'Female']),
        'category_id' => function() {
            return factory(Category::class)->create()->id;
        },
        'subcategory_id' => function() {
            return factory(SubCategory::class)->create()->id;
        },
        'description' => $faker->paragraph,
    ];
});