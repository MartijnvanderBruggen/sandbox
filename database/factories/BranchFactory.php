<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model;
use App\Branch;
use Faker\Generator as Faker;

$factory->define(Branch::class, function (Faker $faker) {
    $branches = [];
    $tmp = json_decode(Storage::get('data/industries.json'));
    foreach($tmp as $industry)
    {
        $branches[] = $industry->name;
    }
    return [
        'name' => $faker->randomElement($branches),
    ];
});
