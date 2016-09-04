<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\View;

//use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Auth;

use App\Http\Requests;
use App\Tipos_Recetas;

use App\Http\CapaNegocio\Receta;
use App\Http\CapaNegocio\Ingrediente;
use App\Http\CapaNegocio\Coccion;


class UserRecetas extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $recetas = new Receta;
        return View::make('userRecetas')
                ->with('tipos', Tipos_Recetas::all())
                ->with('RecetasTime',$recetas->getAllByTime(0))
                ->with('MejoresRecetas',$recetas->getBestRecipes())
                ->with('NRecetasUsuario',$recetas->getCantidaRecetasByUser());
    }

    public function insertReceta(){
       $validator = validator::make(Input::all(), [
            'nombre' => 'required|max:255',
            'descripcion' => 'required|min:5|max:5000',
            'coccion' => 'required',
            'ingredientes' => 'required'/*,
            'images' => 'required'*/
        ]);

        if ($validator->fails())
        {
            $messages = $validator->messages();
            return Redirect::to('/user/recetas')       
                ->withErrors($validator);
        }else {
            $receta = new Receta;
            $ingrediente = new Ingrediente;
            $coccion = new Coccion;

            $receta->insert(Request::input('nombre'),Request::input('descripcion'),Request::input('tipo'));

            $ingredientes_input = explode(',',Request::input('ingredientes'));
            $coccion_input = explode(',', Request::input('coccion'));

            foreach ($ingredientes_input as $key)
              $ingrediente->insert($key);    

            foreach ($coccion_input as $key) 
              $coccion->insert($key);
            

            return Redirect::to('/home');
        }
    }
}
