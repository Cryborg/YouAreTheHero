@extends('base')

@section('content')
    <div class="row vh-100">
        {{-- Left sidebar --}}
        <nav class="col-lg-2 col-xs-12 shadow bg-white no-padding">
            @can('edit', $page)
                <span class="w-20" title="@lang('field.hidden_to_players')">
                    <x-reset-button :page="$page" />
                </span>
            @endcan

            <div class="card card-no-padding">
                <div class="card-header">
                    <span class="icon-backpack display-5 mr-2"></span>
                    @lang('common.inventory')
                </div>
                <div class="card-header purse-block">
                    @lang('common.money')@lang(':') {{ $character->money }}
                </div>
                <div class="card-body inventory-block">
                    @yield('inventory')
                </div>
                <div class="card-header">
                    @lang('equipment.label')
                </div>
                <div class="card-body equipment-block">
                    @foreach ($character->equippedItems as $item)
                        <div class="p-2">
                            <i class="text-muted">{{ $item->equippedOn()->slot }}</i> {{ $item->name }}
                        </div>
                    @endforeach
                </div>
            </div>

            <span class="w-20" title="@lang('field.hidden_to_players')">
                <div class="fixed-bottom btn btn-danger report-btn" data-toggle="modal" data-target="#modalPageReport">@lang('page.report.button')</div>
            </span>
        </nav>

        {{-- Main content --}}
        <div class="col col-xs-12 shadow bg-lightgrey">
            <div id="page_content">
                @include('layouts.partials.page_content', ['page' => $page])
            </div>
        </div>

        {{-- Right sidebar --}}
        <div class="col-lg-3 col-xs-12 shadow bg-white">
            @isset($page->story->options->has_stats)
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
                    @lang('story.locations_label')
                </h5>
                <div class="card-body">
                    <div class="card-text locations-block" data-characterid="{{ $character->id }}"></div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal add choice -->
    @include('page.partials.modals.modal_model', [
        'template' => 'page.partials.modals.modal_report',
        'context' => 'report',
        'title' => trans('page.report.modal_title'),
        'icon' => 'icon-choice',
        'big' => false,
        'data' => [
            'page' => $page,
            'id' => 'PageReport',
            'btn_add_text' => trans('common.save')
        ]
    ])
@endsection
