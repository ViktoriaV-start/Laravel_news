<!DOCTYPE html>
<html lang="ru" class="h-100">

    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>@section('title')News Line | @show</title>

    <!-- Scripts -->
        <script src="{{ asset('js/app.js') }}" defer></script>
    <!-- Styles -->
        <link href="{{ asset('css/app.css') }}" rel="stylesheet">


    <!-- Custom styles for this template -->
        <link href="https://fonts.googleapis.com/css?family=Playfair&#43;Display:700,900&amp;display=swap" rel="stylesheet">
    <!-- Custom styles for this template -->
        <link href="{{ asset('css/blog.css') }}" rel="stylesheet">
        <link href="{{ asset('css/custom.css') }}" rel="stylesheet">
    </head>

    <body class="d-flex flex-column h-100">

        <x-client.header />

        <div class="container">
            @yield('menu')

            @if (session('success'))
                <x-alert type="success" message="{{ session('success') }}"/>
            @endif

            @if (session('error'))
                <x-alert type="danger" message="{{ session('error') }}"/>
            @endif

{{--            @if(session('error'))--}}
{{--                <div class="alert alert-danger alert-dismissible fade show" role="alert">--}}
{{--                    {{ session('error') }}--}}
{{--                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>--}}
{{--                </div>--}}
{{--            @endif--}}
            {{--            @if(session('success'))--}}
            {{--            <div class="alert alert-success alert-dismissible fade show" role="alert">--}}
            {{--                {{ session('success') }}--}}
            {{--                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>--}}
            {{--            </div>--}}
            {{--            @endif--}}

            @yield('content')
        </div>

    <x-client.footer />

    </body>
</html>
