<div class="input-group">
    <div class="input-group-prepend">
        <button class="btn btn-outline-secondary" type="button" data-itemid="{{ $item->id }}" title="@lang('item_page.' . $item->pivot->verb)">
            <span class="glyphicon {{ $icon }} mr-2"></span>
            @if (!in_array($item->pivot->verb, ['take']))
                {!! $item->pivot->price !!}
            @endif
        </button>
    </div>
    <span class="form-control" aria-label="Item price" aria-describedby="basic-addon1">{{ $item->name }}</span>
</div>
