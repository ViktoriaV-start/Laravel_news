<!doctype html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="">

        <!-- CSRF Token -->
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>@section('title')Админ | @show</title>

    <!-- Scripts -->
        <script src="{{ asset('js/app.js') }}" defer></script>
    <!-- Styles -->
        <link href="{{ asset('css/app.css') }}" rel="stylesheet">
        <!-- Custom styles for this template -->
        <link href="{{ asset('css/dashboard.css') }}" rel="stylesheet">

        <style>
            .bd-placeholder-img {
                font-size: 1.125rem;
                text-anchor: middle;
                -webkit-user-select: none;
                -moz-user-select: none;
                user-select: none;
            }
            .main-color {
                background-color: lightblue;
            }

            .note {
                font-size: 12px;
                font-style: italic;
            }

            .font-colored {
                color: #1266e9;
            }

            .btn-special {
                color: #0ca78b;
                background-color: transparent;
                border: none;
                padding-left: 0;
            }

            .btn-width {
                width: 150px;
            }

            .btn-colored {
                color: #696969ff;
                background-color: #ADD8E6FF;
                height: 2.5rem;
                font-size: 0.9rem;
                width: 12rem;
                border: none;
            }

            .btn-colored:hover {
                background-color: #83afbd;
            }

            .btn-delete {
                color: red;
                background-color: transparent;
                border: none;
                padding-left: 0;
            }

            .mt-0-6 {
                margin-top: 0.6rem;
            }

            @media (min-width: 768px) {
                .bd-placeholder-img-lg {
                    font-size: 3.5rem;
                }
            }
        </style>


    </head>

    <body>

        <x-admin.header />
<!--TODO сделать компоненты -->

        <div class="container-fluid">

            <div class="row">

                <x-admin.sidebar />

                <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
                    @include('menu')

                    @if (session('success'))
                    <div class="alert alert-success alert-dismissible fade show mt-2" role="alert">
                        {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                    @endif

                    @if(session('error'))
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    {{ session('error') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif

                        @yield('content')

                </main>
            </div>
        </div>

        <script src="{{ asset('js/dashboard.js') }}"></script>
        @stack('js')
    </body>
</html>

