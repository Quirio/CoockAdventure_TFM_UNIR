<?php
	namespace App\Http\CapaNegocio;

	use Illuminate\Support\Facades\Auth;

	use App\Recetas;
	class Receta{
		private $id_lastInsert;
		function insert($nombre,$descripcion,$tipo,$cdm,$n_images){
			$recetas = new Recetas;
			$recetas->nombreReceta = $nombre; 
			$recetas->descripcion = $descripcion;
			$recetas->id_TipoReceta = $tipo;
	        $recetas->visualizaciones = 0;
	        $recetas->puntuacion = 0.0;
	        $recetas->destacado = 0;
	        $recetas->activo = 1;
	        $recetas->id_usuario = Auth::id();
	        $recetas->cdm = $cdm;
			$recetas->n_images = $n_images;
	        $recetas->save();

	        $this->id_lastInsert = $recetas->id;
		}

		function getUltimaCreada(){
			$recetas = new Recetas;
			return $recetas->find($this->id_lastInsert);
		}

		function getIDUltimaCreada(){
			return $this->id_lastInsert;
		}

		function getTipoByID($id){
			$recetas = new Recetas;
			return $recetas->find($id)['id_TipoReceta'];
		}

		function getBycdm($cdm){
			return Recetas::where('cdm','=', $cdm)->get()[0];
		}

		function getAllByTime($sentido){
			$nPaginas = 3;
			switch ($sentido) {
				case '0':
					return Recetas::orderBy('id', 'DESC')->paginate($nPaginas);
				case '1':
					return Recetas::orderBy('id', 'ASC')->paginate($nPaginas);				
				default:
					return Recetas::orderBy('id', 'DESC')->paginate($nPaginas);
			}			
		}

		function getAllByTimeByAuthUser($sentido){
			$nPaginas = 3;
			switch ($sentido) {
				case '0':
					return Recetas::where('id_usuario', Auth::id())->orderBy('id', 'DESC')->paginate($nPaginas);
				case '1':
					return Recetas::where('id_usuario', Auth::id())->orderBy('id', 'ASC')->paginate($nPaginas);				
				default:
					return Recetas::where('id_usuario', Auth::id())->orderBy('id', 'DESC')->paginate($nPaginas);
			}			
		}

		function getBestRecipes(){
			$nPaginas = 3;
			return Recetas::orderBy('puntuacion', 'DESC')->paginate($nPaginas);
		}

		function getBestRecipesByAuthUser(){
			$nPaginas = 3;
			return Recetas::where('id_usuario', Auth::id())->orderBy('puntuacion', 'DESC')->paginate($nPaginas);
		}

		function getCantidaRecetasByUser(){
			return Recetas::where('id_usuario','=', Auth::id())->count();
		}

		function removebycdmid($cdm){
			return Recetas::where('id_usuario', '=',  Auth::id())->where('cdm','=',$cdm)->delete();
		}

		function modifybycmdid($nombre,$descripcion,$tipo,$cdm,$n_images){
			Recetas::where('id_usuario', '=',  Auth::id())
			->where('cdm','=',$cdm)
			->update(['nombreReceta' => $nombre,
				'descripcion' => $descripcion,
				'id_TipoReceta' => $tipo,
				'n_images'=> $n_images]);
		/*	$recetas->nombreReceta = $nombre; 
			$recetas->descripcion = $descripcion;
			$recetas->id_TipoReceta = $tipo;
	        $recetas->visualizaciones = 0;
	        $recetas->puntuacion = 0.0;
	        $recetas->destacado = 0;
	        $recetas->activo = 1;
	        $recetas->id_usuario = Auth::id();
	        $recetas->cdm = $cdm;
			$recetas->n_images = $n_images;
	        $recetas->save();*/
		}
	}
?>