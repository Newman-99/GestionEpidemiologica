	<?php 
	
	$requestAjax = TRUE;

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
		 $primaryKeyPersona = array();

		 $primaryKeyPersona['idNacionalidad'] = $idNacionalidad;

		 $primaryKeyPersona['docIdentidad'] = $docIdentidad;

		 	// Si existe comprobarlo en la bd

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
			}else{

				// Si no hay errores anade la persona que sera el usuario
				$personaController->addPersonaController($dataUser);

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

    		if(!self::isValidAliasUser($aliasUser)){
				
				$alert=[
				"Alert"=>"simple",
				"Title"=>"Datos Invalidos",
				"Text"=>"El Alias de 	Usuario debe tener:
					<br>
					Entre 5 y 20 caracteres
					<br>
					Almenos una letra
					<br>
					Almenos una numero	
					<br>
					No se permite espacios en blanco
				",
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


		 $dataUser = array();

		 	$dataUser['docIdentidad'] = $docIdentidad;

		 	$dataUser['idNivelPermiso'] = $idNivelPermiso;

		 	$dataUser['idEstado'] = $idEstado;

		 	$dataUser['aliasUser'] = $aliasUser;

		 	$dataUser['password'] = mainModel::encryption($password);

		 	$dataUser['question1'] = mainModel::encryption($question1);

		 	$dataUser['question2'] = mainModel::encryption($question2);

		 	$dataUser['email'] = $email;		 	
		 	$dataUser['telefono'] = $telefono;

			userModel::addUserModel($dataUser);


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
			
			
			$aliasUser = mainModel::cleanStringSQL($dataUser["aliasUser"]);
		 	$docIdentidad = mainModel::cleanStringSQL($dataUser["docIdentidad"]);
		 	// 3 = Invitado en DB
		 	$idNivelPermiso = "3";
		 	// 0 = Inactivo  en DB		 	
		 	$idEstado = "0";
		 	
		 	$password = mainModel::cleanStringSQL($dataUser["password"]);
		 	$passwordConfirm = mainModel::cleanStringSQL($dataUser["passwordConfirm"]); 
		 	$email = mainModel::cleanStringSQL($dataUser["email"]);
		 
			if (mainModel::isDataEmtpy($aliasUser,
		 	$docIdentidad,
		 	$password,
		 	$passwordConfirm, 
		 	$email)){
				echo "ALGO VACIO!";
			}else{

			$dataUser = array();

			$dataUser['aliasUser'] = $aliasUser;
		 	$dataUser['docIdentidad'] = $docIdentidad;
		 	$dataUser['idNivelPermiso'] = $idNivelPermiso;
		 	$dataUser['idEstado'] = $idEstado;
		 	$dataUser['password'] = $password;
		 	$dataUser['passwordConfirm'] = $passwordConfirm; 
		 	$dataUser['email'] = $email;

			 userModel::updateUserModel($dataUser);

			}
		}


		public function deleteUserController($dataUser){
			
		 $aliasUser = mainModel::cleanStringSQL($dataUser['aliasUser']);
		 
		 
		 	if (mainModel::isDataEmtpy(
						 $aliasUser)) {

				 	}else{


		 $dataUser = array();

		 $dataUser['aliasUser'] = $aliasUser;
		 
			 userModel::deleteUserModel($dataUser);

				 	}

				 }

			public static function getUserController($dataUser){
 		 			 
		$userAttributesFilter = [];

 		$filterValues = [];

		if (isset($dataUser["docIdentidad"]) && !mainModel::isDataEmtpy($dataUser["docIdentidad"])) {

		$docIdentidad = mainModel::cleanStringSQL($dataUser["docIdentidad"]);

		array_push($userAttributesFilter, 'docIdentidad = :docIdentidad');
		$filterValues[':docIdentidad'] = [
		'value' => $docIdentidad,
		'type' => \PDO::PARAM_STR,
		];}

		if (isset($dataUser["aliasUser"]) && !mainModel::isDataEmtpy($dataUser["aliasUser"])) {
		
		$aliasUser = mainModel::cleanStringSQL($dataUser["aliasUser"]);

		array_push($userAttributesFilter, 'alias = :aliasUser');
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

		array_push($userAttributesFilter, 'idEstado = :idEstado');
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

	//$pattern='/^(?=.*\d)(?=.*[a-z]){5,20}$/';

	if(preg_match('/^[a-zA-Z0-9]{5,20}+$/', $aliasUser)) {

		return true;
	/*
	    if (preg_match($pattern,$aliasUser)) {
			return TRUE;
		}
		return FALSE;
	*/
	}else{
		return false;

		}

	}

}

 ?>
