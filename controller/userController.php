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

			echo "<h1>REGISTRADO</h1>";

			var_dump($dataUser);

			 userModel::addUserModel($dataUser);

			}
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

			echo "<h1>Actualizado</h1>";

			var_dump($dataUser);

			 userModel::updateUserModel($dataUser);

			}
		}

				public function deleteUserController($dataUser){
			
		 $aliasUser = mainModel::cleanStringSQL($dataUser['aliasUser']);
		 
		 
		 			if (mainModel::isDataEmtpy(
						 $aliasUser)) {
			 		echo "<h1>aliasUser VACIO</h1>";
				 	}else{


		 $dataUser = array();

		 $dataUser['aliasUser'] = $aliasUser;
		 
			echo "<h1>Eliminado</h1>";

			var_dump($dataUser);

			 userModel::deleteUserModel($dataUser);

				 	}

				 }

			public function getUserController($dataUser){
 
			$aliasUser = mainModel::cleanStringSQL($dataUser["aliasUser"]);
		 	$docIdentidad = mainModel::cleanStringSQL($dataUser["docIdentidad"]);
		 	// 3 = Invitado en DB
		 	$idNivelPermiso = "3";
		 	// 0 = Inactivo  en DB		 	
		 	$idEstado = "0";
		 
		 	$email = mainModel::cleanStringSQL($dataUser["email"]);


		$UserAttributesFilter = [];

 		$filterValues = [];

		if (!empty($docIdentidad)) {
		array_push($UserAttributesFilter, 'docIdentidad = :docIdentidad');
		$filterValues[':docIdentidad'] = [
		'value' => $docIdentidad,
		'type' => \PDO::PARAM_STR,
		];}

		if (!empty($aliasUser)) {
		array_push($UserAttributesFilter, 'alias = :aliasUser');
		$filterValues[':aliasUser'] = [
		'value' => $aliasUser,
		'type' => \PDO::PARAM_STR,
		];}

		if (!empty($idNivelPermiso)) {
		array_push($UserAttributesFilter, 'idNivelPermiso = :idNivelPermiso');
		$filterValues[':idNivelPermiso'] = [
		'value' => $idNivelPermiso,
		'type' => \PDO::PARAM_INT,
		];}
		if (!empty($idEstado)) {
		array_push($UserAttributesFilter, 'idEstado = :idEstado');
		$filterValues[':idEstado'] = [
		'value' => $idEstado,
		'type' => \PDO::PARAM_STR,
		];}


		if (!empty($email)) {
		array_push($UserAttributesFilter, '$email = :$email');
		$filterValues[':$email'] = [
		'value' => $email,
		'type' => \PDO::PARAM_STR,
		];}


		// Si todos estan vacios
		if (mainModel::isDataEmtpy($docIdentidad) == TRUE &&
		 mainModel::isDataEmtpy($aliasUser) == TRUE &&
		 mainModel::isDataEmtpy($idNivelPermiso) == TRUE &&
		 mainModel::isDataEmtpy($idEstado) == TRUE &&
		 mainModel::isDataEmtpy($email == TRUE)){

			echo "Todos Vacioo, No Permitido";

		}else{


	var_dump(userModel::getUserModel($UserAttributesFilter,$filterValues));

		}

		}
	}


 ?>
