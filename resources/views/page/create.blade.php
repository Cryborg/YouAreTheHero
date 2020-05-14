@extends('base')

@section('title', $title)

@section('content')
    <span class="float-right toggle-help close glyphicon glyphicon-question-sign"></span>
    <h2>{{ trans('page.edit_pages_title') }}</h2>

    {{-- Current page --}}
    @include('page.partials.create')

    <hr>

    {{-- Choice(s) --}}
    <div class="row">
        <div class="col">
            @info({!! trans('page.current_page_choices_help') !!})

            <nav class="nav nav-tabs">
                @if($page->choices)
                    @foreach($page->choices as $key => $choice)
                        <a class="nav-item nav-link @if ($key === 0) active @endif" href="#p{{ $key }}" data-toggle="tab">
                            <span class="choice_title_{{ $key }}">
                                <input type="text" class="form-control" placeholder="{{ trans('page.link_text') }}" id="linktext-{{ $choice->id }}" value="{{ $choice->pivot->link_text }}">
                            </span>
                        </a>
                    @endforeach
                @endif
                <a class="nav-item nav-link" href="" id="addNewPage" data-page-from="{{ $page->id }}">+</a>
                <a class="nav-item nav-link" href="">
                    <select class="form-control mr-sm-2" id="childrenSelect" data-page-from="{{ $page->id }}">
                        <option value="0" selected>{{ trans('page.existing_page') }}</option>
                        @foreach ($page->getPotentialChildren() as $existingPage)
                            @if ($existingPage->id !== $page->id)
                                <option value="{{ $existingPage->id }}">{{ $existingPage->title }}</option>
                            @endif
                        @endforeach
                    </select>
                </a>
            </nav>
            <div class="tab-content" id="choicesForm">
                @if($page->choices)
                    @foreach($page->choices as $key => $choice)
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
        'async' => true,
        'title' => trans('story.all_pages_modal_title'),
        'data' => [
            'story' => $story,
            'id' => 'AllPages',
        ]
    ])

    <!-- Modal new Riddle -->
    @include('page.partials.modal_model', [
        'template' => 'page.partials.modal_riddle',
        'async' => false,
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
        'async' => false,
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
        'async' => false,
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
