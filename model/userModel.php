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
			id_nacionalidad,
		 	doc_identidad,
		 	id_nivel_permiso,
		 	id_estado,
		 	pass_encrypt, 
		 	email,
		 	telefono) VALUES (
		 	:alias,
		 	:id_nacionalidad,
		 	:doc_identidad,
		 	:id_nivel_permiso,
		 	:id_estado,
		 	:pass_encrypt, 
		 	:email,
		 	:telefono)");

			$sqlQuery->execute(array(
		"alias"=>$dataUser['aliasUser'],
		"id_nacionalidad"=>$dataUser['id_nacionalidad'],
		"doc_identidad"=>$dataUser['doc_identidad'],
		"id_nivel_permiso"=>$dataUser['id_nivel_permiso'],
		"id_estado"=>$dataUser['id_estado'],
		"pass_encrypt"=>$dataUser['password'],
		"email"=>$dataUser['email'],
		"telefono"=>$dataUser['telefono']));

		$sqlQuery = mainModel::connectDB()->prepare("INSERT INTO usuarios_preguntas(
		usuario_alias,
	 	id_pregunta,
	 	respuesta) VALUES (
	 	:usuario_alias,
	 	:id_pregunta,
		:respuesta)");

			$sqlQuery->execute(array(
		"usuario_alias"=>$dataUser['aliasUser'],
		"id_pregunta"=>"1",
		"respuesta"=>$dataUser["question1"]));

		$sqlQuery->execute(array(
		"usuario_alias"=>$dataUser['aliasUser'],
		"id_pregunta"=>"2",
		"respuesta"=>$dataUser["question2"]));

			return $sqlQuery;
	}	


	protected static function updateUserModel($userValuesUpdate,$userAttributesUpdate){


		$sqlQuery = mainModel::connectDB()->prepare("UPDATE usuarios 
			SET 	".implode(",",$userAttributesUpdate)." WHERE alias = :aliasUser;");


		  foreach($userValuesUpdate as $key => $values) {
		    $sqlQuery->bindParam($key, $values['value'], $values['type']);
		  }

		  return $sqlQuery->execute();

	}

		protected static function updateUserQuestionModel($dataUpdateQuestions){


		$sqlQuery = mainModel::connectDB()->prepare("UPDATE usuarios_preguntas 
			SET respuesta = :respuesta WHERE usuario_alias = :aliasUser AND id_pregunta = :id_pregunta ;");

		    return $sqlQuery->execute(array("aliasUser"=>$dataUpdateQuestions["aliasUser"],"id_pregunta"=>$dataUpdateQuestions["id_pregunta"],"respuesta"=>$dataUpdateQuestions["respuesta"]));

		}	


			protected static function deleteUserModel($dataUser){

				mainModel::disableForeingDB();


		$sqlQuery = mainModel::connectDB()->prepare("DELETE FROM usuarios_preguntas WHERE usuario_alias = :aliasUser;");

			$sqlQuery->execute(array(
			 "aliasUser"=>$dataUser['aliasUser']));

			$resultQueryQuestions = $sqlQuery->execute();

		$sqlQuery = mainModel::connectDB()->prepare(" DELETE FROM usuarios WHERE alias = :aliasUser;");

			$resultQueryUsers = $sqlQuery->execute(array(
		 "aliasUser"=>$dataUser['aliasUser']));

				mainModel::enableForeingDB();
				//return un valoor boooleano
				return $resultQueryUsers*$resultQueryUsers;

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
				$stringQueryForGetUser = ' SELECT  DISTINCT ON (usr.alias) usr.alias usuario_alias,usr.id_nacionalidad,usr.doc_identidad, usr.id_nivel_permiso, usr.id_estado, usr.pass_encrypt, usr.email, usr.telefono, pers.nombres, pers.apellidos, pers.fecha_nacimiento, pers.id_genero,
				nacion.descripcion_nacionalidad,
				gnro.descripcion_genero,
				usrEtdo.descripcion_estado,
				usrNivl.descripcion_nivel_permiso,
				usrQuest.id_pregunta,usrQuest.respuesta FROM usuarios usr
				INNER JOIN personas pers ON usr.doc_identidad = pers.doc_identidad
				INNER JOIN nacionalidades nacion ON pers.id_nacionalidad = nacion.id_nacionalidad 
				INNER JOIN generos gnro ON pers.id_genero = gnro.id_genero 
				INNER JOIN usuarios_estados usrEtdo ON usr.id_estado =  usrEtdo.id_estado
				INNER JOIN usuarios_niveles usrNivl ON usr.id_nivel_permiso =  usrNivl.id_nivel_permiso
				INNER JOIN usuarios_preguntas usrQuest ON usr.alias =  usrQuest.usuario_alias ';

				return $stringQueryForGetUser;
			}
		
	 protected static function userTypeCounterModel($userAttribute,$userType){

	 $WHERE = "";

	 if (!is_null($userType)) {
	 $WHERE = "WHERE $userAttribute ='$userType'";
	 }

	$userTypeCounter = mainModel::connectDB()->query("SELECT $userAttribute FROM usuarios ".$WHERE);

	return $userTypeCounter->rowCount();

	}
	

	}





 ?>