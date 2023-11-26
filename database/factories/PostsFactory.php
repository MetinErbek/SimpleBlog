<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Faker\Generator as Faker;
use App\Models\User;
use Str;
/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Posts>
 */
class PostsFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $title = $this->faker->sentence;
        return [
            'title' =>  $title,
            'details' =>  $this->faker->paragraph,
            'user_id' => function () {
                return User::where('role_id', 3)->inRandomOrder()->first()->id;
            },
            'status' =>  $this->faker->randomElement(['draft', 'publish']),
            'slug'  =>  Str::slug($title) . '-' . uniqid(),
        ];
    }
}
