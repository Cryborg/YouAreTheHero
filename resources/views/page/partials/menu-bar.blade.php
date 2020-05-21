<span data-toggle="tooltip" data-placement="bottom" data-original-title="@lang('page.edit')">
    <span class="icon-save display-5 text-white clickable bg-success shadow mr-2 rounded-lg" data-page-from="{{ $page_from ?? 0 }}"></span>
</span>

<span data-toggle="tooltip" data-placement="bottom" data-original-title="@lang('page.add_choice')" class="clickable shadow mr-2">
    <span class="icon-choice text-white display-5" data-pageid="{{ $page->id }}" data-target="#modalAddChoice" data-toggle="modal"></span>
</span>

<span data-toggle="tooltip" data-placement="bottom" data-original-title="@lang('story.list_all_pages')" class="clickable shadow">
    <span class="icon-papers text-white display-5" data-pageid="{{ $page->id }}" data-target="#modalAllPages" data-toggle="modal"></span>
</span>

{{-- spanider --}}
<span class="glyphicon glyphicon-none display-6"></span>

@if (!$page->is_first)
    <span data-toggle="tooltip" data-placement="bottom" data-original-title="@lang('actions.add_new_prerequisite')" class="clickable shadow mr-2">
        <span data-pageid="{{ $page->id }}" class="icon-unlocking display-5 text-white"
            data-toggle="modal" data-target="#modalCreatePrerequisite"></span>
    </span>
@endif

<span data-toggle="tooltip" data-placement="bottom" data-original-title="@lang('actions.add_new_action')" class="clickable shadow mr-2">
    <span class="icon-chest text-white display-5" data-pageid="{{ $page->id }}" data-target="#modalCreateAction" data-toggle="modal"></span>
</span>

<span data-toggle="tooltip" data-placement="bottom" data-original-title="@lang('actions.add_new_riddle')" class="clickable shadow mr-2">
    <span data-pageid="{{ $page->id }}" class="icon-jigsaw-piece display-5 text-white"
        data-toggle="modal" data-target="#modalCreateRiddle"></span>
</span>

{{-- spanider --}}
<span class="glyphicon glyphicon-none display-6"></span>

@if ($page->choices()->count() > 0)
    <span data-toggle="tooltip" data-placement="bottom" data-original-title="@lang('common.cannot_delete')">
        <span class="icon-trash display-5 text-dark clickable shadow disabled" data-pageid="{{ $page->id }}"></span>
    </span>
@else
    <span data-toggle="tooltip" data-placement="bottom" data-original-title="@lang('common.delete')">
        <span class="icon-trash display-5 text-white clickable shadow bg-danger rounded-lg" data-pageid="{{ $page->id }}"></span>
    </span>
@endif
