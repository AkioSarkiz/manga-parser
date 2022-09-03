<?php

declare(strict_types=1);

namespace Database\Factories;

use App\Models\ParsedManga;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<ParsedManga>
 */
class ParsedMangaFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'source' => fake()->domainName(),
            'key' => fake()->unique()->word(),
            'parsed_data' => json_encode([
                'title' => fake()->title(),
                'uri' => fake()->url(),
                'cover' => fake()->imageUrl(),
                'description' => fake()->text(),
            ]),
            'raw_data' => fake()->randomHtml(),
        ];
    }
}
