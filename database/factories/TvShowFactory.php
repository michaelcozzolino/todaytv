<?php

namespace Database\Factories;

use App\Models\Channel;
use App\Models\TvShowDetail;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\TvShow>
 */
class TvShowFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $startingAt = Carbon::today()
            ->copy()
            ->addHours(rand(0, 24));

        return [
            'starting_at' => $startingAt->toDateTimeString(),
            'ending_at' => $startingAt
                ->copy()
                ->addHour()
                ->toDateTimeString(),
            'channel_id' => Channel::factory()->create()->id,
            'duration' => $this->faker->randomNumber(2),
            'tv_show_detail_id' => TvShowDetail::factory()->create()->id,
        ];
    }
}
