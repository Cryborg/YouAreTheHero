<?php

namespace App\Presenters;

use Laracasts\Presenter\Presenter;

class CharacterPresenter extends Presenter
{
    public function money()
    {
        return $this->money . ' <img src="' . asset('img/gold_coin_icon.png') . '" class="money_icon">';
    }
}
