<?php

use App\Postponement;
use Illuminate\Database\Seeder;

class PostponementTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(Postponement::class, 20)->create();
    }
}
