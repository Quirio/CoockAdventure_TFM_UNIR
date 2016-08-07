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

use App\Recetas;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Input;


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
Route::post('/user/recetas/crear', ['middleware' => 'auth', function()
{
	 

        $validator = validator::make(Input::all(), [
            'nombre' => 'required|max:255',
            'descripcion' => 'required|min:5|max:5000',
            'images' => 'required',
        ]);

       

    if ($validator->fails())
    {
        $messages = $validator->messages();
        return Redirect::to('/user/recetas')
            ->withErrors($validator);
    }else {        
        $recetas = new Recetas;

        $recetas->nombreReceta =  Request::input('nombre');

      /*  $recetas->descripcion = Input::post('descripcion');
        $recetas->id_TipoReceta = Input::post('tipo');*/
        $recetas->visualizaciones = 0;
        $recetas->puntuacion = 0.0;
        $recetas->destacado = 0;
        $recetas->activo = 1;
        $recetas->save();

        return Redirect::to('/home');
    }


}]);
