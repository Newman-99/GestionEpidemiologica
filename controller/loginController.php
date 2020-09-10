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
			"bitacoraHoraFinal"=>$currentHour,
			"token_dptoEpidemi"=>$_SESSION["token_dptoEpidemi"],
			"bitacoraCodigo"=>$_SESSION["bitacoraCodigo"]];


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

			$passEncryptDB = $valuesDataUser["passEncrypt"]; 

			$aliasUser = $valuesDataUser["aliasUsuario"]; 			
			$docIdentidad = $valuesDataUser["docIdentidad"];

			$idNivelPermiso = $valuesDataUser["idNivelPermiso"];

			$idEstado = $valuesDataUser["idEstado"];			
		}

			// Comprobar contrasenas

			$passRequest = mainModel::encryption($passRequest);

		    if (strcmp($passEncryptDB, $passRequest) != 0){
				$alert=[
				"Alert"=>"simple",
				"Title"=>"Datos Invalidos",
				"Text"=>"El alias de usuario o la contraseña son incorrectos ",
				"Type"=>"error"
			];

				echo json_encode($alert);

				exit();
    	}


		// Obtener datos de persona
			require_once "../controller/personaController.php";

			$personController = new personaController();

			$recordsPersonSQL = personaController::getPersonaController(array("docIdentidad"=>$docIdentidad));
					
			$recordsPersonSQL->execute();
	
			while($valuesDataPerson=$recordsPersonSQL->fetch(PDO
			::FETCH_ASSOC)){ 

			$nameUser = $valuesDataPerson["idGenero"]; 
			$nameUser = $valuesDataPerson["nombres"]; 
			$lastNamesUser = $valuesDataPerson["apellidos"]; 
			$idGeneroUser = $valuesDataPerson["idGenero"]; 

		}


		// Comprobar que el estado del usuario se ha valido
		
		if($idEstado == 0 || $idEstado == 2){
				
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


				$queryRecordsBitacora = mainModel::runSimpleQuery("SELECT id FROM bitacora");

				$totalRecordsBitacora = ($queryRecordsBitacora->rowCount())+1;

				$bitacoraCodigo = mainModel::generateRandomCode("CB",8,$totalRecordsBitacora);

				$dataUsuarioBitacora=[
					"usuarioAlias"=>$aliasUser,
					"bitacoraCodigo"=>$bitacoraCodigo,
					"bitacoraFecha"=>$currentDate,
					"bitacoraYear"=>$currentYear,
					"bitacoraHoraInicio"=>$currentHour,
					"bitacoraHoraFinal"=> NULL,//Se registrar cuando cierre secion
					"bitacoraNivelUsuario"=>$idNivelPermiso];

					mainModel::addUsuarioBitacora($dataUsuarioBitacora);
					
				

				// Datos para las variables de SESSION

				$arrayNamesUser = explode (" ", $nameUser);
				$arrayLastNamesUser = explode (" ", $lastNamesUser);			   
				$_SESSION['docIdentidad']=$docIdentidad;
				$_SESSION['aliasUser']=$aliasUser;

				$_SESSION['nameUser']=$arrayNamesUser[0];
				$_SESSION['lastNameUser']=$arrayLastNamesUser[0];
				$_SESSION['idNivelPermiso']=$idNivelPermiso;
				$_SESSION['idEstado']=$idEstado;
				$_SESSION['idGeneroUser']=$idGeneroUser;
				$_SESSION['bitacoraCodigo']=$bitacoraCodigo;

				$_SESSION['token_dptoEpidemi']=md5(uniqid(mt_rand(),true));
			
				if ($idGeneroUser == "1"){
                  $_SESSION['iconUser'] = "male-user.png"; 
                }elseif ($idGeneroUser == "2") {
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
			"bitacoraHoraFinal"=>$currentHour,
			"token_dptoEpidemi"=>$_SESSION["token_dptoEpidemi"],
			"bitacoraCodigo"=>$_SESSION["bitacoraCodigo"]];

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
				"Alert"=>"redirecting",
				"URL"=>SERVERURL."dashboard/"
				];

				echo json_encode($alert);
				header("Location: ".SERVERURL);
						exit();
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

				array_push($userAttributesUpdate, 'idEstado = :idEstado');
				$userValuesUpdate['idEstado'] = [
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

				array_push($userAttributesUpdate, 'idEstado = :idEstado');
				$userValuesUpdate['idEstado'] = [
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

	$idGeneroUser =mt_rand(1,2);
	if ($idGeneroUser == "1"){
		 return $iconUser = "male-user.png"; 
			}elseif ($idGeneroUser == "2") {
				 return $iconUser = "fermale-user.png"; 
           	}




       }

 }
 ?>