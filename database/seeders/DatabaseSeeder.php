<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Post;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        Category::create(['title' => 'Laravel']);
        Category::create(['title' => 'PHP']);
        Category::create(['title' => 'JavaScript']);
        Category::create(['title' => 'Vue.js']);
        Category::create(['title' => 'React']);

        $laravel_category = Category::where('title', 'Laravel')->first();
        $php_category = Category::where('title', 'PHP')->first();

        Post::create([
            'title' => 'Laravel 11 is released',
            'author' => 'John Doe',
            'body' => 'Laravel 11 is released and it has many new features.',
            'category_id' => $laravel_category->id,
        ]);

        $firstpost = Post::query()->latest()->first();
        //firstpost create 5 comments by different authors with some negative reviews
        $firstpost->comments()->createMany([
            ['body' => 'This is a bad post.', 'author' => 'Jane Doe'],
            ['body' => 'I hate Laravel.', 'author' => 'Brother Joe'],
            ['body' => 'This is a terrible post.', 'author' => 'John Deere'],
            ['body' => 'I dislike Laravel.', 'author' => 'Jane Maria']
        ]);

        //this is the same as the above code
        $post = new Post();
        $post->title = 'PHP 8.4 is in the making';
        $post->author = 'John Doe';
        $post->body = 'PHP 8.4 is in the making and it has many new features.';
        $post->category_id = $php_category->id;
        $post->save();

        //we are using model relationship to add comments
        $post->comments()->createMany([
            ['body' => 'This is a great post.', 'author' => 'John Doe'],
            ['body' => 'I love Laravel.', 'author' => 'Jane Doe'],
        ]);
    }
}
