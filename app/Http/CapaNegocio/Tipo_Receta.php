<?php
	use App\Tipos_Recetas;
	class Tipo_Receta{
		function add_one($id){
			$Tipos_Recetas = new Tipos_Recetas;
			$Tipos_Recetas->where('id', $id)->increment('total_registros');
		}
	}
?>