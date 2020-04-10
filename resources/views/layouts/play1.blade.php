@extends('base')

@section('content')

    <div class="row h-100">
        <div class="col-lg-2 col-xs-12 bloc">
            <div class="row">
                <div class="col">
                    <div class="title">@lang('common.inventory')</div>
                </div>
            </div>
            <div class="row">
                <div class="col inventory-block">
                    @yield('inventory')
                </div>
            </div>

        </div>
        <div class="col col-xs-12 bloc">
            <div class="row">
                <div class="col text-center">
                    <div id="loadingDiv"></div>
                    <div class="title">{{ $page->title }}</div>
                </div>
            </div>
            <div class="row">
                <div class="col text-justify">
                    <p>{!! $page->present()->content !!}</p>
                </div>
            </div>
            <div class="row">
                <div class="col">
                    @yield('actions')
                </div>
            </div>
            <div class="row">
                <div class="col">
                    @yield('riddle')
                </div>
            </div>
            <div class="row">
                <div class="col choices-block">
                    @yield('choices')
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-xs-12 bloc">
            <div class="row">
                <div class="col">
                    <div class="title">@lang('stat.sheet')</div>
                </div>
            </div>
            <div class="row">
                <div class="col sheet-block">
                    @yield('sheet', 'No available sheet')
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <div class="title">@lang('story.map')</div>
                </div>
            </div>
            <div class="row">
                <div class="col map-bloc">
                    @yield('map')
                </div>
            </div>
        </div>
    </div>
@endsection
