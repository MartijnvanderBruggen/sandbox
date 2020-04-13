<?php

/** @var Factory $factory */

use App\City;
use App\Company;
use Faker\Generator as Faker;
use Illuminate\Database\Eloquent\Factory;
use Illuminate\Support\Facades\Storage;
use function GuzzleHttp\json_decode;

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

