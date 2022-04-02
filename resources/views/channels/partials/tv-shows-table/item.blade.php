<tr class="program">
    <td class="startTime-col" >{{$tvShow->starting_at->format('H:i')}}</td>
    <td>
        <a href="{{ $tvShow->detail->route() }}">

            <div>{{$tvShow->detail->title}}<i class="fas fa-stopwatch ml-2"></i> {{ $tvShow->duration }}</div>
            @if($tvShow->isLive())
                @include('channels.partials.tv-shows-table.progress-bar', ['percentage' => $tvShow->getLiveTimeDurationPercentage()])
            @endif

            @isset($tvShow->detail->genre)
                <div class="font-smaller font-italic font-weight-light"><i class="fas fa-theater-masks"></i> {{$tvShow->detail->genre}}</div>
            @endisset

            @if(!is_null($tvShow->detail->cover_url) && $tvShow->isLive() && $withCover)
                <img src="{{$tvShow->detail->cover_url}}" alt="" class="poster w-auto">
            @endisset
        </a>
    </td>
</tr>
