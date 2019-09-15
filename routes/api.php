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

Route::group(
    [
    ]
    , function () {
    Route::get('roles', 'Auth\Api\ApiController@roles');
    Route::resource('chat', 'Chat\ChatController');
    Route::resource('user', 'Auth\Api\ApiController');
    Route::put('votes/{vote}/publish', 'Votes\VotesController@publish')->name('votes.publish');
    Route::resource('votes', 'Votes\VotesController');


// append

});
