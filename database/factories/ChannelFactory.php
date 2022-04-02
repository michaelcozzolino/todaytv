<?php

namespace Database\Factories;

use App\Models\TvGroup;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Channel>
 */
class ChannelFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $tvGroups = TvGroup::inRandomOrder()->get();
        $tvGroupId = $tvGroups->count() ? $tvGroups->first()->id : null;

        return [
            'name' => $this->faker->word(),
            'number' => $this->faker->randomNumber(3),
            'api_id' => $this->faker->word(),
            'tv_group_id' => $tvGroupId,
        ];
    }
}
