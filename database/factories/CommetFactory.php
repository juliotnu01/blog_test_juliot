<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Comment;
use Faker\Generator as Faker;

$factory->define(Comment::class, function (Faker $faker) {
    return [
        "postDate" => $faker->dateTime(),
        "content" => $faker->sentence(20),
        "album_id" => function () {
            return factory(App\Models\Album::class)->create()->id;
        },
        "photo_id" => function () {
            return factory(App\Models\Photo::class)->create()->id;
        }
        
    ];
});
