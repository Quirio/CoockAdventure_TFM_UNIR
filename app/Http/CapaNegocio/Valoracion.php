<?php
	namespace App\Http\CapaNegocio;

	use Illuminate\Support\Facades\Auth;

	use App\Valoraciones;
	class Valoracion{

		function isCreatedValoracion($cdmReceta){
			if(Valoraciones::where('usuario','=', Auth::id())->where('cdmReceta','=',$cdmReceta)
			->count() > 0)
				return true;
			return false;
		}

		function getValoracionesByAuthUserID($cdmReceta){
			return Valoraciones::where('usuario','=', Auth::id())
			->where('cdmReceta','=',$cdmReceta)
			->get();
		}

		function insertValoracion($cdm,$valoracion){
			if(!$this->isCreatedValoracion($cdm)){
				$Valoraciones = new Valoraciones;
			    $Valoraciones->usuario = Auth::id();
		        $Valoraciones->cdmReceta = $cdm;
		        $Valoraciones->valoraciones = $valoracion;
		        $Valoraciones->save();
		    }

		    else{
		    	Valoraciones::where('usuario','=', Auth::id())
		    	->where('cdmReceta','=',$cdm)
          		->update(['valoraciones' => $valoracion]);
		    }
		}
	}
?>