<?php

use Illuminate\Database\Seeder;

class VisitsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Visit::class, 500)->create();
        factory(App\ServiceVisit::class, 100)->create();
    }
}
