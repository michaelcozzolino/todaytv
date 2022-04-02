<?php

namespace Tests\Feature\Traits;

use App\Models\Channel;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class TvshowableTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_returns_the_correct_data()
    {
        $this->assertEquals(120, $this->skyTvShow->getDuration());

        $this->assertEquals('f325e992-aa0a-4c85-9625-85cbdcc547ac', $this->skyTvShow->getId());
    }

    /** @test */
    public function it_stores_the_tv_show_details()
    {
        $this->assertDatabaseHas('tv_show_details', [
            'api_uuid' => $this->skyTvShow->getId(),
            'title' => $this->skyTvShow->getTitle(),
            'description' => $this->skyTvShow->getDescription(),
            'genre' => $this->skyTvShow->getGenre(),
            'cover_url' => $this->skyTvShow->getCoverUrl(),
        ]);
    }

    /** @test */
    public function it_stores_the_tv_show()
    {
        $this->assertDatabaseHas('tv_shows', [
            'starting_at' => $this->skyTvShow->getStartTime(),
            'ending_at' => $this->skyTvShow->getEndTime(),
            'duration' => $this->skyTvShow->getDuration(),
            'channel_id' => Channel::whereApiId('Italia1.it')->first()->id,
        ]);
    }
}
