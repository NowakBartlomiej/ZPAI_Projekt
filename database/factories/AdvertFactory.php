<?php

namespace Database\Factories;

use App\Models\Car;
use App\Models\City;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class AdvertFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            // 'user_id' => User::select('id')->orderByRaw('RAND()')->first()->id,
            'car_id' => Car::select('id')->orderByRaw('RAND()')->first()->id,
            'price' => $this->faker->numberBetween(1000,100000),
            'description' => $this->faker->text(50),
            'city_id' => City::select('id')->orderByRaw('RAND()')->first()->id,
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
