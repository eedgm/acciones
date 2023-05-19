<?php

namespace Database\Seeders;

use App\Models\Statu;
use App\Models\Prioridad;
use App\Models\Agrupacion;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Adding an admin user
        $user = \App\Models\User::factory()
            ->count(1)
            ->create([
                'name' => 'admin',
                'email' => 'admin@admin.com',
                'password' => \Hash::make('admin'),
            ]);
        $this->call(PermissionsSeeder::class);

        Agrupacion::create(['nombre' => 'David']);
        Agrupacion::create(['nombre' => 'Barú']);
        Agrupacion::create(['nombre' => 'Bugaba']);
        Agrupacion::create(['nombre' => 'Changuinola']);
        Agrupacion::create(['nombre' => 'Chiriquí Grande']);
        Agrupacion::create(['nombre' => 'Veraguas Sur Este']);
        Agrupacion::create(['nombre' => 'Chiriquí Oriente']);
        Agrupacion::create(['nombre' => 'Panamá Metro']);
        Agrupacion::create(['nombre' => 'Panamá Oeste']);
        Agrupacion::create(['nombre' => 'San Miguelito']);
        Agrupacion::create(['nombre' => 'Darién']);
        Agrupacion::create(['nombre' => 'Panamá Este']);
        Agrupacion::create(['nombre' => 'Kuna Yala']);
        Agrupacion::create(['nombre' => 'Coclé']);
        Agrupacion::create(['nombre' => 'Colón']);
        Agrupacion::create(['nombre' => 'Azuero']);
        Prioridad::create(['nombre' => 'Alta', 'color' => 'blue']);
        Prioridad::create(['nombre' => 'Media', 'color' => 'yellow']);
        Prioridad::create(['nombre' => 'Baja', 'color' => 'sky']);
        Statu::create(['nombre' => 'En esperado', 'color' => 'gray']);
        Statu::create(['nombre' => 'Iniciado', 'color' => 'blue']);
        Statu::create(['nombre' => 'Completado', 'color' => 'green']);
        Statu::create(['nombre' => 'Sin completar', 'color' => 'red']);
        // $this->call(UserSeeder::class);
    }
}
