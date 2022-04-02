@php
$headInfo = ["time" => isset($time) ? $time : null, 'tv_group' => isset($tvGroup) ? $tvGroup : null];
@endphp
@extends('layouts.master')

@section('content')
    <div class="row">
        @forelse($channels as $channel)
            @if(count($channel->tvShows))
                @include('channels.partials.tv-shows-table.tv-shows', ['withGoToChannelButton' => true, 'withCover' => true])
            @endif
        @empty
            @include('partials.alert', ['message' => 'Nessun canale disponibile!'])
        @endforelse
    </div>
@endsection
