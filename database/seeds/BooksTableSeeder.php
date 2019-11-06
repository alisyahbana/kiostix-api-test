<?php

use Faker\Factory;
use Illuminate\Database\Seeder;

class BooksTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(\App\Author::class, 10)->create();

        factory(\App\Category::class, 5)->create();

        $authors = \App\Author::pluck('id');
        $categories = \App\Category::pluck('id');

        factory(\App\Book::class, 20)->make()->each(function ($book) use ($authors, $categories){
            $book->author()->associate($authors[rand(0, count($authors)-1)]);
            $book->category()->associate($categories[rand(0, count($categories)-1)]);
            $book->save();
        });
    }
}
