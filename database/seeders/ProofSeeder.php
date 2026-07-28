<?php

namespace Database\Seeders;

use App\Models\Proof;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProofSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Proof::factory(20)->create();
    }
}
