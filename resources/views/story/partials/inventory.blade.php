@foreach ($items as $category => $catItem)
    <div class="card card-no-padding">
        @if (count($items) > 1)
            <div class="card-header bg-inventory-category">{{ $category }}</div>
        @endif
        @foreach ($catItem as $item)
            @if (!$item->pivot->is_used)
                <div class="card-body">
                    <div data-toggle="popover" data-trigger="hover" data-content="">
                        @if ($item->pivot->quantity > 1)
                            {{ $item->pivot->quantity }} *
                        @endif
                        <a class="clickable itemThrowAwayMenu" data-id="popup-{{ $item->pivot->id }}" data-itemid="{{ $item->id }}" data-characterid="{{ $character->id }}" data-characteritemid="{{ $item->pivot->id }}">
                            {{ $item->name }}
                            @if ($item->is_throwable || $item->effects()->count() > 0)
                                <div class="popup-menu border border-dark w-75 shadow" style="display:none" data-popupid="popup-{{ $item->pivot->id }}">
                                    @if ($item->effects()->count() > 0)
                                        <div class="highlight-hover p-2 clickable itemUse">@lang('item.use')</div>
                                    @endif
                                    @if ($item->is_throwable)
                                        <div class="highlight-hover p-2 clickable itemThrowAway">@lang('item.throw_away')</div>
                                    @endif
                                </div>
                            @endif
                        </a>
                    </div>
                </div>
            @endif
        @endforeach
    </div>
@endforeach
