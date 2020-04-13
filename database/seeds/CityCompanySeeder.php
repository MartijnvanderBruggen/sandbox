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
        factory(App\Branch::class, 10)->create();
        factory(App\Company::class, 300)->create();
        factory(App\City::class, 20)->create();
    }
}
