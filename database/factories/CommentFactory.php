<?php

namespace Database\Factories;

use App\Models\Post;
use App\Models\User;
use App\Models\Comment;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Comment>
 */
class CommentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'post_id' => Post::inRandomOrder()->first()->id ?? 1,
            'user_id' => User::inRandomOrder()->first()->id ?? 1,
            'body' => $this->faker->sentence(),
            'parent_id' => null, // default comment utama
        ];
    }

    /**
     * State untuk reply
     */
    public function reply(Comment $parent)
    {
        return $this->state(function () use ($parent) {
            return [
                'post_id' => $parent->post_id,
                'user_id' => User::inRandomOrder()->first()->id ?? 1,
                'body' => $this->faker->sentence(),
                'parent_id' => $parent->id,
            ];
        });
    }
}
