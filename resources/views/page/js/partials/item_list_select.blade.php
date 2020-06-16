<select class="selectpicker itemSelectList w-100" id="item_id" name="item_id"
    data-header="@lang('item.select_item')" data-size="6"
    data-live-search="true"
    data-live-search-normalize="true"
    data-none-selected-text="@lang('common.none_selected')">
    @foreach ($items->sortBy('name') as $item)
        <option value="{{ $item->id }}" data-content='
    <div>
        {{ $item->name }}
    </div>
    <div class="select-subtext">
        <div class="text-muted pl-2">
            <span class="mr-2">
                <i>@lang('item.price'):</i> {!! $item->present()->price !!}
            </span>
            <span class="mr-2">
                <i>@lang('item.is_unique'):</i> @if ($item->is_unique) @lang('common.yes') @else @lang('common.no') @endif
            </span>
            <span>
                <i>@lang('item.size'):</i> {{ $item->size }}
            </span>
        </div>
    </div>
</select>'></option>
    @endforeach
</select>
