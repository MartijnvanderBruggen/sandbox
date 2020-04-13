<?php

/** @var Factory $factory */

use App\Branch;
use App\City;
use App\Company;
use Faker\Generator as Faker;
use Illuminate\Database\Eloquent\Factory;
use Illuminate\Support\Facades\Storage;
use function GuzzleHttp\json_decode;

$factory->define(Company::class, function (Faker $faker) {
    $branch_ids = Branch::all()->pluck('id');
    
    $companies = [];
    
    $tmp = json_decode(Storage::get('data/companies.json'));
    foreach($tmp as $company)
    {
        $companies[] = $company->name;
    }
    
    return [
        'name' => $faker->randomElement($companies),
        'branch_id' => $faker->randomElement($branch_ids),
        
    ];
});
