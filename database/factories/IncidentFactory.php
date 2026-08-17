<?php

namespace Database\Factories;

use App\Models\Category;
use App\Models\Incident;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Incident>
 */
class IncidentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title' => $this->faker->sentence(),
            'description' => $this->faker->paragraph(),
            'date_reported' => $this->faker->dateTimeThisYear(),
            'status' => $this->faker->randomElement(['pending', 'under_review', 'resolved']),
            'user_id'=>User::query()->inRandomOrder()->value('id'),
            'category_id'=>Category::query()->inRandomOrder()->value('id'),
        ];
    }
}
