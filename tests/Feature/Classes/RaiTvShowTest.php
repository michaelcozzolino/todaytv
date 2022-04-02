<?php

namespace Tests\Feature\Classes;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Str;
use Tests\TestCase;

class RaiTvShowTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @test
     */
    public function it_returns_the_correct_data()
    {
        $this->assertEquals('2022-03-13 00:25:00', $this->raiTvShow->getStartTime());

        $this->assertEquals('2022-03-13 02:00:00', $this->raiTvShow->getEndTime());

        $this->assertEquals('info', $this->raiTvShow->getIdKeyName());

        $this->assertEquals(
            '/programmi/info/9accb31f-9b8e-4c71-8d50-0f4b8ef4f182',
            $this->raiTvShow->getContainingIdUrl(),
        );

        $this->assertEquals(Str::slug('Rai Movie'), $this->raiTvShow->getChannel());

        $this->assertEquals(
            "Nella New York del 1982, due amici escogitano un colpo all'azienda di automobili blindate in cui uno dei due ha lavorato. L'obiettivo sono quindici milioni di dollari, ovvero la più grande cifra mai rubata in una rapina negli Stati Uniti. Ispirato a una storia realmente accaduta.",
            $this->raiTvShow->getDescription(),
        );

        $this->assertEquals('Empire State', $this->raiTvShow->getTitle());

        $this->assertEquals(95, $this->raiTvShow->getDuration());
    }
}
