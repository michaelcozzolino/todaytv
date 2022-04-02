@php
    $headInfo = ['tv_show_detail' => $tvShowDetail];
@endphp

@extends('layouts.master')

@section('content')
    <div class="card table-responsive my-2">
        <table class="table white program-info">
            <tbody>
            @if($tvShowDetail->hasPicture())
                <tr>
                    <td colspan="4">
                        <img class="container" style="max-width:185px" src="{{$tvShowDetail->cover_url }}" alt="">
                    </td>
                </tr>
            @endif

            @isset($tvShowDetail->description)
                <tr>
                    <th colspan="4">
                        Descrizione
                    </th>
                </tr>
                <tr>
                    <td colspan="4">
                        {{$tvShowDetail->description}}
                    </td>
                </tr>
            @endif
            {{--TODO: add broadcast by --}}
            {{-- <tr>
                 <th colspan="4">Trasmesso da</th>
             </tr>
             @if($broadcastByChannels)

                 @foreach($broadcastByChannels as $channelWeb => $values)
                     <tr >
                         <td colspan="2">
                             <a href="{{route('programs.channel.index',['channel' => $channelWeb])}}" ><div class="channel-icon {{$channelWeb}} my-auto"></div></a>
                         </td>
                         <td colspan="2" class="broadcastBy-col">
                             @foreach($values as $value)
                                 {{$value->startBroadcastBy}}<br>

                             @endforeach
                         </td>
                     </tr>
                 @endforeach
             @else
                 <tr>
                     <td colspan="4">
                         <a style="color:white" href="{{route('programs.current')}}" class="button">
                             <div class="alert text-center" style="background-color: #2e2e2e" role="alert">
                                 <h3>Nessuna trasmissione in programma per oggi!<br>
                                     Clicca qui per tornare alla lista canali!
                                 </h3>
                             </div>
                         </a>
                     </td>
                 </tr>

             @endif--}}
            </tbody>
        </table>
    </div>
@endsection




