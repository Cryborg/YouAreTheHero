@extends('base')

@section('content')
    <div class="row h-100">
        <div class="col-lg-2 col-xs-12">
            <div class="card">
                <h5 class="card-header">
                    <span class="icon-backpack display-5 mr-2"></span>
                    @lang('common.inventory')
                </h5>
                <div class="card-body">
                    <div class="card-text inventory-block">
                        @yield('inventory')
                    </div>
                </div>
            </div>
        </div>

        @include('layouts.partials.page_content', ['page' => $page])

        <div class="col-lg-3 col-xs-12">
            @isset($page->story->story_options->has_stats)
                <div class="card">
                    <h5 class="card-header">
                        <span class="icon-ninja-heroic-stance display-5 mr-2"></span>
                        @lang('field.sheet')
                    </h5>
                    <div class="card-body">
                        <div class="card-text sheet-block">
                            @yield('sheet', '-')
                        </div>
                    </div>
                </div>
            @endisset

            <div class="card">
                <h5 class="card-header">
                    <span class="icon-treasure-map display-5 mr-2"></span>
                    @lang('story.map')
                </h5>
                <div class="card-body">
                    <div class="card-text map-block">
                        @yield('map')
                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection
