<button data-page-from="{{ $page_from ?? 0 }}" class="glyphicon glyphicon-floppy-disk display-5 clickable menu-icon menu-icon-top rounded-lg" data-toggle="tooltip" data-placement="right" data-original-title="@lang('page.edit')"></button>

<span data-toggle="tooltip" data-placement="right" data-original-title="@lang('story.list_all_pages')">
    <span data-pageid="{{ $page->id }}" class="glyphicon glyphicon-list display-5 clickable pb-4 pt-4" data-toggle="modal" data-target="#modalAllPages"></span>
</span>

{{-- Divider --}}
<span class="glyphicon glyphicon-none display-4"></span>

@if (!$page->is_first)
    <span data-toggle="tooltip" data-placement="right" data-original-title="@lang('actions.add_new_prerequisite')">
        <span data-pageid="{{ $page->id }}" class="glyphicon glyphicon-plus display-5 clickable pb-4 menu-show"
            data-toggle="modal" data-target="#modalCreatePrerequisite"></span>
    </span>
@endif

<span data-toggle="tooltip" data-placement="right" data-original-title="@lang('actions.add_new_action')">
    <span data-pageid="{{ $page->id }}" class="glyphicon glyphicon-gift display-5 clickable pb-4" data-toggle="modal" data-target="#modalCreateAction"></span>
</span>

<span data-toggle="tooltip" data-placement="right" data-original-title="@lang('actions.add_new_riddle')">
    <span data-pageid="{{ $page->id }}" class="glyphicon glyphicon-question-sign display-5 clickable pb-4"
        data-toggle="modal" data-target="#modalCreateRiddle"></span>
</span>

{{-- Divider --}}
<span class="glyphicon glyphicon-none display-4"></span>

<button data-pageid="{{ $page->id }}" class="glyphicon glyphicon-trash display-5 clickable menu-icon menu-icon-bottom rounded-lg"
    @if ($page->choices->count() > 0) disabled @endif
    data-toggle="tooltip" data-placement="right" data-original-title="@lang('common.delete')"></button>
