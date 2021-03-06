<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\View;

use App\Http\Requests;
use Illuminate\Http\Request;

use App\Http\CapaNegocio\Receta;
use App\Http\CapaNegocio\Usuario;
use App\Http\CapaNegocio\Ingrediente;
use App\Http\CapaNegocio\Coccion;
use App\Http\CapaNegocio\FotosReceta;
use App\Http\CapaNegocio\Personaje as PJ;
use App\Http\CapaNegocio\Valoracion;

class HomeController extends Controller
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
        $personaje = new PJ;
        $personaje->createPersonaje();
        $personaje= $personaje->getPersonajeByAuthUserID();

        $recetas = new Receta;
        $recetasTime = $recetas->getAllByTime(0);

        $valoraciones = new Valoracion;
        $usuario = new Usuario;
        $creadoresRecetas = [];
        $valoracionesRecetas = [];

        foreach ($recetasTime as $receta){
            $creadoresRecetas[$receta->cdm] = $usuario->getUsuarioByid($receta->id_usuario);
            $valoracionesRecetas[$receta->cdm] = $valoraciones->getValoracionesByAuthUserID($receta->cdm);
        }
        

        $nivel = $personaje->nivel;
        $progreso = ($personaje->prestigioNivel/200)*100;


        return View::make('home')
                ->with('RecetasTime',$recetasTime)
                ->with('CreadoresRecetas',$creadoresRecetas)
                ->with('ValoracionesRecetas',$valoracionesRecetas)
                ->with('MejoresRecetas',$recetas->getBestRecipes())
                ->with('NRecetasUsuario',$recetas->getCantidaRecetasByUser())
                ->with('nivel',$nivel )
                ->with('progreso',$progreso);
    }

}
