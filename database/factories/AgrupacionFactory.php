<?php

namespace Database\Factories;

use App\Models\Agrupacion;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

class AgrupacionFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Agrupacion::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'nombre' => $this->faker->text(),
        ];
    }
}
