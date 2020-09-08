<div class="row is-page">
    {!! Form::hidden('page_from', $page->id, ['class' => 'is-page-from', 'data-page-from' => $page_from ?? 0]) !!}
    <div class="col-lg-6 col-xs-12">
        <div class="row mb-3">
            <div class="col shadow p-2">
                <button class="btn btn-primary bg-success savePage">
                    <span class="icon-save text-white display-6 align-middle mr-3"></span>
                    <span class="align-middle">@lang('common.save')</span>
                </button>
                <button class="btn btn-primary" data-target="#modalAddChoice" data-toggle="modal">
                    <span class="icon-choice text-white display-6 align-middle mr-3"></span>
                    <span class="align-middle">@lang('page.add_choice')</span>
                    <span class="badge badge-warning rounded float-right shadow ml-3">{{ $page->choices()->count() }}</span>
                </button>
                @if ($showErrorsButton)
                    <button class="btn btn-danger float-right showStoryErrors" data-target="#modalStoryErrors" data-toggle="modal">
                        <span class="align-middle">@lang('story.has_errors')</span>
                        <span class="icon-skull text-white display-6 align-middle ml-3"></span>
                    </button>
                @endif
            </div>
        </div>
        <div class="row">
            <div class="col">
                <textarea class="w-100 hidden" id="inputGraph" rows="5">{{ $graph }}</textarea>
                <nav class="nav nav-pills mb-2">
                    <a class="nav-item nav-link mr-3 @if ($page->is_first) disabled @else shadow @endif" href="#page-1" data-toggle="tab">
                        <span class="icon icon-unlocking text-white display-6 align-middle mr-2"></span>
                        @lang('page.tab_prerequisite')
                        @if ($page->prerequisites()->count() > 0)
                            <span class="badge badge-warning rounded float-right shadow ml-3">{{ $page->prerequisites()->count() }}</span>
                        @endif
                    </a> <a class="nav-item nav-link shadow mr-3 active" href="#page-2" data-toggle="tab">
                        <span class="icon icon-fountain-pen text-white display-6 align-middle mr-2"></span>
                        @lang('page.tab_text')
                    </a> <a class="nav-item nav-link shadow mr-3" href="#page-3" data-toggle="tab">
                        <span class="icon icon-unlocking text-white display-6 align-middle mr-2"></span>
                        @lang('page.tab_bonus')
                        @if ($page->triggers->count() > 0)
                            <span class="badge badge-warning rounded float-right shadow ml-3">{{ $page->triggers->count() }}</span>
                        @endif
                    </a> <a class="nav-item nav-link shadow mr-3" href="#page-4" data-toggle="tab">
                        <span class="icon icon-chest text-white display-6 align-middle mr-2"></span>
                        @lang('page.tab_items')
                        @if ($page->items->count() > 0)
                            <span class="badge badge-warning rounded float-right shadow ml-3">{{ $page->items->count() }}</span>
                        @endif
                    </a> <a class="nav-item nav-link shadow mr-3" href="#page-5" data-toggle="tab">
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

                                        @include('page.partials.prerequisites_list', ['page' => $page])
                                    </div>
                                </div>
                                <hr>
                            </div>
                        </div>
                    @endif

                    {{--                TAB 2 --}}
                    <div class="tab-pane active" id="page-2">
                        @info({!! trans('page.current_page_help') !!})
                        <div class="divAsForm" data-route="{{ route('page.edit.post', ['page' => $page->id]) }}">
                            {{-- Form --}}
                            <div class="card">
                                <h5 class="card-header">
                                    @lang('model.title')
                                </h5>
                                <div class="card-body">
                                    <div class="card-text">
                                        <p class="help-block">{{ trans('model.page_title_help') }}</p>
                                        {!! Form::text('title', $page->title ?? old('title'), ['id' => 'title-' . $page->id, 'class' => 'form-control']) !!}
                                    </div>
                                </div>
                            </div>
                            <div class="card clickable panel-content toggle-summernote">
                                <h5 class="card-header">
                                    @lang('model.content')
                                </h5>
                                <div class="card-body">
                                    <div class="card-text">
                                        <p class="help-block">{{ trans('model.page_content_help') }}</p>
                                        <div id="content-editable-{{ $page->id }}" class="false-input scrollable-content hidden h-200px">{!! $page->content ?? old('content') !!}</div>
                                        <div id="content-{{ $page->id }}" class="false-input scrollable-content h-200px">{!! $page->present()->content ?? old('content') !!}</div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group hidden">
                                {!! Form::label('layout-' . $page->id, trans('model.layout'), ['class' => 'control-label']) !!}
                                <p class="help-block">{{ trans('model.page_layout_help') }}</p>
                                {!! Form::select('layout', $layouts , $page->layout ?? old('layout') , ['class' => 'form-control']) !!}
                            </div>
                            <div class="form-group form-check hidden">
                                <p class="help-block">{{ trans('model.page_is_first_help') }}</p>
                                <label>
                                    {!! Form::checkbox('is_first', 1, $page->is_first or false, ['id' => 'is_first-' . $page->id]) !!}
                                    @lang('model.is_first')
                                </label>
                            </div>
                            @if (!$page->is_first && $page->choices && $page->choices()->count() === 0)
                                <div class="form-group form-check">
                                    <ul class="list-group">
                                        <p class="help-block">{{ trans('model.page_is_last_help') }}</p>
                                        <li class="list-group-item">
                                            <label>
                                                {!! Form::checkbox('is_last', 1, $page->is_last, ['id' => 'is_last-' . $page->id]) !!}
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
                                                        </span>
                                                    </label>
                                                </li>
                                                <li class="list-group-item">
                                                    <label class="ml-4">
                                                        {!! Form::radio('ending_type', \App\Classes\Constants::ENDING_TYPE_BAD, $page->ending_type === \App\Classes\Constants::ENDING_TYPE_BAD) !!}
                                                        @lang('story.ending_type_bad')
                                                        <span class="text-muted font-smaller ml-3">
                                                            @lang('story.ending_type_bad_help')
                                                        </span>
                                                    </label>
                                                </li>
                                                <li class="list-group-item">
                                                    <label class="ml-4">
                                                        {!! Form::radio('ending_type', \App\Classes\Constants::ENDING_TYPE_DEATH, $page->ending_type === \App\Classes\Constants::ENDING_TYPE_DEATH) !!}
                                                        @lang('story.ending_type_death')
                                                        <span class="text-muted font-smaller ml-3">
                                                            @lang('story.ending_type_death_help')
                                                        </span>
                                                    </label>
                                                </li>
                                            </ul>
                                        </li>
                                    </ul>
                                </div>
                            @endif
                            <div class="form-group form-check">
                                <ul class="list-group">
                                    <li class="list-group-item">
                                        <p class="help-block">{{ trans('model.page_is_checkpoint_help') }}</p>
                                        <label>
                                            {!! Form::checkbox('is_checkpoint', 1, $page->is_checkpoint or false, ['id' => 'is_checkpoint-' . $page->id]) !!}
                                            @lang('model.is_checkpoint')
                                        </label>
                                    </li>
                                </ul>
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
                                        <button class="btn btn-success shadow ml-2" data-target="#modalCreateActions" data-toggle="modal">
                                            <span class="icon-add text-white"></span>
                                        </button>
                                    </h3>
                                    @include('page.partials.actions_list', ['page' => $page])
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
                                <button class="btn btn-success shadow ml-2" data-target="#modalCreateItemPage" data-toggle="modal">
                                    <span class="icon-add text-white"></span>
                                </button>
                            </h3>
                            <div class="itemsOnPage">
                                @include('page.partials.item_page_list', ['items' => $page->items])
                            </div>
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
    <div class="col-lg-6 col-xs-12 bg-primary pt-2">
        <div class="w-100 ">
            <button class="btn btn-primary shadow float-left" data-target="#modalAllItems" data-toggle="modal">
                <span class="icon-chest text-white display-6 align-middle mr-3"></span>
                <span class="align-middle">@lang('story.list_all_items')</span>
            </button>
            <button class="btn btn-primary shadow float-right" data-target="#modalAllPages" data-toggle="modal">
                <span class="align-middle">@lang('story.list_all_pages')</span>
                <span class="icon-papers text-white display-6 align-middle ml-3"></span>
            </button>
        </div>
        <div class="svg-container active" id="p1">
            <svg class="svg-content h-100 w-100">
                <g/>
            </svg>
        </div>
    </div>
</div>
