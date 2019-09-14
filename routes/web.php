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

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::group(
    [
        'prefix' =>'api',
        'middleware'=>'api'
    ]
    , function () {
    Route::get('auth', [
        'as' => 'api.auth.index',
        'uses' => 'Auth\ApiController@index',
        //'middleware' => 'can:expert.experts.index',
        'namespace'=>'Auth'
    ]);
// append

});
/*Route::group([
    'middleware' => ['web', 'installChecker'],
    'namespace'  => 'App\Http\Controllers',
], function () {
    Route::get('install', 'InstallController@starting');
    Route::get('install/site_info', 'InstallController@siteInfo');
    Route::post('install/site_info', 'InstallController@siteInfo');
    Route::get('install/system_compatibility', 'InstallController@systemCompatibility');
    Route::get('install/database', 'InstallController@database');
    Route::post('install/database', 'InstallController@database');
    Route::get('install/database_import', 'InstallController@databaseImport');
    Route::get('install/cron_jobs', 'InstallController@cronJobs');
    Route::get('install/finish', 'InstallController@finish');
});*/
