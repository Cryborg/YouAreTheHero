<!DOCTYPE html>
<html lang="{{ $user->locale }}">
    <head>
        <meta charset="utf-8">
    </head>
    <body>
        @yield('body')

        <p><a href="https://www.youarethehero.fr">You Are The Hero</a></p>

        <p>
            <a href="https://discord.gg/zc9TePC">
                <img src="{{ asset('img/discord.png') }}">
            </a>
        </p>
    </body>
</html>
