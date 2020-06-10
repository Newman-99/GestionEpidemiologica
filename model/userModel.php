<?php 
	
	require_once "mainModel.php";

	/**
	 * 
	 */
	class userModel extends mainModel
	{
	
	protected static function addUserModel($dataUser){
		$sqlQuery = mainModel::connectDB()->prepare("INSERT INTO  usuario ( usuario_id ,
		 	usuario_dni,
		 	usuario_nombre,
		 	usuario_apellido,
		 	usuario_telefono,
		 	usuario_direccion,
		 	usuario_email,
		 	usuario_usuario,
		 	usuario_clave,
		 	usuario_estado,
		 	usuario_privilegio ) VALUES (:usuario_id,
		 	:usuario_dni,
		 	:usuario_nombre,
		 	:usuario_apellido,
		 	:usuario_telefono,
		 	:usuario_direccion,
		 	:usuario_email,
		 	:usuario_usuario,
		 	:usuario_clave,
		 	:usuario_estado,
		 	:usuario_privilegio)");

			$sqlQuery->execute(array(
		"usuario_id"=>$dataUser['usuario_id'],
		"usuario_dni"=>$dataUser['usuario_dni'],
		"usuario_nombre"=>$dataUser['usuario_nombre'],
		"usuario_apellido"=>$dataUser['usuario_apellido'],
		"usuario_telefono"=>$dataUser['usuario_telefono'],
		"usuario_direccion"=>$dataUser['usuario_direccion'],
		"usuario_email"=>$dataUser['usuario_email'],
		"usuario_usuario"=>$dataUser['usuario_usuario'],
		"usuario_clave"=>$dataUser['usuario_clave'],
		"usuario_estado"=>$dataUser['usuario_estado'],
		"usuario_privilegio"=>$dataUser['usuario_privilegio']));

			return $sqlQuery;
	}	
	}

 ?>