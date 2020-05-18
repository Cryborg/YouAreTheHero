@extends('base')

@section('title', $title)

@section('content')
    <span class="float-right toggle-help close glyphicon glyphicon-question-sign"></span>
    <h2>{{ trans('page.edit_pages_title') }}</h2>

    {{-- Current page --}}
    @include('page.partials.create')

    <!-- Modal list all pages -->
    @include('page.partials.modal_model', [
        'template' => 'page.partials.modal_list_pages',
        'async' => true,
        'title' => trans('story.all_pages_modal_title'),
        'icon' => 'icon-papers',
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
        'icon' => 'icon-jigsaw-piece',
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
        'icon' => 'icon-chest',
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
        'icon' => 'icon-unlocking',
        'data' => [
            'page' => $page,
            'id' => 'CreatePrerequisite',
            'btn_add_text' => trans('actions.add_prerequisite')
        ]
    ])
@endsection

@push('footer-scripts')
    @include('page.js.create-js')
    @include('item.js.create_item_js', ['story' => $story, 'contexts' => $contexts])
@endpush
