# Laravel-admin
###### Installation
    composer require encore/laravel-admin
###### Mise en place des assets
    php artisan vendor:publish --provider="Encore\Admin\AdminServiceProvider"
###### Installation et seeding
    php artisan admin:install
###### Permet de créer des seeds à partir de tables
    https://github.com/orangehill/iseed
    php artisan iseed nom_table
