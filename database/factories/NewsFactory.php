<?php

namespace Database\Factories;
use App\Models\News;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class NewsFactory extends Factory
{

    public function definition(): array
    {
        $title = str_replace('.', '', fake()->sentence());
        $code = strtolower(str_replace(['.', ' '], ['', '_'], $title));

        return [
            'title' => $title,
            'code' => $code,
            'description' => fake()->text(1600),
            'author' => fake()->name(),
        ];
    }
}
