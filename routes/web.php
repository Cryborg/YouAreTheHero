<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
// Home
Route::get('/', 'HomeController@index')->name('home');

// Items
Route::post('/item/create', 'ItemController@store')->name('item.store');
Route::get('/item/{page}/{item}/take', 'ItemController@take')->name('item.take');
Route::get('/items/{story}/html_list', 'ItemController@htmlList')->name('items.html.list');
Route::get('/item/{item}/throw', 'ItemController@throwAway')->name('item.throw_away');
Route::get('/item/{item}/use', 'ItemController@itemUse')->name('item.use');

// Stories
Route::get('/stories/draft', 'StoriesController@listDraft')->name('stories.list.draft');
Route::get('/stories', 'StoriesController@list')->name('stories.list');

// Story
Route::get('/story/{story}/reset', 'StoryController@getReset')->name('story.reset');

Route::get('/story/create', 'StoryController@getCreate')->name('story.create');
Route::post('/story/create', 'StoryController@store')->name('story.create.post');
Route::get('/story/{story}/edit', 'StoryController@getEdit')->name('story.edit');

Route::get('/story/inventory', 'StoryController@inventory')->name('story.inventory');
Route::get('/story/{story}/sheet', 'StoryController@sheet')->name('story.sheet');
Route::post('/story/{story}/page/create/{page?}', 'PageController@create')->name('page.create');
Route::get('/story/{story}/{page?}', 'StoryController@getPlay')->name('story.play');

Route::post('/story/ajax_post_children_pages', 'StoryController@postChildrenPagesAjax')->name('story.ajax_postchildrenpages');

Route::post('/story/{story}/options', 'StoryOptionController@update')->name('story.options.post');
Route::delete('/story/{story}/delete', 'StoryController@delete')->name('story.delete');


// Page
Route::get('/page/{page}/edit', 'PageController@getEdit')->name('page.edit');
Route::get('/page/{story}/list', 'PageController@list')->name('page.list');
Route::get('/page/{page}/choices', 'PageController@availableChoices')->name('page.choices');
Route::get('/page/{pageFrom}/{pageTo}/choice', 'ChoiceController@get')->name('page.choice');
Route::get('/page/{page}/items/list', 'PageController@listItems')->name('page.items.list');

Route::post('/page/choice/{choice}','ChoiceController@update')->name('choice.update');
Route::post('/page/{page}/edit', 'PageController@postEdit')->name('page.edit.post');
Route::post('/page/{page}/riddle', 'PageController@postRiddle')->name('page.riddle.validate');
Route::post('/page/item/{page}/create', 'PageController@storeItem')->name('page.item.store');

Route::delete('/page/{page}/delete', 'PageController@delete')->name('page.delete');
Route::delete('/page/{page}/{page_from}/delete', 'PageController@deleteChoice')->name('page.choice.delete');
Route::delete('/page/{page}/{item}/item/delete', 'PageController@deleteItem')->name('page.item.delete');

// Prerequisites
Route::post('/prerequisite/store/{page}', 'PrerequisiteController@store')->name('prerequisite.store');
Route::delete('/prerequisite/{prerequisite}/delete', 'PrerequisiteController@delete')->name('prerequisite.delete');

// Authentication
Auth::routes();

// Character
Route::get('/character/create/{story}', 'CharacterController@getCreate')->name('character.create');
Route::post('/character/create/{story}', 'CharacterController@store')->name('character.create.post');

// Language
Route::get('language/{lang}', 'HomeController@language')->name('language');

// Field
Route::post('/field/{story}/create', 'FieldController@store')->name('field.store');
Route::delete('/field/{field}/delete', 'FieldController@delete')->name('field.delete');

// Changelog
Route::get('/changelog', 'HomeController@changelog')->name('changelog');

// Admin
Route::get('/admin', 'AdminController@getIndex')->name('admin');
Route::get('/admin/stories', 'AdminController@getStories')->name('admin.stories');
Route::get('/admin/users', 'AdminController@getUsers')->name('admin.users');
Route::get('/admin/clear-cache', function() {
    Artisan::call('cache:clear');
    return redirect()->route('admin');
})->name('admin.clear.cache');
Route::get('/admin/clear-view', function() {
    Artisan::call('view:clear');
    return redirect()->route('admin');
})->name('admin.clear.view');

// User
Route::get('/user/profile', 'UserController@getProfile')->name('user.profile');
Route::post('/user/{user}/profile', 'UserController@store')->name('user.profile.post');

// Riddle
Route::post('/page/{page}/newriddle', 'RiddleController@store')->name('riddle.store');

// Descriptions
Route::get('/description/{page}', 'DescriptionController@showModal')->name('descriptions.show_modal');
Route::post('/description/{page}', 'DescriptionController@store')->name('description.create');
Route::delete('/description/{description}/delete', 'DescriptionController@delete')->name('description.delete');

// Actions
Route::post('/action/{page}/field/{field}/create', 'ActionController@createField')->name('action.field.create');
Route::post('/action/{page}/item/{item}/create', 'ActionController@createItem')->name('action.item.create');
Route::get('/actions/{page}', 'ActionController@listjs')->name('action.listjs');
Route::delete('/action/{action}/delete', 'ActionController@delete')->name('action.delete');

// Reports
Route::post('/report/{page}/create', 'ReportController@store')->name('report.store');
Route::get('/reports/{story}/list', 'ReportController@index')->name('reports.list');
Route::delete('/report/{report}/delete', 'ReportController@destroy')->name('report.delete');
