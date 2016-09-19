<?php
	namespace App\Http\CapaNegocio;

	use Illuminate\Support\Facades\Auth;

	use App\Usuarios;
	class Usuarios{
		private $usuario;

		function Personaje(){
			$this->$usuario = new Usuarios;
		}

		function getNivelByUserID($id){

		}

		function getUsuarioByURL($id){
			return Usuarios::where('id','=', "$id")->select('url')->get()[0];
		}

		function geURLById($URL){
			return Usuarios::where('url','=', "$URL")->select('id')->get()[0];
		}
	}
?>