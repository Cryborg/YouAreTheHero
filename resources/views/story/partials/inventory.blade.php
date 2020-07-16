@foreach ($items as $category => $catItem)
    @if (count($items) > 1)
        <h5>{{ $category }}</h5>
    @endif
    <ul>
        @foreach ($catItem as $item)
            @if (!$item->pivot->is_used)
                <div data-toggle="popover" data-trigger="hover" data-content="">
                    <li>
                        @if ($item->pivot->quantity > 1)
                            {{ $item->pivot->quantity }} *
                        @endif
                        <a class="clickable itemThrowAwayMenu" data-id="popup-{{ $item->id }}"
                            data-itemid="{{ $item->id }}">
                            {{ $item->name }}
                            <div class="popup-menu border border-dark w-75 shadow" style="display:none" data-popupid="popup-{{ $item->id }}">
                                <div class="highlight-hover p-2 clickable itemUse">@lang('item.use')</div>
                                <div class="highlight-hover p-2 clickable itemThrowAway">@lang('item.throw_away')</div>
                            </div>
                        </a>
                    </li>
                </div>
            @endif
        @endforeach
    </ul>
@endforeach
