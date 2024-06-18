<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class EventNewsSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('event_news')->insert([
            'event_id'=> '1',
            'news_id'=> '1',
        ]);

        DB::table('event_news')->insert([
            'event_id'=> '1',
            'news_id'=> '2',
        ]);

        DB::table('event_news')->insert([
            'event_id'=> '2',
            'news_id'=> '1',
        ]);

        DB::table('event_news')->insert([
            'event_id'=> '3',
            'news_id'=> '3',
        ]);
    }
}
