<?php

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
Route::get('/stories', 'StoriesController@list')->name('stories_list');
Route::get('/stories/ajax_list', 'StoriesController@ajax_list');

// Story
Route::get('/story/{id}/{page_id?}', 'StoryController@play');
Route::get('/story/inventory/{character}', 'StoryController@inventory');
Route::get('/story/sheet/{character}', 'StoryController@sheet');
Route::post('/story/ajax_action', 'StoryController@ajax_action');

// Authentication
Auth::routes();
