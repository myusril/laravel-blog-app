<?php

namespace Database\Seeders;

use App\Models\Post;
use App\Models\User;
use App\Models\Comment;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([UserSeeder::class, CategorySeeder::class]);

        // Generate posts
        $posts = Post::factory()
            ->count(10)
            ->recycle([
                User::all(),
                Category::all()
            ])
            ->create();

        $posts->each(function ($post) {
            $comments = Comment::factory()->count(3)->create([
                'post_id' => $post->id
            ]);

            $comments->each(function ($comment) {
                if (rand(0, 1)) {
                    Comment::factory()->reply($comment)->create();
                }
            });
        });
    }
}
