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
			idNacionalidad,
		 	docIdentidad,
		 	idNivelPermiso,
		 	idEstado,
		 	passEncrypt, 
		 	email,
		 	telefono) VALUES (
		 	:alias,
		 	:idNacionalidad,
		 	:docIdentidad,
		 	:idNivelPermiso,
		 	:idEstado,
		 	:passEncrypt, 
		 	:email,
		 	:telefono)");

			$sqlQuery->execute(array(
		"alias"=>$dataUser['aliasUser'],
		"idNacionalidad"=>$dataUser['idNacionalidad'],
		"docIdentidad"=>$dataUser['docIdentidad'],
		"idNivelPermiso"=>$dataUser['idNivelPermiso'],
		"idEstado"=>$dataUser['idEstado'],
		"passEncrypt"=>$dataUser['password'],
		"email"=>$dataUser['email'],
		"telefono"=>$dataUser['telefono']));

		$sqlQuery = mainModel::connectDB()->prepare("INSERT INTO usuariosPreguntas(
		aliasUsuario,
	 	idPregunta,
	 	respuesta) VALUES (
	 	:aliasUsuario,
	 	:idPregunta,
		:respuesta)");

			$sqlQuery->execute(array(
		"aliasUsuario"=>$dataUser['aliasUser'],
		"idPregunta"=>"1",
		"respuesta"=>$dataUser["question1"]));

		$sqlQuery->execute(array(
		"aliasUsuario"=>$dataUser['aliasUser'],
		"idPregunta"=>"2",
		"respuesta"=>$dataUser["question2"]));

			return $sqlQuery;
	}	


	protected static function updateUserModel($userValuesUpdate,$userAttributesUpdate){


		$sqlQuery = mainModel::connectDB()->prepare("UPDATE usuarios 
			SET 	".implode(",",$userAttributesUpdate)." WHERE alias = :aliasUser;");


		  foreach($userValuesUpdate as $key => $values) {
		    $sqlQuery->bindParam($key, $values['value'], $values['type']);
		  }

		  $sqlQuery->execute();

			return $sqlQuery;

	}

		protected static function updateUserQuestionModel($dataUpdateQuestions){


		$sqlQuery = mainModel::connectDB()->prepare("UPDATE usuariosPreguntas 
			SET respuesta = :respuesta WHERE aliasUsuario = :aliasUser AND idPregunta = :idPregunta ;");


		    return $sqlQuery->execute(array("aliasUser"=>$dataUpdateQuestions["aliasUser"],"idPregunta"=>$dataUpdateQuestions["idPregunta"],"respuesta"=>$dataUpdateQuestions["respuesta"]));

		}	


			protected static function deleteUserModel($dataUser){
		$sqlQuery = mainModel::connectDB()->prepare(mainModel::disableForeingDB()."DELETE FROM usuarios WHERE alias = :aliasUser;".mainModel::enableForeingDB());

			$sqlQuery->execute(array(
		 "aliasUser"=>$dataUser['aliasUser']));


		$sqlQuery = mainModel::connectDB()->prepare("DELETE FROM usuariosPreguntas WHERE aliasUsuario = :aliasUser;");

			$sqlQuery->execute(array(
			 "aliasUser"=>$dataUser['aliasUser']));

			$sqlQuery->execute();

			return $sqlQuery;

		}

			protected static function getUserModel($userAttributesFilter,$filterValues){

  
		    $sqlQuery=self::stringQueryForGetUser();                  
		 
		 // Recoger y anadir campos para filtracion de resultado
		  if (!empty($userAttributesFilter)) {
		    $sqlQuery .= ' WHERE ' . implode(' AND ', $userAttributesFilter);
		  }

			$sqlQuery = mainModel::connectDB()->prepare($sqlQuery);

		  foreach($filterValues as $key => $values) {
		    $sqlQuery->bindParam($key, $values['value'], $values['type']);
		  }
		     return $sqlQuery;
		   
			}

			protected static function stringQueryForGetUser(){
				$stringQueryForGetUser = " SELECT SQL_CALC_FOUND_ROWS usr.alias aliasUsuario, usr.docIdentidad, usr.idNivelPermiso, usr.idEstado, usr.passEncrypt, usr.email, usr.telefono,
				pers.docIdentidad, pers.nombres, pers.apellidos, pers.fechaNacimiento, pers.idNacionalidad, pers.idGenero,
				nacion.descripcionNacionalidad,
				gnro.descripcionGenero,
				usrEtdo.descripcionEstado,
				usrNivl.descripcionNivelPermiso,
				usrQuest.idPregunta,usrQuest.respuesta FROM usuarios usr
				INNER JOIN personas pers ON usr.docIdentidad = pers.docIdentidad
				INNER JOIN nacionalidades nacion ON pers.idNacionalidad = nacion.idNacionalidad 
				INNER JOIN generos gnro ON pers.idGenero = gnro.idGenero 
				INNER JOIN usuariosEstados usrEtdo ON usr.idEstado =  usrEtdo.idEstado
				INNER JOIN usuariosNiveles usrNivl ON usr.idNivelPermiso =  usrNivl.idNivelPermiso
				INNER JOIN usuariosPreguntas usrQuest ON usr.alias =  usrQuest.aliasUsuario";

				return $stringQueryForGetUser;
			}
		
	 protected static function userTypeCounterModel($userAttribute,$userType){

	 $WHERE = "";

	 if (!is_null($userType)) {
	 $WHERE = "WHERE $userAttribute ='$userType'";
	 }

	$userTypeCounter = mainModel::runSimpleQuery("SELECT $userAttribute FROM usuarios ".$WHERE);

	return $userTypeCounter;

	}
	

	}





 ?>