@extends('base')

@section('title', $title)

@section('content')
    <span class="float-right toggle-help close icon-help"></span>

    {{-- Current page --}}
    @include('page.partials.create')

    <!-- Modal add choice -->
    @include('page.partials.modal_model', [
        'template' => 'page.partials.modal_add_choice',
        'context' => 'add_choice',
        'title' => trans('page.add_choice_modal_title'),
        'icon' => 'icon-choice',
        'big' => false,
        'data' => [
            'page' => $page,
            'id' => 'AddChoice',
            'btn_add_text' => trans('common.save')
        ]
    ])

    <!-- Modal list all pages -->
    @include('page.partials.modal_model', [
        'template' => 'page.partials.modal_list_pages',
        'context' => 'list_pages',
        'title' => trans('story.all_pages_modal_title'),
        'icon' => 'icon-papers',
        'big' => true,
        'data' => [
            'story' => $story,
            'id' => 'AllPages',
        ]
    ])

    <!-- Modal insert popover -->
    @include('page.partials.modal_model', [
        'template' => 'page.partials.modal_descriptions',
        'context' => 'descriptions',
        'title' => trans('story.popovers_modal_title'),
        'icon' => 'icon-archive-research',
        'big' => true,
        'data' => [
            'page' => $page,
            'id' => 'Descriptions',
        ]
    ])

    <!-- Modal new Riddle -->
    @include('page.partials.modal_model', [
        'template' => 'page.partials.modal_riddle',
        'context' => 'riddles',
        'title' => trans('page.riddle_modal_title'),
        'icon' => 'icon-jigsaw-piece',
        'big' => true,
        'data' => [
            'page' => $page,
            'id' => 'CreateRiddle',
            'btn_add_text' => trans('actions.add_riddle')
        ]
    ])

    <!-- Modal new Action -->
    @include('page.partials.modal_model', [
        'template' => 'page.partials.modal_actions',
        'context' => 'actions',
        'title' => trans('page.actions_modal_title'),
        'icon' => 'icon-chest',
        'big' => true,
        'data' => [
            'page' => $page,
            'id' => 'CreateAction',
            'btn_add_text' => trans('actions.add_action')
        ]
    ])

    <!-- Modal new Prerequisite -->
    @include('page.partials.modal_model', [
        'template' => 'page.partials.modal_prerequisites',
        'context' => 'prerequisites',
        'title' => trans('page.prerequisite_modal_title'),
        'icon' => 'icon-unlocking',
        'big' => true,
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
