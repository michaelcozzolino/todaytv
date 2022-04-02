<?php

namespace Tests\Feature\Classes;

use Carbon\Carbon;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class SkyTvShowTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @test
     */
    public function it_returns_the_correct_data()
    {
        // sky is UTC+2
        $this->assertEquals(Carbon::today()->format('Y-m-d') . ' 02:00:00', $this->skyTvShow->getStartTime());

        $this->assertEquals(Carbon::today()->format('Y-m-d') . ' 04:00:00', $this->skyTvShow->getEndTime());

        $this->assertEquals('uuid', $this->skyTvShow->getIdKeyName());

        $this->assertEquals(
            'https://guidatv.sky.it/uuid/f325e992-aa0a-4c85-9625-85cbdcc547ac/cover?md5ChecksumParam=b01b7edcbb59f3dedebec43395d34c32',
            $this->skyTvShow->getContainingIdUrl(),
        );

        $this->assertEquals(
            'https://guidatv.sky.it/uuid/f325e992-aa0a-4c85-9625-85cbdcc547ac/cover?md5ChecksumParam=b01b7edcbb59f3dedebec43395d34c32',
            $this->skyTvShow->getCoverUrl(),
        );

        $this->assertEquals('Italia1.it', $this->skyTvShow->getChannel());

        $this->assertEquals('Intrattenimento', $this->skyTvShow->getGenre());

        $this->assertEquals(
            'S1 Ep2 - Bruno fa una importante scoperta su Lackovic, ma deve anche nascondere un segreto. Prox Ep. 25 mar 03:15. Rep. 19 mar 14:45',
            $this->skyTvShow->getDescription(),
        );

        $this->assertEquals('Il Re', $this->skyTvShow->getTitle());
    }
}
