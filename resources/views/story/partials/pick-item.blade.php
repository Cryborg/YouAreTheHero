<div class="input-group">
    <div class="input-group-prepend">
        <button class="btn btn-outline-secondary bg-light" data-original-text="@lang('item_page.take')" type="button" data-itemid="{{ $item->id }}">
            @lang('item_page.take')
        </button>
    </div>
    <span class="form-control">{{ $item->name }}</span>
    @if ($item->effects_list()->count() > 0)
        <div class="form-control">
            @include('page.partials.badge_fields')
        </div>
    @endif
</div>
