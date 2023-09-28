<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Job>
 */
class JobFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            "title" => fake()->jobTitle(),
            "description" => fake()->paragraphs(3, true),
            "salary" => fake()->numberBetween(10000, 200000),
            "category" => fake()->randomElement(\App\Models\Job::$category),
            "location" => fake()->city(),
            "experience" => fake()->randomElement(\App\Models\Job::$experience),
        ];
    }
}
