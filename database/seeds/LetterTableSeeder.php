<?php

use App\Letter;
use Illuminate\Database\Seeder;

class LetterTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(Letter::class, 20)->create();
    }
}
