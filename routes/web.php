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

// Stories
Route::get('/stories/draft', 'StoriesController@listDraft')->name('stories.list.draft');
Route::get('/stories', 'StoriesController@list')->name('stories.list');

// Story
Route::get('/story/{story}/reset', 'StoryController@getReset')->name('story.reset');

Route::get('/story/create', 'StoryController@getCreate')->name('story.create');
Route::post('/story/create', 'StoryController@store')->name('story.create.post');
Route::get('/story/{story}/edit', 'StoryController@getEdit')->name('story.edit');

Route::get('/story/{story}/inventory', 'StoryController@inventory')->name('story.inventory');
Route::get('/story/{story}/sheet', 'StoryController@sheet')->name('story.sheet');
Route::post('/story/{story}/page/create/{page?}', 'PageController@create')->name('page.create');
Route::get('/story/{story}/{page?}', 'StoryController@getPlay')->name('story.play');

Route::post('/story/ajax_action', 'StoryController@ajaxAction')->name('story.ajax_action');
Route::post('/story/ajax_get_item', 'StoryController@getItemAjax')->name('story.ajax_getitem');
Route::post('/story/ajax_post_children_pages', 'StoryController@postChildrenPagesAjax')->name('story.ajax_postchildrenpages');

Route::post('/story/{story}/options', 'StoryOptionController@update')->name('story.options.post');
Route::delete('/story/{story}/delete', 'StoryController@delete')->name('story.delete');


// Page
Route::get('/page/{page}/edit', 'PageController@getEdit')->name('page.edit');
Route::post('/page/{page}/edit', 'PageController@postEdit')->name('page.edit.post');
Route::post('/page/{page}/riddle', 'PageController@postRiddle')->name('page.riddle.validate');
Route::delete('/page/{page}/delete', 'PageController@delete')->name('page.delete');
Route::delete('/page/{page}/{page_from}/delete', 'PageController@deleteChoice')->name('page.choice.delete');
Route::get('/page/{story}/list', 'PageController@list')->name('page.list');
Route::get('/page/{page}/choices', 'PageController@availableChoices')->name('page.choices');
Route::get('/page/{pageFrom}/{pageTo}/choice', 'ChoiceController@get')->name('page.choice');
Route::post('/page/choice/{choice}','ChoiceController@update')->name('choice.update');

// Actions
Route::get('/actions/{page}/list', 'ItemPageController@list')->name('item_page.list');
Route::post('/actions/create/{page}', 'ItemPageController@store')->name('item_page.store');
Route::delete('/actions/{action}/delete', 'ItemPageController@delete')->name('item_page.delete');

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
