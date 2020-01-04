<div class="row">
    <div class="col">
        {{ __('common.money') }}{{ __(':') }} <span id="character_money">{!! $character->money !!}</span>
    </div>
</div>
<div class="row">
    <div class="col">
        <ul>
            @foreach ($items as $item)
                <li>{{ $item['quantity'] }} * {{ $item['item']->name }}</li>
            @endforeach
        </ul>
    </div>
</div>
