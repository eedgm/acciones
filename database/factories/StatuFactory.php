<?php

namespace Database\Factories;

use App\Models\Statu;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

class StatuFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Statu::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'nombre' => $this->faker->text(255),
            'color' => $this->faker->hexcolor(),
        ];
    }
}
