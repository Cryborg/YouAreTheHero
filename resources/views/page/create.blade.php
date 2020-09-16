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

    <!-- Modal story errors -->
    @include('page.partials.modal_model', [
        'template' => 'page.partials.modal_story_errors',
        'context' => 'story_errors',
        'title' => trans('page.story_errors_modal_title'),
        'icon' => 'icon-skull',
        'big' => false,
        'data' => [
            'page' => $page,
            'id' => 'StoryErrors',
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

    <!-- Modal list all items -->
    @include('page.partials.modal_model', [
        'template' => 'page.partials.modal_list_items',
        'context' => 'list_items',
        'title' => trans('story.all_items_modal_title'),
        'icon' => 'icon-chest',
        'big' => true,
        'data' => [
            'story' => $story,
            'id' => 'AllItems',
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

    <!-- Modal meta (prerequisites, actions, items) -->
    @include('page.partials.modal_model', [
        'template' => 'page.partials.modal_meta',
        'context' => 'prerequisites',
        'title' => '',
        'icon' => '',
        'big' => true,
        'data' => [
            'page' => $page,
            'id' => 'Meta',
            'btn_add_text' => trans('common.add')
        ]
    ])
@endsection

@push('footer-scripts')
    <script type="text/javascript">
        var storyId = {{ $story->id }};

        @include('page.js.dagred3-js', ['pages' => $page->story->pages, 'current' => $page])

        var pageId = {{ $page->id }};
        var confirmDeleteFieldText = "@lang('field.confirm_delete')";
        var confirmDeleteItemText = "@lang('item.confirm_delete')";
        var confirmDeletePageText = "@lang('page.confirm_delete')";
        var confirmDeleteLinkText = "@lang('page.confirm_delete_link')";
        var langPageRiddleTextLabel = "@lang('page.riddle_page_text_label')";
        var langPageRiddleAnswerLabel = "@lang('page.riddle_answer_label')";
        var langPageRiddleTargetPageIdLabel = "@lang('page.riddle_target_page_id_label')";
        var langPageEarnedItemLabel = "@lang('page.earned_item')";
        var langItem = "@lang('item.item')";
        @include('page.js.create-js')
        @include('page.js.partials.create.bindings')
        @include('page.js.partials.create.refresh')

        var routeItem = '{{ route('item.store') }}';
        @include('item.js.create_item_js', ['story' => $story, 'contexts' => $contexts])
    </script>
@endpush
