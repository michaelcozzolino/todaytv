<?php

namespace App\Classes;

use App\Interfaces\ProvidesTvShow;
use App\Traits\TvShowable;
use Carbon\Carbon;
use Carbon\Exceptions\InvalidFormatException;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;

class RaiTvShow implements ProvidesTvShow
{
    use TvShowable;

    private \stdClass $raiTvShow;
    private ?\stdClass $additionalData;

    public function __construct(\stdClass $raiTvShow)
    {
        $this->raiTvShow = $raiTvShow;

        $this->additionalData = $this->getAdditionalData();
    }

    public function getId()
    {
        $uuid = str_replace('ContentItem-', '', $this->raiTvShow->id);

        return Str::isUuid($uuid) ? $uuid : $this->getCustomUUID();
    }

    public function isAdditionalDataAvailable()
    {
        return isset($this->additionalData);
    }

    public function getCoverUrl()
    {
        $coverPath = $this->isAdditionalDataAvailable() ? $this->additionalData->images->portrait_logo : '';

        return $coverPath !== '' ? $this->generateUrl($coverPath) : null;
    }

    public function getTitle()
    {
        return $this->raiTvShow->name;
    }

    public function getDescription()
    {
        return $this->raiTvShow->description;
    }

    public function getGenre()
    {
        $details = $this->isAdditionalDataAvailable() ? $this->additionalData->details : [];

        foreach ($details as $detail) {
            if ($detail->key === 'genre') {
                return $detail->value;
            }
        }

        return null;
    }

    public function getStartTime()
    {
        return $this->formatTime($this->raiTvShow->date . ' ' . $this->raiTvShow->hour)->toDateTimeString();
    }

    public function getEndTime()
    {
        $startTime = Carbon::rawParse($this->getStartTime());

        return isset($startTime) ? $startTime->add('minutes', $this->getDuration())->toDateTimeString() : null;
    }

    public function getChannel()
    {
        return \Str::slug($this->raiTvShow->channel);
    }

    public function formatTime(string $time): ?Carbon
    {
        try {
            return Carbon::createFromFormat('d/m/Y H:i', $time);
        } catch (InvalidFormatException $e) {
            return null;
        }
    }

    public function getDuration(): int
    {
        return (int) str_replace(' min', '', $this->raiTvShow->duration_in_minutes);
    }

    private function generateUrl(string $path): string
    {
        return 'https://www.raiplay.it' . $path;
    }

    private function getInfoUrl(): string
    {
        return $this->generateUrl($this->raiTvShow->program->info_url);
    }

    private function getAdditionalData(): ?\stdClass
    {
        return Http::get($this->getInfoUrl())->object();
    }
}
