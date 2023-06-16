<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Task>
 */
class TaskFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => fake()->name(),
            'description' => fake()->text(),
            'status_id' => fake()->numberBetween(1, 4),
            'created_by_id' => fake()->numberBetween(1, 16),
            'assigned_to_id' => fake()->numberBetween(1, 15),
        ];
    }
}
