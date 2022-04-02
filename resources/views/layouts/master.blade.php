<!DOCTYPE html>
<html lang="it">

@include('layouts.partials.head')

<body class="blue-grey lighten-5">
<main>


@include('layouts.partials.navbar')

    <section id="logo-section" class="text-center">
        <a href="{{\App\Models\TvGroup::route(time: App\Classes\ValidTvTime::ON_AIR)}}">
            <div class="logo my-3"></div>
        </a>
    </section>

    <div class="container">
        @include('layouts.partials.tabs')
{{--        @include('includes.elements.searchModal')--}}
        @yield('content')
    </div>

</main>

@include('layouts.partials.footer')

<script>
    helpers.showChannelsLogo();
</script>

@if(App::environment('production'))
    @include('layouts.partials.googleAnalytics')
@endif

@stack('scripts')
</body>

</html>

