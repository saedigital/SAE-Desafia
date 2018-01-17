<?php

use Illuminate\Database\Seeder;

class PoltronaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(\App\Poltronas::class,10)->create();
    }
}
