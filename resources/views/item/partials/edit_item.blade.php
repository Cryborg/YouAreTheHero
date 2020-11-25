<input type="hidden" value="{{ $item->id }}" id="item_id_edit">

<div class="form-group row">
    <label for="item_category_edit" class="col-sm-4 col-form-label">@lang('item.category')</label>
    <div class="col-sm-8">
        <input type="text" class="form-control" id="item_category_edit" placeholder="@lang('item.category')" value="{{ $item->category }}">
    </div>
</div>
<div class="form-group row">
    <label for="item_name_edit" class="col-sm-4 col-form-label">@lang('item.name')</label>
    <div class="col-sm-8">
        <input type="text" class="form-control" id="item_name_edit" placeholder="@lang('item.name')" value="{{ $item->name }}">
    </div>
</div>
<div class="form-group row">
    <label for="item_price_edit" class="col-sm-4 col-form-label">@lang('item.price')</label>
    <div class="col-sm-8">
        <input type="number" class="form-control" id="item_price_edit" placeholder="@lang('item.price')" value="{{ $item->default_price }}">
    </div>
</div>
<div class="form-group row">
    <label for="item_size_edit" class="col-sm-4 col-form-label">@lang('item.size')</label>
    <div class="col-sm-8">
        <input type="number" class="form-control" id="item_size_edit" placeholder="@lang('item.size')" value="{{ $item->size }}" step="0.1">
    </div>
</div>
<div class="form-group row">
    <div class="col-sm-4">{{ trans('item.options') }}</div>
    <div class="col-sm-8">
        <div class="form-check">
            <input class="form-check-input" type="checkbox" id="is_unique_edit" @if ($item->is_unique) checked @endif>
            <label class="form-check-label" for="is_unique_edit">@lang('item.is_unique')</label>
        </div>
        <div class="form-check">
            <input class="form-check-input" type="checkbox" id="single_use_edit" @if ($item->single_use) checked @endif>
            <label class="form-check-label" for="single_use_edit">@lang('item.single_use')</label>
        </div>
        <div class="form-check">
            <input class="form-check-input" type="checkbox" id="is_throwable_edit" @if ($item->is_throwable) checked @endif>
            <label class="form-check-label" for="is_throwable_edit">@lang('item.is_throwable')</label>
        </div>
    </div>
</div>
