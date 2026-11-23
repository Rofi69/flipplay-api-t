<?php

namespace Database\Factories;

use App\Models\Media;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Media>
 */
class MediaFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
	{
		return [
			'title' => fake()->unique()->sentence(3),
			'type' => fake()->randomElement(['film', 'series', 'musik']),
			'genre' => fake()->randomElement(['aksi', 'drama', 'komedi', 'horor', 'pop']),
			'description' => fake()->sentence(),
		];
	}
}
