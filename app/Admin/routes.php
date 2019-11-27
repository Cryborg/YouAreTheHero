<?php

use Illuminate\Routing\Router;

Admin::routes();

Route::group([
    'prefix'        => config('admin.route.prefix'),
    'namespace'     => config('admin.route.namespace'),
    'middleware'    => config('admin.route.middleware'),
], function (Router $router) {

    $router->get('/', 'HomeController@index')->name('admin.home');
    $router->get('/list-stories', 'Stories\StoriesListController@list')->name('admin.stories.list');
    $router->get('/list-stories/create', 'Stories\StoryCreateController@create')->name('admin.story.create');
    $router->post('/story/store', 'Stories\StoryCreateController@store')->name('admin.story.store');
    $router->get('/list-pages', 'Pages\PagesListController@list')->name('admin.pages.list');
    $router->get('/list-stories/{id}/edit', 'Stories\StoryEditController@edit')->name('admin.story.edit');
    $router->put('/list-stories/{id}/update', 'Stories\StoryUpdateController@update')->name('admin.story.update');
    $router->get('/page/get-form', 'Pages\PageFormController@form')->name('page.form');
    $router->post('/page/store', 'Pages\PageStoreController@store')->name('admin.page.store');
});
