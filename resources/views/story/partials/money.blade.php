<div class="container">
    <div class="row">
        <div class="col-sm-3 action-label-container">
            {{ $name }}
        </div>
        <div class="col-sm-1 action-label-container action-label effect-value-{{ $operator }}">
            {!! $value !!} <img src=" {{ asset('img/gold_coin_icon.png') }}" class="money_icon">
        </div>
    </div>
</div>
