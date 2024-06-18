<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Ubication;

class UbicationSeeder extends Seeder
{
    public function run(): void
    {

        Ubication::factory()->count(6)->create();

        $ubication = Ubication::all();
        foreach($ubication as $ubication){
            $ubication->addMediaFromUrl('https://picsum.photos/1400/1400')
            ->toMediaCollection();
        }

        // Ubication::create([
        //     'capacity' => 120,
        //     'place' => 'Auditorio de Fibes',
        //     'place_description' => 'junto al Palacio de los Congresos, situado en Sevilla Este'
        // ]);

        // Ubication::create([
        //     'capacity' => 320,
        //     'place' => 'Pabellón Maria Zambrano',
        //     'place_description' => 'Calle Alarifes'
        // ]);
    }
}
