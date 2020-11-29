<?php

namespace App\Providers;

use App\Models\Field;
use App\Models\Item;
use App\Models\CharacterField;
use App\Models\Currency;
use App\Models\Page;
use App\Models\Riddle;
use Illuminate\Support\ServiceProvider;
use Illuminate\Database\Eloquent\Relations\Relation;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        require_once app_path() . '/Helpers/ViewHelper.php';
        require_once app_path() . '/Helpers/Helper.php';
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Relation::morphMap([
           'character_field' => CharacterField::class,
           'field'           => Field::class,
           'item'            => Item::class,
           'currency'        => Currency::class,
           'page'            => Page::class,
           'riddle'          => Riddle::class,
        ]);
    }
}
