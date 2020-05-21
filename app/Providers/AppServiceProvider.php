<?php

namespace App\Providers;

use App\Models\Field;
use App\Models\Item;
use App\Models\CharacterField;
use App\Models\Page;
use App\Models\Riddle;
use Illuminate\Support\Facades\Blade;
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
           'item' => Item::class,
           'riddle' => Riddle::class,
           'page' => Page::class,
           'field' => Field::class,
        ]);

        Blade::directive('info', function ($expression) {
            return '<div class="alert alert-info d-flex flex-row">' .
                        '<i class="glyphicon glyphicon-info-sign mr-3"></i>' .
                           '<div>' .
                                $expression .
                           '</div>' .
                    '</div>';
        });
        Blade::directive('warning', function ($expression) {
            return '<div class="alert alert-warning d-flex flex-row">' .
                        '<i class="glyphicon glyphicon-warning-sign mr-3"></i>' .
                           '<div>' .
                                $expression .
                           '</div>' .
                    '</div>';
        });
        Blade::directive('danger', function ($expression) {
            return '<div class="alert alert-danger d-flex flex-row">' .
                        '<i class="glyphicon glyphicon-exclamation-sign mr-3"></i>' .
                           '<div>' .
                                $expression .
                           '</div>' .
                    '</div>';
        });
    }
}
