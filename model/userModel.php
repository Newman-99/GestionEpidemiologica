<?php 
	
	require_once "mainModel.php";

	/**
	 * 
	 */
	class userModel extends mainModel
	{
	
	protected static function addUserModel($dataUser){
		$sqlQuery = mainModel::connectDB()->prepare("INSERT INTO usuarios ( 
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
		"alias"=>$dataUser['aliasUser'],
		"docIdentidad"=>$dataUser['docIdentidad'],
		"idNivelPermiso"=>$dataUser['idNivelPermiso'],
		"idEstado"=>$dataUser['idEstado'],
		"passEncypt"=>$dataUser['password'],
		"correoElectronico"=>$dataUser['email']));

			return $sqlQuery;
	}	


	protected static function updateUserModel($dataUser){
		$sqlQuery = mainModel::connectDB()->prepare("UPDATE usuarios 
			SET docIdentidad = :docIdentidad,
		 	idNivelPermiso = :idNivelPermiso,
		 	idEstado = :idEstado,
		 	passEncypt = :password, 
		 	email = :email WHERE alias = :aliasUser;");

			$sqlQuery->execute(array(
		"aliasUser"=>$dataUser['aliasUser'],
		"docIdentidad"=>$dataUser['docIdentidad'],
		"idNivelPermiso"=>$dataUser['idNivelPermiso'],
		"idEstado"=>$dataUser['idEstado'],
		"password"=>$dataUser['password'],
		"email"=>$dataUser['email']));

			return $sqlQuery;
	}	


			protected static function deleteUserModel($dataPersona){
		$sqlQuery = mainModel::connectDB()->prepare(mainModel::disableForeingDB()."DELETE FROM usuarios WHERE alias = :aliasUser;".mainModel::enableForeingDB());

			$sqlQuery->execute(array(
		 "aliasUser"=>$dataPersona['aliasUser']));

			return $sqlQuery;
		}

			protected static function getUserModel($userAttributesFilter,$filterValues){

  
		    $sqlQuery="SELECT * FROM usuarios";                  
		 

		 // Recoger y anadir campos para filtracion de resultado
		  if (!empty($userAttributesFilter)) {
		    $sqlQuery .= ' WHERE ' . implode(' AND ', $userAttributesFilter);
		  }

			$sqlQuery = mainModel::connectDB()->prepare($sqlQuery);

		  foreach($filterValues as $key => $values) {
		    $sqlQuery->bindParam($key, $values['value'], $values['type']);
		  }
		    $sqlQuery->execute();
		   
		    return $recordsResult=$sqlQuery->fetch(PDO::FETCH_ASSOC);

			}

		

	}

 ?>