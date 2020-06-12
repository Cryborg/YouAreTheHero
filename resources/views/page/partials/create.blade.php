<div class="row is-page">
    {!! Form::hidden('page_from', $page->id, ['class' => 'is-page-from', 'data-page-from' => $page_from ?? 0]) !!}
    <div class="col-lg-6 col-xs-12">
        <div class="row">
            <div class="col">
                <textarea class="w-100" id="inputGraph" rows="5" style="display: none">{{ $graph }}</textarea>
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
                                <div id="content-editable-{{ $page->id }}" class="false-input scrollable-content hidden h-300px">{!! $page->content ?? old('content') !!}</div>
                                <div id="content-{{ $page->id }}" class="false-input scrollable-content h-300px">{!! $page->present()->content ?? old('content') !!}</div>
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
                            <p class="help-block">{{ trans('model.page_is_last_help') }}</p>
                            <label>
                                {!! Form::checkbox('is_last', 1, $page->is_last or false, ['id' => 'is_last-' . $page->id]) !!}
                                @lang('model.is_last')
                            </label>
                        </div>
                    @endif
                    <div class="form-group form-check">
                        <p class="help-block">{{ trans('model.page_is_checkpoint_help') }}</p>
                        <label>
                            {!! Form::checkbox('is_checkpoint', 1, $page->is_checkpoint or false, ['id' => 'is_checkpoint-' . $page->id]) !!}
                            @lang('model.is_checkpoint')
                        </label>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col">
                <button class="btn btn-primary shadow bg-success savePage">
                    <span class="icon-save text-white display-6 align-middle mr-3"></span>
                    <span class="align-middle">@lang('common.save')</span>
                </button>
                <button class="btn btn-primary shadow" data-target="#modalAllPages" data-toggle="modal">
                    <span class="icon-papers text-white display-6 align-middle mr-3"></span>
                    <span class="align-middle">@lang('story.list_all_pages')</span>
                </button>

                <button class="btn btn-primary shadow" data-target="#modalAddChoice" data-toggle="modal">
                    <span class="icon-choice text-white display-6 align-middle mr-3"></span>
                    <span class="align-middle">@lang('page.add_choice')</span>
                    <span class="badge badge-warning rounded float-right shadow font-bigger ml-3">{{ $page->choices()->count() }}</span>
                </button>
            </div>
        </div>
    </div>

    <div class="col-lg-6 col-xs-12 bg-primary pt-2">
        <nav class="nav nav-pills mb-2">
            <a class="nav-item nav-link active text-white" href="#p1" data-toggle="tab">@lang('story.tree')</a>
            <a class="nav-item nav-link text-white" href="#p2" data-toggle="tab">@lang('page.settings')</a>
            @if ($page->reports()->count() > 0)
                <a class="nav-item nav-link text-white" href="#p3" data-toggle="tab">@lang('page.reports')</a>
            @endif
        </nav>
        <div class="tab-content">
            <div class="tab-pane svg-container active" id="p1">
                <svg class="svg-content h-100 w-100"><g/></svg>
            </div>
            <div class="tab-pane" id="p2">
                @if (!$page->is_first)
                    <button class="btn btn-primary shadow w-90 align-middle text-left" data-target="#modalCreateActions" data-toggle="modal">
                        <span class="icon-unlocking text-white display-6 align-middle mr-3"></span>
                        <span class="align-middle">@lang('page.add_actions_modal_title')</span>
                        <span class="badge badge-warning rounded float-right shadow font-bigger">{{ $page->trigger()->count() }}</span>
                    </button><button class="btn btn-primary shadow w-10 mb-3 align-middle show-help" data-help="actions_help"><span class="icon-help text-white align-middle display-6"></span></button>
                    <div class="w-100 text-white bg-info p-2 mb-3" style="display: none" id="actions_help">
                        <div class="row">
                            <div class="col">
                                @info({!! trans('page.current_page_actions_help') !!})

                                <h3>{{ trans('item.items_title') }}</h3>
                                @include('page.partials.actions_list', ['page' => $page])
                            </div>
                        </div>
                        <hr>
                    </div>
                @endif

                @if (!$page->is_first)
                    <button class="btn btn-primary shadow w-90 align-middle text-left" data-target="#modalCreatePrerequisite" data-toggle="modal">
                        <span class="icon-unlocking text-white display-6 align-middle mr-3"></span>
                        <span class="align-middle">@lang('item_page.add_prerequisite')</span>
                        <span class="badge badge-warning rounded float-right shadow font-bigger">{{ $page->prerequisites()->count() }}</span>
                    </button><button class="btn btn-primary shadow w-10 mb-3 align-middle show-help" data-help="prerequisites_help"><span class="icon-help text-white align-middle display-6"></span></button>
                    <div class="w-100 text-white bg-info p-2 mb-3" style="display: none" id="prerequisites_help">
                        <div class="row">
                            <div class="col">
                                @info({!! trans('page.current_page_prerequisites_help') !!})

                                @include('page.partials.prerequisites_list', ['page' => $page])
                            </div>
                        </div>
                        <hr>
                    </div>
                @endif

                <button class="btn btn-primary shadow w-90 align-middle text-left" data-target="#modalCreateItemPage" data-toggle="modal">
                    <span class="icon-chest text-white display-6 align-middle mr-3"></span>
                    <span class="align-middle">@lang('item_page.add_item_page')</span>
                    <span class="badge badge-warning rounded float-right shadow font-bigger">{{ $page->items()->count() }}</span>
                </button><button class="btn btn-primary shadow w-10 mb-3 align-middle show-help" data-help="item_page_help"><span class="icon-help text-white align-middle display-6"></span></button>
                <div class="w-100 text-white bg-info p-2 mb-3" style="display: none" id="item_page_help">
                    @info({!! trans('page.current_page_item_page_help') !!})

                    <div class="itemsOnPage">
                        @include('page.partials.item_page_list', ['items' => $page->items])
                    </div>
                </div>

                <button class="btn btn-primary shadow w-90 align-middle text-left" data-target="#modalCreateRiddle" data-toggle="modal">
                    <span class="icon-jigsaw-piece text-white display-6 align-middle mr-3"></span>
                    <span class="align-middle">@lang('item_page.add_new_riddle')</span>
                </button><button class="btn btn-primary shadow w-10 mb-3 align-middle show-help" data-help="riddles_help"><span class="icon-help text-white align-middle display-6"></span></button>
                <div class="w-100 text-white bg-info p-2 mb-3" style="display: none" id="riddles_help">
                    @info({!! trans('page.current_page_riddles_help') !!})

                    @include('page.partials.riddles_list', ['page' => $page])
                </div>
            </div>
        </div>
    </div>
</div>
