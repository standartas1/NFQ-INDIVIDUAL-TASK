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

Route::get('/', 'MeetingsController@index');
Route::get('/meetings', 'MeetingsController@index');

Route::get('/meetings/create', 'MeetingsController@create')->name('meeting-create');
Route::post('/meetings/store', 'MeetingsController@store')->name('meeting-store');

Route::get('/meetings/find', 'MeetingsController@find')->name('meeting-find');
Route::get('/meetings/findId', 'MeetingsController@findId')->name('meeting-find-id');

Route::get('/meetings/cancel', 'MeetingsController@cancelMeeting')->name('meeting-cancel');
Route::get('/meetings/cancelId', 'MeetingsController@cancelMeetingId')->name('meeting-cancel-id');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home')->middleware('auth');
Route::get('/home/meetings', 'MeetingsController@viewAllMeetings')->name('meeting-view')->middleware('auth');
Route::get('/home/personalMeetings', 'MeetingsController@viewPersonalMeetings')->name('personal-view')->middleware('auth');
Route::get('/home/displayBoard', 'MeetingsController@viewDisplayBoardMeetings')->name('display-view')->middleware('auth');

Route::get('/meetings/{id}/edit', 'MeetingsController@edit')->name('meeting-edit')->middleware('auth');
Route::patch('/meetings/{id}/edit', 'MeetingsController@update')->name('meeting-update')->middleware('auth');

// Kad nebutu galima prisiregistruoti
Route::get('/register', function() {
    return view('customAuth.newLogin');
});