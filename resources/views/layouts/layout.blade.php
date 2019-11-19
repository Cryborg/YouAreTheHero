<!DOCTYPE html>
<html lang="fr">
    <head>
        @include('layouts.partials.head')
        @stack('head')
        <title>@yield('title')</title>

        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

        <link href="{{ url('vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
    </head>
    <body>
        <div class="container-fluid fill">
            @yield('content')
        </div>
        <div class="row">
            <div class="col">
                @include('layouts.partials.nav')
            </div>
        </div>
        @stack('footer-scripts')
    </body>
    <footer>


    </footer>
</html>
