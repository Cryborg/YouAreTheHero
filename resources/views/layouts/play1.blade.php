@extends('base')

@section('content')
    <div class="row h-100">
        <div class="col-lg-2 col-xs-12">
            <div class="card">
                <div class="card-header">
                    <span class="icon-backpack display-5 mr-2"></span>
                    @lang('common.inventory')
                </div>
                <div class="card-header">
                    @lang('common.money')@lang(':') {{ $character->money }}
                </div>
                <div class="card-header">
                    @lang('common.inventory')
                </div>
                <div class="card-body inventory-block">
                    @yield('inventory')
                </div>
            </div>
        </div>
        <div class="col col-xs-12" id="page_content">
            @include('layouts.partials.page_content', ['page' => $page])
        </div>
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

    <div class="fixed-bottom btn mb-5" style="width: 250px">
        <a href="https://discord.com/channels/749977538931064965/749977538931064968" target="_blank">
            <img src="{{ asset('img/discord.png') }}" class="w-100 h-100"></a>
    </div>
    <div class="fixed-bottom btn btn-danger report-btn" data-toggle="modal" data-target="#modalPageReport">@lang('page.report_button')</div>

    <!-- Modal add choice -->
    @include('page.partials.modal_model', [
        'template' => 'page.partials.modal_report',
        'context' => 'report',
        'title' => trans('page.report_modal_title'),
        'icon' => 'icon-choice',
        'big' => false,
        'data' => [
            'page' => $page,
            'id' => 'PageReport',
            'btn_add_text' => trans('common.save')
        ]
    ])
@endsection
