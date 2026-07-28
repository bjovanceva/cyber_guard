<?php

namespace Database\Factories;

use App\Models\Category;
use App\Models\Incident;
use App\Models\SummarizedIncident;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<SummarizedIncident>
 */
class SummarizedIncidentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'generated_summary' => $this->faker->text(),
            'predicted_category_id' => Category::query()->inRandomOrder()->value('id'),
            'incident_id' => Incident::query()->inRandomOrder()->value('id'),
        ];
    }
}
