<?php

use Illuminate\Database\Seeder;

class CategoryTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        App\Category::create(['category_name'=>'Arts & Literature']);
        App\Category::create(['category_name'=>'Science']);
        App\Category::create(['category_name'=>'Computing & Technology']);
        App\Category::create(['category_name'=>'Nature']);
        App\Category::create(['category_name'=>'Accountancy']);
        App\Category::create(['category_name'=>'Business']);
        App\Category::create(['category_name'=>'Personal/Freestyle Writings']);
    }
}
