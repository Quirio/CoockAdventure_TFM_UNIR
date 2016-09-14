<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\View;

use App\Http\Requests;
use Illuminate\Http\Request;

use App\Http\CapaNegocio\Receta;
use App\Http\CapaNegocio\Ingrediente;
use App\Http\CapaNegocio\Coccion;
use App\Http\CapaNegocio\FotosReceta;

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
        $recetas = new Receta;
        return View::make('home')
                ->with('RecetasTime',$recetas->getAllByTime(0))
                ->with('MejoresRecetas',$recetas->getBestRecipes());
    }

}
