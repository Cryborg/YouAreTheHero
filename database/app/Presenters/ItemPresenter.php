<?php

namespace App\Presenters;

use Laracasts\Presenter\Presenter;

class ItemPresenter extends Presenter
{
    public function price()
    {
        return $this->default_price . ' <img src="' . asset('img/gold_coin_icon.png') . '" class="money_icon">';
    }
}
