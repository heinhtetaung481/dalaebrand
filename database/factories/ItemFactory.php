<?php

use Faker\Generator as Faker;


$factory->define(App\Item::class, function (Faker $faker) use ($factory) {

	$color = $faker->randomElement(['white', 'green', 'purple']);

    return [
        'size' => $faker->randomDigit,
        'color' => $color,
        'price' =>$faker->randomDigit,
        'quantity' => $faker->randomDigit,
        'itemtype_id' => $faker->randomDigit([6,7]),
    ];
});
