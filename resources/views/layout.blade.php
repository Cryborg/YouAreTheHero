<!DOCTYPE html>
<html>
    <head>
        <title>@yield('title')</title>
    </head>
    <body>
        @yield('content')
    </body>
    <footer>
        <a href="{{ url('/') }}">Home</a>
        <a href="{{ url('/stories') }}">Stories</a>
    </footer>
</html>
