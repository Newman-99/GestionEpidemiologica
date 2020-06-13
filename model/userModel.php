<?php 
	
	require_once "mainModel.php";

	/**
	 * 
	 */
	class userModel extends mainModel
	{
	
	protected static function addUserModel($dataUser){
		$sqlQuery = mainModel::connectDB()->prepare("INSERT INTO  usuarios ( 
			alias,
		 	docIdentidad,
		 	idNivelPermiso,
		 	idEstado,
		 	passEncypt, 
		 	correoElectronico) VALUES (
		 	:alias,
		 	:docIdentidad,
		 	:idNivelPermiso,
		 	:idEstado,
		 	:passEncypt, 
		 	:correoElectronico)");

			$sqlQuery->execute(array(
		"alias"=>$dataUser['alias'],
		"docIdentidad"=>$dataUser['docIdentidad'],
		"idNivelPermiso"=>$dataUser['idNivelPermiso'],
		"idEstado"=>$dataUser['idEstado'],
		"passEncypt"=>$dataUser['passEncypt'],
		"correoElectronico"=>$dataUser['correoElectronico']));

			return $sqlQuery;
	}	
	}

 ?>