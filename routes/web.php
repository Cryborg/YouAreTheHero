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
Route::get('/stories', 'StoriesController@list')->name('stories.list');
Route::get('/stories/ajax_list', 'StoriesController@ajax_list')->name('stories.list.ajax');

// Story
Route::get('/story/{story}/inventory', 'StoryController@inventory')->name('story.inventory');
Route::get('/story/{story}/sheet', 'StoryController@sheet')->name('story.sheet');;
Route::get('/story/{story}/{page}/choices', 'StoryController@choices')->name('story.choices');;
Route::get('/story/{story}/{page?}', 'StoryController@play')->name('story.play');;
Route::post('/story/ajax_action', 'StoryController@ajax_action')->name('story.ajax_action');;

// Authentication
Auth::routes();
