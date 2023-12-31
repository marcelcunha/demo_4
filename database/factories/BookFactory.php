<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Book>
 */
class BookFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title' => $this->faker->unique()->sentence(3),
            'author' => $this->faker->name(),
            'pages' => $this->faker->numberBetween(100, 1000),
            'description' => $this->faker->optional(.3)->text(400),
            'created_at' => $this->faker->dateTimeBetween('-5 year'),
        ];
    }
}
