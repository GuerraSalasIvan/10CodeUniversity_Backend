<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Event;
use App\Models\Ubications;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Ubication>
 */
class UbicationFactory extends Factory
{

    public function definition(): array
    {

        $place = str_replace('.', '', fake()->sentence());
        $code = strtolower(str_replace(['.', ' '], ['', '_'], $place));
        $openning_time = ['07:00', '08:00', '09:00', '10:00', '11:00'];
        $closing_time = ['21:00', '22:00', '23:00'];

        return [
            'place' => $place,
            'code' => $code,
            'place_description' => fake()->text(150),
            'address' => fake()->address(),
            'capacity' => fake()->numberBetween(0,2000),
            'opens_at' => fake()->randomElement($openning_time),
            'closes_at' => fake()->randomElement($closing_time),
        ];
    }
}
