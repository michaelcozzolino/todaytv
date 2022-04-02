<div class="col-md-{{$md ?? 6}} my-2">
    <div class="card table-responsive">
        <table class="table white">
            <tbody class="programs">
            <tr>
                <th class="text-center" scope="col" colspan="2">

                    @include('channels.partials.tv-shows-table.channel-logo')
                    @if($withGoToChannelButton)
                        @include('channels.partials.tv-shows-table.go-to-channel-button')
                    @endif
                </th>
            </tr>
            @php
            $tvShows = Request::route('time') === \App\Classes\ValidTvTime::ON_AIR ?
                                                        $channel->tvShows->reverse() :
                                                        $channel->tvShows;
            @endphp
            @foreach($tvShows as $tvShow)
                @include('channels.partials.tv-shows-table.item')
            @endforeach
            </tbody>
        </table>
    </div>
</div>
