<div class="row is-page" data-pageid="{{ $page->id }}">
    {!! Form::hidden('page_from', $page->id, ['class' => 'is-page-from', 'data-page-from' => $page_from ?? 0]) !!}
    <div class="col-lg-8 col-xs-12 col-current">
        <div class="row h-100">
            <div class="menu-bar-left">
                <div class="bg-primary mr-2 h-100 pull-left text-center p-3">
                    @include('page.partials.menu-bar')
                </div>
            </div>
            <div class="col">
                @info({!! trans('page.current_page_help') !!})

                <div class="divAsForm" data-route="{{ route('page.edit.post', ['page' => $page->id]) }}">

                    @can('debug')
                        From: <span class="badge badge-warning">{{ $page_from ?? 0 }}</span>
                        This: <span class="badge badge-warning">{{ $page->id }}</span>
                    @endcan

                    {{-- Form --}}
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            @lang('model.title')
                        </div>

                        <p class="help-block">{{ trans('model.page_title_help') }}</p>
                        {!! Form::text('title', $page->title ?? old('title'), ['id' => 'title-' . $page->id, 'class' => 'form-control']) !!}
                    </div>

                    <div class="panel panel-default clickable panel-content toggle-summernote">
                        <div class="panel-heading">
                            @lang('model.content')
                        </div>

                        <p class="help-block">{{ trans('model.page_content_help') }}</p>
                        <div id="content-{{ $page->id }}" class="false-input scrollable-content">{!! $page->content ?? old('content') !!}</div>
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

    <hr>

    {{-- Choice(s) --}}
    <div class="col">
        @info({!! trans('page.current_page_choices_help') !!})

        <nav class="nav nav-tabs">
            @if($page->choices)
                @foreach($page->choices as $key => $choice)
                    <span class="nav-item nav-link href="#p{{ $key }}"
                        data-toggle="tab" data-pageid="{{ $choice->id }}" data-page-from="{{ $page->id }}">
                        <span class="choice_title_{{ $choice->id }}">
                            <input type="text" class="form-control" placeholder="{{ trans('page.link_text') }}" id="linktext-{{ $choice->id }}" value="{{ $choice->pivot->link_text }}">
                        </span>
                    </span>
                @endforeach
            @endif
            <a class="nav-item nav-link addNewPage" href="" data-page-from="{{ $page->id }}">+</a>
            <a class="nav-item nav-link" href="">
                <select class="form-control mr-sm-2 childrenSelect" data-page-from="{{ $page->id }}">
                    <option value="0" selected>{{ trans('page.existing_page') }}</option>
                    @foreach ($page->getPotentialChildren() as $existingPage)
                        @if ($existingPage->id !== $page->id)
                            <option value="{{ $existingPage->id }}">{{ $existingPage->title }}</option>
                        @endif
                    @endforeach
                </select>
            </a>
        </nav>
    </div>
</div>

<div class="row">
    <div class="col">
        <div class="tab-content choicesForm" data-page-from="{{ $page->id }}">
            {{--                @if($page->choices)--}}
            {{--                    @foreach($page->choices as $key => $choice)--}}
            {{--                        <div class="tab-pane @if ($key === 0) active @endif" id="p{{ $key }}">--}}
            {{--                            @include('page.partials.create', ['page' => $choice, 'page_from' => $page->id])--}}
            {{--                        </div>--}}
            {{--                    @endforeach--}}
            {{--                @endif--}}
        </div>
    </div>
</div>
