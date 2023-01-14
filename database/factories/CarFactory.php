<?php

namespace Database\Factories;

use App\Models\BodyType;
use App\Models\CarModel;
use App\Models\Fuel;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Car>
 */
class CarFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'car_model_id' => CarModel::select('id')->orderByRaw('RAND()')->first()->id,
            'body_type_id' => BodyType::select('id')->orderByRaw('RAND()')->first()->id,
            'fuel_id' => Fuel::select('id')->orderByRaw('RAND()')->first()->id,
            'year' => $this->faker->numberBetween(1990, 2022),
            'odometer' => $this->faker->numberBetween(1000, 300000),
            'VIN' => $this->faker->unique()->regexify('[A-HJ-NPR-Z0-9]{17}'),
            'engine' => $this->faker->randomFloat(2, 1,3),
            'power' => $this->faker->numberBetween(70, 400),
            'created_at' => $this->faker->dateTimeBetween(
                '- 8 weeks',
                '- 4 weeks',
            ),
            'updated_at' => $this->faker->dateTimeBetween(
                '- 4 weeks',
                '- 1 week'
            ),
            'deleted_at' => null
        ];
    }
}
