<?php

namespace Database\Seeders;

use App\Models\SummarizedIncident;
use Illuminate\Database\Seeder;

class SummarizedIncidentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        SummarizedIncident::factory(20)->create();
    }
}
