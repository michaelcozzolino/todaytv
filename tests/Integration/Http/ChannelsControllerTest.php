<?php

namespace Tests\Integration\Http;

use App\Classes\ValidTvTime;
use App\Models\TvGroup;
use App\Models\TvShow;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ChannelsControllerTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @test
     */
    public function index_page_can_be_rendered()
    {
        $response = $this->get(
            route('channels.index', [
                'tvGroup' => TvGroup::first()->slug,
                'time' => ValidTvTime::ON_AIR,
            ]),
        );

        $response->assertOk();

        $response->assertViewHasAll(['channels', 'time', 'tvGroup']);
    }

    /**
     * @test
     */
    public function show_page_can_be_rendered()
    {
        $response = $this->get(
            route('channels.show', [
                'channel' => TvShow::first()->channel->slug,
            ]),
        );

        $response->assertOk();

        $response->assertViewHasAll(['channel']);
    }
}
