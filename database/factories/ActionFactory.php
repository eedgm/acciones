<?php

namespace Database\Factories;

use App\Models\Action;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

class ActionFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Action::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'numero' => $this->faker->text(255),
            'accion' => $this->faker->text(255),
            'descripcion' => $this->faker->text(),
            'fecha' => $this->faker->date(),
            'statu_id' => \App\Models\Statu::factory(),
            'prioridad_id' => \App\Models\Prioridad::factory(),
        ];
    }
}
