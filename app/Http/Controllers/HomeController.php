<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\View;

use App\Http\Requests;
use Illuminate\Http\Request;

use App\Http\CapaNegocio\Receta;
use App\Http\CapaNegocio\Ingrediente;
use App\Http\CapaNegocio\Coccion;
use App\Http\CapaNegocio\FotosReceta;
use App\Http\CapaNegocio\Personaje as PJ;

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
        $nivel = $personaje->nivel;
        $progreso = ($personaje->prestigioNivel/200)*100;
        $recetas = new Receta;

        return View::make('home')
                ->with('RecetasTime',$recetas->getAllByTime(0))
                ->with('MejoresRecetas',$recetas->getBestRecipes())
                ->with('NRecetasUsuario',$recetas->getCantidaRecetasByUser())
                ->with('nivel',$nivel )
                ->with('progreso',$progreso);
    }

}
