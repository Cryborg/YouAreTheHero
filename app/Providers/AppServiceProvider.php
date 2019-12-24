<?php

namespace App\Providers;

use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;

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
