<button data-page-from="{{ $page_from ?? 0 }}" class="glyphicon glyphicon-floppy-disk display-5 clickable menu-icon menu-icon-top" data-toggle="tooltip" data-placement="right" data-original-title="@lang('page.edit')"></button>

{{-- Divider --}}
<span class="glyphicon glyphicon-none display-4"></span>

@if (!$page->is_first)
    <span data-pageid="{{ $page->id }}" class="glyphicon glyphicon-plus display-5 clickable menu-show"
        data-toggle="modal" data-target="#modalCreatePrerequisite"></span>
@endif

<span data-pageid="{{ $page->id }}" class="display-5 clickable" data-toggle="popover" data-content="Disabled popover" data-trigger="hover">
    <span class="glyphicon glyphicon-gift" data-toggle="modal" data-target="#modalCreateAction"></span>
</span>

<span data-pageid="{{ $page->id }}" class="glyphicon glyphicon-question-sign display-5 clickable"
    data-toggle="modal" data-target="#modalCreateRiddle"></span>

{{-- Divider --}}
<span class="glyphicon glyphicon-none display-4"></span>

<button class="glyphicon glyphicon-trash display-5 clickable menu-icon menu-icon-bottom"
    data-toggle="tooltip" data-placement="right" data-original-title="@lang('common.delete')"></button>
