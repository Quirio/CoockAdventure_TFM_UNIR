<?php
	namespace App\Http\CapaNegocio;

	use App\Fotos_Recetas;
	class FotosReceta{
		function insert($id_receta,$img_name){
			$fotos = new Fotos_Recetas;
			$fotos->id_receta = $id_receta;
			$fotos->path = $img_name;
			$fotos->save();
		}

		function getImagenesReceta(){
			return Fotos_Recetas::all();
		}
	}
?>