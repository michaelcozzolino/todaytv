<?php

namespace App\Classes;

use App\Models\Channel;
use App\Models\TvShow;
use Carbon\Carbon;
use GuzzleHttp\Exception\ClientException;
use Illuminate\Http\Client\Response;
use Illuminate\Support\Facades\Http;

class TvShowsManager
{
    public const RAI_PROVIDER = 'rai';
    public const SKY_PROVIDER = 'sky';

    public function __invoke()
    {
        $raiAPIChannels = Channel::useAPI()->get();

        /** TODO: too many providers as parameters, i'm sure i can improve it */
        foreach ($raiAPIChannels as $raiAPIChannel) {
            $this->store(
                $this->scrape($this->getProviderUrl(self::RAI_PROVIDER, $raiAPIChannel->api_id)),
                self::RAI_PROVIDER,
            );
        }

        $skyAPIChannels = Channel::useAPI(self::SKY_PROVIDER)->get();

        foreach ($skyAPIChannels as $skyAPIChannel) {
            echo "{$skyAPIChannel}\n";
            $this->store(
                $this->scrape($this->getProviderUrl(self::SKY_PROVIDER, $skyAPIChannel->api_id)),
                self::SKY_PROVIDER,
            );
        }
    }

    private function destroyOld()
    {
        TvShow::old()->delete();
    }

    private function scrape(string $providerUrl): ?Response
    {
        $this->destroyOld();

        try {
            return Http::get($providerUrl);
        } catch (ClientException $e) {
            return null;
        }
    }

    private function store(?Response $response, $providerName)
    {
        if ($providerName === 'sky') {
            $skyTvShows = simplexml_load_string($response->body(), 'SimpleXMLElement', LIBXML_NOCDATA)->programme;

            foreach ($skyTvShows as $skyTvShow) {
                (new SkyTvShow($skyTvShow))();
            }
        } elseif ($providerName === 'rai') {
            $raiTvShows = $response->object()->events;

            foreach ($raiTvShows as $raiTvShow) {
                (new RaiTvShow($raiTvShow))();
            }
        }
    }

    private function getProviderUrl($providerName, $channelApiId = null): ?string
    {
        $tomorrow = Carbon::tomorrow()->format('d-m-Y');

        $providers = [
            'sky' => 'https://iptv-org.github.io/epg/guides/it/guidatv.sky.it.epg.xml',
            'rai' => "https://www.raiplay.it/palinsesto/app/{$channelApiId}/{$tomorrow}.json",
        ];

        return array_key_exists($providerName, $providers) ? $providers[$providerName] : null;
    }
}
