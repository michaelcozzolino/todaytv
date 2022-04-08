<?php

use App\Classes\RaiTvShow;
use App\Classes\SkyTvShow;

function getSampleRaiTvShow()
{
    $raiTvShowJSON = <<<'JSON'
    {
        "id": "ContentItem-04bcd2b6-9c82-416e-923a-44756ad38703",
        "name": "Empire State",
        "episode_title": "",
        "episode": "",
        "season": "",
        "description": "Nella New York del 1982, due amici escogitano un colpo all'azienda di automobili blindate in cui uno dei due ha lavorato. L'obiettivo sono quindici milioni di dollari, ovvero la più grande cifra mai rubata in una rapina negli Stati Uniti. Ispirato a una storia realmente accaduta.",
        "channel": "Rai Movie",
        "date": "13/03/2022",
        "hour": "00:25",
        "duration": "01:35:00",
        "duration_in_minutes": "95 min",
        "path_id": "/video/2017/09/Empire-State-f580a3e7-f737-43c4-b41e-180d8a3b46eb.json",
        "weblink": "/video/2017/09/Empire-State-f580a3e7-f737-43c4-b41e-180d8a3b46eb.html",
        "event_weblink": "/dirette/raimovie/Empire-State-04bcd2b6-9c82-416e-923a-44756ad38703.html",
        "has_video": true,
        "image": "/dl/img/2019/11/05/1572957868475_2048x1152.jpg",
        "playlist_id": "57952847",
        "program": {
        	"name": "Empire State",
        	"path_id": "/programmi/empirestate.json",
        	"info_url": "/programmi/info/9accb31f-9b8e-4c71-8d50-0f4b8ef4f182.json",
        	"weblink": "/programmi/empirestate"
        }
    }
    JSON;

    return new RaiTvShow(json_decode($raiTvShowJSON));
}

function getSampleSkyTvShow()
{
    $date = config('app.scraping_date');

    $start = $date->copy()->format('YmdHis');

    $end = $date
        ->copy()
        ->addHours(2)
        ->format('YmdHis');

    $skyTvShowXML = <<<XML
    <tv>
        <programme start="{$start} +0000" stop="{$end} +0000" channel="Italia1.it">
            <title lang="it">Il Re</title>
            <desc lang="it">S1 Ep2 - Bruno fa una importante scoperta su Lackovic, ma deve anche nascondere un segreto. Prox Ep. 25 mar 03:15. Rep. 19 mar 14:45</desc>
            <category lang="it">Intrattenimento</category>
            <icon src="https://guidatv.sky.it/uuid/f325e992-aa0a-4c85-9625-85cbdcc547ac/cover?md5ChecksumParam=b01b7edcbb59f3dedebec43395d34c32"/>
        </programme>
    </tv>
    XML;

    return new SkyTvShow(simplexml_load_string($skyTvShowXML, 'SimpleXMLElement', LIBXML_NOCDATA)->programme);
}
