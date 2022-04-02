<?php

namespace Database\Seeders;

use App\Models\TvShowDetail;
use Illuminate\Database\Seeder;

class TvShowDetailsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $tvShowDetails = [];

        for ($i = 0; $i < 5000; $i++) {
            $tvShowDetail = TvShowDetail::factory()->make();

            $tvShowDetail->slug = \Str::slug($tvShowDetail->title . ' ' . $tvShowDetail->api_uuid);

            $tvShowDetails[] = $tvShowDetail->toArray();
        }

        $chunks = array_chunk($tvShowDetails, 2000);

        foreach ($chunks as $chunk) {
            TvShowDetail::insert($chunk);
        }
    }
}
