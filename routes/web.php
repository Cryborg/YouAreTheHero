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

// Stories
Route::get('/stories/draft', 'StoriesController@listDraft')->name('stories.list.draft');
Route::get('/stories', 'StoriesController@list')->name('stories.list');
Route::get('/stories/ajax_list', 'StoriesController@ajaxList')->name('stories.list.ajax');

// Story
Route::get('/story/create', 'StoryController@getCreate')->name('story.create');
Route::post('/story/create', 'StoryController@postCreate')->name('story.create.post');

Route::get('/story/{story}/edit', 'StoryController@getEdit')->name('story.edit');
Route::post('/story/{story}/edit', 'StoryController@postEdit')->name('story.edit.post');

Route::get('/story/{story}/inventory', 'StoryController@inventory')->name('story.inventory');
Route::get('/story/{story}/sheet', 'StoryController@sheet')->name('story.sheet');
Route::get('/story/{story}/page/create', 'PageController@getCreate')->name('page.create');
Route::get('/story/{story}/{page}/choices', 'StoryController@choices')->name('story.choices');
Route::get('/story/{story}/{page?}', 'StoryController@getPlay')->name('story.play');
Route::post('/story/ajax_action', 'StoryController@ajaxAction')->name('story.ajax_action');

// Page
Route::get('/page/{page}/edit', 'PageController@getEdit')->name('page.edit');
Route::post('/page/{page}/edit', 'PageController@postEdit')->name('page.edit.post');

// Authentication
Auth::routes();
