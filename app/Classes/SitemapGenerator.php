<?php

namespace App\Classes;

use App\Models\Channel;
use App\Models\TvGroup;
use App\Models\TvShowDetail;
use Spatie\Sitemap\Sitemap;
use Spatie\Sitemap\SitemapIndex;
use Spatie\Sitemap\Tags\Url;

class SitemapGenerator
{
    public const MAX_SITEMAP_URLS = 50000;
    public const CHANNELS_SITEMAP_FILE_NAME = 'sitemap_channels.xml';
    public const INDEX_SITEMAP_FILE_NAME = 'sitemap_index.xml';
    public const TV_GROUPS_TIMES_SITEMAP_FILE_NAME = 'sitemap_tv_groups_times.xml';

    public function generateChannels()
    {
        return $this->save(Sitemap::create()->add(Channel::all()), self::CHANNELS_SITEMAP_FILE_NAME);
    }

    public function generateTvShowDetails()
    {
        $tvShowDetailsChunks = TvShowDetail::orderBy('id')
            ->get()
            ->chunk(self::MAX_SITEMAP_URLS);

        foreach ($tvShowDetailsChunks as $key => $tvShowDetailsChunk) {
            $this->save(Sitemap::create()->add($tvShowDetailsChunk), "sitemap{$key}.xml");
        }

        return $this;
    }

    public function generateTvGroupsTimes(): static
    {
        $sitemap = Sitemap::create();

        $tvTimes = ValidTvTime::getTimes();

        $tvGroups = TvGroup::getGroupedTvGroups();

        foreach ($tvGroups as $tvGroup) {
            if (!is_null($tvGroup->sub_tv_groups)) {
                $sitemap->add($this->generateTvGroupsTimesUrls(explode(',', $tvGroup->slugs), $tvTimes));
            } else {
                $sitemap->add($this->generateTvGroupsTimesUrls([$tvGroup->slugs], $tvTimes));
            }
        }

        return $this->save($sitemap, self::TV_GROUPS_TIMES_SITEMAP_FILE_NAME);
    }

    private function generateTvGroupsTimesUrls(array $tvGroups, array $tvTimes): array
    {
        $urls = [];

        foreach ($tvGroups as $tvGroup) {
            foreach ($tvTimes as $tvTime) {
                $urls[] = Url::create(TvGroup::route($tvGroup, $tvTime))->setChangeFrequency(
                    $tvTime === ValidTvTime::ON_AIR ? Url::CHANGE_FREQUENCY_HOURLY : Url::CHANGE_FREQUENCY_DAILY,
                );
            }
        }

        return $urls;
    }

    public function generateIndex()
    {
        $sitemapIndex = SitemapIndex::create();

        if (($publicDirectoryFileNames = scandir(public_path())) !== false) {
            foreach ($publicDirectoryFileNames as $publicDirectoryFileName) {
                if (
                    str_contains($publicDirectoryFileName, 'sitemap') !== false &&
                    $publicDirectoryFileName !== self::INDEX_SITEMAP_FILE_NAME
                ) {
                    $sitemapIndex->add($publicDirectoryFileName);
                }
            }

            $this->save($sitemapIndex, self::INDEX_SITEMAP_FILE_NAME);
        }

        return $this;
    }

    private function save(Sitemap|SitemapIndex $sitemap, string $fileName)
    {
        $sitemap->writeToFile(public_path($fileName));

        return $this;
    }

    public function getTvShowDetailsSitemapFilePath(int $sitemapId)
    {
        return public_path("sitemap{$sitemapId}.xml");
    }
}
