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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/stories', 'StoriesController@list');

Route::get('/stories/ajax_list', 'StoriesController@ajax_list');
Route::post('/story/ajax_action', 'StoryController@ajax_action');

Route::get('/story/inventory/{character}', 'StoryController@inventory');
Route::get('/story/{id}/{page_id?}', 'StoryController@play');
