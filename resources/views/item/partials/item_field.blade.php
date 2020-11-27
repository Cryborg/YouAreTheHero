<div class="col-8">
    @include('page.partials.badge_fields', ['field' => $field])
</div>
<div class="col-4">
    <div class="btn btn-outline-danger">
        <span class="icon-trash text-red deleteItemField" data-fieldid="{{ $field->id }}" data-itemid="{{ $item->id }}"></span>
    </div>
</div>
