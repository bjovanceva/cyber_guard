<?php

namespace Database\Factories;

use App\Models\Incident;
use App\Models\Proof;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Proof>
 */
class ProofFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'file_name' => $this->faker->word() . '.pdf',
            'file_type' => 'application/pdf',
            'file_path' => 'proofs/'.$this->faker->uuid(),
            'incident_id' => Incident::query()->inRandomOrder()->value('id'),
        ];
    }
}
