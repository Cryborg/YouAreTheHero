<!DOCTYPE html>
<html lang="fr">
    <head>
        @include('layouts.partials.head')
    </head>
    <body>
        <div class="container-fluid fill">
            <div class="row h-100">
                <div class="col-lg-2 col-xs-12 bloc">
                    {{-- Inventory --}}
                </div>
                <div class="col col-xs-12 bloc">
                    <div class="row">
                        <div class="col">
                            @include('layouts.partials.header')
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            @yield('content')
                        </div>
                    </div>
                    @include('layouts.partials.footer-scripts')
                </div>
                <div class="col-lg-3 col-xs-12 bloc">
                    <div class="row bloc">
                        <div class="col img-bloc">
                            <img src="{{ asset('img/castle.jpg') }}">
                        </div>
                    </div>
                    <div class="row bloc">
                        <div class="col">
                            Autre
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col bloc">
                    @include('layouts.partials.nav')
                </div>
            </div>
        </div>
    </body>
</html>
