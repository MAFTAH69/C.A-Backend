<?php

use App\Role;

use Illuminate\Database\Seeder;

class RoleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Admin Role
        $role = new Role();
        $role->name = 'Admin';
        $role->description = 'A system Administrator';
        $role->save();

        // Student Role
        $role = new Role();
        $role->name = 'Student';
        $role->description = 'Valid student of the University of Dar es salaam';
        $role->save();

        // Instructor Role
        $role = new Role();
        $role->name = 'Instructor';
        $role->description = 'A Teaching staff of the University of Dar es salaam';
        $role->save();

        // H.O.D Role
        $role = new Role();
        $role->name = 'HOD';
        $role->description = 'Head of Department within a college at the University of Dar es salaam';
        $role->save();

        // Principle Role
        $role = new Role();
        $role->name = 'Principle';
        $role->description = 'A college administrator at the University of Dar es salaam';
        $role->save();

        // D.O.U Role
        $role = new Role();
        $role->name = 'DOU';
        $role->description = 'Director of Undergraduate Studies at the University of Dar es salaam';
        $role->save();

        // DVC Role
        $role = new Role();
        $role->name = 'DVC';
        $role->description = 'Deputy Vice Chancelor (Academic) of the University of Dar es salaam';
        $role->save();
    }
}
