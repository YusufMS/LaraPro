<?php

use Illuminate\Database\Seeder;
use App\User;
use App\Role;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // $role_viewer = Role::where('role', 'viewer')->first();
        // $role_writer  = Role::where('role', 'writer')->first();

        // $writer = new User();
        // $writer->first_name = 'writer';
        // $writer->last_name = 'sherry';
        // $writer->email = 'sherry@test.com';
        // $writer->user_name = 'sherry_wri';
        // $writer->password = bcrypt('secret');
        // $writer->save();
        // $writer->roles()->attach($role_writer);

        // $viewer = new User();
        // $viewer->first_name = 'viewer';
        // $viewer->last_name = 'berry';
        // $viewer->email = 'berry@test.com';
        // $viewer->user_name = 'berry';
        // $viewer->password = bcrypt('secret');
        // $viewer->save();
        // $viewer->roles()->attach($role_viewer);

    }
}
