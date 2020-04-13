<?php

use Illuminate\Database\Seeder;

class CityCompanySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Branch::class, 4)->create();
        factory(App\City::class, 4)->create();
        factory(App\Company::class, 20)->create();
        
        factory(App\User::class, 1000)->create();
    }
}
