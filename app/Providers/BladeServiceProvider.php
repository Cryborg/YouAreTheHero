<?php

namespace App\Providers;

use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;

class BladeServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        Blade::directive('info', static function ($expression) {
            return '<div class="alert alert-info d-flex flex-row">' .
               '<i class="icon-info mr-3 display-6 text-primary"></i>' .
               '<div>' .
                   $expression .
               '</div>' .
           '</div>';
        });
        Blade::directive('warning', static function ($expression) {
            return '<div class="alert alert-warning d-flex flex-row">' .
               '<i class="icon-warning mr-3"></i>' .
               '<div>' .
                   $expression .
               '</div>' .
           '</div>';
        });
        Blade::directive('danger', static function ($expression) {
            return '<div class="alert alert-danger d-flex flex-row">' .
               '<i class="glyphicon glyphicon-exclamation-sign mr-3"></i>' .
               '<div>' .
                   $expression .
               '</div>' .
           '</div>';
        });
        Blade::directive('editorbutton', static function ($expression) {
            return '<button class="note-btn btn btn-light btn-sm btn-outline-secondary">' .
               $expression .
           '</button>';
        });
    }
}
