<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Tag;
use Faker\Generator as Faker;

$factory->define(Tag::class, function (Faker $faker) {
    return [
        "title" => $faker->word,
        "tag_photos_id" => function () {
            return factory(App\Models\TagPhotos::class)->create()->id;
        }
        
    ];
});
