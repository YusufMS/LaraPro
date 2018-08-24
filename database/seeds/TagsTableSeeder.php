<?php

use Illuminate\Database\Seeder;

class TagsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        App\Tag::create(['tag' => 'Phones']);
        App\Tag::create(['tag' => 'Flowers']);
        App\Tag::create(['tag' => 'Colors']);
        App\Tag::create(['tag' => 'Films']);
        App\Tag::create(['tag' => 'Leaders']);
        App\Tag::create(['tag' => 'Movies']);
        App\Tag::create(['tag' => 'Tech']);
        App\Tag::create(['tag' => 'Geeks']);
        App\Tag::create(['tag' => 'Laptops']);
        App\Tag::create(['tag' => 'Web']);
        App\Tag::create(['tag' => 'Laravel']);
    }
}
