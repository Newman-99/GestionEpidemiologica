<?php 
	
	require_once "personModel.php";
	require_once "casosEpidemiModel.php";

	/**
	 * 
	 */
	class userModel extends personModel
	{
	
	public static function addUserModel($dataUser){
		
		$DB_transacc = mainModel::connectDB();

		$DB_transacc->beginTransaction();

	try {
		//si no existe la persona
	if(!$dataUser['ifExistPerson']){
		// registrar como person
		$sqlQuery  = personModel::stringQueryAddPersonModel();

		$sqlQuery = $DB_transacc->prepare($sqlQuery);

		$sqlQuery->execute(array(
		 "doc_identidad"=>$dataUser['doc_identidad'],
		 "nombres"=>$dataUser['nombres'],
		 "apellidos"=>$dataUser['apellidos'],
		 "fecha_nacimiento"=>$dataUser['fecha_nacimiento'],
		 "id_nacionalidad"=>$dataUser['id_nacionalidad'],
		 "id_genero"=>$dataUser['id_genero']));

		$sqlQuery->closeCursor();

			$queryGetIdPersonToRegister = $DB_transacc->query("SELECT id_person FROM public.personas ORDER BY id_person DESC limit 1;");
		  
		  			$idPersonToRegister = $queryGetIdPersonToRegister->fetchColumn();
		  			
		  if (!$idPersonToRegister) {
           		$idPersonToRegister = 1;
           	}

			$dataUser["id_person"]=$idPersonToRegister;

		}		

		//registrar como usuario
		
		$sqlQuery = $DB_transacc->prepare("INSERT INTO usuarios ( 
			alias,
			id_person,
		 	id_nivel_permiso,
		 	id_estado,
		 	pass_encrypt, 
		 	email,
		 	telefono) VALUES (
		 	:alias,
		 	:id_person,
		 	:id_nivel_permiso,
		 	:id_estado,
		 	:pass_encrypt, 
		 	:email,
		 	:telefono)");

			$sqlQuery->execute(array(
		"alias"=>$dataUser['aliasUser'],
		"id_person"=>$dataUser['id_person'],
		"id_nivel_permiso"=>$dataUser['id_nivel_permiso'],
		"id_estado"=>$dataUser['id_estado'],
		"pass_encrypt"=>$dataUser['password'],
		"email"=>$dataUser['email'],
		"telefono"=>$dataUser['telefono']));

		$sqlQuery->closeCursor();

		$sqlQuery = $DB_transacc->prepare("INSERT INTO usuarios_preguntas(
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

		$sqlQuery->closeCursor();

		$sqlQuery->execute(array(
		"usuario_alias"=>$dataUser['aliasUser'],
		"id_pregunta"=>"2",
		"respuesta"=>$dataUser["question2"]));

		$sqlQuery->closeCursor();

			$DB_transacc->commit();

			$alert=[
				"Alert"=>"reload",
				"Title"=>"Operacion Exitosa",
				"Text"=>"Usuario Registrado
				<br>
				Por favor contacte con el administrador para su autorizacion en el sistema",
				"Type"=>"success"
			];

			}catch (Exception $e) {

			$DB_transacc->rollBack();

			$alert=[
				"Alert"=>"simple",
				"Title"=>"Ha ocurrido un error inesperado",
				"Text"=>"No se ha podido registar el usuario en el sistema <br>
					Error".$e->getMessage()."",
				"Type"=>"error"
			];

		}

		 return json_encode($alert);
	}	


	public static function updateUserModel($userValuesUpdate,$userAttributesUpdate,$dataPerson = ''){
		
		$DB_transacc = mainModel::connectDB();

		$DB_transacc->beginTransaction();

	try {

// si no son los mismos datos personales acualizamos
if (isset($dataPerson['ifUpdatePerson']) && $dataPerson['ifUpdatePerson'] == true ) {
	

if (isset($dataPerson['dataBitacoraLastCaseEpidemiAssignUser'])) {

		$sqlQuery = $DB_transacc->prepare(casosEpidemiController::$queryAddBitacoraCasoEpidemi);


			$sqlQuery->execute(array(
		 "id_person_caso"=>$dataPerson['dataBitacoraLastCaseEpidemiAssignUser']['id_person'],
		 "id_person_usuario"=>$dataPerson['dataBitacoraLastCaseEpidemiAssignUser']['id_person_usuario'],
		 "usuario_alias"=>$dataPerson['dataBitacoraLastCaseEpidemiAssignUser']['usuario_alias'],
		 "bitacora_fecha"=>$dataPerson['dataBitacoraLastCaseEpidemiAssignUser']['bitacora_fecha'],
		 "bitacora_hora"=>$dataPerson['dataBitacoraLastCaseEpidemiAssignUser']['bitacora_hora'],
		 "bitacora_year"=>$dataPerson['dataBitacoraLastCaseEpidemiAssignUser']['bitacora_year'],
		 "id_tipo_operacion"=>$dataPerson['dataBitacoraLastCaseEpidemiAssignUser']['id_tipo_operacion'],
		 "id_caso_epidemi"=>$dataPerson['dataBitacoraLastCaseEpidemiAssignUser']['id_caso_epidemi'],
		 "fecha_caso_epidemi"=>$dataPerson['dataBitacoraLastCaseEpidemiAssignUser']['fecha_registro'],
		 "catalog_key_cie10"=>$dataPerson['dataBitacoraLastCaseEpidemiAssignUser']['catalog_key_cie10'],
		 "id_nacionalidad_caso"=>$dataPerson['dataBitacoraLastCaseEpidemiAssignUser']['id_nacionalidad_caso'],
		 "doc_identidad_caso"=>$dataPerson['dataBitacoraLastCaseEpidemiAssignUser']['doc_identidad_caso'],
		 "is_hospital"=>$dataPerson['dataBitacoraLastCaseEpidemiAssignUser']['is_hospital']));

		$sqlQuery->closeCursor();


}

		$sqlQuery  = personModel::stringQueryUpdatePersonModel();

		$sqlQuery = $DB_transacc->prepare($sqlQuery);

		 $sqlQuery->execute(array(
		 "id_person"=>$dataPerson['id_person'],
		 "id_nacionalidad"=>$dataPerson['id_nacionalidad'],
		 "doc_identidad"=>$dataPerson['doc_identidad'],
		 "nombres"=>$dataPerson['nombres'],
		 "apellidos"=>$dataPerson['apellidos'],
		 "fecha_nacimiento"=>$dataPerson['fecha_nacimiento'],
		 "id_nacionalidad"=>$dataPerson['id_nacionalidad'],
		 "id_genero"=>$dataPerson['id_genero']));

		$sqlQuery->closeCursor();

	}
		// tomo solo los valores diferentes y enviados en el form
		$sqlQuery = mainModel::connectDB()->prepare("UPDATE usuarios 
			SET 	".implode(",",$userAttributesUpdate)." WHERE alias = :aliasUser;");


		  foreach($userValuesUpdate as $key => $values) {
		    $sqlQuery->bindParam($key, $values['value'], $values['type']);
		  }

		  $sqlQuery->execute();

		  $sqlQuery->closeCursor();
			
			$alert=[
				"Alert"=>"reload",
				"Title"=>"Operacion Exitosa",
				"Text"=>"Datos del usuarios actualizados",
				"Type"=>"success"
			];

		  	$DB_transacc->commit();
		
			}catch (Exception $e) {

			$DB_transacc->rollBack();

			$alert=[
				"Alert"=>"simple",
				"Title"=>"Ocurrio un error inesperado",
				"Text"=>"Error en la actualizacion del usuario <br>
					Error".$e->getMessage()."",
				"Type"=>"error"
			];

		}

			return json_encode($alert);

	}


		public static function updateUserQuestionModel($dataUpdateQuestions){


		$sqlQuery = mainModel::connectDB()->prepare("UPDATE usuarios_preguntas 
			SET respuesta = :respuesta WHERE usuario_alias = :aliasUser AND id_pregunta = :id_pregunta ;");

		    return $sqlQuery->execute(array("aliasUser"=>$dataUpdateQuestions["aliasUser"],"id_pregunta"=>$dataUpdateQuestions["id_pregunta"],"respuesta"=>$dataUpdateQuestions["respuesta"]));

		}	


	public static function deleteUserModel($dataUser){

		$DB_transacc = mainModel::connectDB();
		$DB_transacc->beginTransaction();

	try {

		$DB_transacc->query(parent::$stringQuerydisableForeingDB);

		// borrar usuario
		$sqlQuery = $DB_transacc->prepare("DELETE FROM usuarios WHERE alias = :aliasUser;");

		$sqlQuery->execute(array("aliasUser"=>$dataUser['aliasUser']));

		  $sqlQuery->closeCursor();

		// borrar preguntas
		$sqlQuery = $DB_transacc->prepare("DELETE FROM usuarios_preguntas WHERE usuario_alias = :aliasUser;");

			$sqlQuery->execute(array(
			 "aliasUser"=>$dataUser['aliasUser']));

			$sqlQuery->execute();

		  $sqlQuery->closeCursor();

		  // borrar bitacora de sessiones
		  
		   	$sqlQuery = $DB_transacc->prepare(mainModel::$stringQueryDeleteBitacora); 
	
			$sqlQuery->execute(array("usuario_alias"=>$dataUser['aliasUser']));

		  		$sqlQuery->closeCursor();
		  
		  	// borrar como persona
		if (isset($dataUser['deletePerson'])) {
		
		$stringQueryDeletePersonModel = personModel::stringQueryDeletePersonModel();

		$sqlQuery = $DB_transacc->prepare($stringQueryDeletePersonModel);

		  $sqlQuery->execute(array(
		 "id_person"=>$dataUser['id_person']));
	
		}

		$DB_transacc->query(parent::$stringQueryEnableForeingDB);

		  			$alert=[
				"Alert"=>"reload",
				"Title"=>"Operacion Exitosa",
				"Text"=>"El usuario ha sido eliminado",
				"Type"=>"success"
			];

			
			$DB_transacc->commit();
			
			}catch (Exception $e) {

			$DB_transacc->rollBack();

			$alert=[
				"Alert"=>"simple",
				"Title"=>"Ocurrio un error inesperado",
				"Text"=>"Error en la eliminacion del usuario <br>
					Error".$e->getMessage()."",
				"Type"=>"error"
			];

		}

			return json_encode($alert);
		

		}

			public static function getQueryInnerJoimForUser($userAttributesFilter,$filterValues){

  
		    $sqlQuery=self::stringQueryInnerJoinForGetUser();                  
		 
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

			public static function stringQueryInnerJoinForGetUser(){
				$stringQueryInnerJoinForGetUser = " SELECT  DISTINCT ON (usr.alias) usr.alias usuario_alias,pers.id_nacionalidad,pers.doc_identidad, usr.id_nivel_permiso, usr.id_estado, usr.pass_encrypt, usr.email, usr.telefono,pers.id_person, pers.nombres, pers.apellidos, pers.fecha_nacimiento, pers.id_genero,
				nacion.descripcion_nacionalidad,
				gnro.descripcion_genero,
				usrEtdo.descripcion_estado,
				usrNivl.descripcion_nivel_permiso,
				usrQuest.id_pregunta,usrQuest.respuesta,(nacion.descripcion_nacionalidad || '' || pers.doc_identidad) AS doc_identidad_complete
 				FROM usuarios usr
				INNER JOIN personas pers ON usr.id_person = pers.id_person
				INNER JOIN nacionalidades nacion ON pers.id_nacionalidad = nacion.id_nacionalidad 
				INNER JOIN generos gnro ON pers.id_genero = gnro.id_genero 
				INNER JOIN usuarios_estados usrEtdo ON usr.id_estado =  usrEtdo.id_estado
				INNER JOIN usuarios_niveles usrNivl ON usr.id_nivel_permiso =  usrNivl.id_nivel_permiso
				INNER JOIN usuarios_preguntas usrQuest ON usr.alias =  usrQuest.usuario_alias ";

				return $stringQueryInnerJoinForGetUser;
			}
		
					public static function stringQueryInnerJoinForGetDataSecurityUser(){
				$stringQueryInnerJoinForGetDataSecurityUser = " SELECT  DISTINCT ON (usr.alias) usr.alias usuario_alias, usr.pass_encrypt,
				usrQuest.id_pregunta,usrQuest.respuesta

 				FROM usuarios usr
				INNER JOIN usuarios_estados usrEtdo ON usr.id_estado =  usrEtdo.id_estado
				INNER JOIN usuarios_niveles usrNivl ON usr.id_nivel_permiso =  usrNivl.id_nivel_permiso
				INNER JOIN usuarios_preguntas usrQuest ON usr.alias =  usrQuest.usuario_alias ";

				return $stringQueryInnerJoinForGetDataSecurityUser;
			}
		

	 public static function userTypeCounterModel($userAttribute,$userType){

	 $WHERE = "";

	 if (!is_null($userType)) {
	 $WHERE = "WHERE $userAttribute ='$userType'";
	 }

	$userTypeCounter = mainModel::connectDB()->query("SELECT $userAttribute FROM usuarios ".$WHERE);

	return $userTypeCounter->rowCount();

	}
	


	}


 ?>