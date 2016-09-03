<?php
	use App\Recetas;
	class Receta{
		private $id_lastInsert;
		function insert($nombre,$descripcion,$tipo){
			$recetas = new Recetas;
			$recetas->nombreReceta = $nombre; 
			$recetas->descripcion = $descripcion;
			$recetas->id_TipoReceta = $tipo;
	        $recetas->visualizaciones = 0;
	        $recetas->puntuacion = 0.0;
	        $recetas->destacado = 0;
	        $recetas->activo = 1;
	        $recetas->id_usuario = Auth::id();
	        $recetas->save();

	        $this->id_lastInsert = $recetas->id;
		}

		function getUltimaCreada(){
			$recetas = new Recetas;
			return $recetas->find($this->id_lastInsert);
		}

		function getTipoByID($id){
			$recetas = new Recetas;
			return $recetas->find($id)['id_TipoReceta'];
		}
	}
?>