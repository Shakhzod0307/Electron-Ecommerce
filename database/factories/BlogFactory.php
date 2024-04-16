<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Blog>
 */
class BlogFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id'=>UserFactory::new()->create()->id,
            'title'=>$this->faker->sentence(6),
            'image'=>'factory.jpg',
            'content'=>$this->faker->paragraphs(10,true),
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
