<?php
	namespace App\Http\CapaNegocio;

	use App\Cocciones;
	class Coccion{
		function insert($nombre){			
			$Coincidencia = Cocciones::where('nombre','=', $nombre)->first();

			if(empty($Coincidencia)){				
				$coccion = new Cocciones;
				$coccion->nombre = $nombre;
				$coccion->total_registros = 1;
				$coccion->save();
			}else{
				$Coincidencia->increment('total_registros');
				$Coincidencia->save();
			}
		}
	}
?>