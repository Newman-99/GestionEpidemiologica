	<?php 
	
	$requestAjax = TRUE;

	if($requestAjax){
		require_once "../model/userModel.php";
	}else{
		require_once "./model/userModel.php";
	}

	class userController extends userModel{

		public function addUserController($dataUser){
			
			
			$aliasUser = mainModel::cleanStringSQL($dataUser["aliasUser"]);
		 	$docIdentidad = mainModel::cleanStringSQL($dataUser["docIdentidad"]);
		 	// 3 = Invitado en DB
		 	$idNivelPermiso = "3";
		 	// 0 = Inactivo  en DB		 	
		 	$idEstado = "0";
		 	$password = mainModel::cleanStringSQL($dataUser["password"]);
		 	$passwordConfirm = mainModel::cleanStringSQL($dataUser["passwordConfirm"]); 

		 	$email = mainModel::cleanStringSQL($dataUser["email"]);

		 
		 	$dataUser = array();

			if (mainModel::isDataEmtpy($aliasUser,
		 	$docIdentidad,
		 	$password,
		 	$passwordConfirm, 
		 	$email)){

				$alert=[
					"Alert"=>"simple",
					"Title"=>"Campos Vacios",
					"Text"=>"Todos los campos del usuario deben ser llenados",
					"Type"=>"error"
				];

				echo json_encode($alert);

				exit();

			}

			// Si exist el alias de usuario


			$dataUser['aliasUser'] = $aliasUser;

				echo getUserController($dataUser['aliasUser']);

				exit();

/*
			if (getUserController($dataUser['aliasUser']) {

			}
*/

		 	$dataUser['docIdentidad'] = $docIdentidad;
		 	$dataUser['idNivelPermiso'] = $idNivelPermiso;
		 	$dataUser['idEstado'] = $idEstado;
		 	$dataUser['password'] = $password;
		 	$dataUser['passwordConfirm'] = $passwordConfirm; 
		 	$dataUser['email'] = $email;

			// userModel::addUserModel($dataUser);

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

			public function getUserController($dataUser){
 		 			 

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
	}


 ?>
