<?php

use Illuminate\Database\Seeder;
use App\Role;

class RoleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $role_writer = new Role();
        $role_writer->role = 'writer';
        $role_writer->description = 'A user who can write posts to the blog';
        $role_writer->save();

        $role_viewer = new Role();
        $role_viewer->role = 'viewer';
        $role_viewer->description = 'A user who sees posts written by writers';
        $role_viewer->save();
    }
}
