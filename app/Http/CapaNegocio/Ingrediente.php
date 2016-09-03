<?php
	use App\Ingredientes;
	class Ingrediente{
		function insert($nombre){			
			$Coincidencia = Ingredientes::where('nombre','=', $nombre)->first();

			if(empty($Coincidencia)){				
				$Ingrediente = new Ingredientes;
				$Ingrediente->nombre = $nombre;
				$Ingrediente->total_registros = 1;
				$Ingrediente->save();
			}else{
				$Coincidencia->increment('total_registros');
				$Coincidencia->save();
			}
		}
	}
?>