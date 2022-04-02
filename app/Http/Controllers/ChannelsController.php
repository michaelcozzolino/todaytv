<?php

namespace App\Http\Controllers;

use App\Classes\ValidTvTime;
use App\Models\Channel;
use App\Models\TvGroup;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class ChannelsController extends Controller
{
    public function show(Channel $channel)
    {
        abort_if((bool) !$channel->tvShows->count(), 404);

        return view('channels.show', compact('channel'));
    }

    public function index(TvGroup $tvGroup, string $time)
    {
        abort_if(!(new ValidTvTime($time))(), 404);

        $channels = Channel::getTvShowsByTime($tvGroup, $time);

        return view('channels.index', compact('channels', 'time', 'tvGroup'));
    }

    /**
     * Search all the channels that have a specific tv show
     * TODO: not working, to be fixed.
     * @param Request $request
     * @return Response
     */
    public function search(Request $request): Response
    {
        abort_if(!$request->ajax(), 404);

        $searchQuery = $request->input('query');

        $filter = function ($query) use ($searchQuery) {
            return $query->where('title', 'like', "%{$searchQuery}%");
        };

        $channels = Channel::with(['tvShows.detail' => $filter])
            ->whereHas('tvShows.detail', $filter)
            ->get();

        return response()->view('channels.index', compact('channels'));
    }
}
