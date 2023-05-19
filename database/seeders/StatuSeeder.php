<?php

namespace Database\Seeders;

use App\Models\Statu;
use Illuminate\Database\Seeder;

class StatuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Statu::factory()
            ->count(5)
            ->create();
    }
}
