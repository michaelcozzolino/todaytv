<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\TvShowDetail>
 */
class TvShowDetailFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'api_uuid' => $this->faker->uuid(),
            'title' => $this->faker->word(),
            'description' => $this->faker->realText(),
            'genre' => $this->faker->word(),
            'cover_url' => $this->faker->imageUrl(),
        ];
    }
}
