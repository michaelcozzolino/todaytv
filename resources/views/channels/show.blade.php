@php
    $headInfo = compact('channel');
@endphp
@extends('layouts.master')

@section('content')
    <div class="row">

        @include('channels.partials.tv-shows-table.tv-shows', ['withGoToChannelButton' => false, 'withCover' => false, 'md' => 12])
    </div>
@endsection
