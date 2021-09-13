<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\App;
use App\Models\Topic;
use App\Models\Content;
use App\Models\Post;
use App\Models\Stamp;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $stamps = collect(['👍', '👎', '❤️', '😁', '😓', '🎉', '😭', '😇'])->map(function($emoji){
            return Stamp::create([
                'name' => $emoji,
            ]);
        });

        $users = User::factory(10)->create();
        $apps = $users->map(function($user){
            return App::factory(3)->make()->each(function($app) use ($user){
                $app->user()->associate($user);
                $app->save();
                return $app;
            });
        })->collapse();

        $topics = $apps->map(function($app) use ($users){
            return $users->map(function($user) use ($app) {
                $topic = Topic::factory()->make();
                $topic->app()->associate($app);
                $topic->user()->associate($user);
                $topic->save();
                $topic->contents()->saveMany(Content::factory(4)->make());
                return $topic;
            });
        })->collapse();

        $posts = $topics->map(function($topic) use ($users){
            return $users->map(function($user) use ($topic) {
                $post = Post::factory()->make();
                $post->topic()->associate($topic);
                $post->user()->associate($user);
                $post->save();
                return $post;
            });
        })->collapse();
        
    }
}
