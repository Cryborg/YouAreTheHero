<div class="card-header">
    @lang('item.item_fields')
</div>
<div class="card-body row item-fields">
    @foreach ($item->fields as $field)
        <div class="col-8">
            @include('page.partials.badge_fields', ['field' => $field])
        </div>
        <div class="col-4">
            <div class="btn btn-outline-danger">
                <span class="icon-trash text-red deleteItemField" data-fieldid="{{ $field->id }}" data-itemid="{{ $item->id }}"></span>
            </div>
        </div>
    @endforeach
</div>
