<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model;
use Faker\Generator as Faker;
use App\Company;
use App\User;
use App\Branch;

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
