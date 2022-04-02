@php
    $headData = getHeadData($headInfo ?? []);
@endphp
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="description" content="{{ array_key_exists('description', $headData) ? $headData['description'] : "" }}">
    <meta name="robots" content="index, follow,noodp,noydir">

    <title>{{ config('app.name') }} {{ array_key_exists('title', $headData) ? " - " . $headData['title'] : "" }}</title>

    <link href="{{ mix('/css/app.css') }}" rel="stylesheet" />
    <script src="{{ mix('/js/app.js') }}"></script>

    <link href="/css/mdb.min.css" rel="stylesheet">
    <script src="/js/mdb.min.js"></script>

    <link href="/css/style.css" rel="stylesheet">

    <meta name="csrf-token" content="{{ csrf_token() }}"/>
    {{--
    <script>


        $(document).ready(function () {

            $('#searchBox').keyup(function () {
                var token = $('meta[name="csrf-token"]').attr('content');
                $value = $(this).val();
                if ($value !== "") {
                    $.ajax({

                        type: 'post',

                        --}}{{--url: '{{route("programs.search")}}',--}}{{--

                        data: {'_token': token, 'searchValue': $value},

                        success: function (data) {

                            $("#searchResult").html(data);

                        }
                    });

                }
            });


            $("#searchModal").on('hide.bs.modal', function () {
                $("#searchResult").empty();
                $("#searchBox").val("");
            });
        });
    </script>--}}

</head>
