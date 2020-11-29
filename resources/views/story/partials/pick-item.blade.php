<div class="input-group">
    <div class="input-group-prepend">
        <button class="btn btn-outline-secondary bg-light" data-original-text="@lang('item_page.take')" type="button" data-itemid="{{ $item->id }}">
            @if ($item->pivot->price > 0)
                @lang('item_page.buy', ['price' => $item->pivot->price])
            @else
                @lang('item_page.take')
            @endif
        </button>
    </div>
    <span class="form-control">{{ $item->name }}</span>
    @if ($item->fields()->count() > 0)
        <div class="form-control">
            @foreach ($item->fields as $field)
                @include('page.partials.badge_fields', ['field' => $field])
            @endforeach
        </div>
    @endif
</div>
