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
        App\Tag::create(['tag' => 'phones']);
        App\Tag::create(['tag' => 'flowers']);
        App\Tag::create(['tag' => 'colors']);
        App\Tag::create(['tag' => 'films']);
        App\Tag::create(['tag' => 'leaders']);
        App\Tag::create(['tag' => 'movies']);
        App\Tag::create(['tag' => 'tech']);
        App\Tag::create(['tag' => 'geeks']);
        App\Tag::create(['tag' => 'laptops']);
        App\Tag::create(['tag' => 'web']);
        App\Tag::create(['tag' => 'laravel']);
    }
}
