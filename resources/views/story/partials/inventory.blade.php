<div class="row">
    <div class="col">
        <div class="card">
            <div class="card-header">
                @lang('common.money')@lang(':') {{ $character->money }}
            </div>
            <div class="card-header">
                @lang('common.inventory')
            </div>
            <div class="card-body">
                <ul>
                    @foreach ($character->items as $item)
                        <li data-toggle="popover" data-trigger="hover" data-content="">
                            @if ($item->pivot->quantity > 1)
                                {{ $item->pivot->quantity }} *
                            @endif
                            {{ $item->name }}
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
</div>
