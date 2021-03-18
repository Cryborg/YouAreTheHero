<div class="row is-page">
    {!! Form::hidden('page_from', $page->id, ['class' => 'is-page-from', 'data-page-from' => $page_from ?? 0]) !!}
    <div class="col-lg-6 col-xs-12">
        <div class="row">
            <div class="col shadow-sm p-3">
                {{-- Preview story button --}}
                <a target="_blank" href="{{ route('story.play', [$story]) }}">
                    <button class="btn btn-light shadow">
                        <span class="icon-play display-6 align-middle"></span>
                        <div class="align-middle">@lang('story.preview')</div>
                    </button>
                </a>

                {{-- Location button --}}
                <button class="btn btn-light shadow" data-target="#modalLocation" data-toggle="modal">
                    <span class="icon-position-marker display-6 align-middle @if ($page->location()->count() > 0) text-success @endif"></span>
                    <div class="align-middle location-label">
                        @if ($page->location()->count() > 0)
                            {{ $page->location->name }}
                        @else
                            @lang('story.locations_label')
                        @endif
                    </div>
                </button>

                {{-- Error button --}}
                @if ($showErrorsButton)
                    <button class="btn btn-danger float-right shadow showStoryErrors grow" data-target="#modalStoryErrors" data-toggle="modal">
                        <div class="align-middle">@lang('story.has_errors')</div>
                        <span class="icon-skull text-white display-6 align-middle"></span>
                    </button>
                @endif
            </div>
        </div>
        <div class="row">
            <div class="col mt-3">
                <textarea class="w-100 hidden" id="inputGraph" rows="5">{{ $graph }}</textarea>
                <nav class="nav nav-pills mb-2">
                    <a class="nav-item nav-link mr-3 @if ($page->is_first) disabled @else shadow @endif" href="#page-1" data-toggle="tab"
                        title="@lang('page.current_page_prerequisites_help')">
                        <span class="icon icon-unlocking text-white display-6 align-middle mr-2"></span>
                        @lang('page.tab_prerequisite')
                        <span class="badge badge-warning rounded float-right shadow ml-3 badge_prerequisites_count" @if ($page->prerequisites()->count() === 0) style="display:none" @endif>{{ $page->prerequisites()->count() }}</span>
                    </a>
                    <a class="nav-item nav-link shadow mr-3 active" href="#page-2" data-toggle="tab">
                        <span class="icon icon-fountain-pen text-white display-6 align-middle mr-2"></span>
                        @lang('page.tab_text')
                    </a>
                    <a class="nav-item nav-link shadow mr-3" href="#page-3" data-toggle="tab"
                        title="@lang('page.current_page_actions_help')">
                        <span class="icon icon-unlocking text-white display-6 align-middle mr-2"></span>
                        @lang('page.tab_bonus')
                        <span class="badge badge-warning rounded float-right shadow ml-3 badge_triggers_count" @if ($page->triggers->count() === 0) style="display:none" @endif>{{ $page->triggers->count() }}</span>
                    </a>
                    <a class="nav-item nav-link shadow mr-3" href="#page-4" data-toggle="tab"
                        title="@lang('page.current_page_item_page_help')">
                        <span class="icon icon-chest text-white display-6 align-middle mr-2"></span>
                        @lang('page.tab_items')
                        <span class="badge badge-warning rounded float-right shadow ml-3 badge_items_count" @if ($page->items->count() === 0) style="display:none" @endif>{{ $page->items->count() }}</span>
                    </a>
                    <a class="nav-item nav-link shadow mr-3" href="#page-5" data-toggle="tab"
                        title="@lang('page.current_page_riddles_help')">
                        <span class="icon icon-jigsaw-piece text-white display-6 align-middle mr-2"></span>
                        @lang('page.tab_riddle')
                        @if ($page->riddle)
                            <span class="badge badge-warning rounded float-right shadow ml-3">1</span>
                        @endif
                    </a>
                </nav>
                <div class="tab-content">
                    {{--                    TAB 1 --}}
                    @if (!$page->is_first)
                        <div class="tab-pane" id="page-1">
                            <div class="w-100 text-white bg-info p-2 mb-3" id="prerequisites_help">
                                <div class="row">
                                    <div class="col">
                                        @info({!! trans('page.current_page_prerequisites_help') !!})
                                        <h3>
                                            {{ trans('page.prerequisite_title') }}
                                            <button class="btn btn-success shadow ml-2" id="showPrerequisites">
                                                <span class="icon-add text-white"></span>
                                            </button>
                                        </h3>
                                        <div class="prerequisites_list"></div>
                                    </div>
                                </div>
                                <hr>
                            </div>
                        </div>
                    @endif

                    {{--                TAB 2 --}}
                    <div class="tab-pane active" id="page-2">
                        @info({!! trans('page.current_page_help') !!})
                        <div class="divAsForm" data-route="{{ route('page.store', ['page' => $page->id]) }}">
                            {{-- Form --}}
                            <div class="card">
                                <h5 class="card-header">
                                    @lang('model.title')
                                </h5>
                                <div class="card-body">
                                    <div class="card-text">
                                        <x-help-block :help="trans('model.page_title_help')"></x-help-block>
                                        {!! Form::text('title', $page->title ?? old('title'), ['id' => 'title', 'class' => 'form-control']) !!}
                                    </div>
                                </div>
                            </div>
                            <div class="card panel-content">
                                <h5 class="card-header">
                                    @lang('model.content')
                                    <button class="btn btn-success float-right" id="editorToggle" data-state="off">
                                        <span id="edit_content_button">
                                            <span class="icon-fountain-pen mr-2 text-white"></span>
                                            {{ trans('story.edit_content') }}
                                        </span>
                                        <span id="save_button">
                                            <span class="icon-save mr-2 text-white"></span>
                                            {{ trans('common.save') }}
                                        </span>
                                    </button>
                                </h5>
                                <div class="card-body">
                                    <div class="card-text">
                                        <x-help-block :help="trans('model.page_content_help')"></x-help-block>
                                        <div id="content-editable" class="false-input scrollable-content hidden h-200px">{!! $page->content ?? old('content') !!}</div>
                                        <div id="content" class="false-input scrollable-content h-200px">{!! $page->present()->content ?? old('content') !!}</div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group hidden">
                                {!! Form::label('layout', trans('model.layout'), ['class' => 'control-label']) !!}
                                <x-help-block :help="trans('model.page_layout_help')"></x-help-block>
                                {!! Form::select('layout', $layouts , $page->layout ?? old('layout') , ['class' => 'form-control']) !!}
                            </div>
                            <div class="form-group form-check hidden">
                                <x-help-block :help="trans('model.page_is_first_help')"></x-help-block>
                                <label>
                                    {!! Form::checkbox('is_first', 1, $page->is_first or false, ['id' => 'is_first']) !!}
                                    @lang('model.is_first')
                                </label>
                            </div>
                            @if (!$page->is_first && $page->choices && $page->choices()->count() === 0)
                                <div class="form-group form-check">
                                    <ul class="list-group">
                                        <x-help-block :help="trans('model.page_is_last_help')"></x-help-block>
                                        <li class="list-group-item">
                                            <label>
                                                {!! Form::checkbox('is_last', 1, $page->is_last, ['id' => 'is_last']) !!}
                                                @lang('model.is_last')
                                            </label>
                                        </li>
                                        <li class="ending_types_list list-group-item" @if (!$page->is_last) style="display:none" @endif>
                                            <ul class="list-group">
                                                <li class="list-group-item">
                                                    <label class="ml-4">
                                                        {!! Form::radio('ending_type', \App\Classes\Constants::ENDING_TYPE_GOOD, $page->ending_type === \App\Classes\Constants::ENDING_TYPE_GOOD) !!}
                                                        @lang('story.ending_type_good')
                                                        <span class="text-muted font-smaller ml-3">
                                                            @lang('story.ending_type_good_help')
                                                        </span> </label>
                                                </li>
                                                <li class="list-group-item">
                                                    <label class="ml-4">
                                                        {!! Form::radio('ending_type', \App\Classes\Constants::ENDING_TYPE_BAD, $page->ending_type === \App\Classes\Constants::ENDING_TYPE_BAD) !!}
                                                        @lang('story.ending_type_bad')
                                                        <span class="text-muted font-smaller ml-3">
                                                            @lang('story.ending_type_bad_help')
                                                        </span> </label>
                                                </li>
                                                <li class="list-group-item">
                                                    <label class="ml-4">
                                                        {!! Form::radio('ending_type', \App\Classes\Constants::ENDING_TYPE_DEATH, $page->ending_type === \App\Classes\Constants::ENDING_TYPE_DEATH) !!}
                                                        @lang('story.ending_type_death')
                                                        <span class="text-muted font-smaller ml-3">
                                                            @lang('story.ending_type_death_help')
                                                        </span> </label>
                                                </li>
                                            </ul>
                                        </li>
                                    </ul>
                                </div>
                            @endif

                            {{-- Add choice button --}}
                            <div class="row">
                                <div class="col-md-12 col-lg-4 mb-3">
                                    <button class="btn btn-success shadow w-100 navbar-btn" data-target="#modalAddChoice" data-toggle="modal">
                                        <span class="icon-choice text-white display-6 float-left"></span>
                                        <div>@lang('page.add_choice')</div>
                                        <span class="badge badge-warning rounded float-right shadow ml-3">{{ $page->choices()->count() }}</span>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane" id="page-3">
                        <div class="w-100 text-white bg-info p-2 mb-3" id="actions_help">
                            <div class="row">
                                <div class="col">
                                    @info({!! trans('page.current_page_actions_help') !!})
                                    <h3>
                                        {{ trans('item.items_title') }}
                                        <button class="btn btn-success shadow ml-2" id="showActions">
                                            <span class="icon-add text-white"></span>
                                        </button>
                                    </h3>
                                    <div class="actions_list"></div>
                                </div>
                            </div>
                            <hr>
                        </div>
                    </div>
                    <div class="tab-pane" id="page-4">
                        <div class="w-100 text-white bg-info p-2 mb-3" id="item_page_help">
                            @info({!! trans('page.current_page_item_page_help') !!})
                            <h3>
                                @lang('page.item_page_modal_title')
                                <button class="btn btn-success shadow ml-2" id="showItems">
                                    <span class="icon-add text-white"></span>
                                </button>
                            </h3>
                            <div class="items_list"></div>
                        </div>
                    </div>
                    <div class="tab-pane" id="page-5">
                        <div class="w-100 text-white bg-info p-2 mb-3" id="riddles_help">
                            @include('page.partials.riddles_list', ['page' => $page])
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-6 col-xs-12 pt-2 bg-primary">
        <div class="w-100 ">
            <button class="btn btn-primary shadow float-left" data-target="#modalAllItems" data-toggle="modal">
                <span class="icon-chest text-white display-6 align-middle mr-3"></span>
                <span class="align-middle">@lang('story.list_all_items')</span>
            </button>
        </div>
        <div class="svg-container active" id="p1">
            <svg class="svg-content h-100 w-100">
                <g/>
            </svg>
        </div>
    </div>
</div>
