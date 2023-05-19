<?php

namespace Database\Seeders;

use App\Models\Agrupacion;
use Illuminate\Database\Seeder;

class AgrupacionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Agrupacion::factory()
            ->count(5)
            ->create();
    }
}
