<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});


Route::post('auth/register','Api\AuthController@register');
Route::post('auth/login','Api\AuthController@login');
Route::group(['middleware'=>'jwt.auth'], function(){

    Route::get('auth/user','Api\AuthController@user');
    Route::get('auth/refresh', 'Api\AuthController@refresh');
    Route::post('auth/logout','Api\AuthController@logout');
    Route::get('calendar/{calendar}', 'Api\CalendarController@show');
    Route::post('calendar', 'Api\CalendarController@store');
    Route::put('calendar/{calendar}', 'Api\CalendarController@update');
    Route::delete('calendar/{calendar}', 'Api\CalendarController@delete');
    Route::get('calendar', 'Api\CalendarController@index');
    Route::get('event', 'Api\EventController@index');
    Route::get('event/{event}', 'Api\EventController@show');
    Route::get('events/{calendar}', 'Api\EventController@getByCalendar');
    Route::get('events/{calendar}/{amount}', 'Api\EventController@getLast');
    Route::post('event', 'Api\EventController@store');
    Route::put('event/{event}', 'Api\EventController@update');
    Route::delete('event/{event}', 'Api\EventController@delete');

});
