<?php

use App\Examination;
use Illuminate\Database\Seeder;

class ExaminationTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(Examination::class, 20)->create();
    }
}
