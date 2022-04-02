<?php

namespace App\Traits;

use App\Models\Channel;
use App\Models\TvShowDetail;
use Carbon\Carbon;

trait TvShowable
{
    private ?Channel $channel;
    private ?TvShowDetail $tvShowDetail;
    private ?string $apiUUID;

    public function __invoke()
    {
        $this->apiUUID = $this->getId();
        $this->tvShowDetail = TvShowDetail::where('api_uuid', $this->apiUUID)->first();
        $this->channel = Channel::whereApiId($this->getChannel())->first();
        $this->createTvShowDetail()->createTvShow();
    }

    public function getDuration(): int
    {
        return Carbon::rawParse($this->getEndTime())->diffInMinutes($this->getStartTime());
    }

    public function getId()
    {
        $urlBindings = explode('/', $this->getContainingIdUrl());

        $idKeyNameBindIndex = array_search($this->getIdKeyName(), $urlBindings);

        $idBindIndex = $idKeyNameBindIndex + 1;

        if ($idKeyNameBindIndex !== false && array_key_exists($idBindIndex, $urlBindings)) {
            $uuid = $urlBindings[$idBindIndex];

            return \Str::isUuid($uuid) ? $uuid : $this->getCustomUUID();
        }

        return null;
    }

    private function createTvShowDetail()
    {
        if (! isset($this->tvShowDetail) && isset($this->apiUUID)) {
            $this->tvShowDetail = TvShowDetail::create([
                'api_uuid' => $this->apiUUID,
                'title' => $this->getTitle(),
                'description' => $this->getDescription(),
                'genre' => $this->getGenre(),
                'cover_url' => $this->getCoverUrl(),
            ]);
        }

        return $this;
    }

    private function createTvShow()
    {
        $startingAt = $this->getStartTime();

        $endingAt = $this->getEndTime();

        if (
            isset($this->tvShowDetail, $this->channel, $startingAt, $endingAt) &&
            Carbon::rawParse($startingAt)->isCurrentDay()
        ) {
            $this->tvShowDetail->tvShows()->firstOrCreate([
                'starting_at' => $startingAt,
                'ending_at' => $endingAt,
                'duration' => $this->getDuration(),
                'channel_id' => $this->channel->id,
            ]);
        }
    }

    /**
     * Get a custom UUID if the one from the API is not available.
     *
     * @return string
     */
    private function getCustomUUID(): string
    {
        $tvShowDetail = TvShowDetail::where([
            'title' => $this->getTitle(),
            'description' => $this->getDescription(),
            'genre' => $this->getGenre(),
            'cover_url' => $this->getCoverUrl(),
        ])->first();

        return isset($tvShowDetail) ? $tvShowDetail->api_uuid : (string) \Str::uuid();
    }
}
