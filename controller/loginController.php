<?php 	


	if($requestAjax){
		require_once "../controller/userController.php";
	}else{
		require_once "./controller/userController.php";
	}

	class loginController extends userController{
// Iniamos y revismo el contador en cada pagina para cerrar la sesion


	function __construct(){


		session_start(['name'=>'dptoEpidemi']);	

	if (isset($_SESSION['timeout']) && (time() - $_SESSION['timeout'] > 10800)) {
			
			self::forceClosureController();

	}
				$_SESSION['timeout'] = time();
}


public function loginUserController($dataUser){
			// si hay una sesion iniciada se le registre su cieerre de sesion en bitacora

			if (isset($_SESSION['aliasUser'])) {

			$currentDate =  mainModel::getDateCurrentSystem();

			$currentHour = date("h:i:s a", $currentDate);
 
			$dataSession=[
			"aliasUser"=>$_SESSION["aliasUser"],
			"tokenCurrentUser"=>$_SESSION["token_dptoEpidemi"],
			"bitacora_hora_final"=>$currentHour,
			"token_dptoEpidemi"=>$_SESSION["token_dptoEpidemi"],
			"bitacora_codigo"=>$_SESSION["bitacora_codigo"]];


			$updateUsuarioBitacora = mainModel::updateUsuarioBitacora($dataSession);
			
			if (!$updateUsuarioBitacora->rowCount()) {
				$alert=[
					"Alert"=>"simple",
					"Title"=>"Ocurrio un error inesperado",
					"Text"=>"No se pudo cerrar la anterior sesion en el sistema",
					"Type"=>"error"

				];
			}
				session_unset();
				session_destroy();
			// se vuelve a crear para usarla despues
		session_start(['name'=>'dptoEpidemi']);
	}

		$aliasUser = mainModel::cleanStringSQL($dataUser["aliasUser"]);
		$passRequest = mainModel::cleanStringSQL($dataUser["password"]);


		if (mainModel::isDataEmtpy($aliasUser,
		 	$passRequest)){

				$alert=[
					"Alert"=>"simple",
					"Title"=>"Campos Vacios",
					"Text"=>"Todos los campos del usuario son obligatorios",
					"Type"=>"error"
				];

				echo json_encode($alert);

				exit();

			}

			// para usar los metodos de user como si heredaramos

			$recordsUserSQL = userController::getUserController(array("aliasUser"=>$aliasUser));
					
			$recordsUserSQL->execute();

		if(!$recordsUserSQL->rowCount()){
				
				$alert=[
				"Alert"=>"simple",
				"Title"=>"Datos no encontrados",
				"Text"=>"El alias de usuario o la contraseña son incorrectos",
				"Type"=>"error"
			];
				echo json_encode($alert);

				exit();

			}


		// Obtener datos de usuario
		while($valuesDataUser=$recordsUserSQL->fetch(PDO
			::FETCH_ASSOC)){ 

			$pass_encryptDB = $valuesDataUser["pass_encrypt"]; 

			$aliasUser = $valuesDataUser["usuario_alias"]; 			
			$doc_identidad = $valuesDataUser["doc_identidad"];

			$id_nivel_permiso = $valuesDataUser["id_nivel_permiso"];

			$id_estado = $valuesDataUser["id_estado"];			
		}

			// Comprobar contrasenas

			$passRequest = mainModel::encryption($passRequest);

		    if (strcmp($pass_encryptDB, $passRequest) != 0){
				$alert=[
				"Alert"=>"simple",
				"Title"=>"Datos Invalidos",
				"Text"=>"El alias de usuario o la contraseña son incorrectos ",
				"Type"=>"error"
			];

				echo json_encode($alert);

				exit();
    	}


		// Obtener datos de person
			require_once "../controller/personController.php";

			$personController = new personController();

			$recordspersonasQL = personController::getpersonController(array("doc_identidad"=>$doc_identidad));
					
			$recordspersonasQL->execute();
	
			while($valuesdataPerson=$recordspersonasQL->fetch(PDO
			::FETCH_ASSOC)){ 

			$nameUser = $valuesdataPerson["id_genero"]; 
			$nameUser = $valuesdataPerson["nombres"]; 
			$lastNamesUser = $valuesdataPerson["apellidos"]; 
			$id_generoUser = $valuesdataPerson["id_genero"]; 

		}


		// Comprobar que el estado del usuario se ha valido
		
		if($id_estado == 0 || $id_estado == 2){
				
				$alert=[
				"Alert"=>"simple",
				"Title"=>"Permiso Denegado",
				"Text"=>"El usuario se encuentra inactivo o reiniciado, por favor contactar un administrador",
				"Type"=>"error"
			];

				echo json_encode($alert);

				exit();

			}

			// Datos para la bitacora
			
				$currentDate =  mainModel::getDateCurrentSystem();


				$currentYear = date("Y", $currentDate);

				$currentHour = date("h:i:s a", $currentDate);

				$currentDate = date("Y-m-d", $currentDate);


				$queryRecordsBitacora = mainModel::connectDB()->query("SELECT id_bitacora FROM usuario_bitacora");

				$totalRecordsBitacora = ($queryRecordsBitacora->rowCount())+1;

				$bitacora_codigo = mainModel::generateRandomCode("CB",8,$totalRecordsBitacora);

				$data_usuario_bitacora=[
					"usuario_alias"=>$aliasUser,
					"bitacora_codigo"=>$bitacora_codigo,
					"bitacora_fecha"=>$currentDate,
					"bitacora_year"=>$currentYear,
					"bitacora_hora_inicio"=>$currentHour,
					"bitacora_hora_final"=> NULL,//Se registrar cuando cierre secion
					"bitacora_nivel_usuario"=>$id_nivel_permiso];

					mainModel::addUsuarioBitacora($data_usuario_bitacora);
					
				

				// Datos para las variables de SESSION

				$arrayNamesUser = explode (" ", $nameUser);
				$arrayLastNamesUser = explode (" ", $lastNamesUser);			   
				$_SESSION['doc_identidad']=$doc_identidad;
				$_SESSION['aliasUser']=$aliasUser;

				$_SESSION['nameUser']=$arrayNamesUser[0];
				$_SESSION['lastNameUser']=$arrayLastNamesUser[0];
				$_SESSION['id_nivel_permiso']=$id_nivel_permiso;
				$_SESSION['id_estado']=$id_estado;
				$_SESSION['id_generoUser']=$id_generoUser;
				$_SESSION['bitacora_codigo']=$bitacora_codigo;

				$_SESSION['token_dptoEpidemi']=md5(uniqid(mt_rand(),true));
			
				if ($id_generoUser == "1"){
                  $_SESSION['iconUser'] = "male-user.png"; 
                }elseif ($id_generoUser == "2") {
                  $_SESSION['iconUser'] = "fermale-user.png"; 
                }


				$alert=[
				"Alert"=>"redirecting",
				"URL"=>SERVERURL."dashboard/"
				];

				echo json_encode($alert);

				exit();

		}
 
		public function forceClosureController(){

			// si hay una sesion iniciada, se usa closeControllerSession para que registre la bitacora
			if (isset($_SESSION['aliasUser'])) {
					$dataSession=[
			"tokenCurrentUser"=>mainModel::encryption($_SESSION["token_dptoEpidemi"])];
			self::closeControllerSession($dataSession);
	}

			session_unset();
			session_destroy();

			if(headers_sent()){
				return header("Location: ".SERVERURL);
			}else{
				return header("Location: ".SERVERURL);
			}

			}


		public function closeControllerSession($dataSession){

			$tokenCurrentUser=mainModel::decryption($dataSession['tokenCurrentUser']);

			$aliasUser= $_SESSION['aliasUser'];

			$currentDate =  mainModel::getDateCurrentSystem();

			$currentHour = date("h:i:s a", $currentDate);

			$dataSession=[
			"aliasUser"=>$aliasUser,
			"tokenCurrentUser"=>$tokenCurrentUser,
			"bitacora_hora_final"=>$currentHour,
			"token_dptoEpidemi"=>$_SESSION["token_dptoEpidemi"],
			"bitacora_codigo"=>$_SESSION["bitacora_codigo"]];

			// si no se crea otra alert, imprimira este msj error
				$alert=[
					"Alert"=>"simple",
					"Title"=>"Ocurrio un error inesperado",
					"Text"=>"No se pudo cerrar la sesion en el sistema",
					"Type"=>"error"

				];

			if($tokenCurrentUser==$_SESSION['token_dptoEpidemi']){

			$updateUsuarioBitacora = mainModel::updateUsuarioBitacora($dataSession);
			
			if ($updateUsuarioBitacora->rowCount()) {


				session_unset();
				session_destroy();
			
				$alert=[
				"Alert"=>"simpleReload",
				];

			}

		}			
			echo json_encode($alert);
			exit();
	}

public function forgotPassUserController($dataUser){


		 $aliasUser = mainModel::cleanStringSQL($dataUser["aliasUser"]);


		if (mainModel::isDataEmtpy($aliasUser,
		 	$dataUser["question1"],$dataUser["question2"],$dataUser["newPassword"],$dataUser["newPasswordConfirm"])){

				$alert=[
					"Alert"=>"simple",
					"Title"=>"Campos Vacios",
					"Text"=>"Todos los campos son obligatorios",
					"Type"=>"error"
				];

				echo json_encode($alert);

				exit();

			}

			// Desactivamos el usuario
			
		$userAttributesUpdate = [];

 		$userValuesUpdate = [];

			// Actualizamos la contrasenia
			$resultQueryModifyUserSafetyData = userController::modifyUserSafetyDataController($dataUser);


				$userValuesUpdate['aliasUser'] = [
				'value' => $aliasUser,
				'type' => \PDO::PARAM_STR,
				];

				array_push($userAttributesUpdate, 'id_estado = :id_estado');
				$userValuesUpdate['id_estado'] = [
				'value' => 0,
				'type' => \PDO::PARAM_INT,
				];

			$resultQueryUpdateUserStatus = userModel::updateUserModel($userValuesUpdate,$userAttributesUpdate);


			$alert=[
				"Alert"=>"simple",
				"Title"=>"Ocurrio un error inesperado",
				"Text"=>"Error en la actualizacion del usuario",
				"Type"=>"error"
			];

			if ($resultQueryModifyUserSafetyData && $resultQueryUpdateUserStatus) {
			$alert=[
				"Alert"=>"reload",
				"Title"=>"Operacion Exitosa",
				"Text"=>"Contraseña Recuperada, Por favor contacte con el administrador para reactivar su cuenta",
				"Type"=>"success"
			];

			}

				echo json_encode($alert);

				exit();	 	


}


public function addDataForUserRestartController($dataUser){


		 $aliasUser = mainModel::cleanStringSQL($dataUser["aliasUser"]);

		$userAttributesUpdate = [];

 		$userValuesUpdate = [];

		if (mainModel::isDataEmtpy($aliasUser,
		 	$dataUser["newQuestion1"],$dataUser["newQuestion2"],$dataUser["newPassword"],$dataUser["newPasswordConfirm"])){

				$alert=[
					"Alert"=>"simple",
					"Title"=>"Campos Vacios",
					"Text"=>"Todos los campos son obligatorios",
					"Type"=>"error"
				];

				echo json_encode($alert);

				exit();

			}

			$resultQueryModifyUserSafetyData = userController::modifyUserSafetyDataController($dataUser);

				$userValuesUpdate['aliasUser'] = [
				'value' => $aliasUser,
				'type' => \PDO::PARAM_STR,
				];

				array_push($userAttributesUpdate, 'id_estado = :id_estado');
				$userValuesUpdate['id_estado'] = [
				'value' => 0,
				'type' => \PDO::PARAM_INT,
				];

			$resultQueryUpdateUserStatus = userModel::updateUserModel($userValuesUpdate,$userAttributesUpdate);

			$alert=[
				"Alert"=>"simple",
				"Title"=>"Ocurrio un error inesperado",
				"Text"=>"Error en la actualizacion del usuario",
				"Type"=>"error"
			];

			if ($resultQueryModifyUserSafetyData && $resultQueryUpdateUserStatus) {
			$alert=[
				"Alert"=>"reload",
				"Title"=>"Operacion Exitosa",
				"Text"=>"Datos de Seguridad reiniciados, Por favor contacte con el administrador para reactivar su cuenta",
				"Type"=>"success"
			];

			}

				echo json_encode($alert);

				exit();			
}

	public static function randIconUserIMG(){

	$id_generoUser =mt_rand(1,2);
	if ($id_generoUser == "1"){
		 return $iconUser = "male-user.png"; 
			}elseif ($id_generoUser == "2") {
				 return $iconUser = "fermale-user.png"; 
           	}




       }

 }
 ?>