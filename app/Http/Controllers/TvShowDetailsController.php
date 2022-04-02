<?php

namespace App\Http\Controllers;

use App\Models\TvShowDetail;

class TvShowDetailsController extends Controller
{
    public function show(TvShowDetail $tvShowDetail)
    {
        return view('tv-show-details.show', compact('tvShowDetail'));
    }
}
