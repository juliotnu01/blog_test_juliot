<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Member;
use Faker\Generator as Faker;

$factory->define(Member::class, function (Faker $faker) {
    return [
        "email" => $faker->email,
        "password" => bcrypt('123456789'),
        "name" => $faker->name,
        "phoneNum" => $faker->phoneNumber,
        "address" => $faker->address,
        "role_id" => factory(App\Models\Role::class)
    ];
});
