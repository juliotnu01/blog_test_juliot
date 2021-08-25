<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Album;
use Faker\Generator as Faker;

$factory->define(Album::class, function (Faker $faker) {
    return [
        "title" => $faker->sentence(),
        "description" => $faker->sentence(),
        "location_id" =>  factory(App\Models\Location::class),
        "photo_id" => factory(App\Models\Photo::class),
        "member_id" => factory(App\Models\Member::class)
    ];
});
