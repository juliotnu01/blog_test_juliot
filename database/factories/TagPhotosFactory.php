<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\TagPhotos;
use Faker\Generator as Faker;

$factory->define(TagPhotos::class, function (Faker $faker) {
    return [
        "photo_id" => function () {
            return factory(App\Models\Photo::class)->create()->id;
        }
        
    ];
});
