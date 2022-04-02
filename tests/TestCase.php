<?php

namespace Tests;

use App\Classes\RaiTvShow;
use App\Classes\SkyTvShow;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;

    protected RaiTvShow $raiTvShow;
    protected SkyTvShow $skyTvShow;

    protected function setUp(): void
    {
        parent::setUp();

        $this->seed();

        $this->raiTvShow = getSampleRaiTvShow();

        $this->skyTvShow = getSampleSkyTvShow();

        ($this->raiTvShow)();
        ($this->skyTvShow)();
    }
}
