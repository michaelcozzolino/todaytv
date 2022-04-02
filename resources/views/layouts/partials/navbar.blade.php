<nav class="navbar sticky-top navbar-expand-md navbar-dark elegant-color">
    <a class="navbar-brand" style="cursor: context-menu">{{config('app.name')}}</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto">
            @php
                $navbarItems = getNavbarItems();
            @endphp

            @foreach($navbarItems as $navbarItem)

                <li class="nav-item">
                    {{--TODO: add active class if navbar tab is selected --}}
                    <a class="nav-link waves-effect waves-light"
                       href="{{$navbarItem["route"]}}">
                        {{$navbarItem["name"]}}
                    </a>
                </li>
            @endforeach

        </ul>
        {{--<button id="search-button" class="btn search-button-nav rounded-pill btn-md my-sm-0 waves-effect waves-light" data-toggle="modal"
                data-target="#searchModal">Ricerca <i class="fas fa-search"></i></button>--}}

    </div>
</nav>
