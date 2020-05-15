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
        <div class="col col-xs-12">
            <div class="panel panel-default">
                <div class="panel-heading text-center">
                    @can('edit', $page)
                        <a href="{{ route('page.edit', ['page' => $page]) }}" target="_blank" class="pull-left">
                            <button>
                                <span class="icon-fountain-pen display-6"></span>
                            </button>
                        </a>
                    @endcan

                    {{ $page->title }}
                    <div id="loadingDiv"></div>
                </div>
                <div class="panel-body text-justify">
                    {!! $page->present()->content !!}
                </div>

                <div class="panel-body">
                    @yield('actions')
                </div>
                <div class="panel-body">
                    @yield('riddle')
                </div>
                <div class="panel-body">
                    @yield('choices')
                </div>
            </div>
        </div>
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
