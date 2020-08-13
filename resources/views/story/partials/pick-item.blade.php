<div class="input-group">
    <div class="input-group-prepend">
        <button class="btn btn-outline-secondary bg-light" data-original-text="@lang('item_page.take')" type="button" data-itemid="{{ $item->id }}">
            @lang('item_page.take')
        </button>
    </div>
    <span class="form-control" aria-label="Item price" aria-describedby="basic-addon1">{{ $item->name }}</span>
</div>
