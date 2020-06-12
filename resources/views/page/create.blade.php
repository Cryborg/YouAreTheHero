@extends('base')

@section('title', $title)

@section('content')
    <span class="float-right toggle-help close icon-help"></span>

    {{-- Current page --}}
    @include('page.partials.create')

    <!-- Modal add choice -->
    @include('page.partials.modal_model', [
        'template' => 'page.partials.modal_actions',
        'context' => 'add_actions',
        'title' => trans('page.add_actions_modal_title'),
        'icon' => 'icon-choice',
        'big' => true,
        'data' => [
            'page' => $page,
            'id' => 'CreateActions'
        ]
    ])


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

    <!-- Modal edit choice -->
    @include('page.partials.modal_model', [
        'template' => 'page.partials.modal_edit_choice',
        'context' => 'edit_choice',
        'title' => trans('page.edit_choice_modal_title'),
        'icon' => 'icon-choice',
        'big' => false,
        'data' => [
            'page' => $page,
            'id' => 'EditChoice',
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
            'btn_add_text' => trans('item_page.add_riddle')
        ]
    ])

    <!-- Modal add item on page -->
    @include('page.partials.modal_model', [
        'template' => 'page.partials.modal_item_page',
        'context' => 'item_page',
        'title' => trans('page.item_page_modal_title'),
        'icon' => 'icon-chest',
        'big' => true,
        'data' => [
            'page' => $page,
            'id' => 'CreateItemPage',
            'btn_add_text' => trans('item_page.add_item_page')
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
            'btn_add_text' => trans('item_page.add_prerequisite')
        ]
    ])
@endsection

@push('footer-scripts')
    <script type="text/javascript">
        var storyId = {{ $story->id }};
        var saveSuccessHeading = "{!! trans('notification.save_success_title') !!}";
        var saveSuccessText = "{!! trans('notification.save_success_text') !!}";
        var saveFailedHeading = "{!! trans('notification.save_failed_title') !!}";
        var saveFailedText = "{!! trans('notification.save_failed_text') !!}";

        @include('page.js.dagred3-js', ['pages' => $page->story->pages, 'current' => $page])
        @include('page.js.create-js')

        var routeItem = '{{ route('item.store') }}';
        @include('item.js.create_item_js', ['story' => $story, 'contexts' => $contexts])
    </script>
@endpush
