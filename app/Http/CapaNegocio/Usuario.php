<?php
	namespace App\Http\CapaNegocio;

	use Illuminate\Support\Facades\Auth;

	use App\Usuarios;
	class Usuario{
		private $usuario;

		function Personaje(){
			$this->$usuario = new Usuarios;
		}

		function getNivelByUserID($id){

		}

		function getUsuarioByid($id){
			return Usuarios::where('id','=', "$id")->get()[0];
		}
		
	}
?>