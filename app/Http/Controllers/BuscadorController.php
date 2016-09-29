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

class BuscadorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {   
        $personaje = new PJ;
        $recetas = new Receta;

        $nivel = $personaje->nivel;
        $progreso = ($personaje->prestigioNivel/200)*100;
        
        return View::make('buscador')
                ->with('NRecetasUsuario',$recetas->getCantidaRecetasByUser())
                ->with('nivel',$nivel )
                ->with('progreso',$progreso);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
