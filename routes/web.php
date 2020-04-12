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
Route::get('/stories/ajax_list', 'StoriesController@ajaxList')->name('stories.list.ajax');

// Story
Route::get('/story/{story}/reset', 'StoryController@getReset')->name('story.reset');

Route::get('/story/create', 'StoryController@getCreate')->name('story.create');
Route::post('/story/create', 'StoryController@store')->name('story.create.post');
Route::get('/story/{story}/edit', 'StoryController@getEdit')->name('story.edit');

Route::get('/story/{story}/tree', 'StoryController@getTree')->name('story.tree');
Route::get('/story/{story}/inventory', 'StoryController@inventory')->name('story.inventory');
Route::get('/story/{story}/sheet', 'StoryController@sheet')->name('story.sheet');
Route::get('/story/{story}/page/create/{page?}', 'PageController@getCreate')->name('page.create');
Route::get('/story/{story}/{page}/choices', 'StoryController@choices')->name('story.choices');
Route::get('/story/{story}/{page?}', 'StoryController@getPlay')->name('story.play');

Route::post('/story/ajax_action', 'StoryController@ajaxAction')->name('story.ajax_action');
Route::post('/story/ajax_get_item', 'StoryController@getItemAjax')->name('story.ajax_getitem');
Route::post('/story/ajax_post_children_pages', 'StoryController@postChildrenPagesAjax')->name('story.ajax_postchildrenpages');

Route::post('/story/{story}/options', 'StoryOptionsController@update')->name('story.options.post');


// Page
Route::get('/page/{page}/edit', 'PageController@getEdit')->name('page.edit');
Route::post('/page/{page}/edit', 'PageController@postEdit')->name('page.edit.post');
Route::post('/page/{page}/riddle', 'PageController@postRiddle')->name('page.riddle.validate');

// Actions
Route::get('/actions/{page}/list', 'ActionController@list')->name('actions.list');
Route::post('/actions/create/{page}', 'ActionController@store')->name('actions.store');
Route::delete('/actions/{action}/delete', 'ActionController@delete')->name('actions.delete');

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

// StatStory
Route::post('/stat/{story}/create', 'StatStoryController@store')->name('stat.store');
Route::delete('/stat/{stat_story}/delete', 'StatStoryController@delete')->name('stat.delete');

// Changelog
Route::get('/changelog', 'HomeController@changelog')->name('changelog');

// Admin
Route::get('/admin', 'AdminController@getIndex')->name('admin');
Route::get('/admin/stories', 'AdminController@getStories')->name('admin.stories');
Route::get('/admin/users', 'AdminController@getUsers')->name('admin.users');

// User
Route::get('/user/profile', 'UserController@getProfile')->name('user.profile');
Route::post('/user/{user}/profile', 'UserController@store')->name('user.profile.post');

// Riddle
Route::post('/page/{page}/newriddle', 'RiddleController@store')->name('riddle.store');
