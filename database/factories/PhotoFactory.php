<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Photo;
use Faker\Generator as Faker;

$factory->define(Photo::class, function (Faker $faker) {
    return [
        "title" => $faker->sentence(5),
        "description"=> $faker->sentence(),
        "privacy"=> $faker->boolean(),
        "uploadDate"=> $faker->dateTime(),
        "view"=> $faker->numberBetween(0,99),
        "imgPath"=> $faker->imageUrl($width = 640, $height = 480),
        "comment_id" => factory(App\Models\Comment::class)
    ];
});


