<?php
	use App\Fotos_Recetas;
	class FotosReceta{
		function insert($id_receta,$img_name){
			$fotos = new Fotos_Recetas;
			$fotos->id_receta = $id_receta;
			$fotos->path = storage_path() . '/' . $img_name . '.jpg';
			$fotos->save();
		}
	}
?>