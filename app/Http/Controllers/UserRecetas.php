<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\View;

//use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

use App\Http\Requests;
use App\Tipos_Recetas;

use App\Http\CapaNegocio\Receta;
use App\Http\CapaNegocio\Ingrediente;
use App\Http\CapaNegocio\Coccion;
use App\Http\CapaNegocio\FotosReceta;


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
                ->with('NRecetasUsuario',$recetas->getCantidaRecetasByUser())
                ->with('Imagenes',"");
    }

    public function insertReceta(){
       $validator = validator::make(Input::all(), [
            'nombre' => 'required|max:255',
            'descripcion' => 'required|min:5|max:5000',
            'coccion' => 'required',
            'ingredientes' => 'required',
            'images' => 'required'
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

            $files = Input::file('images');
            $file_count = count($files);
            $cdm = rand(11111,99999);

            $count = 0 ;
            foreach ($files as $img) {
              $fileNameFinal = $cdm."$count.".$img->getClientOriginalExtension();
              $img->move(resource_path().'/img',$fileNameFinal);
              $count ++;
            }

            $receta->insert(Request::input('nombre'),Request::input('descripcion'),Request::input('tipo'),$cdm,$file_count);

            $ingredientes_input = explode(',',Request::input('ingredientes'));
            $coccion_input = explode(',', Request::input('coccion'));

            foreach ($ingredientes_input as $key)
              $ingrediente->insert($key);    

            foreach ($coccion_input as $key) 
              $coccion->insert($key);           
           
            

             if($count == $file_count){
                  Session::flash('success', 'Upload successfully'); 
                  return Redirect::to('/home');
              }

              else{
                Session::flash('message', 'Imagenes subidas: '. $files);
                return Redirect::to('user/recetas'); 
              } 
           
        }
    }
}
