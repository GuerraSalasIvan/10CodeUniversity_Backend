<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Event;
use App\Models\Ubication;
use Carbon\Carbon;

class EventFactory extends Factory
{
    public function definition(): array
    {
        $currentDateTime = Carbon::now();
        $availableAtDateTime = $currentDateTime->copy()->addDays(random_int(1, 365))->second(0); // Establecer los segundos a 0
        $finishAtDateTime = $availableAtDateTime->copy()->addDays(random_int(1, 365))->second(0); // Establecer los segundos a 0

        $title = str_replace('.', '', $this->faker->sentence());
        $code = strtolower(str_replace(['.', ' '], ['', '_'], $title));

        return [
            'title' => $title,
            'code' => $code,
            'description' => $this->faker->text(1600),
            'organizator' => $this->faker->name(),
            'available_at' => $availableAtDateTime,
            'finish_at' => $finishAtDateTime,
            'ubication_id' => Ubication::factory(),
            'capacity' => $this->faker->numberBetween(0,500),
        ];
    }


    // public function configure()
    // {
    //     return $this->afterCreating(function (Event $event){
    //         $url = $event ->image;
    //         $event ->addMediaFromUrl()
    //     });
    // }
}
