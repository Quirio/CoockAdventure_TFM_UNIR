<?php
	namespace App\Http\CapaNegocio;

	use Illuminate\Support\Facades\Auth;

	use App\Personajes;
	class Personaje{
		private $personaje;
		private $variacion_prestigio;

		function Personaje(){
			$this->$personaje = new Personajes;
			$this->variacion_prestigio = 10;
		}

		function createPersonaje(){
			$personajes = new Personajes;
			if($this->issetPersonajeOfAuthUser() == 0){				
				$personajes->usuario = Auth::id(); 
		        $personajes->save();
		    }
		}

		function getPersonajeByUserID($id){
			return Personajes::where('usuario','=', $id)->get()[0];
		}

		function getPersonajeByAuthUserID(){
			return Personajes::where('usuario','=', Auth::id())->get()[0];
		}

		function issetPersonajeOfAuthUser(){
			return Personajes::where('usuario','=', Auth::id())->count();
		}

		function incrementprestigioByUserID($id){
			$variacion_prestigio = 10;
			$personaje = Personajes::where('usuario','=', $id)->get()[0];
			Personajes::where('usuario','=', $id)
				->update(['prestigioTotal' => $personaje->prestigioTotal+$variacion_prestigio,'prestigioNivel' => $personaje->prestigioNivel+$variacion_prestigio]);
		}
	}
?>