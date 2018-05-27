<?php
use Illuminate\Notifications\RoutesNotifications;

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


/*-------------------------------------------------------------------------
| Main Routes
|------------------------------------------------------------------------*/
Route::get('/', function () {return redirect('home');});
Route::get('home', 'EventController@home')->name('home')->middleware('nocache');
Route::get('/info/ref', function () {return view('references');});
Route::get('/autherror', function () {return view('auth/autherror');})->name('autherror');
Route::get('/notapproved', function () {return view('auth/notapproved');})->name('notapproved');

/*-------------------------------------------------------------------------
| Account Routes
|------------------------------------------------------------------------*/
Auth::routes();
Route::get('myaccount', 'AccountController@alleventsByUser')->name('myaccount')->middleware('customauth');
Route::post('myaccount', 'EventController@delete')->middleware('customauth');
Route::post('myaccount/basic', 'AccountController@updateAccountInfo')->middleware('customauth');
Route::post('myaccount/password', 'AccountController@postChangePassword')->middleware('customauth');

/*-------------------------------------------------------------------------
| Event Routes
|------------------------------------------------------------------------*/
// All events
Route::get('events', 'EventController@allevents')->name('allevents')->middleware('nocache');

//Single event
Route::get('event/{id}', 'EventController@event')->name('event')->middleware('nocache');
Route::post('event/{id}', 'EventController@registerInterest');

// Add event
Route::get('addevent', 'EventController@createForm')->name('addevent')->middleware('customauth','userapproved');
Route::post('addevent', 'EventController@create')->middleware('customauth', 'userapproved');

//Update event
Route::get('updateevent/{id}', 'EventController@updateForm')->name('updateevent')->middleware('nocache', 'customauth', 'userapproved');
Route::post('updateevent/{id}', 'EventController@update')->middleware('customauth', 'userapproved');
