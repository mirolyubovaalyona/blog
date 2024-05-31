<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\User;

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
    public function definition(): array
    {
        $title = $this->faker->realText(rand(10, 50));
        $short_title = strlen($title) > 30 ? mb_substr($title, 0, 30) . '...' : $title; 

        return [
            'title'=> $title,
            'short_title'=> $short_title , 
            'created_at'=> $this->faker->dateTimeBetween('-30 days', '-1 days'),
            'updated_at'=> $this->faker->dateTimeBetween('-30 days', '-1 days'),
            'author_id' => User::inRandomOrder()->first()->id,
            'descr' => $this->faker->sentence,
        ];
    }
}
