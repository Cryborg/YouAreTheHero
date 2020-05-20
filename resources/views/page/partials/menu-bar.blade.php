<div class="clickable bg-success shadow mb-2" data-toggle="tooltip" data-placement="right" data-original-title="@lang('page.edit')">
    <span class="icon-save display-4 text-white" data-page-from="{{ $page_from ?? 0 }}"></span>
</div>

<div data-toggle="tooltip" data-placement="right" data-original-title="@lang('page.add_choice')" class="clickable shadow mb-2">
    <span class="icon-choice text-white display-4" data-pageid="{{ $page->id }}" data-target="#modalAddChoice" data-toggle="modal"></span>
</div>

<div data-toggle="tooltip" data-placement="right" data-original-title="@lang('story.list_all_pages')" class="clickable shadow">
    <span class="icon-papers text-white display-4" data-pageid="{{ $page->id }}" data-target="#modalAllPages" data-toggle="modal"></span>
</div>

{{-- Divider --}}
<span class="glyphicon glyphicon-none display-4"></span>

@if (!$page->is_first)
    <div data-toggle="tooltip" data-placement="right" data-original-title="@lang('actions.add_new_prerequisite')" class="clickable shadow mb-2">
        <span data-pageid="{{ $page->id }}" class="icon-unlocking display-4 text-white"
            data-toggle="modal" data-target="#modalCreatePrerequisite"></span>
    </div>
@endif

<div data-toggle="tooltip" data-placement="right" data-original-title="@lang('actions.add_new_action')" class="clickable shadow mb-2">
    <span class="icon-chest text-white display-4" data-pageid="{{ $page->id }}" data-target="#modalCreateAction" data-toggle="modal"></span>
</div>

<div data-toggle="tooltip" data-placement="right" data-original-title="@lang('actions.add_new_riddle')" class="clickable shadow mb-2">
    <span data-pageid="{{ $page->id }}" class="icon-jigsaw-piece display-4 text-white"
        data-toggle="modal" data-target="#modalCreateRiddle"></span>
</div>

{{-- Divider --}}
<span class="glyphicon glyphicon-none display-4"></span>

@isset($page_from)
    <div class="clickable menu-icon menu-icon-bottom shadow bg-danger mb-3"
        data-toggle="tooltip" data-placement="right" data-original-title="@lang('common.delete_link')">
        <span class="icon-breaking-chain display-4 text-white" data-pageid="{{ $page->id }}" data-page-from="{{ $page_from }}"></span>
    </div>
@endisset

@if ($page->choices()->count() > 0)
    <div class="menu-icon menu-icon-bottom shadow bg-secondary"
        data-toggle="tooltip" data-placement="right" data-original-title="@lang('common.cannot_delete')">
        <span class="icon-trash display-4 text-dark" data-pageid="{{ $page->id }}"></span>
    </div>
@else
    <div class="clickable menu-icon menu-icon-bottom shadow bg-danger"
        data-toggle="tooltip" data-placement="right" data-original-title="@lang('common.delete')">
        <span class="icon-trash display-4 text-white" data-pageid="{{ $page->id }}"></span>
    </div>
@endif
