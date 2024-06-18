<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Event;
use Carbon\Carbon;

class EventSeeder extends Seeder
{

    private function generateCodeFromTitle(string $title): string
{

    $lowercasedTitle = strtolower($title);

    $code = str_replace(' ', '_', $lowercasedTitle);
    return $code;
}

    public function run(): void
    {

        Event::factory()->count(15)->create();

        $events = [
            [
                'title' => 'UX review presentations',
                'description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean tristique, tortor nec consequat vulputate.',
                'organizator' => '10Code',
                'available_at' => Carbon::create(2024, 5, 17, 12, 0, 0),
                'finish_at' => Carbon::create(2024, 5, 20, 13, 0, 0),
                'ubication_id' => 1,
                'capacity' =>200,
            ],

            [
                'title' => 'UX review presentations',
                'description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean tristique, tortor nec consequat vulputate.',
                'organizator' => '10Code',
                'available_at' => Carbon::create(2024, 5, 15, 12, 0, 0),
                'finish_at' => Carbon::create(2024, 5, 16, 13, 0, 0),
                'ubication_id' => 1,
                'capacity' =>200,
            ],

            [
                'title' => 'Migrating to Linear 101',
                'description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean tristique, tortor nec consequat vulputate.',
                'organizator' => '10Code',
                'available_at' => Carbon::create(2024, 04, 25, 12, 00, 00),
                'finish_at' => Carbon::create(2024, 04, 29, 14, 00, 00),
                'ubication_id' => 2,
                'capacity' =>200,
            ],

            [
                'title' => 'Building your API Stack',
                'description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean tristique, tortor nec consequat vulputate.',
                'organizator' => '10Code',
                'available_at' => Carbon::create(2024, 04, 25, 12, 00, 00),
                'finish_at' => Carbon::create(2024, 05, 15, 13, 00, 00),
                'ubication_id' => 1,
                'capacity' =>200,
            ],

            [
                'title' => 'Evento en curso',
                'description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean tristique, tortor nec consequat vulputate.',
                'organizator' => 'Ivan',
                'available_at' => Carbon::create(2023, 06, 25, 16, 00, 00),
                'finish_at' => Carbon::create(2024, 06, 25, 18, 00, 00),
                'ubication_id' => 2,
                'capacity' =>200,
            ],

            [
                'title' => 'Evento Finalizado',
                'description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean tristique, tortor nec consequat vulputate.',
                'organizator' => 'Ivan',
                'available_at' => Carbon::create(2023, 06, 25, 16, 00, 00),
                'finish_at' => Carbon::create(2023, 06, 25, 18, 00, 00),
                'ubication_id' => 1,
                'capacity' =>200,
            ]

        ];

        foreach ($events as $eventData) {

            $event = Event::create([
                'title' => $eventData['title'],
                'code' => $this->generateCodeFromTitle($eventData['title']),
                'description' => $eventData['description'],
                'organizator' => $eventData['organizator'],
                'available_at' => $eventData['available_at'],
                'finish_at' => $eventData['finish_at'],
                'ubication_id' => $eventData['ubication_id'],
                'capacity' =>$eventData['capacity'],
            ]);
        }

        $event = Event::all();
        foreach($event as $event){
            $event->addMediaFromUrl('https://picsum.photos/1400/1400')
            ->toMediaCollection();
        }

    }
}
