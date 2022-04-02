@php
    $routeCheck = route::is("serata.index") || route::is("programs.current") || route::is('programs.search');
    $tabs = getTabs();
@endphp
<div class="d-flex justify-content-center my-2">
    <div class="btn-group" role="group" aria-label="tv-groups">
        @foreach($tabs as $tab)
            @if(is_null($tab['sub_tv_groups']))
                <a href="{{ \App\Models\TvGroup::route($tab['name']) }}" type="button" class="btn btn-elegant">{{$tab['name']}}</a>
            @else
                <div class="btn-group" role="group">
                    <button id="{{$tab['name']}}" type="button" class="btn btn-info dropdown-toggle btn-elegant" data-toggle="dropdown"
                            aria-haspopup="true" aria-expanded="false">
                        {{$tab['name']}}
                    </button>
                    <div class="dropdown-menu" aria-labelledby="{{$tab['name']}}">
                        @foreach($tab['sub_tv_groups'] as $subTvGroupName)
                            <a href="{{ \App\Models\TvGroup::route($subTvGroupName) }}"
                               class="dropdown-item">
                                {{ $subTvGroupName }}
                            </a>
                        @endforeach
                    </div>
                </div>

            @endif
        @endforeach
    </div>
</div>
