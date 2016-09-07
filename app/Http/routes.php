<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

// Authentication routes...
Route::get('auth/login', 'Auth\AuthController@getLogin');
Route::post('auth/login', 'Auth\AuthController@postLogin');
Route::get('auth/logout', 'Auth\AuthController@getLogout');

// Registration routes...
Route::get('auth/register', 'Auth\AuthController@getRegister');
Route::post('auth/register', 'Auth\AuthController@postRegister');

Route::auth();

Route::get('/',  ['middleware' => 'auth', 'uses' => 'HomeController@index']);
Route::get('/home',  ['middleware' => 'auth', 'uses' => 'HomeController@index']);
Route::get('/user',  ['middleware' => 'auth', 'uses' => 'UserPortal@index']);
Route::get('/user/recetas',  ['middleware' => 'auth', 'uses' => 'UserRecetas@index']);
Route::get('/user/recetas/delete/{cdm}', ['middleware' => 'auth', 'uses' => 'UserRecetas@delete']);
Route::get('/user/recetas/modify/{cdm}', ['middleware' => 'auth', 'uses' => 'UserRecetas@index']);
Route::get('/user/recetas/modify/done/{cdm}', ['middleware' => 'auth', 'uses' => 'UserRecetas@modify']);
Route::get('/images/{filename}', function ($filename)
{
    $path = resource_path("img/$filename.jpg");

    if(!File::exists($path))
    	$path = resource_path("img/$filename.jpeg");
    if(!File::exists($path)) 
    	abort(404);

    $file = File::get($path);
    $type = File::mimeType($path);

    $response = Response::make($file, 200);
    $response->header("Content-Type", $type);

    return $response;
});
Route::post('/user/recetas/crear', ['middleware' => 'auth', 'uses' => 'UserRecetas@insertReceta']);