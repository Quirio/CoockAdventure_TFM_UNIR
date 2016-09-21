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
use App\Http\CapaNegocio\Usuario;
use App\http\CapaNegocio\Personaje;
use App\http\CapaNegocio\Valoracion;
class RecetaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($cdm)
    {
        $recetas = new Receta;
         return View::make('receta')
            ->with('Receta',$recetas->getBycdm($cdm));               
    }

    public function positiva($cdm){
        $recetas = new Receta;
        $personaje = new Personaje;
        $valoracion = new Valoracion;

        $id = $recetas->getBycdm($cdm)->id_usuario;
        $personaje->incrementprestigioByUserID($id);
        $valoracion->insertValoracion($cdm,1);
        return back();
    }

    public function negativa($cdm){
        $recetas = new Receta;
        $personaje = new Personaje;
        $valoracion = new Valoracion;


        $id = $recetas->getBycdm($cdm)->id_usuario;
        $personaje->decrementprestigioByUserID($id);
        $valoracion->insertValoracion($cdm,0);
        return back();
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
