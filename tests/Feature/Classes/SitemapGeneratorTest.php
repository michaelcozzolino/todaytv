<?php

namespace Tests\Feature\Classes;

use App\Classes\SitemapGenerator;
use App\Classes\ValidTvTime;
use App\Models\Channel;
use App\Models\TvGroup;
use App\Models\TvShowDetail;
use Database\Seeders\TvShowDetailsSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class SitemapGeneratorTest extends TestCase
{
    use RefreshDatabase;
    private SitemapGenerator $sitemapGenerator;
    private string $channelsSitemapPath;

    protected function setUp(): void
    {
        parent::setUp();

        $this->seed([TvShowDetailsSeeder::class]);

        $this->sitemapGenerator = new SitemapGenerator();
    }

    /**
     * @test
     */
    public function it_creates_the_channels_sitemap()
    {
        $this->sitemapGenerator->generateChannels();

        $channelsSitemapXML = simplexml_load_file(public_path(SitemapGenerator::CHANNELS_SITEMAP_FILE_NAME));

        $this->assertEquals(Channel::all()->count(), $channelsSitemapXML->count());

        deleteFile(public_path(SitemapGenerator::CHANNELS_SITEMAP_FILE_NAME));
    }

    /**
     * @test
     */
    public function it_creates_the_tv_show_details_sitemaps()
    {
        $this->sitemapGenerator->generateTvShowDetails();

        $totalTvShowDetails = TvShowDetail::count();

        $totalTvShowDetailsSitemaps = (int) ceil($totalTvShowDetails / SitemapGenerator::MAX_SITEMAP_URLS);

        for ($i = 0; $i < $totalTvShowDetailsSitemaps; $i++) {
            $sitemapFileName = "sitemap{$i}.xml";

            $tvShowDetailsSitemapXML = simplexml_load_file(public_path($sitemapFileName));

            $expectedTvShowDetailsSitemapCount =
                $i === $totalTvShowDetailsSitemaps - 1
                    ? $totalTvShowDetails - SitemapGenerator::MAX_SITEMAP_URLS * ($totalTvShowDetailsSitemaps - 1)
                    : SitemapGenerator::MAX_SITEMAP_URLS;

            $this->assertEquals($expectedTvShowDetailsSitemapCount, $tvShowDetailsSitemapXML->count());

            deleteFile($this->sitemapGenerator->getTvShowDetailsSitemapFilePath($i));
        }
    }

    /**
     * @test
     */
    public function it_creates_the_tv_groups_times_sitemap()
    {
        $this->sitemapGenerator->generateTvGroupsTimes();

        $tvGroupsTimesSitemapXML = simplexml_load_file(
            public_path(SitemapGenerator::TV_GROUPS_TIMES_SITEMAP_FILE_NAME),
        );

        $this->assertEquals(count(ValidTvTime::getTimes()) * TvGroup::count(), $tvGroupsTimesSitemapXML->count());

        deleteFile(public_path(SitemapGenerator::TV_GROUPS_TIMES_SITEMAP_FILE_NAME));
    }

    /**
     * @test
     */
    public function it_creates_the_index_sitemap()
    {
        $this->sitemapGenerator->generateChannels();

        $this->sitemapGenerator->generateTvShowDetails();

        $this->sitemapGenerator->generateTvGroupsTimes();

        $this->sitemapGenerator->generateIndex();

        $indexSitemapXML = simplexml_load_file(public_path(SitemapGenerator::INDEX_SITEMAP_FILE_NAME));

        $tvShowDetailsSitemapsCount = (int) ceil(TvShowDetail::count() / SitemapGenerator::MAX_SITEMAP_URLS);

        $expectedSitemapsCount = 2 + $tvShowDetailsSitemapsCount;

        $this->assertEquals($expectedSitemapsCount, $indexSitemapXML->count());

        deleteFile(public_path(SitemapGenerator::CHANNELS_SITEMAP_FILE_NAME));

        deleteFile(public_path(SitemapGenerator::TV_GROUPS_TIMES_SITEMAP_FILE_NAME));

        deleteFile(public_path(SitemapGenerator::INDEX_SITEMAP_FILE_NAME));

        for ($i = 0; $i < $tvShowDetailsSitemapsCount; $i++) {
            deleteFile(public_path("sitemap{$i}.xml"));
        }
    }
}
