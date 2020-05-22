<div class="row is-page">
    {!! Form::hidden('page_from', $page->id, ['class' => 'is-page-from', 'data-page-from' => $page_from ?? 0]) !!}
    <div class="col-lg-8 col-xs-12">
        <div>
            <div class="col-12 bg-primary p-2">
                @include('page.partials.menu-bar')
            </div>
        </div>
        <div class="row">
            <div class="col">
                @info({!! trans('page.tree_help') !!})

                @include('page.partials.tree', ['page' => $page])

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
                                <div id="content-editable-{{ $page->id }}" class="false-input scrollable-content hidden">{!! $page->content ?? old('content') !!}</div>
                                <div id="content-{{ $page->id }}" class="false-input scrollable-content">{!! $page->present()->content ?? old('content') !!}</div>
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
    </div>

    <div class="col-lg-4 col-xs-12">
        @if (!$page->is_first)
            <div class="row">
                <div class="col">
                    @info({!! trans('page.current_page_prerequisites_help') !!})

                    @include('page.partials.prerequisites_list', ['page' => $page])
                </div>
            </div>
            <hr>
        @endif
        <div class="row">
            <div class="col">
                @info({!! trans('page.current_page_actions_help') !!})

                @include('page.partials.actions_list', ['page' => $page])
            </div>
        </div>
        <hr>
        <div class="row">
            <div class="col">
                @info({!! trans('page.current_page_riddles_help') !!})

                @include('page.partials.riddles_list', ['page' => $page])
            </div>
        </div>
    </div>
</div>
