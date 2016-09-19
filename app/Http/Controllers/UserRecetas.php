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
use App\Http\CapaNegocio\Personaje as PJ;
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
    public function index($cdm = NULL)
    {   
        $recetas = new Receta;
        $personaje = new PJ;
        $modifycdm = NULL;
        $recetaToModify = NULL;
        if(isset($cdm)){
          $modifycdm = $cdm;
          $recetaToModify = $recetas->getBycdm($cdm);
        }

        $personaje= $personaje->getPersonajeByAuthUserID();
        $nivel = $personaje->nivel;
        $progreso = ($personaje->prestigioNivel/2000)*100;

        return View::make('userRecetas')
                ->with('tipos', Tipos_Recetas::all())
                ->with('RecetasTime',$recetas->getAllByTimeByAuthUser(0))
                ->with('MejoresRecetas',$recetas->getBestRecipesByAuthUser())                
                ->with('modifyCdm',$cdm)
                ->with('recetaToModify',$recetaToModify)
                ->with('NRecetasUsuario',$recetas->getCantidaRecetasByUser())
                ->with('nivel',$nivel )
                ->with('progreso',$progreso);
    }

    private function randomString($length = 6) {
      $str = "";
      $characters = array_merge(range('A','Z'), range('a','z'), range('0','9'));
      $max = count($characters) - 1;
      for ($i = 0; $i < $length; $i++) {
        $rand = mt_rand(0, $max);
        $str .= $characters[$rand];
      }
      return $str;
    }

    public function delete($cdm){
      $recetas = new Receta;
      if($recetas->removebycdmid($cdm))
        return Redirect::to('user/recetas'); 
    }

    public function change($cdm){
      $validator = validator::make(Input::all(), [
            'nombre' => 'required|max:255',
            'descripcion' => 'required|min:5|max:5000',
            'coccion' => 'required',
            'ingredientes' => 'required'
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

            $count = 0 ;
            if($file_count > 0){
              foreach ($files as $img) {
                $fileNameFinal = $cdm."$count.".$img->getClientOriginalExtension();
                $img->move(resource_path().'/img',$fileNameFinal);
                $count ++;
              }
            }

            $receta->   modifybycmdid(Request::input('nombre'),Request::input('descripcion'),Request::input('tipo'),$cdm,$file_count);

            $ingredientes_input = explode(',',Request::input('ingredientes'));
            $coccion_input = explode(',', Request::input('coccion'));

            foreach ($ingredientes_input as $key)
              $ingrediente->insert($key);    

            foreach ($coccion_input as $key) 
              $coccion->insert($key);           
           
             if($count == $file_count)
                Session::flash('success', 'Upload successfully');  
             else
                Session::flash('message', 'Imagenes subidas: '. $files);
             return Redirect::to('user/recetas');        
           
        }   

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
            $cdm = $this->randomString();

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
           
             if($count == $file_count)
                Session::flash('success', 'Upload successfully');  
             else
                Session::flash('message', 'Imagenes subidas: '. $files);
             return Redirect::to('user/recetas');           
           
        }
    }
}
