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

/*Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});*/

Route::group(
    [
    ]
    , function () {
    Route::get('token', 'Auth\Api\ApiController@token')->name('user.token');
    Route::resource('user', 'Auth\Api\ApiController');
    Route::get('roles', 'Auth\Api\ApiController@roles')->name('user.roles');
    Route::resource('chat', 'Chat\ChatController');
    Route::put('votes/{vote}/publish', 'Votes\VotesController@publish')->name('votes.publish');
    Route::post('votes/{vote}/vote', 'Votes\VotesController@vote')->name('votes.vote');
    Route::resource('votes', 'Votes\VotesController');
    Route::resource('document', 'Document\DocumentController');

// append

});
