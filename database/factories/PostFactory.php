<?php

namespace Database\Factories;

use App\Models\Post;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Post>
 */
class PostFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected $model = Post::class;
    public function definition(): array
    {
        return [
            'title' => $this->faker->unique()->sentence(3), // Adjust as needed
            'description' => $this->faker->paragraph(), // Adjust as needed
            'user_id' => User::inRandomOrder()->first()->id, // Ensure it matches your User model
            'image' => $this->faker->image('public/images/posts', 640, 480, null, false) // Generate a fake image file
        ];
    }
}
