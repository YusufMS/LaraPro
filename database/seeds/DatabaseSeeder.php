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
        // $this->call(UsersTableSeeder::class);
        $this->call(CategoryTableSeeder::class);
        $this->call(TagsTableSeeder::class);
        $this->call(RoleTableSeeder::Class);
        $this->call(UserTableSeeder::Class);
    }
}
