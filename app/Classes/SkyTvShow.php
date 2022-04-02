<?php

namespace App\Classes;

use App\Interfaces\ProvidesTvShow;
use App\Traits\TvShowable;
use Carbon\Carbon;
use Carbon\Exceptions\InvalidFormatException;

class SkyTvShow implements ProvidesTvShow
{
    use TvShowable;
    private \SimpleXMLElement $skyTvShow;

    public function __construct(\SimpleXMLElement $skyTvShow)
    {
        $this->skyTvShow = $skyTvShow;
    }

    public function getCoverUrl()
    {
        $coverUrl = $this->skyTvShow->icon->attributes()->src;

        return !$this->isGenericCoverUrl($coverUrl) ? $coverUrl : null;
    }

    public function getTitle()
    {
        return $this->skyTvShow->title;
    }

    public function getDescription()
    {
        return $this->skyTvShow->desc;
    }

    public function getGenre()
    {
        return $this->skyTvShow->category;
    }

    public function getContainingIdUrl()
    {
        return $this->getCoverUrl();
    }

    public function getIdKeyName()
    {
        return 'uuid'; // https://guidatv.sky.it/uuid/{id}
    }

    public function getStartTime()
    {
        return $this->formatTime($this->skyTvShow->attributes()->start)->toDateTimeString();
    }

    public function getEndTime()
    {
        return $this->formatTime($this->skyTvShow->attributes()->stop)->toDateTimeString();
    }

    public function getChannel()
    {
        return $this->skyTvShow->attributes()->channel;
    }

    public function formatTime(string $time): ?Carbon
    {
        try {
            return Carbon::rawParse($time)->addHours(2);
        } catch (InvalidFormatException $e) {
            return null;
        }
    }

    /**
     * Check if the cover url is a generic one, by meaning that a specific cover url for the tv shows does not exist.
     * examples:
     * specific cover url: https://guidatv.sky.it/uuid/9b5decaa-b61c-408f-9da0-a37167ff8898/cover
     * generic cover url: https://guidatv.sky.it/uuid/dtt_cover_l58VsCKBwnW.png .
     *
     * @param string $coverUrl
     * @return bool
     */
    private function isGenericCoverUrl(string $coverUrl): bool
    {
        return \Str::endsWith($coverUrl, '.png');
    }
}
