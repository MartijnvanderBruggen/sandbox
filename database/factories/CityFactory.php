<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model;
use App\City;
use Faker\Generator as Faker;

$factory->define(City::class, function (Faker $faker) {
    $cities = [];
    $tmp = json_decode(Storage::get('data/cities.json'));
    foreach($tmp as $city)
    {
        $cities[] = $city->name;
    }
    return [
        'name' => $faker->randomElement($cities),
    ];
});
