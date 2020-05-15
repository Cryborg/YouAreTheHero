@extends('base')

@section('content')
    <div class="row h-100">
        <div class="col-lg-2 col-xs-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <span class="icon-backpack display-5 mr-2"></span>
                    @lang('common.inventory')
                </div>
                <div class="panel-body inventory-block">
                    @yield('inventory')
                </div>
            </div>
        </div>

        @include('layouts.partials.page_content', ['page' => $page])

        <div class="col-lg-3 col-xs-12">
            @isset($page->story->story_options->has_stats)
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <span class="icon-ninja-heroic-stance display-5 mr-2"></span>
                        @lang('field.sheet')
                    </div>
                    <div class="panel-body sheet-block">
                        @yield('sheet', '-')
                    </div>
                </div>
            @endisset

            <div class="panel panel-default">
                <div class="panel-heading">
                    <span class="icon-treasure-map display-5 mr-2"></span>
                    @lang('story.map')
                </div>
                <div class="panel-body map-block">
                    @yield('map')
                </div>
            </div>

        </div>
    </div>
@endsection
