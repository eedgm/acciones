<?php

namespace Database\Seeders;

use App\Models\Prioridad;
use Illuminate\Database\Seeder;

class PrioridadSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Prioridad::factory()
            ->count(5)
            ->create();
    }
}
