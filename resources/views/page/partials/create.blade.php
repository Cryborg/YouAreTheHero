<div class="row is-page">
    {!! Form::hidden('page_from', $page->uuid, ['class' => 'is-page-from', 'data-page-from' => 'page_from']) !!}
    <div class="col-lg-8 col-xs-12 col-current">
        <div class="row h-100">
            <div class="menu-bar-left" data-internalid="{{ $internalId }}">
                <div class="bg-primary mr-2 h-100 pull-left text-center p-3">
                    @include('page.partials.menu-bar')
                </div>
            </div>
            <div class="col">
                @info({!! trans('page.current_page_help') !!})

                <div class="divAsForm" data-internalid="{{ $internalId }}"
                    data-route="{{ route('page.edit.post', ['page' => $page->uuid]) }}">

                    {{--  Errors --}}
                    <div class="form-errors alert alert-danger hidden"></div>
                    {!! Form::hidden('internalid', $internalId, ['name' => 'internalid']) !!}

                    {{-- Form --}}
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            @lang('model.title')
                        </div>

                        <p class="help-block">{{ trans('model.page_title_help') }}</p>
                        {!! Form::text('title-' . $internalId, $page->title ?? old('title'), ['id' => 'title-' . $internalId, 'class' => 'form-control']) !!}
                    </div>

                    <div class="panel panel-default clickable panel-content">
                        <div class="panel-heading">
                            @lang('model.content')
                        </div>

                        <p class="help-block">{{ trans('model.page_content_help') }}</p>
                        <div id="content-{{ $internalId }}" class="false-input">
                            {!! $page->content ?? old('content') !!}
                        </div>
                    </div>

                    <div class="form-group hidden">
                        {!! Form::label('layout-' . $internalId, trans('model.layout'), ['class' => 'control-label']) !!}
                        <p class="help-block">{{ trans('model.page_layout_help') }}</p>
                        {!! Form::select('layout-' . $internalId, $layouts , $page->layout ?? old('layout') , ['class' => 'form-control']) !!}
                    </div>

                    <div class="form-group form-check hidden">
                        <p class="help-block">{{ trans('model.page_is_first_help') }}</p>
                        <label>
                            {!! Form::checkbox('is_first-' . $internalId, 1, $page->is_first or false, ['id' => 'is_first-' . $internalId]) !!}
                            @lang('model.is_first')
                        </label>
                    </div>
                    @if (!$page->is_first && $page->choices() && $page->choices()->count() === 0)
                        <div class="form-group form-check">
                            <p class="help-block">{{ trans('model.page_is_last_help') }}</p>
                            <label>
                                {!! Form::checkbox('is_last-' . $internalId, 1, $page->is_last or false, ['id' => 'is_last-' . $internalId]) !!}
                                @lang('model.is_last')
                            </label>
                        </div>
                    @endif
                    <div class="form-group form-check">
                        <p class="help-block">{{ trans('model.page_is_checkpoint_help') }}</p>
                        <label>
                            {!! Form::checkbox('is_checkpoint-' . $internalId, 1, $page->is_checkpoint or false, ['id' => 'is_checkpoint-' . $internalId]) !!}
                            @lang('model.is_checkpoint')
                        </label>
                    </div>
                </div>

                @if ($internalId > 0)
                    <a data-toggle="tooltip" title="{{ trans('page.edit_help') }}" class="btn btn-primary w-25" href="{{ route('page.edit', $page->uuid) }}#current_page">{{ trans('page.edit') }}</a>
                @endif
            </div>
        </div>
    </div>

    <div class="col-lg-4 col-xs-12 col-border-right col-current">
        <div class="row">
            <div class="col">
                @info({!! trans('page.current_page_prerequisites_help') !!})

                @include('page.partials.prerequisites_list', ['page' => $page])
            </div>
        </div>
        <hr>
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
