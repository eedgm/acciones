<?php

namespace Database\Factories;

use App\Models\Prioridad;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

class PrioridadFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Prioridad::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'nombre' => $this->faker->name(),
            'color' => $this->faker->hexcolor(),
        ];
    }
}
