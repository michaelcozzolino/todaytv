<?php

namespace Database\Seeders;

use App\Classes\SitemapGenerator;
use App\Models\Channel;
use App\Models\TvGroup;
use App\Models\TvShow;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        Channel::destroy(Channel::all()->pluck('id'));

        TvGroup::destroy(TvGroup::all()->pluck('id'));

        /** TODO: compact data */
        TvGroup::create(['name' => 'Digitale terrestre', 'sub_tv_group_name' => null]);
        //        TvGroup::create(['name' => 'Premium', 'sub_tv_group_name' => null]);
        TvGroup::create(['name' => 'Sky', 'sub_tv_group_name' => 'Bambini']);
        TvGroup::create(['sub_tv_group_name' => 'Cinema', 'name' => 'Sky']);
        TvGroup::create(['sub_tv_group_name' => 'Doc e Lifestyle', 'name' => 'Sky']);
        TvGroup::create(['sub_tv_group_name' => 'Intrattenimento', 'name' => 'Sky']);
        TvGroup::create(['sub_tv_group_name' => 'Sport', 'name' => 'Sky']);

        $this->call([ChannelsTableSeeder::class]);

        if (\App::environment('production')) {
            (new SitemapGenerator())->generateChannels()->generateTvGroupsTimes();
        } elseif (\App::environment('testing')) {
            TvShow::factory()
                ->count(30)
                ->create();
        }
    }
}
