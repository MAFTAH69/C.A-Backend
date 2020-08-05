<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UserTableSeeder::class);
        $this->call(AssignmentTableSeeder::class);
        $this->call(CommentTableSeeder::class);
        $this->call(CourseTableSeeder::class);
        $this->call(ExaminationTableSeeder::class);
        $this->call(LetterTableSeeder::class);
        $this->call(PostponementTableSeeder::class);
        $this->call(PracticalTableSeeder::class);
        $this->call(QuizTableSeeder::class);
        $this->call(SemesterTableSeeder::class);
        $this->call(TestTableSeeder::class);
        $this->call(YearTableSeeder::class);
        $this->call(RoleTableSeeder::class);

    }
}
