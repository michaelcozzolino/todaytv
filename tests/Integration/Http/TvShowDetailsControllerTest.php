<?php

namespace Tests\Integration\Http;

use App\Models\TvShowDetail;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class TvShowDetailsControllerTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @test
     */
    public function tv_show_detail_page_can_be_rendered()
    {
        $this->get(
            route('tv-show-details.show', [
                'tvShowDetail' => TvShowDetail::first(),
            ]),
        )
            ->assertOk()
            ->assertViewHas('tvShowDetail');
    }
}
