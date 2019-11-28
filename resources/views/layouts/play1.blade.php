@extends('base')

@section('content')
    <div class="row h-100">
        <div class="col-lg-2 col-xs-12 bloc inventory-block">
            @yield('inventory')
        </div>
        <div class="col col-xs-12 bloc">
            <div class="row">
                <div class="col">
                    <div id="loadingDiv"></div>
                    @include('layouts.partials.header')
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <p>{!! $page->description !!}</p>
                </div>
            </div>
            <div class="row">
                <div class="col">
                    @yield('items')
                </div>
            </div>
            <div class="row">
                <div class="col">
                    @yield('choices')
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-xs-12 bloc">
            <div class="row bloc">
                <div class="col img-bloc">
                    <img src="{{ asset('img/castle.jpg') }}" alt="dummy image">
                </div>
            </div>
            <div class="row bloc">
                <div class="col sheet-block">
                    @yield('sheet', 'No available sheet')
                </div>
            </div>
        </div>
    </div>
@endsection
