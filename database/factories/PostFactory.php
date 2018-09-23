<?php

use Faker\Generator as Faker;

$factory->define(App\Post::class, function (Faker $faker) {
    return [
        'title' => $faker->words($nb = 3, $asText = true),
        'sub_title' => $faker->sentence,
        'content' => $faker->paragraphs($nb = 2, $asText = true),
        'category_id' => $faker->numberBetween($min = 1, $max = 7),
        'user_id' => $faker->numberBetween($min = 1, $max = 4),
        'visibility'=> $faker->numberBetween($min = 0, $max = 1),
        'created_at' => $faker->dateTimeBetween($startDate = '-1 months', $endDate = 'now', $timezone = null),      
        'image_name' => 'NoImageUploaded.jpg',

    ];
});
