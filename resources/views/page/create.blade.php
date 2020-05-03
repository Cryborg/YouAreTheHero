@extends('base')

@section('title', $title)

@section('content')
    <span class="pull-right toggle-help close glyphicon glyphicon-question-sign"></span>
    <h2>{{ trans('page.edit_pages_title') }}</h2>

    {{-- Parent page(s) --}}
    @if (!$page->is_first)
        <div class="row">
            <div class="col col-border-left col-border-right col-parents">
                @info({!! trans('page.parent_pages_help') !!})

                <div>
                    <div class="tab-content">
                        @if($page->parents())
                            @foreach($page->parents() as $key => $parent)
                                <div class="tab-pane @if ($key === 0) active @endif" id="pp{{ $key }}">
{{--                                    @include('page.partials.create_readonly', ['page' => $parent, 'child' => false])--}}
                                    @include('page.partials.create', ['page' => $parent])
                                </div>
                            @endforeach
                        @endif
                    </div>
                    <nav class="nav nav-pills">
                        @if($page->parents())
                            @foreach($page->parents() as $key => $choice)
                                <a class="nav-item nav-link @if ($key === 0) active @endif" href="#pp{{ $key }}" data-toggle="tab">
                                    <span class="choice_title_{{ $key }}">
                                        <input type="text" class="form-control" value="{{ $choice->link_text }}" disabled>
                                    </span>
                                </a>
                            @endforeach
                        @endif
                    </nav>
                </div>
            </div>
        </div>
    @endif

    <hr>

    {{-- Current page --}}
    {!! Form::hidden('page_from', $page->uuid, ['id' => 'page_from']) !!}
    <div class="row" id="current_page">
        <div class="col-lg-8 col-xs-12 col-current">
            <div class="row h-100">
                <div class="menu-bar-left" data-internalid="{{ $internalId }}">
                    <div class="bg-primary mr-2 h-100 pull-left text-center p-3">
                        @include('page.partials.menu-bar')
                    </div>
                </div>
                <div class="col">
                    @info({!! trans('page.current_page_help') !!})

                    @include('page.partials.create', ['page' => $page])
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

    <hr>

    {{-- Choice(s) --}}
    <div class="row">
        <div class="col col-border-left col-border-right col-choices">
            @info({!! trans('page.current_page_choices_help') !!})

            <nav class="nav nav-pills">
                @if($page->choices())
                    @foreach($page->choices() as $key => $choice)
                        <a class="nav-item nav-link @if ($key === 0) active @endif" href="#p{{ $key }}" data-toggle="tab">
                            <span class="choice_title_{{ $key }}">
                                <input type="text" class="form-control" placeholder="{{ trans('page.link_text') }}" id="linktext-{{ $key + 1 }}" value="{{ $choice->link_text }}">
                            </span>
                        </a>
                    @endforeach
                @endif
                <a class="nav-item nav-link" href="" id="addNewPage">+</a>
                <a class="nav-item nav-link" href="">
                    <select class="form-control mr-sm-2" id="childrenSelect">
                        <option value="0" selected>{{ trans('page.existing_page') }}</option>
                        @foreach ($page->getPotentialChildren() as $existingPage)
                            @if ($existingPage->uuid !== $page->uuid)
                                <option value="{{ $existingPage->uuid }}">{{ $existingPage->title }}</option>
                            @endif
                        @endforeach
                    </select>
                </a>
            </nav>
            <div class="tab-content" id="choicesForm">
                @if($page->choices())
                    @foreach($page->choices() as $key => $choice)
                        <div class="tab-pane @if ($key === 0) active @endif" id="p{{ $key }}">
{{--                            @include('page.partials.create_readonly', ['page' => $choice, 'child' => true])--}}
                            @include('page.partials.create', ['page' => $choice])
                        </div>
                    @endforeach
                @endif
            </div>
        </div>
    </div>

    <!-- Modal list all pages -->
    @include('page.partials.modal_model', [
        'template' => 'page.partials.modal_list_pages',
        'title' => trans('story.all_pages_modal_title'),
        'data' => [
            'story' => $story,
            'id' => 'AllPages',
        ]
    ])

    <!-- Modal new Riddle -->
    @include('page.partials.modal_model', [
        'template' => 'page.partials.modal_riddle',
        'title' => trans('page.riddle_modal_title'),
        'data' => [
            'page' => $page,
            'id' => 'CreateRiddle',
            'btn_add_text' => trans('actions.add_riddle')
        ]
    ])

    <!-- Modal new Action -->
    @include('page.partials.modal_model', [
        'template' => 'page.partials.modal_actions',
        'title' => trans('page.actions_modal_title'),
        'data' => [
            'page' => $page,
            'id' => 'CreateAction',
            'btn_add_text' => trans('actions.add_action')
        ]
    ])

    <!-- Modal new Prerequisite -->
    @include('page.partials.modal_model', [
        'template' => 'page.partials.modal_prerequisites',
        'title' => trans('page.prerequisite_modal_title'),
        'data' => [
            'page' => $page,
            'id' => 'CreatePrerequisite',
            'btn_add_text' => trans('actions.add_prerequisite')
        ]
    ])
@endsection

@push('footer-scripts')
    @include('page.js.create-js')
@endpush
