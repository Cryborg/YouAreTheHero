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
// Authentication
Auth::routes();

// Google Auth
Route::get('/redirect', 'Auth\LoginController@redirectToProvider')->name('google.auth');
Route::get('/callback', 'Auth\LoginController@handleProviderCallback');

// Language
Route::get('language/{lang}', 'HomeController@language')->name('language');

Route::middleware('guest')->group(static function () {
// Anonymous user for tuto
    Route::get('/story/anonymous', 'StoryController@getPlayAnonymous')
         ->name('story.play.anonymous');
});

Route::middleware('auth')->group(static function () {
// Home
    Route::get('/', 'StoryController@index')->name('home');

// Items
    Route::post('/item/create', 'ItemController@store')->name('item.store');
    Route::get('/item/{item}/{page}/take', 'ItemController@take')->name('item.take');
    Route::get('/items/{story}/html_list', 'ItemController@htmlList')->name('items.html.list');
    Route::get('/item/{character_item}/throw', 'ItemController@throwAway')->name('item.throw_away');
    Route::get('/item/{character}/{item}/use', 'CharacterItemController@itemUse')->name('item.use');
    Route::delete('/item/{item}/delete', 'ItemController@delete')->name('item.delete');
    Route::get('/item/{item}/details', 'ItemController@details')->name('item.details');

// Stories
    Route::get('/stories/draft', 'StoryController@indexDraft')->name('stories.list.draft');
    Route::get('/stories', 'StoryController@index')->name('stories.list');

// Story
    Route::get('/story/{story}/reset/{play?}', 'StoryController@getReset')->name('story.reset');

    Route::get('/story/create', 'StoryController@getCreate')->name('story.create');
    Route::post('/story/create', 'StoryController@store')->name('story.create.post');
    Route::get('/story/{story}/edit', 'StoryController@edit')->name('story.edit');

    Route::get('/story/{story}/inventory', 'StoryController@inventory')->name('story.inventory');
    Route::get('/story/{story}/sheet', 'StoryController@sheet')->name('story.sheet');
    Route::post('/story/{story}/page/create/{page?}', 'PageController@create')->name('page.create');
    Route::get('/story/{story}/has_errors', 'StoryController@hasErrors')->name('story.has_errors');
    Route::get('/story/{story}/{page?}', 'StoryController@getPlay')->name('story.play');

    Route::post('/story/ajax_post_children_pages', 'StoryController@postChildrenPagesAjax')->name('story.ajax_postchildrenpages');

    Route::post('/story/{story}/options', 'StoryOptionController@update')->name('story.options.post');
    Route::delete('/story/{story}/delete', 'StoryController@delete')->name('story.delete');

    Route::get('/story/{story}/items/list', 'ItemController@list')->name('items.list');
    Route::get('/story/{story}/items/modal', 'ItemController@modalList')->name('items.modal.list');
    Route::get('/story/{story}/errors/list', 'StoryController@errors')->name('story.errors');

// Page
    Route::get('/page/{page}/edit', 'PageController@edit')->name('page.edit');
    Route::get('/page/{story}/list', 'PageController@list')->name('page.list');
    Route::get('/page/{page}/choices', 'PageController@availableChoices')->name('page.choices');
    Route::get('/page/{pageFrom}/{pageTo}/choice', 'ChoiceController@get')->name('page.choice');
    Route::get('/page/{page}/items/list', 'PageController@listItems')->name('page.items.list');

    Route::post('/page/choice/{choice}','ChoiceController@update')->name('choice.update');
    Route::post('/page/{page}/edit', 'PageController@store')->name('page.store');
    Route::post('/page/{page}/riddle', 'PageController@postRiddle')->name('page.riddle.validate');
    Route::post('/page/{page}/item/create', 'PageController@storeItem')->name('page.item.store');

    Route::delete('/page/{page}/delete', 'PageController@delete')->name('page.delete');
    Route::delete('/page/{page}/{page_from}/delete', 'PageController@deleteChoice')->name('page.choice.delete');
    Route::delete('/page/{page}/{item}/item/delete', 'PageController@deleteItem')->name('page.item.delete');

// Prerequisites
    Route::get('/prerequisite/{page}/list', 'PrerequisiteController@list')->name('prerequisites.list');
    Route::post('/prerequisite/store/{page}', 'PrerequisiteController@store')->name('prerequisite.store');
    Route::delete('/prerequisite/{prerequisite}/delete', 'PrerequisiteController@delete')->name('prerequisite.delete');

// Character
    Route::get('/character/{character}/purse', 'CharacterController@purse')->name('character.purse');
    Route::get('/character/create/{story}', 'CharacterController@getCreate')->name('character.create');
    Route::post('/character/create/{story}', 'CharacterController@store')->name('character.create.post');

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
    Route::get('/user/{user}/profile', 'UserController@getProfile')->name('user.profile.get');
    Route::post('/user/{user}/profile', 'UserController@store')->name('user.profile.post');

// Riddle
    Route::post('/page/{page}/newriddle', 'RiddleController@store')->name('riddle.store');

// Descriptions
    Route::get('/description/{page}', 'DescriptionController@showModal')->name('descriptions.show_modal');
    Route::post('/description/{page}', 'DescriptionController@store')->name('description.create');
    Route::delete('/description/{description}/delete', 'DescriptionController@delete')->name('description.delete');

// Actions
    Route::post('/action/{page}/field/{field}/create', 'ActionController@createField')->name('action.field.create');
    Route::post('/action/{page}/item/create', 'ActionController@createItem')->name('action.item.create');
    Route::get('/actions/{page}', 'ActionController@listjs')->name('action.listjs');
    Route::get('/actions/{page}/list', 'ActionController@list')->name('actions.list');
    Route::delete('/action/{action}/delete', 'ActionController@delete')->name('action.delete');

// Reports
    Route::post('/report/{page}/create', 'ReportController@store')->name('report.store');
    Route::get('/reports/{story}/list', 'ReportController@index')->name('reports.list');
    Route::delete('/report/{report}/delete', 'ReportController@destroy')->name('report.delete');

// Mails
    Route::get('/mail/{user}/{mailable}/preview', 'MailController@preview')->name('mail.preview');
    Route::post('/mail/{user}/{mailable}/send', 'MailController@send')->name('mail.send');

// Persons
    Route::get('/story/{story}/people/list', 'PersonController@index')->name('story.people.list');
    Route::post('/story/{story}/person/store', 'PersonController@store')->name('story.person.store');
    Route::delete('/story/{story}/person/{person}/delete', 'PersonController@destroy')->name('story.person.delete');
});

// Successes
    Route::resource('user.success', UserSuccessController::class);

// Inbox
    Route::get('inbox', 'InboxController@index')->name('inbox.index');
    Route::post('inbox/store', 'InboxController@store')->name('inbox.store');
    Route::post('inbox/{thread}/reply', 'InboxController@reply')->name('inbox.reply');
    Route::get('inbox/{thread}', 'InboxController@show')->name('inbox.show');
    Route::delete('inbox/{thread}/destroy', 'InboxController@destroy')->name('inbox.destroy');
