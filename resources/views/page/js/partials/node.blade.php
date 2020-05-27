<div
    data-page-to="{{ $choice->id }}"
    data-page-from="{{ $page->id }}">
    <span class="choice-text icon-fountain-pen text-white clickable border-right border-light p-1 mr-2">
    </span>
    <span class="link-text">{{ $choice->pivot->link_text }}</span>
    <span class="choice-text icon-trash clickable text-red border-left border-light p-1 ml-2"></span>
</div>
