<?php

namespace Database\Seeders;

use App\Models\TvGroup;
use Illuminate\Database\Seeder;

class ChannelsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        TvGroup::with('channels')
            ->whereName('Digitale terrestre')
            ->first()
            ->channels()
            ->createMany($this->getDigitaleTerrestreChannels());

        /** TODO: implement mediaset premium */
        /*TvGroup::with('channels')
            ->whereName('Premium')
            ->first()
            ->channels()
            ->createMany([
                [
                    'name' => 'Premium Crime',
                    'number' => 118,
                    'api_id' => 'PremiumCrime.it',
                ],
                [
                    'name' => 'Premium Stories',
                    'number' => 122,
                    'api_id' => 'PremiumStories.it',
                ],
                [
                    'name' => 'Premium Action',
                    'number' => 125,
                    'api_id' => 'PremiumAction.it',
                ],
            ]);*/

        TvGroup::with('channels')
            ->whereSlug(\Str::slug('Sky Intrattenimento'))
            ->first()
            ->channels()
            ->createMany([
                [
                    'name' => 'Sky Uno',
                    'number' => 108,
                    'api_id' => 'SkyUno.it',
                ],
                [
                    'name' => 'Sky Atlantic',
                    'number' => 110,
                    'api_id' => 'SkyAtlantic.it',
                ],
                [
                    'name' => 'Fox',
                    'number' => 112,
                    'api_id' => 'FoxItalia.us',
                ],
                [
                    'name' => 'Crime Investigation',
                    'number' => 119,
                    'api_id' => 'CrimePlusInvestigationNetworkItalia.us',
                ],
                [
                    'name' => 'Sky Arte',
                    'number' => 120,
                    'api_id' => 'SkyArte.it',
                ],
                [
                    'name' => 'Comedy Central',
                    'number' => 128,
                    'api_id' => 'ComedyCentralItalia.us',
                ],
                [
                    'name' => 'LaF',
                    'number' => 135,
                    'api_id' => 'LaF.it',
                ],
                [
                    'name' => 'Classica HD',
                    'number' => 136,
                    'api_id' => 'ClassicaHD.de',
                ],
                [
                    'name' => 'NOVE',
                    'number' => 149,
                    'api_id' => 'Nove.it',
                ],
            ]);

        TvGroup::with('channels')
            ->whereSlug(\Str::slug('Sky Bambini'))
            ->first()
            ->channels()
            ->createMany([
                [
                    'name' => 'Nick Junior',
                    'number' => 603,
                    'api_id' => 'NickJrItalia.it',
                ],
                [
                    'name' => 'Nickelodeon',
                    'number' => 605,
                    'api_id' => 'NickelodeonItalia.it',
                ],
                [
                    'name' => 'Boomerang',
                    'number' => 609,
                    'api_id' => 'BoomerangItalia.us',
                ],
                [
                    'name' => 'Baby TV',
                    'number' => 624,
                    'api_id' => 'BabyTVEurope.uk',
                ],
            ]);

        TvGroup::with('channels')
            ->whereSlug(\Str::slug('Sky Cinema'))
            ->first()
            ->channels()
            ->createMany([
                [
                    'name' => 'Sky Cinema Uno',
                    'number' => 301,
                    'api_id' => 'SkyCinemaUno.it',
                ],
                [
                    'name' => 'Sky Cinema Due',
                    'number' => 302,
                    'api_id' => 'SkyCinemaDue.it',
                ],
                [
                    'name' => 'Sky Cinema Family',
                    'number' => 304,
                    'api_id' => 'SkyCinemaFamily.it',
                ],
                [
                    'name' => 'Sky Cinema Action',
                    'number' => 305,
                    'api_id' => 'SkyCinemaAction.it',
                ],
                [
                    'name' => 'Sky Cinema Suspense',
                    'number' => 306,
                    'api_id' => 'SkyCinemaSuspense.it',
                ],
                [
                    'name' => 'Sky Cinema Romance',
                    'number' => 307,
                    'api_id' => 'SkyCinemaRomance.it',
                ],
                [
                    'name' => 'Sky Cinema Drama',
                    'number' => 308,
                    'api_id' => 'SkyCinemaDrama.it',
                ],
                [
                    'name' => 'Sky Cinema Comedy',
                    'number' => 309,
                    'api_id' => 'SkyCinemaComedy.it',
                ],
            ]);

        TvGroup::with('channels')
            ->whereSlug(\Str::slug('Sky Sport'))
            ->first()
            ->channels()
            ->createMany([
                [
                    'name' => 'Sky Sport 24',
                    'number' => 200,
                    'api_id' => 'SkySport24.it',
                ],
                [
                    'name' => 'Sky Sport Uno',
                    'number' => 201,
                    'api_id' => 'SkySportUno.it',
                ],
                [
                    'name' => 'Sky Sport Serie A',
                    'number' => 202,
                    'api_id' => 'SkySportSerieA.it',
                ],
                [
                    'name' => 'Sky Sport Football',
                    'number' => 203,
                    'api_id' => 'SkySportFootball.it',
                ],
                [
                    'name' => 'Sky Sport Arena',
                    'number' => 204,
                    'api_id' => 'SkySportArena.it',
                ],
                [
                    'name' => 'Sky Sport NBA',
                    'number' => 206,
                    'api_id' => 'SkySportNBA.it',
                ],

                [
                    'name' => 'Sky Sport F1',
                    'number' => 207,
                    'api_id' => 'SkySportF1.it',
                ],
                [
                    'name' => 'Sky Sport Moto GP',
                    'number' => 208,
                    'api_id' => 'SkySportMotoGP.it',
                ],
            ]);

        TvGroup::with('channels')
            ->whereSlug(\Str::slug('Sky Doc e Lifestyle'))
            ->first()
            ->channels()
            ->createMany([
                [
                    'name' => 'Discovery Channel',
                    'number' => 401,
                    'api_id' => 'DiscoveryChannelItalia.us',
                ],

                [
                    'name' => 'National Geographic',
                    'number' => 403,
                    'api_id' => 'NationalGeographicItalia.us',
                ],
                [
                    'name' => 'Discovery Science',
                    'number' => 405,
                    'api_id' => 'DiscoveryScienceItalia.us',
                ],
                [
                    'name' => 'History Channel',
                    'number' => 407,
                    'api_id' => 'HistoryItalia.us',
                ],

                [
                    'name' => 'National Geographic Wild',
                    'number' => 409,
                    'api_id' => 'NationalGeographicWildItalia.us',
                ],
                [
                    'name' => 'Gambero Rosso',
                    'number' => 412,
                    'api_id' => 'GamberoRossoChannel.it',
                ],
            ]);
    }

    private function getDigitaleTerrestreChannels()
    {
        return [
            [
                'name' => 'Rai 1',
                'number' => 1,
                'api_id' => 'rai-1',
            ],
            [
                'name' => 'Rai 2',
                'number' => 2,
                'api_id' => 'rai-2',
            ],
            [
                'name' => 'Rai 3',
                'number' => 3,
                'api_id' => 'rai-3',
            ],
            [
                'name' => 'Rete 4',
                'number' => 4,
                'api_id' => 'Rete4.it',
            ],
            [
                'name' => 'Canale 5',
                'number' => 5,
                'api_id' => 'Canale5.it',
            ],
            [
                'name' => 'Italia 1',
                'number' => 6,
                'api_id' => 'Italia1.it',
            ],
            [
                'name' => 'Mediaset 20',
                'number' => 20,
                'api_id' => '20Mediaset.it',
            ],
            [
                'name' => 'Rai 4',
                'number' => 21,
                'api_id' => 'rai-4',
            ],
            [
                'name' => 'Iris',
                'number' => 22,
                'api_id' => 'Iris.it',
            ],
            [
                'name' => 'Rai 5',
                'number' => 23,
                'api_id' => 'rai-5',
            ],
            [
                'name' => 'Rai Movie',
                'number' => 24,
                'api_id' => 'rai-movie',
            ],
            [
                'name' => 'Rai Premium',
                'number' => 25,
                'api_id' => 'rai-premium',
            ],
            [
                'name' => 'La 5',
                'number' => 30,
                'api_id' => 'La5.it',
            ],
            [
                'name' => 'Focus',
                'number' => 35,
                'api_id' => 'Focus.it',
            ],
            [
                'name' => 'Top Crime',
                'number' => 39,
                'api_id' => 'TopCrime.it',
            ],
            [
                'name' => 'Boing',
                'number' => 40,
                'api_id' => 'BoingItalia.it',
            ],
            [
                'name' => 'Rai Gulp',
                'number' => 42,
                'api_id' => 'rai-gulp',
            ],
            [
                'name' => 'Rai Yoyo',
                'number' => 43,
                'api_id' => 'rai-yoyo',
            ],
            [
                'name' => 'Cartoonito',
                'number' => 46,
                'api_id' => 'CartoonitoItalia.us',
            ],
            [
                'name' => 'Rai News 24',
                'number' => 48,
                'api_id' => 'rai-news-24',
            ],
            [
                'name' => 'Rai Storia',
                'number' => 54,
                'api_id' => 'rai-storia',
            ],
            [
                'name' => 'Mediaset Extra',
                'number' => 55,
                'api_id' => 'MediasetExtra.it',
            ],
            [
                'name' => 'Italia 2',
                'number' => 66,
                'api_id' => 'Italia2.it',
            ],
        ];
    }
}
