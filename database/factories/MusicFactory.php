<?php

namespace Database\Factories;

use App\Models\Artist;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Music>
 */
class MusicFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'artist_id' => Artist::factory()->create()->id,
            'title' => $this->faker->word(),
            'album_name' => $this->faker->word(),
            'genre' => $this->faker->randomElement(['rnb', 'country', 'classic', 'rock', 'jazz']),
        ];
    }
}
