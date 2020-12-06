<div class="card-header">
    <span class="icon-backpack display-5 mr-2"></span>
    @lang('common.inventory')
</div>
<div class="card-header purse-block">
    @lang('common.money')@lang(':') {{ $character->money }}
</div>
<div class="card-body">
    @foreach ($items as $category => $catItem)
        <div class="card card-no-padding">
            @if (count($items) > 1)
                <div class="card-header bg-inventory-category">{{ $category }}</div>
            @endif
            @foreach ($catItem as $item)
                @if (!$item->pivot->is_used)
                    <div class="card-body">
                        <div class="collapse navbar-collapse show">
                        <span class="p-2 float-left" data-id="popup-{{ $item->pivot->id }}">
                            {{ $item->name }}

                            @if ($item->pivot->quantity > 1)
                                x{{ $item->pivot->quantity }}
                            @endif
                        </span>

                            @if ($item->is_throwable || $item->triggers()->count() > 0 || $item->fields()->count() > 0 || $item->equipment_id !== null)
                                <ul class="navbar-nav ml-auto float-right">
                                    <li class="nav-item dropdown">
                                        <a class="nav-link" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            <span class="icon-menu-dots display-6 text-black clickable"></span>
                                        </a>

                                        <div class="dropdown-menu dropdown-menu-right shadow-lg">
                                            @if ($item->triggers()->count() > 0)
                                                @foreach ($item->triggers as $trigger)
                                                    @if ($trigger->actionable instanceof \App\Models\Location)
                                                        <a class="clickable dropdown-item itemUseMap"
                                                            data-itemid="{{ $item->id }}" data-characterid="{{ $character->id }}">@lang('item.use_map')</a>
                                                        @break
                                                    @endif
                                                @endforeach
                                            @endif

                                            @if ($item->equipment_id !== null)
                                                <a class="clickable dropdown-item itemEquip"
                                                    data-itemid="{{ $item->id }}" data-characterid="{{ $character->id }}">@lang('item.equip')</a>
                                            @endif
                                            @if ($item->fields()->count() > 0)
                                                <a class="clickable dropdown-item itemUse"
                                                    data-itemid="{{ $item->id }}" data-characterid="{{ $character->id }}">@lang('item.use')</a>
                                            @endif
                                            @if ($item->is_throwable)
                                                <a class="clickable dropdown-item itemThrowAway"
                                                    data-characteritemid="{{ $item->pivot->id }}">@lang('item.throw_away')</a>
                                            @endif
                                        </div>
                                    </li>
                                </ul>
                            @endif
                        </div>
                    </div>
                @endif
            @endforeach
        </div>
    @endforeach
</div>
<div class="card-header">
    @lang('equipment.label')
</div>
<div class="card-body equipment-block">
    @foreach ($character->equippedItems as $item)
        <div class="p-2">
            <i class="text-muted">{{ $item->equippedOn()->slot }}</i> {{ $item->name }}
        </div>
    @endforeach
</div>
