<?php

namespace App\Interfaces;

use Carbon\Carbon;

interface ProvidesTvShow
{
    public function getId();

    public function getCoverUrl();

    public function getTitle();

    public function getDescription();

    public function getGenre();

    public function getStartTime();

    public function getEndTime();

    public function getChannel();

    public function formatTime(string $time): ?Carbon;
}
