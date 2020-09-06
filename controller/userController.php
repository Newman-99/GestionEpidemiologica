	<?php 

	if($requestAjax){
		require_once "../model/userModel.php";
	}else{
		require_once "./model/userModel.php";
	}

	class userController extends userModel{

		public function addUserController($dataUser){
		
		 $idNacionalidad = mainModel::cleanStringSQL($dataUser["idNacionalidad"]);

		 $docIdentidad = mainModel::cleanStringSQL($dataUser["docIdentidad"]);
		 	// 3 = Invitado en DB
		 $idNivelPermiso = "3";
		 	// 0 = Inactivo  en DB		 	
		 $idEstado = "0";

		$aliasUser = mainModel::cleanStringSQL($dataUser["aliasUser"]);

		 $question1 = mainModel::cleanStringSQL($dataUser["question1"]);

		 $question2 = mainModel::cleanStringSQL($dataUser["question2"]);

		 $password = mainModel::cleanStringSQL($dataUser["password"]);
		
		 $passwordConfirm = mainModel::cleanStringSQL($dataUser["passwordConfirm"]); 

	 $telefono = $dataUser['telefonoPart1'].$dataUser['telefonoPart2'].$dataUser['telefonoPart3'];

		 $telefono = mainModel::cleanStringSQL($telefono);


		 $email = mainModel::cleanStringSQL($dataUser["email"]);
		 // Comprobar si las password son iguales
		 // 
		 //			

		if (mainModel::isDataEmtpy($aliasUser,
		 	$docIdentidad,
		 	$password,
		 	$passwordConfirm, 
		 	$email,$idNacionalidad,$question1,$question2)){

				$alert=[
					"Alert"=>"simple",
					"Title"=>"Campos Vacios",
					"Text"=>"Todos los campos del usuario son obligatorios",
					"Type"=>"error"
				];

				echo json_encode($alert);

				exit();

			}

		
		// Registrar como persona

		// Comprobar si existe o no la persona en la BD

		$primaryKeyPersona = [

			"idNacionalidad"=>$idNacionalidad,
			"docIdentidad"=>$docIdentidad
		];

			require_once "../controller/personaController.php";

			$personaController = new personaController();

			$SQL_isExistPersona = $personaController->getPersonaController($primaryKeyPersona);
			$SQL_isExistPersona->execute();


			if(isset($dataUser['siExistPerson']) && $dataUser['siExistPerson'] == "1" ){

			if(!$SQL_isExistPersona->rowCount()){
			$alert=[
				"Alert"=>"simple",
				"Title"=>"Datos no encontrados",
				"Text"=>"No se encuentra una persona con esta cedula registrada ",
				"Type"=>"error"
			];

				echo json_encode($alert);

				exit();
			}

			}else{
				// Si no existe y es una persona nueva comprabar que no este repetido en la BD
			if($SQL_isExistPersona->rowCount()){
			$alert=[
				"Alert"=>"simple",
				"Title"=>"Datos Duplicados",
				"Text"=>"Ya se encuentra una persona con esta cedula registrada ",
				"Type"=>"error"
			];

				echo json_encode($alert);

				exit();
			}

		}
			// Validar exist el alias de usuario
		 
		 $SQL_isExistUser=self::getUserController(array("aliasUser"=>$aliasUser));

		$SQL_isExistUser->execute();		 

		if($SQL_isExistUser->rowCount()){
				
				$alert=[
				"Alert"=>"simple",
				"Title"=>"Campos Duplicados",
				"Text"=>"Ya existe un usuario con este alias registrado",
				"Type"=>"error"
			];

				echo json_encode($alert);

				exit();

			}

    		if(strlen($aliasUser)<5 || strlen($aliasUser)>20 || preg_match('/\s/',$aliasUser)){
				
				$alert=[
				"Alert"=>"simple",
				"Title"=>"Datos Invalidos",
				"Text"=>"El Alias de Usuario debe tener:
					<br>
					Entre 5 y 20 caracteres
					<br>
					No se permite espacios en blanco",
				"Type"=>"error"
			];

				echo json_encode($alert);

				exit();

			}


		if (!self::isValidEmail($email)) {
				$alert=[
					"Alert"=>"simple",
					"Title"=>"Datos Invalidos",
					"Text"=>"El campo del correo electronico es invalido",
					"Type"=>"error"
				];
				echo json_encode($alert);

				exit();

		}


		   if(strlen($question1)<3 || strlen($question2)<3 ){

			$alert=[
			"Alert"=>"simple",
			"Title"=>"Datos Invalidos",
			"Text"=>"Las preguntas de seguridad deben ser mayor a 3 caracteres",
			"Type"=>"error"
				];
		
				echo json_encode($alert);

				exit();
			}

		   if(strcmp($question1,$question2 )== 0){

			$alert=[
			"Alert"=>"simple",
			"Title"=>"Datos Invalidos",
			"Text"=>"Las preguntas de seguridad no deben ser iguales",
			"Type"=>"error"
				];
		
				echo json_encode($alert);

				exit();
			}

    	if(strcmp($passwordConfirm,$password )!== 0){
		
			$alert=[
			"Alert"=>"simple",
			"Title"=>"Datos Invalidos",
			"Text"=>"Las contraseñas no coinciden",
			"Type"=>"error"
				];
		
				echo json_encode($alert);

				exit();

		}



		if (!self::isValidPassword($password)) {
				$alert=[
					"Alert"=>"simple",
					"Title"=>"Datos Invalidos",
					"Text"=>"La contraseña debe tener:
					<br>
					Longitud de entre 8 y 20 caracteres
					<br>
					Almenos una letra mayuscula		
					<br>
					Almenos una letra minuscula
					<br>
					Almenos un numero
					<br>
					Almenos un caracter especial
					",
					"Type"=>"error"
				];
				echo json_encode($alert);

				exit();
			}

			// Se espera hasta que termina la validacion de usuarios y no hay errors
			if(!isset($dataUser['siExistPerson'])){
			$personaController->addPersonaController($dataUser);			
			}


			$dataUser=[
			"idNacionalidad"=>$idNacionalidad,
			"docIdentidad"=>$docIdentidad,
			"idNivelPermiso"=>$idNivelPermiso,
			"idEstado"=>$idEstado,
			"aliasUser"=>$aliasUser,
			"question1"=>mainModel::encryption($question1),
			"question2"=>mainModel::encryption($question2),
			"password"=>mainModel::encryption($password),
			"telefono"=>$telefono,
			"email"=>$email];
			
			$queryAddUser= userModel::addUserModel($dataUser);
			
			if(!$queryAddUser->rowCount()){

			$alert=[
				"Alert"=>"simple",
				"Title"=>"Ha ocurrido un error inesperado",
				"Text"=>"No se ha podido registar el usuario en el sistema",
				"Type"=>"error"
			];

			echo json_encode($alert);

			exit();

			}

			$alert=[
				"Alert"=>"clean",
				"Title"=>"Operacion Exitosa",
				"Text"=>"Usuario Registrado
				<br>
				Por favor contacte con el administrador para su autorizacion en el sistema",
				"Type"=>"success"
			];


			echo json_encode($alert);

			exit();
		

		}

				
	public function updateUserController($dataUser){
		 
		 $idNacionalidad = mainModel::cleanStringSQL($dataUser["idNacionalidad"]);

		 $docIdentidad = mainModel::cleanStringSQL($dataUser["docIdentidad"]);

		 $aliasUser = mainModel::cleanStringSQL($dataUser["aliasUser"]);

		 $telefono = $dataUser['telefonoPart1'].$dataUser['telefonoPart2'].$dataUser['telefonoPart3'];

		 $telefono = mainModel::cleanStringSQL($telefono);

		 $email = mainModel::cleanStringSQL($dataUser["email"]);
		 
		 $fechaNacimiento = mainModel::cleanStringSQL($dataUser["fechaNacimiento"]);

		 $nombres = mainModel::cleanStringSQL($dataUser["nombres"]);

		 $apellidos = mainModel::cleanStringSQL($dataUser["apellidos"]);


		 $idGenero = mainModel::cleanStringSQL($dataUser["idGenero"]);

		 // para datos principales del usuario
		$userAttributesUpdate = [];

 		$userValuesUpdate = [];

 		// Campos del usuario como persona a comparar con la BD
 		$fieldstoComparePerson = [
		 "fechaNacimiento"=>$fechaNacimiento,
		 "nombres"=>$nombres,
		 "apellidos"=>$apellidos,
		 "idGenero"=>$idGenero 			
 		];


		if (!self::isValidEmail($email)) {
				$alert=[
					"Alert"=>"simple",
					"Title"=>"Datos Invalidos",
					"Text"=>"El campo del correo electronico es invalido",
					"Type"=>"error"
				];
				echo json_encode($alert);

				exit();

		}


				$personValuesUpdate['docIdentidad'] = [
				'value' => $docIdentidad,
				'type' => \PDO::PARAM_INT,
				];

				$personValuesUpdate['idNacionalidad'] = [
				'value' => $idNacionalidad,
				'type' => \PDO::PARAM_INT,
				];

				$userValuesUpdate['aliasUser'] = [
				'value' => $aliasUser,
				'type' => \PDO::PARAM_STR,
				];



				array_push($userAttributesUpdate, 'email = :email');
				$userValuesUpdate['email'] = [
				'value' => $email,
				'type' => \PDO::PARAM_STR,
				];


				array_push($userAttributesUpdate, 'telefono = :telefono');
				$userValuesUpdate['telefono'] = [
				'value' => $telefono,
				'type' => \PDO::PARAM_STR,
				];


		$fieldstoCompareUser=["telefono"=>$telefono,"email"=>$email];

		 if (isset($dataUser["idNivelPermiso"]) AND $dataUser['idNivelPermiso'] != 0){

		 $idNivelPermiso = mainModel::cleanStringSQL($dataUser["idNivelPermiso"]);

				array_push($userAttributesUpdate, 'idNivelPermiso = :idNivelPermiso');
				$userValuesUpdate['idNivelPermiso'] = [
				'value' => $idNivelPermiso,
				'type' => \PDO::PARAM_INT,
				];

		 	$fieldstoCompareUser["idNivelPermiso"] = $idNivelPermiso;
		}

		 if (isset($dataUser["idEstado"])) {

		 $idEstado = mainModel::cleanStringSQL($dataUser["idEstado"]);

				array_push($userAttributesUpdate, 'idEstado = :idEstado');
				$userValuesUpdate['idEstado'] = [
				'value' => $idEstado,
				'type' => \PDO::PARAM_INT,
				];
			$fieldstoCompareUser["idEstado"] = $idEstado;
		 }


		 // comprobamos si los campos enviados son iguales a los de la BD

 		$queryToGetUser = self::getUserController(array("aliasUser"=>$aliasUser));

		$fieldsEqualDatabaseUser = mainModel::isFieldsEqualToThoseInTheDatabase($queryToGetUser,$fieldstoCompareUser);

		 // Tambien lo hacemos con los datos personales

			require_once "../controller/personaController.php";
			
			$personaController = new personaController();

 		$queryToGetPerson = $personaController->getPersonaController(array("docIdentidad"=>$docIdentidad,"idNacionalidad"=>$idNacionalidad));


		$fieldsEqualDatabasePerson = mainModel::isFieldsEqualToThoseInTheDatabase($queryToGetPerson,$fieldstoComparePerson);

 
			if ($fieldsEqualDatabaseUser AND $fieldsEqualDatabasePerson) {

			$alert=[
				"Alert"=>"simple",
				"Title"=>"Datos Duplicados",
				"Text"=>"No se ha encontrado ningun cambio a actualizar",
				"Type"=>"error"
			];

				echo json_encode($alert);

				exit();

			}

			// HAcemos las operaciones de actualizacion principales

			$resultUpdatePerson = $personaController::updatePersonaController($dataUser);

			$resultUpdateUser = userModel::updateUserModel($userValuesUpdate,$userAttributesUpdate);


			// Impimirmo el resultado de la operacion
			$alert=[
				"Alert"=>"reload",
				"Title"=>"Operacion Exitosa",
				"Text"=>"Datos del usuarios actualizados",
				"Type"=>"success"
			];


			if (!$resultUpdateUser || !$resultUpdatePerson) {
			
			$alert=[
				"Alert"=>"simple",
				"Title"=>"Ocurrio un error inesperado",
				"Text"=>"Error en la actualizacion del usuario",
				"Type"=>"error"
			];

			}

				echo json_encode($alert);

				exit();	 	


			}


// Esta funcion se usa en 4 funcionalidades del sistema:
// config: Formulario de actulizacion de seguridad normal
// restart: proceso de reinicio del usuario
// recoverPass:: proceso de recuperacion password
// 
	public  static function modifyUserSafetyDataController($dataUser){

		$aliasUser = mainModel::cleanStringSQL($dataUser["aliasUser"]);

	// variables para guardar el resultado de las consultas

		$resultQueryUpdatePass = TRUE;
		$resultQueryUpdateQuestion1 = TRUE;
		$resultQueryUpdateQuestion2 = TRUE;


	// Comprobamos que exista el susuario

		$queryGetUserStatus = mainModel::runSimpleQuery("SELECT idEstado FROM `usuarios` WHERE alias =
			'$aliasUser'");

		$queryGetUserStatus->execute();

		$idEstado = $queryGetUserStatus->fetchColumn();

		if(!$queryGetUserStatus->rowCount()){
				
				$alert=[
				"Alert"=>"simple",
				"Title"=>"Datos no encontrados",
				"Text"=>"No existe un usuario con este alias registrado",
				"Type"=>"error"
			];
				echo json_encode($alert);

				exit();

			}

		// si estado es 0 no tiene permiso de cambiar datos de seguridad
		if($idEstado == 0){
				
				$alert=[
				"Alert"=>"simple",
				"Title"=>"Permiso Denegado",
				"Text"=>"El usuario se encuentra inactivo por favor contactar un administrador",
				"Type"=>"error"
			];

				echo json_encode($alert);

				exit();

			}

		// si esta funcion es llamada por restar USer verificara que el estado No se ha activo
if ($dataUser["operationType"] == "restart") {
		if($idEstado == 1){
				
				$alert=[
				"Alert"=>"simple",
				"Title"=>"Permiso Denegado",
				"Text"=>"El usuario no posee una solicitud de reinicio",
				"Type"=>"error"
			];

				echo json_encode($alert);

				exit();

			}
}

// Comprobamos los datos de seguridad

// solo en la configuracion normal de usuario se verfica la password

if ($dataUser["operationType"] == "config") {

		// Estos datos deben estar llenados en cofig
		if (mainModel::isDataEmtpy($aliasUser,
		 	$dataUser["question1"],$dataUser["question2"],$dataUser["password"])){
				$alert=[
					"Alert"=>"simple",
					"Title"=>"Campos Vacios",
					"Text"=>"Todos los campos del usuario son obligatorios",
					"Type"=>"error"
				];

				echo json_encode($alert);

				exit();

			}

if (mainModel::isDataEmtpy($dataUser["newQuestion1"]) &&
	mainModel::isDataEmtpy($dataUser["newQuestion2"]) &&
	mainModel::isDataEmtpy($dataUser["newPassword"]) &&
	mainModel::isDataEmtpy($dataUser["newPasswordConfirm"])){
				$alert=[
					"Alert"=>"simple",
					"Title"=>"Campos Vacios",
					"Text"=>"No se encuentra ningun dato para actualizar",
					"Type"=>"error"
				];

				echo json_encode($alert);

				exit();
 
			}
// Imprime msj si es incorrecta
self::passwordCorrespondDatabase($dataUser);

}

// validar preguntas de seguridad 

// solo en la configuracion normal y recuperacion de password  se verfica las preguntas de seguridad

if ($dataUser["operationType"] == "config" || $dataUser["operationType"] == "recoverPass") {

self::securityQuestionsCorrespondDatabase($dataUser);
}

// Actualizamos password si se desea

if (!mainModel::isDataEmtpy($dataUser["newPasswordConfirm"]) || !mainModel::isDataEmtpy($dataUser["newPassword"])) {
		
$resultQueryUpdatePass = self::passwordUpdateController($dataUser);

	}

				// Actualizamos preguntas si se desea

		if (isset($dataUser["newQuestion1"]) && !mainModel::isDataEmtpy($dataUser["newQuestion1"])) {

		$dataUpdateQuestions = ["newQuestion"=>$dataUser["newQuestion1"],"aliasUser"=>$aliasUser,"idPregunta"=>'1'];

		$resultQueryUpdateQuestion1 = self::questionUpdateController($dataUpdateQuestions);

	}


		if (isset($dataUser["newQuestion2"]) && !mainModel::isDataEmtpy($dataUser["newQuestion2"])) {

		$dataUpdateQuestions = ["newQuestion"=>$dataUser["newQuestion2"],"aliasUser"=>$aliasUser,"idPregunta"=>'2'];

		$resultQueryUpdateQuestion2 = self::questionUpdateController($dataUpdateQuestions);

		}

			// Guardar e Impimir el resultado de las operaciones

			$totalResultQuerys = TRUE;

			if (!$resultQueryUpdatePass || !$resultQueryUpdateQuestion1 || !$resultQueryUpdateQuestion2) {
				
				$totalResultQuerys = FALSE;
				
				}


if ($dataUser["operationType"] == "config") {
			$alert=[
				"Alert"=>"simple",
				"Title"=>"Ocurrio un error inesperado",
				"Text"=>"Error en la actualizacion del usuario",
				"Type"=>"error"
			];

			if ($totalResultQuerys) {

			$alert=[
				"Alert"=>"reload",
				"Title"=>"Operacion Exitosa",
				"Text"=>"Datos del usuario actualizados",
				"Type"=>"success"
			];


			}

				echo json_encode($alert);

				exit();	 	
}

// procesos recover pass y restart user imprimiran su propio msjs de exito

 
return $totalResultQuerys;


}


protected static function passwordCorrespondDatabase($dataUser){

		$aliasUser = mainModel::cleanStringSQL($dataUser["aliasUser"]);

		$password = mainModel::cleanStringSQL($dataUser["password"]);

		$queryGetpassEncrypt = mainModel::runSimpleQuery("SELECT passEncrypt FROM `usuarios` WHERE alias =
			'$aliasUser'");

		$queryGetpassEncrypt->execute();

		$passEncryptDB = mainModel::decryption($queryGetpassEncrypt->fetchColumn());
				
		    if (strcmp($passEncryptDB, $password) != 0){
				$alert=[
				"Alert"=>"simple",
				"Title"=>"Datos Invalidos",
				"Text"=>"La contraseña es incorrecta",
				"Type"=>"error"
			];

				echo json_encode($alert);

				exit();
    	}

}
		protected static function passwordUpdateController($dataUser){
		$aliasUser = mainModel::cleanStringSQL($dataUser["aliasUser"]);
		
		$newPasswordConfirm = mainModel::cleanStringSQL($dataUser["newPasswordConfirm"]); 

		$newPassword = mainModel::cleanStringSQL($dataUser["newPassword"]);

    	if(strcmp($newPasswordConfirm,$newPassword)!== 0){
		
			$alert=[
			"Alert"=>"simple",
			"Title"=>"Datos Invalidos",
			"Text"=>"Las contraseñas no coinciden",
			"Type"=>"error"
				];
		
				echo json_encode($alert);

				exit();

		}

		if (!self::isValidPassword($newPassword)) {
				$alert=[
					"Alert"=>"simple",
					"Title"=>"Datos Invalidos",
					"Text"=>"La contraseña debe tener:
					<br>
					Longitud de entre 8 y 20 caracteres
					<br>
					Almenos una letra mayuscula		
					<br>
					Almenos una letra minuscula
					<br>
					Almenos un numero
					<br>
					Almenos un caracter especial
					",
					"Type"=>"error"
				];
				echo json_encode($alert);

				exit();
			}
		
			$userAttributesUpdate = [];
				array_push($userAttributesUpdate, 'passEncrypt = :password');
				$userValuesUpdate['password'] = [
				'value' => mainModel::encryption($newPassword),
				'type' => \PDO::PARAM_STR];


				array_push($userAttributesUpdate, 'alias = :aliasUser');
				$userValuesUpdate['aliasUser'] = [
				'value' => $aliasUser,
				'type' => \PDO::PARAM_STR];

			return $resultQueryUpdatePass = userModel::updateUserModel($userValuesUpdate,$userAttributesUpdate);
		}

		// las pregunas de seguridad corresponden base de datos
		
		protected static function securityQuestionsCorrespondDatabase($dataUser){
		$aliasUser = mainModel::cleanStringSQL($dataUser["aliasUser"]);
		// Verificamos que la pregunta no este repetida
		$recordsUserSQL = userController::getUserController(array("aliasUser"=>$aliasUser));
					
		$recordsUserSQL->execute();

		// Obtener preguntas del usuario
		while($valuesDataUser=$recordsUserSQL->fetch(PDO
			::FETCH_ASSOC)){ 

			if ($valuesDataUser["idPregunta"] == 1) {

				$registeredQuestion1 = mainModel::decryption($valuesDataUser['respuesta']);

				}else{

					// id pregunta == 2
				$registeredQuestion2 = mainModel::decryption($valuesDataUser['respuesta']);
				}

		}

		$question1 = mainModel::cleanStringSQL($dataUser["question1"]); 

		$question2 = mainModel::cleanStringSQL($dataUser["question2"]); 

		    if (strcmp($registeredQuestion1, $question1) != 0 || strcmp($registeredQuestion2, $question2) != 0){
				$alert=[
				"Alert"=>"simple",
				"Title"=>"Datos Invalidos",
				"Text"=>"Revise las preguntas de seguridad",
				"Type"=>"error"
			];

				echo json_encode($alert);

				exit();
    	}
}

		protected static function questionUpdateController($dataUser){

		$aliasUser = mainModel::cleanStringSQL($dataUser["aliasUser"]);

		$newQuestion = mainModel::cleanStringSQL($dataUser["newQuestion"]);

		$idPregunta = mainModel::cleanStringSQL($dataUser["idPregunta"]);

		// Verificamos que la pregunta no este repetida
		$recordsUserSQL = userController::getUserController(array("aliasUser"=>$aliasUser));
					
		$recordsUserSQL->execute();

		// Obtener preguntas del usuario
		while($valuesDataUser=$recordsUserSQL->fetch(PDO
			::FETCH_ASSOC)){ 


			if ($valuesDataUser["idPregunta"] == 1) {
				$registeredQuestion1 = mainModel::decryption($valuesDataUser['respuesta']);

				}else{
					// id pregunta == 2
				$registeredQuestion2 = mainModel::decryption($valuesDataUser['respuesta']);
				}

		}

		   if(strcmp($registeredQuestion1,$newQuestion)== 0 || strcmp($registeredQuestion2,$newQuestion)== 0){

			$alert=[
			"Alert"=>"simple",
			"Title"=>"Datos Invalidos",
			"Text"=>"Las preguntas de seguridad no deben ser iguales a las registradas",
			"Type"=>"error"
				];
		
				echo json_encode($alert);

				exit();
			}


		   if(strlen($newQuestion)<3){

			$alert=[
			"Alert"=>"simple",
			"Title"=>"Datos Invalidos",
			"Text"=>"Las preguntas de seguridad deben ser mayor a 3 caracteres",
			"Type"=>"error"
				];
		
				echo json_encode($alert);

				exit();
			}

		$dataUpdateQuestions = ["aliasUser"=>$aliasUser,"idPregunta"=>$idPregunta,"respuesta"=>mainModel::encryption($newQuestion)];

		return $resultQueryUpdateQuestion = userModel::updateUserQuestionModel($dataUpdateQuestions);


		}


		public static function deleteUserController($dataUser){

		$aliasUser = mainModel::cleanStringSQL($dataUser['aliasUsuario']);


		$docIdentidad = mainModel::cleanStringSQL($dataUser['docIdentidad']);


		$idNacionalidad = mainModel::cleanStringSQL($dataUser['idNacionalidad']);


		
if (!isset($dataUser['confirmDelete'])) {
		 $aliasUser = mainModel::decryption($dataUser['aliasUsuario']);

		 $docIdentidad = mainModel::decryption($dataUser['docIdentidad']);

		 $idNacionalidad = mainModel::decryption($dataUser['idNacionalidad']);


			$queryRecordUser=self::getUserController(array("aliasUser"=>$aliasUser));

			$queryRecordUser->execute();

			$dataRecordUser = $queryRecordUser->fetch();				 


		 	if (mainModel::isDataEmtpy($aliasUser)) {
			$alert=[
				"Alert"=>"simple",
				"Title"=>"Datos Vacios",
				"Text"=>"Datos no recibidos",
				"Type"=>"error"
			];
			
			echo json_encode($alert);

			exit();

		 	}


		  if(strcmp($aliasUser,"master")==0){
			
			$alert=[
				"Alert"=>"simple",
				"Title"=>"Ocurrio un error inesperado",
				"Text"=>"El usuarios super administrador no puede ser eliminado",
				"Type"=>"error"
			];
			echo json_encode($alert);

			exit();
			}

		// Si la persona  solo tiene un usuario y no presenta un caso epidemiologico, elimanos datos personales del BD pero primero avisamos


		$userRecordsPerDocIdentidad = mainModel::runSimpleQuery("SELECT alias FROM `usuarios` WHERE docIdentidad =
			'$docIdentidad'");

		$casosEpidemiRecordsPerDocIdentidad = mainModel::runSimpleQuery("SELECT docIdentidad FROM `casosEpidemiologicos` WHERE docIdentidad =
			'$docIdentidad'");


		if ($userRecordsPerDocIdentidad->rowCount()==1 && $casosEpidemiRecordsPerDocIdentidad->rowCount() == 0) {
					$alert=[
						"Alert"=>"confirmation",
						"Text"=>"Esta persona no posee mas usuarios ni presenta un caso epidemiologico por lo que se eliminara del sistema completamente",
						"Url"=>"".SERVERURL."ajax/userAjax.php",
						"Data"=>"docIdentidad=$docIdentidad&aliasUsuario=$aliasUser&idNacionalidad=$idNacionalidad&operationType=delete&confirmDelete=true",
						"Method"=>"POST"];
					
					echo json_encode($alert);

					exit();
		}
	}
		

		mainModel::deleteBitacora($aliasUser);


		userModel::deleteUserModel(array('aliasUser'=>$aliasUser));

		// Eliminacion de la persona
		if (isset($dataUser['confirmDelete'])) {

		require_once "../controller/personaController.php";
	
		$personaController = new personaController();
		
		$primaryKeyPersona = [
			"idNacionalidad"=>$idNacionalidad,
			"docIdentidad"=>$docIdentidad];
		
		$personaController->deletePersonaController($primaryKeyPersona);
		}
		


			$alert=[
				"Alert"=>"reload",
				"Title"=>"Operacion Exitosa",
				"Text"=>"El usuario ha sido eliminado",
				"Type"=>"success"
			];
			
			echo json_encode($alert);

			exit();

				 }

			public static function getUserController($dataUser){
 		 			 
		$userAttributesFilter = [];

 		$filterValues = [];

		if (isset($dataUser["idNacionalidad"]) && !mainModel::isDataEmtpy($dataUser["idNacionalidad"])) {

		$idNacionalidad = mainModel::cleanStringSQL($dataUser["idNacionalidad"]);

		array_push($userAttributesFilter, 'usr.idNacionalidad = :idNacionalidad');
		$filterValues[':idNacionalidad'] = [
		'value' => $idNacionalidad,
		'type' => \PDO::PARAM_STR,
		];}

		if (isset($dataUser["docIdentidad"]) && !mainModel::isDataEmtpy($dataUser["docIdentidad"])) {

		$docIdentidad = mainModel::cleanStringSQL($dataUser["docIdentidad"]);

		array_push($userAttributesFilter, 'usr.docIdentidad = :docIdentidad');
		$filterValues[':docIdentidad'] = [
		'value' => $docIdentidad,
		'type' => \PDO::PARAM_STR,
		];}

		if (isset($dataUser["aliasUser"]) && !mainModel::isDataEmtpy($dataUser["aliasUser"])) {
		
		$aliasUser = mainModel::cleanStringSQL($dataUser["aliasUser"]);

		array_push($userAttributesFilter, 'usr.alias = :aliasUser');
		$filterValues[':aliasUser'] = [
		'value' => $aliasUser,
		'type' => \PDO::PARAM_STR,
		];}

		if (isset($dataUser["idNivelPermiso"]) && !mainModel::isDataEmtpy($$dataUser["idNivelPermiso"])) {

		$idNivelPermiso = mainModel::cleanStringSQL($dataUser["idNivelPermiso"]);

		array_push($userAttributesFilter, 'idNivelPermiso = :idNivelPermiso');
		$filterValues[':idNivelPermiso'] = [
		'value' => $idNivelPermiso,
		'type' => \PDO::PARAM_INT,
		];}


		if (isset($dataUser["idEstado"]) && !mainModel::isDataEmtpy($dataUser["idEstado"])) {

		$idEstado = mainModel::cleanStringSQL($dataUser["idEstado"]);

		array_push($userAttributesFilter, 'usr.idEstado = :idEstado');
		$filterValues[':idEstado'] = [
		'value' => $idEstado,
		'type' => \PDO::PARAM_STR,
		];}


		if (isset($dataUser["email"]) && !mainModel::isDataEmtpy($dataUser["email"])) {

		$email = mainModel::cleanStringSQL($dataUser["email"]);

		array_push($userAttributesFilter, '$email = :$email');
		$filterValues[':$email'] = [
		'value' => $email,
		'type' => \PDO::PARAM_STR,
		];}

	 return userModel::getUserModel($userAttributesFilter,$filterValues);

	}


 
	public static function restartUserController($dataUser){
	

		 $aliasUser = mainModel::cleanStringSQL($dataUser["aliasUser"]);


		 $aliasUser = mainModel::decryption($dataUser["aliasUser"]);

		$userAttributesUpdate = [];

 		$userValuesUpdate = [];

		$queryIsExistUser = mainModel::runSimpleQuery("SELECT alias FROM `usuarios` WHERE alias = '$aliasUser'");
					
		$queryIsExistUser->execute();


		if(!$queryIsExistUser->rowCount()){
				
				$alert=[
				"Alert"=>"simple",
				"Title"=>"Datos Invalidos",
				"Text"=>"Error de envio de datos",
				"Type"=>"error"
			];

				echo json_encode($alert);

				exit();

			}

				$userValuesUpdate['aliasUser'] = [
				'value' => $aliasUser,
				'type' => \PDO::PARAM_STR,
				];

				array_push($userAttributesUpdate, 'idEstado = :idEstado');
				$userValuesUpdate['idEstado'] = [
				'value' => 2,
				'type' => \PDO::PARAM_INT,
				];


				$alert=[
				"Alert"=>"reload",
				"Title"=>"Operacion Exitosa",
				"Text"=>"Datos del usuario reiniciados",
				"Type"=>"success"
			];

				if (!userModel::updateUserModel($userValuesUpdate,$userAttributesUpdate)) {

					$alert=[
				"Alert"=>"simple",
				"Title"=>"Ha ocurrido un error inesperado",
				"Text"=>"Error al modificar los datos",
				"Type"=>"error"
			];

				}


				echo json_encode($alert);

				exit();	 		
	}

public static function paginateUserController($currentPaginate,$nivelUser,$aliasUser){

	$currentPaginate= mainModel::cleanStringSQL($currentPaginate);
	$nivelUser= mainModel::cleanStringSQL($nivelUser);
	$aliasUser= mainModel::cleanStringSQL($aliasUser);


	$connectDB = mainModel::connectDB();

	$stringQueryForGetUsers = userModel::stringQueryForGetUser();

	$recordsQueryUser = $connectDB->query($stringQueryForGetUsers." WHERE usr.alias != '$aliasUser' AND usr.alias != 'Master' GROUP BY usr.alias ORDER BY usr.docIdentidad ASC");

	$dataRecordsQueryUser = $recordsQueryUser->fetchAll();

	$totalRecordsQueryUser=$connectDB->query("SELECT FOUND_ROWS()");

	$totalRecordsQueryUser=(int)$totalRecordsQueryUser->fetchColumn();

	$nroRecordsDisplay = $totalRecordsQueryUser;

	$currentPaginate = (isset($currentPaginate) && $currentPaginate>0) ? (int)$currentPaginate : 1 ;

	$initialRecords = ($currentPaginate>0) ? (($currentPaginate*$nroRecordsDisplay)-$nroRecordsDisplay) :0;

	$nroPaginates = ceil($totalRecordsQueryUser/$nroRecordsDisplay);


$table = "";
$table.="<div class='table-responsive'>
                <table class='table table-bordered' id='dataTable' width='100%' cellspacing='0'>
                  <thead>
                    <tr>
                      <th>Nro. </th>
                     <th>Genero</th>
                      <th>Documento de Identidad</th>
                      <th>Alias</th>
                      <th>Nombres</th>
                      <th>Apellidos</th>
                      <th>Nivel de Permiso</th>
                      <th>Estado</th>
                      <th>Email</th>
                      <th></th>
                      <th></th>
                      <th></th>
                    </tr>
                  </thead>
                  <tfoot>
                    <tr>
                       <th>Nro. </th>
                      <th>Genero</th>
                      <th>Documento de Identidad</th>
                      <th>Alias</th>
                      <th>Nombres</th>
                      <th>Apellidos</th>
                      <th>Nivel de Permiso</th>
                      <th>Estado</th>
                      <th>Email</th>
                      <th></th>
                      <th></th>
                    </tr>
                  </tfoot>
                  <tbody>";

		if ($totalRecordsQueryUser>=1 && $currentPaginate<=$nroPaginates) { 
			$count = $initialRecords+1;

			foreach ($dataRecordsQueryUser as $rows) {

				if ($rows['idNacionalidad'] === "1") {
					$nacionalidad = "V";
				}else{
					$nacionalidad = "E";
				}

				if ($rows['idGenero'] == "1"){
                  $rows['iconGenero'] = "male-user.png"; 
                }elseif ($rows['idGenero'] == "2") {
                  $rows['iconGenero'] = "fermale-user.png"; 
                }

			$table.='
                 <tr>
                    <td>'.$count.'</td>
                    <td> 
                    <span class="d-none">'.$rows["idGenero"].'</span>
                    <img class="img-profile rounded-circle" width="40" src="'.SERVERURL.'view/img/'.$rows["iconGenero"].'"></td>

		 			<td>'.$nacionalidad.'-'.$rows['docIdentidad'].'</td>
					<td>'.$rows['aliasUsuario'].'</td>
                    <td>'.$rows['nombres'].'</td>
                    <td>'.$rows['apellidos'].'</td>
		 			<td>'.$rows['descripcionNivelPermiso'].'</td>
		 			<td>'.$rows['descripcionEstado'].'</td>
		 			<td>'.$rows['email'].'</td>
		 			<td>
	                  <a href="'.SERVERURL.'dataAccount/'.mainModel::encryption($rows['aliasUsuario']).'" class="btn btn-info btn-circle btn-sm">
	                    <i class="fas  fa-plus"></i>
	                  </a>
		 			</td>


				<td>
		 		<form class="formAjax" action="'.SERVERURL.'ajax/userAjax.php" method="POST" data-form="restart" enctypy="multipart/form-data" autocomplete="off">
					
					<input name= "aliasUser" type="hidden" value="'.mainModel::encryption($rows['aliasUsuario']).'">

					<input name= "idNacionalidad" type="hidden" value="'.mainModel::encryption($rows['idNacionalidad']).'">

					<input name= "docIdentidad" type="hidden" value="'.mainModel::encryption($rows['docIdentidad']).'">

						<button type="submit" value = "delete" class="btn btn-warning btn-circle btn-sm">
	                    <i class="fas fa-redo"></i>
	                     </button>
	                     <div class="responseProcessAjax"></div>
		 			</form>
				</td>

		 			<td>
		 		<form class="formAjax" action="'.SERVERURL.'ajax/userAjax.php" method="POST" data-form="delete" enctypy="multipart/form-data" autocomplete="off">
					
					<input name= "aliasUsuario" type="hidden" value="'.mainModel::encryption($rows['aliasUsuario']).'">

					<input name= "idNacionalidad" type="hidden" value="'.mainModel::encryption($rows['idNacionalidad']).'">

					<input name= "docIdentidad" type="hidden" value="'.mainModel::encryption($rows['docIdentidad']).'">

						<button type="submit" value = "delete" class="btn btn-danger btn-circle btn-sm">
	                    <i class="fas fa-trash"></i>
	                     </button>
	                     <div class="responseProcessAjax"></div>
		 			</form>
		 			</td>
               </tr>
			';

			$count ++;
			
			}
		}else{

			if ($totalRecordsQueryUser>=1) {
		$table.='
			<tr>
			<td colspan="10">
			<a href="'.SERVERURL.'user-list/" class="btn btn-success btn-icon-split">
              <span class="icon text-white-50">
                <i class="fas fa-redo"></i>
              </span>
              <span class="text">Recargar Lista</span>
            </a>
            </td>
			</tr>';

			}else{
			$table.="
			<tr>
				<td colspan='10'>No hay registros en el sistema</td>
			</tr>
			";
			}
		}
$table.="</tbody>
                </table>
              </div>";



	return $table;

}

	private static function isValidEmail($email){
		  return (false !== filter_var($email, FILTER_VALIDATE_EMAIL));
		  }

	private static function isValidPassword($pass){


	$pattern='/^(?=.*\d)(?=.*[@#\-_$%^&+=§!\?])(?=.*[a-z])(?=.*[A-Z])[0-9A-Za-z@#\-_$%^&+=§!\?]{8,20}$/';

	    if (preg_match($pattern,$pass)) {
			return TRUE;
		}

		return FALSE;

	}

	 private static function isValidAliasUser($aliasUser){

	if(preg_match('/^(?=.*\d)(?=.*[@#\-_$%^&+=§!\?])(?=.*[a-z])[0-9a-za-z@#\-_$%^&+=§!\?]{5,20}$/', $aliasUser)) {
		return true;
	}
		return false;

	}

	 public static function printUserTypeCountController(){
		
		$userAdmins = userModel::userTypeCounterModel('idNivelPermiso',1);
		
		$userOperators = userModel::userTypeCounterModel('idNivelPermiso',2);

		$userInviteds = userModel::userTypeCounterModel('idNivelPermiso',3);

		$userActives = userModel::userTypeCounterModel('idEstado',1);

		$userInactives = userModel::userTypeCounterModel('idEstado',0);

		$userRestarts = userModel::userTypeCounterModel('idEstado',2);

		$usersTotal = userModel::userTypeCounterModel('alias',NULL);

		$dataCounTypeUsers = [
		'userAdmins' => $userAdmins->rowCount(),
		'userOperators' => $userOperators->rowCount(),
		'userInviteds' => $userInviteds->rowCount(),
		'userActives' => $userActives->rowCount(),
		'userInactives' => $userInactives->rowCount(),
		'usersTotal' => $usersTotal->rowCount(),
		'userRestarts' => $userRestarts->rowCount()
	];

        echo "
  		Administradores: ".$dataCounTypeUsers['userAdmins']." 
  		<br>
        Operadores: ".$dataCounTypeUsers['userOperators']."
  		<br>
        Invitados: ".$dataCounTypeUsers['userInviteds']."
  		<br>
        Activos: ".$dataCounTypeUsers['userActives']."
  		<br>
        Inactivos: ".$dataCounTypeUsers['userInactives']."
		<br>
        Reiniciados: ".$dataCounTypeUsers['userRestarts']."
		<br>
        Total: ".$dataCounTypeUsers['usersTotal']."";
		
	}
}

 ?>
