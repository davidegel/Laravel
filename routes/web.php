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

Route::get('user/event',['uses' => 'UserController@eventUser'])->name('user_event');

Route::get('user/ajax/resources',['uses' => 'UserController@ajaxResources']);
Route::get('user/ajax',['uses' => 'UserController@ajax']);
Route::post('user/ajax/post',['as' => 'ajaxPost','uses' => 'UserController@ajaxPost']);

Route::get('user/access',['as' => 'user_access', 'uses' => 'UserController@accessUser']);

Route::post('user/registrazioneUtente',['as' => 'user_code_generate', 'uses' => 'UserController@registrazioneUtente']);
Route::get('user/verifyCode/{email}/{param}',['as' => 'user_code_verify', 'uses' => 'UserController@verifyCode']);
Route::get('user/formRegistrazione',['as' => 'user_register', 'uses' => 'UserController@formRegistrazione']);


Route::get('user/create',['as' => 'creates', 'uses' => 'UserController@createUser']);

Route::get('user/profile/{name?}', ['as' => 'profile', 'uses' => 'UserController@index']);

Route::get('dashboard', function () {
    return redirect()->route('utente', ['name' => 'giulio']);
});

Route::get('user/{name?}',['as' => 'utente', function ($name = null) {
    return 'User '.$name;
}])->where('name', '[A-Za-z]+');


Route::group(array('prefix' => 'admin'), function()
{
    
    Route::get('/testata', function()
    {
        return View::make('admin.dashboard');
    });

});

Route::get('/login',['as' => 'loginDavide', 'uses' => 'DavideController@login']);

Route::group(['prefix' => 'davide',['middleware' => ['web','auth','amm','role:admin|owner']]], function() {

    Route::match(['GET', 'POST'], '/richiesta', ['as' => 'davideReq', 'uses' => 'DavideController@richiesta']);
    Route::get('/amministrazione',['as' => 'ammDavide', 'uses' => 'DavideController@amministrazione']);
    Route::get('/logout',['as' => 'logout', 'uses' => 'DavideController@logout']);
    Route::get('/json',['as' => 'json', 'uses' => 'DavideController@json']);
    Route::post('/authenticate',['as' => 'authenticate', 'uses' => 'DavideController@authenticate']);
});


Route::group(['prefix' => 'utente',['middleware' => ['web']]], function() {

    Route::get('/login',['uses' => 'UserAccess@login']);
    Route::post('/access',['uses' => 'UserAccess@access'])->name('access');

});


Route::group(['middleware' => 'auth'], function () {
    
    Route::get('/privata',['uses' => 'UserController@riservata'])->name('riservata');
});
