<?php

use App\Practical;
use Illuminate\Database\Seeder;

class PracticalTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(Practical::class, 3)->create();
    }
}
