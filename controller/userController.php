	<?php 

		// para colaboracion de objetos
		// para simular la herencia mediante colaboracion de objetos

		require_once "casosEpidemiController.php";

		require_once "personController.php";

	if($requestAjax){
		require_once "../model/userModel.php";

	}else{
		require_once "./model/userModel.php";
	}

	class userController extends userModel{
		
		public static $personController;

		public static $casosEpidemiController;

		function __construct()
			{

			self::$personController = new personController();

			self::$casosEpidemiController = new casosEpidemiController();
		}

		public function addUserController($dataUser){
		
		 $id_nacionalidad = mainModel::cleanStringSQL($dataUser["id_nacionalidad"]);

		 $doc_identidad = mainModel::cleanStringSQL($dataUser["doc_identidad"]);
		 	// 3 = Invitado en DB
		 $id_nivel_permiso = "3";
		 	// 0 = Inactivo  en DB		 	
		 $id_estado = "0";

		$aliasUser = mainModel::cleanStringSQL($dataUser["aliasUser"]);

		 $question1 = mainModel::cleanStringSQL($dataUser["question1"]);

		 $question2 = mainModel::cleanStringSQL($dataUser["question2"]);

		 $password = mainModel::cleanStringSQL($dataUser["password"]);
		
		 $passwordConfirm = mainModel::cleanStringSQL($dataUser["passwordConfirm"]); 

	 $telefono = $dataUser['telefonoPart1'].$dataUser['telefonoPart2'].$dataUser['telefonoPart3'];

		 $telefono = mainModel::cleanStringSQL($telefono);


		 $email = mainModel::cleanStringSQL($dataUser["email"]);

		$ifExistPerson = 0;


		if (mainModel::isDataEmtpy($aliasUser,
		 	$doc_identidad,
		 	$password,
		 	$passwordConfirm, 
		 	$email,$id_nacionalidad,$question1,$question2)){

				$alert=[
					"Alert"=>"simple",
					"Title"=>"Campos Vacios",
					"Text"=>"Todos los campos del usuario son obligatorios",
					"Type"=>"error"
				];

				echo json_encode($alert);

				exit();

			}

		// Comprobar si existe o no la person en la BD

		$queryIsExistPerson = mainModel::connectDB()->query("SELECT id_nacionalidad,doc_identidad FROM personas WHERE id_nacionalidad = '$id_nacionalidad' AND doc_identidad = '$doc_identidad'");

			if(isset($dataUser['ifExistPerson']) && $dataUser['ifExistPerson'] == "1" ){

			$ifExistPerson = 1;

			if(!$queryIsExistPerson->rowCount()){
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
				// Si no existe y es una person nueva comprabar que no este repetido en la BD
			if($queryIsExistPerson->rowCount()){
			$alert=[
				"Alert"=>"simple",
				"Title"=>"Datos Duplicados",
				"Text"=>"Ya se encuentra una person con esta cedula registrada ",
				"Type"=>"error"
			];

				echo json_encode($alert);

				exit();
			}

		}
			// Validar exist el alias de usuario
		 
		$queryIsExistUser = mainModel::connectDB()->query("SELECT alias FROM usuarios WHERE alias = '$aliasUser'");

		$queryIsExistUser->execute();		 

		if($queryIsExistUser->rowCount()){
				
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

		if(!self::$personController->isValidNroTlf($telefono)){
			
			$alert=[
				"Alert"=>"simple",
				"Title"=>"Datos Invalidos",
				"Text"=>"El Nro de Telefono es invalido",
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

			// si otra persona ya tiene este correo a parte del usuario a registrar

		$id_person = self::$personController->getIdPerson($id_nacionalidad,$doc_identidad);

		$queryIfMailOccupiedAnotherPerson = mainModel::connectDB()->query("SELECT id_person FROM usuarios WHERE email = '$email'");

		while($recordsMailsUserPerson=$queryIfMailOccupiedAnotherPerson->fetch(PDO
			::FETCH_ASSOC)){ 

			$recordsIdPerson = $recordsMailsUserPerson['id_person'];

			if ($recordsIdPerson != $id_person) {

			$alert=[
			"Alert"=>"simple",
			"Title"=>"Datos Duplicados",
			"Text"=>"Este correo ya esta ocupado por otra persona",
			"Type"=>"error"
				];
		
				echo json_encode($alert);

				exit();

			}


		}


			// si otra persona ya tiene este telefono a parte del usuario a registrar 

		$queryIfTlfOccupiedAnotherPerson = mainModel::connectDB()->query("SELECT id_person FROM usuarios WHERE telefono = '$telefono'");

		while($recordsTlfUserPerson=$queryIfTlfOccupiedAnotherPerson->fetch(PDO
			::FETCH_ASSOC)){ 

			$recordsIdPerson = $recordsTlfUserPerson['id_person'];

			if ($recordsIdPerson != $id_person) {

			$alert=[
			"Alert"=>"simple",
			"Title"=>"Datos Duplicados",
			"Text"=>"Este telefono ya esta ocupado por otra persona",
			"Type"=>"error"
				];
		
				echo json_encode($alert);

				exit();

			}


		}

		   if(strlen($question1)<3 || strlen($question2)<3 || strlen($question1) > 20 || strlen($question2)>20 ){

			$alert=[
			"Alert"=>"simple",
			"Title"=>"Datos Invalidos",
			"Text"=>"Las respuestas de seguridad deben ser poseer entre 3 y 20 caracteres",
			"Type"=>"error"
				];
		
				echo json_encode($alert);

				exit();
			}

		   if(strcmp($question1,$question2 )== 0){

			$alert=[
			"Alert"=>"simple",
			"Title"=>"Datos Invalidos",
			"Text"=>"Las respuestas de seguridad no deben ser iguales",
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


		

			// data ya limpia
			$dataUserValid=[
			"id_person"=>$id_person,
			"id_nacionalidad"=>$id_nacionalidad,
			"doc_identidad"=>$doc_identidad,
			"id_nivel_permiso"=>$id_nivel_permiso,
			"id_estado"=>$id_estado,
			"aliasUser"=>$aliasUser,
			"question1"=>mainModel::encryption($question1),
			"question2"=>mainModel::encryption($question2),
			"password"=>mainModel::encryption($password),
			"telefono"=>$telefono,
			"email"=>$email,
			"ifNotHaveIdentityDocument"=>false,
			"ifExistPerson"=>$ifExistPerson
		];

			$dataUser['ifNotHaveIdentityDocument'] = false;
			$dataUser['id_person'] = $id_person;
			$dataUser['ifExistPerson'] = $ifExistPerson;


				// si no existe la person la creamos
			if(!$ifExistPerson){

				$dataPerson = self::$personController->addPersonControllerr($dataUser);

				$dataUserValid = array_merge($dataUserValid,$dataPerson);
			}

		 echo userModel::addUserModel($dataUserValid);			

	}

				
	public static function updateUserController($dataUser){

		 $id_person = mainModel::cleanStringSQL($dataUser["id_person"]);
	
		 $id_nacionalidad = mainModel::cleanStringSQL($dataUser["id_nacionalidad"]);

		 $doc_identidad = mainModel::cleanStringSQL($dataUser["doc_identidad"]);

		 $aliasUser = mainModel::cleanStringSQL($dataUser["aliasUser"]);

		 $telefono = $dataUser['telefonoPart1'].$dataUser['telefonoPart2'].$dataUser['telefonoPart3'];

		 $telefono = mainModel::cleanStringSQL($telefono);

		 $email = mainModel::cleanStringSQL($dataUser["email"]);

		 $fecha_nacimiento = mainModel::cleanStringSQL($dataUser["fecha_nacimiento"]);

		 $nombres = mainModel::cleanStringSQL($dataUser["nombres"]);

		 $apellidos = mainModel::cleanStringSQL($dataUser["apellidos"]);

		 $id_genero = mainModel::cleanStringSQL($dataUser["id_genero"]);

		 $dataUser["id_person_update"]=$id_person;

		$dataUser["ifNotHaveIdentityDocument"] = false;

		// si hay error imprime mensaje y exit()
	$dataPerson = self::$personController->updatePersonaController($dataUser);


 		  $columnsTableToCompare = [
		"telefono",
		"email"];

if (mainModel::isDataEmtpy($id_nacionalidad,$doc_identidad,$aliasUser,$telefono,$email,$fecha_nacimiento,$nombres,$apellidos)){
				$alert=[
					"Alert"=>"simple",
					"Title"=>"Campos Vacios",
					"Text"=>"No se encuentra ningun dato para actualizar o alguno necesario esta vacio",
					"Type"=>"error"
				];

				echo json_encode($alert);

				exit();
 
			}



if ($_SESSION['id_nivel_permiso'] == 3){
				$alert=[
					"Alert"=>"simple",
					"Title"=>"Permiso Denegado",
					"Text"=>"No Posee permisos para realizar esta operacion",
					"Type"=>"error"
				];

				echo json_encode($alert);

				exit();
 
			}

		 // para datos principales del usuario
		$userAttributesUpdate = [];

 		$userValuesUpdate = [];


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

			// si otra persona ya tiene este correo a parte del usuario a registrar

			// si otra persona ya tiene este correo a parte del usuario a registrar

		$id_person = self::$personController->getIdPerson($id_nacionalidad,$doc_identidad);
		// verifica estos cambios si el doc identidad va actulizarce
		if ($id_person) {

		$queryIfMailOccupiedAnotherPerson = mainModel::connectDB()->query("SELECT id_person FROM usuarios WHERE email = '$email'");

		while($recordsMailsUserPerson=$queryIfMailOccupiedAnotherPerson->fetch(PDO
			::FETCH_ASSOC)){ 

			$recordsIdPerson = $recordsMailsUserPerson['id_person'];

			if ($recordsIdPerson != $id_person) {

			$alert=[
			"Alert"=>"simple",
			"Title"=>"Datos Duplicados",
			"Text"=>"Este correo ya esta ocupado por otra persona",
			"Type"=>"error"
				];
		
				echo json_encode($alert);

				exit();

			}


		}


			// si otra persona ya tiene este telefono a parte del usuario a registrar 

		$queryIfTlfOccupiedAnotherPerson = mainModel::connectDB()->query("SELECT id_person FROM usuarios WHERE telefono = '$telefono'");

		while($recordsTlfUserPerson=$queryIfTlfOccupiedAnotherPerson->fetch(PDO
			::FETCH_ASSOC)){ 

			$recordsIdPerson = $recordsTlfUserPerson['id_person'];

			if ($recordsIdPerson != $id_person) {

			$alert=[
			"Alert"=>"simple",
			"Title"=>"Datos Duplicados",
			"Text"=>"Este telefono ya esta ocupado por otra persona",
			"Type"=>"error"
				];
		
				echo json_encode($alert);

				exit();

			}


		}

				}

				$personValuesUpdate['doc_identidad'] = [
				'value' => $doc_identidad,
				'type' => \PDO::PARAM_INT,
				];

				$personValuesUpdate['id_nacionalidad'] = [
				'value' => $id_nacionalidad,
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

		$userDataTocomparedWithDatabase=["telefono"=>$telefono,"email"=>$email];


		// isset cuando el id_nivel_permiso no se muestra en form por seguridad

		if ($_SESSION['id_nivel_permiso'] == 1) {
		 if (isset($dataUser["id_nivel_permiso"]) && $dataUser['id_nivel_permiso'] != 0){

		 $id_nivel_permiso = mainModel::cleanStringSQL($dataUser["id_nivel_permiso"]);

				array_push($userAttributesUpdate, 'id_nivel_permiso = :id_nivel_permiso');
				$userValuesUpdate['id_nivel_permiso'] = [
				'value' => $id_nivel_permiso,
				'type' => \PDO::PARAM_INT,
				];

		 	$userDataTocomparedWithDatabase["id_nivel_permiso"] = $id_nivel_permiso;
		$columnsTableToCompare[]="id_nivel_permiso";

		}


		// isset cuando el id_estado no se muestra en form por seguridad

		 if (isset($dataUser["id_estado"])) {

		 $id_estado = mainModel::cleanStringSQL($dataUser["id_estado"]);

				array_push($userAttributesUpdate, 'id_estado = :id_estado');
				$userValuesUpdate['id_estado'] = [
				'value' => $id_estado,
				'type' => \PDO::PARAM_INT,
				];
			$userDataTocomparedWithDatabase["id_estado"] = $id_estado;
		 		$columnsTableToCompare[]="id_estado";

		 }

		}

		 // comprobamos si los campos enviados son iguales a los de la BD

 		$queryToGetUser = self::getUserController($columnsTableToCompare,array("aliasUser"=>$aliasUser));



		$ifUserDataUpdateIsSameDatabase = mainModel::isFieldsEqualToThoseInTheDatabase($queryToGetUser,$userDataTocomparedWithDatabase);


			if ($ifUserDataUpdateIsSameDatabase && !$dataPerson['ifUpdatePerson']) {

			$alert=[
				"Alert"=>"simple",
				"Title"=>"Datos Duplicados",
				"Text"=>"No se ha encontrado ningun cambio a actualizar",
				"Type"=>"error"
			];

				echo json_encode($alert);

				exit();

			}



			// si cambiamos los datos personales y tiene un caso epidemiologico asignado, entonces
			// registramos una bitacora con el ultimo id_caso_epidemi
			 
			if ($dataPerson['ifUpdatePerson']){


	$queryifExistView = mainModel::connectDB()->query("SELECT where EXISTS  ( SELECT FROM information_schema.tables WHERE table_name = 'caso_epidemi_view' ) = true");

				if(!$queryifExistView->rowCount()){
	    
	    		mainModel::connectDB()->query(self::$casosEpidemiController::$queryCreateViewCasosEpidemi);
				
				}

		$queryLastEpidemiCaseAssignedToUser = mainModel::connectDB()->query("SELECT id_caso_epidemi,id_person_caso,fecha_registro,catalog_key_cie10,is_hospital,fecha_nacimiento, id_genero,id_tipo_entrada FROM caso_epidemi_view WHERE 
			id_person_caso = $id_person ORDER BY id_caso_epidemi ASC");


			if ($queryLastEpidemiCaseAssignedToUser->rowCount()){


				$currentDate =  mainModel::getDateCurrentSystem();

				$currentYear = date("Y", strtotime($currentDate));

				$currentHour = date("h:i:s a", strtotime($currentDate));

				$currentDate = date("Y-m-d", strtotime($currentDate));


		while($dataLastEpidemiCaseAssignedToUser=$queryLastEpidemiCaseAssignedToUser->fetch(PDO
			::FETCH_ASSOC)){

			// data para registro de bitcora
	
    			$idsCaseEpidemiOtherCaseSameDocumentIdentity[] = $dataLastEpidemiCaseAssignedToUser['id_caso_epidemi'];

    			$idsPersonsOtherCaseSameDocumentIdentity[] = $dataLastEpidemiCaseAssignedToUser['id_person_caso'];

		if ($dataLastEpidemiCaseAssignedToUser['is_hospital'] == true) {
		$dataLastEpidemiCaseAssignedToUser['is_hospital'] = 'true';
		}		

		if ($dataLastEpidemiCaseAssignedToUser['is_hospital'] == false) {
		$dataLastEpidemiCaseAssignedToUser['is_hospital'] = 'false';
		}


			$dataBitacoraLastCaseEpidemiAssignUser = array(
		 "indicatorEpidemiCaseError"=> '<br>En el Caso Epidemiologico ID: '.$dataLastEpidemiCaseAssignedToUser['id_caso_epidemi'],
		 "id_person"=>$id_person,
		 "id_person_caso"=>$id_person,
		 "id_person_usuario"=>$_SESSION['id_person'],
		 "usuario_alias"=>$_SESSION['aliasUser'],
			"bitacora_fecha"=>$currentDate,
			"bitacora_year"=>$currentYear,
			"bitacora_hora"=>$currentHour,
		"id_tipo_operacion"=>'2', // tipo Actualizacion
		 "id_caso_epidemi"=>$dataLastEpidemiCaseAssignedToUser['id_caso_epidemi'],
		 "fecha_caso_epidemi"=>$dataLastEpidemiCaseAssignedToUser['fecha_registro'],
		 "fecha_registro"=>$dataLastEpidemiCaseAssignedToUser['fecha_registro'],
		 "fecha_nacimiento"=>$fecha_nacimiento,
		 "id_genero"=>$id_genero,
		 "catalog_key_cie10"=>$dataLastEpidemiCaseAssignedToUser['catalog_key_cie10'],
		 "ifNotHaveIdentityDocument"=>FALSE,
		 "id_tipo_entrada"=>$dataLastEpidemiCaseAssignedToUser['id_tipo_entrada'],
		 "id_nacionalidad_caso"=>$id_nacionalidad,
		 "doc_identidad_caso"=>$doc_identidad,
		 "is_hospital"=>$dataLastEpidemiCaseAssignedToUser['is_hospital']);
	

			self::$casosEpidemiController::msgValididGenreAssingnEventCIE10($dataBitacoraLastCaseEpidemiAssignUser);

			self::$casosEpidemiController::msgValididAgeAssingnEventCIE10($dataBitacoraLastCaseEpidemiAssignUser);


			}

		// solo el ultimo array de la bitacora se tomara en cuenta

		$dataPerson['dataBitacoraLastCaseEpidemiAssignUser'] = $dataBitacoraLastCaseEpidemiAssignUser;


			}

		}

			echo userModel::updateUserModel($userValuesUpdate,$userAttributesUpdate,$dataPerson);
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

		$queryGetUserStatus = mainModel::connectDB()->query("SELECT id_estado FROM usuarios WHERE alias =
			'$aliasUser'");

		$queryGetUserStatus->execute();

		$id_estado = $queryGetUserStatus->fetchColumn();

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
		if($id_estado == 0){
				
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
		if($id_estado == 1){
				
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

if ($aliasUser === 'admin') {
$dataUser["question1"] = 'admin1';
$dataUser["question2"] = 'admin2';

$dataUser["newQuestion1"] = '';

$dataUser["newQuestion2"] = '';

}

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


		// Estos datos deben estar llenados en cofig

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

if (!mainModel::isDataEmtpy($dataUser["newQuestion1"]) ||
	!mainModel::isDataEmtpy($dataUser["newQuestion2"]) &&
	$aliasUser === 'admin'){

				$alert=[
					"Alert"=>"simple",
					"Title"=>"Datos Invalidos",
					"Text"=>"Esta operacion no es permitida",
					"Type"=>"error"
				];

				echo json_encode($alert);

				exit();
}

// Imprime msj si es incorrecta
self::passwordCorrespondDatabase($dataUser);

}

// validar preguntas de seguridad 

// solo en la configuracion normal y recuperacion de password  se verfica Las respuestas de seguridad

if ($dataUser["operationType"] == "config" || $dataUser["operationType"] == "recoverPass") {

self::securityQuestionsCorrespondDatabase($dataUser);
}

// Actualizamos password si se desea

if (!mainModel::isDataEmtpy($dataUser["newPasswordConfirm"]) || !mainModel::isDataEmtpy($dataUser["newPassword"])) {
		
$resultQueryUpdatePass = self::passwordUpdateController($dataUser);

	}

				// Actualizamos preguntas si se desea

		if (isset($dataUser["newQuestion1"]) && !mainModel::isDataEmtpy($dataUser["newQuestion1"])) {

		$dataUpdateQuestions = ["newQuestion"=>$dataUser["newQuestion1"],"aliasUser"=>$aliasUser,"id_pregunta"=>'1'];

		$resultQueryUpdateQuestion1 = self::questionUpdateController($dataUpdateQuestions);

	}


		if (isset($dataUser["newQuestion2"]) && !mainModel::isDataEmtpy($dataUser["newQuestion2"])) {

		$dataUpdateQuestions = ["newQuestion"=>$dataUser["newQuestion2"],"aliasUser"=>$aliasUser,"id_pregunta"=>'2'];

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

		$queryGetpass_encrypt = mainModel::connectDB()->query("SELECT pass_encrypt FROM usuarios WHERE alias =
			'$aliasUser'");

		$pass_encryptDB = mainModel::decryption($queryGetpass_encrypt->fetchColumn());
				
		    if (strcmp($pass_encryptDB, $password) != 0){
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
				array_push($userAttributesUpdate, 'pass_encrypt = :password');
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
	
    $userAttributesFilter =  [];

    $userFilterValues = [];

		array_push($userAttributesFilter, 'usuario_alias = :aliasUser');
		$userFilterValues[':aliasUser'] = [
		'value' => $aliasUser,
		'type' => \PDO::PARAM_STR,
		];

		$recordsUserSQL = parent::querySelectsCreator('usuarios_preguntas',['id_pregunta','respuesta'],$userAttributesFilter,$userFilterValues);

		$recordsUserSQL->execute();

		// Obtener preguntas del usuario
		while($valuesDataUser=$recordsUserSQL->fetch(PDO
			::FETCH_ASSOC)){ 

			if ($valuesDataUser["id_pregunta"] == 1) {

				$registeredQuestion1 = mainModel::decryption($valuesDataUser['respuesta']);
				}else{

					// id pregunta == 2
				$registeredQuestion2 = mainModel::decryption($valuesDataUser['respuesta']);

				}

		}

//		var_dump($registeredQuestion1,$registeredQuestion2);

		$question1 = mainModel::cleanStringSQL($dataUser["question1"]); 

		$question2 = mainModel::cleanStringSQL($dataUser["question2"]); 

		    if (strcmp($registeredQuestion1, $question1) != 0 || strcmp($registeredQuestion2, $question2) != 0){
				$alert=[
				"Alert"=>"simple",
				"Title"=>"Datos Invalidos",
				"Text"=>"Revise Las respuestas de seguridad",
				"Type"=>"error"
			];

				echo json_encode($alert);

				exit();
    	}
}

		protected static function questionUpdateController($dataUser){

		$aliasUser = mainModel::cleanStringSQL($dataUser["aliasUser"]);

		$newQuestion = mainModel::cleanStringSQL($dataUser["newQuestion"]);

		$id_pregunta = mainModel::cleanStringSQL($dataUser["id_pregunta"]);

    $userAttributesFilter =  [];

    $userFilterValues = [];

		// Verificamos que la pregunta no este repetida
		array_push($userAttributesFilter, 'usuario_alias = :aliasUser');
		$userFilterValues[':aliasUser'] = [
		'value' => $aliasUser,
		'type' => \PDO::PARAM_STR,
		];

		$recordsUserSQL = parent::querySelectsCreator('usuarios_preguntas',['id_pregunta','respuesta'],$userAttributesFilter,$userFilterValues);

		$recordsUserSQL->execute();

		// Obtener preguntas del usuario
		while($valuesDataUser=$recordsUserSQL->fetch(PDO
			::FETCH_ASSOC)){ 


			if ($valuesDataUser["id_pregunta"] == 1) {
				$registeredQuestion1 = mainModel::decryption($valuesDataUser['respuesta']);

				}else{
					// id pregunta == 2
				$registeredQuestion2 = mainModel::decryption($valuesDataUser['respuesta']);
				}

		}

		   if(strlen($newQuestion)<3){

			$alert=[
			"Alert"=>"simple",
			"Title"=>"Datos Invalidos",
			"Text"=>"Las respuestas de seguridad deben ser mayor a 3 caracteres",
			"Type"=>"error"
				];
		
				echo json_encode($alert);

				exit();
			}

		$dataUpdateQuestions = 
		["aliasUser"=>$aliasUser,
		"id_pregunta"=>$id_pregunta,
		"respuesta"=>mainModel::encryption($newQuestion)];

		return $resultQueryUpdateQuestion = userModel::updateUserQuestionModel($dataUpdateQuestions);


		}


		public static function deleteUserController($dataUser){

		$aliasUser = mainModel::decryption(mainModel::cleanStringSQL($dataUser['usuario_alias']));


		$id_person = mainModel::decryption(mainModel::cleanStringSQL($dataUser['id_person']));


		$doc_identidad = mainModel::decryption(mainModel::cleanStringSQL($dataUser['doc_identidad']));


		$id_nacionalidad = mainModel::decryption(mainModel::cleanStringSQL($dataUser['id_nacionalidad']));


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
				"Title"=>"Operacion no Permitida",
				"Text"=>"El usuarios super administrador no puede ser eliminado",
				"Type"=>"error"
			];
			echo json_encode($alert);

			exit();
			}

		$queryIsUserExistBitacoraCasosEpidemi = mainModel::connectDB()->query("SELECT usuario_alias FROM casos_epidemi_bitacora WHERE usuario_alias = '$aliasUser' LIMIT 1");


		if ($queryIsUserExistBitacoraCasosEpidemi->rowCount()>1) {
			$alert=[
				"Alert"=>"simple",
				"Title"=>"Operacion no Permitida",
				"Text"=>"El usuarios posee registros de Casos Epidemilogicos asignados, por lo que no se puede eliminar",
				"Type"=>"error"
			];
			echo json_encode($alert);

			exit();

			}

if (!isset($dataUser['confirmDelete'])) {

		// Si la person  solo tiene un usuario y no presenta un caso epidemi, elimanos datos personles del BD pero primero avisamos


		$queryIfExistUserPerPerson = mainModel::connectDB()->query("SELECT alias FROM usuarios WHERE id_person = '$id_person'");


		$queryIsExistPersonPerCasosEpidemi = mainModel::connectDB()->query("SELECT id_person FROM casos_epidemi WHERE id_person = '$id_person'");

		if ($queryIfExistUserPerPerson->rowCount()==1 && $queryIsExistPersonPerCasosEpidemi->rowCount() == 0) {

		$aliasUser = mainModel::encryption($aliasUser);

		$id_person = mainModel::encryption($id_person);

		$doc_identidad = mainModel::encryption($doc_identidad);

		$id_nacionalidad = mainModel::encryption($id_nacionalidad);


					$alert=[

						"Alert"=>"confirmation",
						"Text"=>"Esta persona no posee mas usuarios ni presenta un caso epidemioligico por lo que se eliminara del sistema completamente",
						"Url"=>"".SERVERURL."ajax/userAjax.php",
						"Data"=>"doc_identidad=$doc_identidad&usuario_alias=$aliasUser&id_nacionalidad=$id_nacionalidad&operationType=delete&confirmDelete=true&id_person=$id_person",
						"Method"=>"POST"];
					
					echo json_encode($alert);

					exit();
		}
	}


		// recoger datos limpios
		
		$dataUserToDelete = [
			'id_person'=>$id_person,
			'aliasUser'=>$aliasUser,
		'doc_identidad' => $doc_identidad,
		'id_nacionalidad' => $id_nacionalidad];

		// si existe la confirmacion de Eliminacion de la person
		if (isset($dataUser['confirmDelete'])) {
		
		$primaryKeyperson = [
			"id_person"=>$id_person];
		
		// si hay algun error se detiene el code e imprime msj
		self::$personController->deletePersonController($primaryKeyperson);

		$dataUserToDelete['deletePerson'] = TRUE;
		}
		
		echo userModel::deleteUserModel($dataUserToDelete);

				 }

			public static function getUserController($columnsTable,$dataUser){
 		 			 
		$userAttributesFilter = [];

 		$filterValues = [];

		if (isset($dataUser["id_person"]) && !mainModel::isDataEmtpy($dataUser["id_person"])) {

		$id_person = mainModel::cleanStringSQL($dataUser["id_person"]);

		array_push($userAttributesFilter, 'id_person = :id_person');
		$filterValues[':id_person'] = [
		'value' => $id_person,
		'type' => \PDO::PARAM_INT,
		];}

		if (isset($dataUser["id_nacionalidad"]) && !mainModel::isDataEmtpy($dataUser["id_nacionalidad"])) {

		$id_nacionalidad = mainModel::cleanStringSQL($dataUser["id_nacionalidad"]);

		array_push($userAttributesFilter, 'id_nacionalidad = :id_nacionalidad');
		$filterValues[':id_nacionalidad'] = [
		'value' => $id_nacionalidad,
		'type' => \PDO::PARAM_STR,
		];}

		if (isset($dataUser["doc_identidad"]) && !mainModel::isDataEmtpy($dataUser["doc_identidad"])) {

		$doc_identidad = mainModel::cleanStringSQL($dataUser["doc_identidad"]);

		array_push($userAttributesFilter, 'doc_identidad = :doc_identidad');
		$filterValues[':doc_identidad'] = [
		'value' => $doc_identidad,
		'type' => \PDO::PARAM_STR,
		];}

		if (isset($dataUser["aliasUser"]) && !mainModel::isDataEmtpy($dataUser["aliasUser"])) {
		
		$aliasUser = mainModel::cleanStringSQL($dataUser["aliasUser"]);

		array_push($userAttributesFilter, 'alias = :aliasUser');
		$filterValues[':aliasUser'] = [
		'value' => $aliasUser,
		'type' => \PDO::PARAM_STR,
		];}

		if (isset($dataUser["id_nivel_permiso"]) && !mainModel::isDataEmtpy($$dataUser["id_nivel_permiso"])) {

		$id_nivel_permiso = mainModel::cleanStringSQL($dataUser["id_nivel_permiso"]);

		array_push($userAttributesFilter, 'id_nivel_permiso = :id_nivel_permiso');
		$filterValues[':id_nivel_permiso'] = [
		'value' => $id_nivel_permiso,
		'type' => \PDO::PARAM_INT,
		];}


		if (isset($dataUser["id_estado"]) && !mainModel::isDataEmtpy($dataUser["id_estado"])) {

		$id_estado = mainModel::cleanStringSQL($dataUser["id_estado"]);

		array_push($userAttributesFilter, 'id_estado = :id_estado');
		$filterValues[':id_estado'] = [
		'value' => $id_estado,
		'type' => \PDO::PARAM_STR,
		];}


		if (isset($dataUser["email"]) && !mainModel::isDataEmtpy($dataUser["email"])) {

		$email = mainModel::cleanStringSQL($dataUser["email"]);

		array_push($userAttributesFilter, '$email = :$email');
		$filterValues[':$email'] = [
		'value' => $email,
		'type' => \PDO::PARAM_STR,
		];}

			return mainModel::querySelectsCreator('usuarios',$columnsTable,$userAttributesFilter,$filterValues);

	}


 
	public static function restartUserController($dataUser){
	

		 $aliasUser = mainModel::cleanStringSQL($dataUser["aliasUser"]);


		 $aliasUser = mainModel::decryption($dataUser["aliasUser"]);

		$userAttributesUpdate = [];

 		$userValuesUpdate = [];

		$queryIsExistUser = mainModel::connectDB()->query("SELECT alias FROM usuarios WHERE alias = '$aliasUser'");
					

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

				array_push($userAttributesUpdate, 'id_estado = :id_estado');
				$userValuesUpdate['id_estado'] = [
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

public static function paginateUserController($currentAliasUser){

	$currentAliasUser= mainModel::cleanStringSQL($currentAliasUser);


	$stringQueryInnerJoinForGetUsers = userModel::stringQueryInnerJoinForGetUser();

	$queryForGetUsers = mainModel::connectDB()->query($stringQueryInnerJoinForGetUsers." WHERE usr.alias != '$currentAliasUser' AND usr.alias != 'admin' ");

$table = "";

$table.="<div class='table-responsive'>
                <table class='table table-bordered table-striped' id='dataTable' width='100%' cellspacing='0'>
                  <thead>
                    <tr>
                      <th>Nro. </th>
                      <th></th>
                      <th>Documento de Identidad</th>
                      <th>Alias</th>
                      <th>Nombres</th>
                      <th>Apellidos</th>
                      <th>Nivel de Permiso</th>
                      <th>Estado</th>
                      <th></th>
                    </tr>
                  </thead>
                  <tfoot>
                    <tr>
                       <th>Nro. </th>
                      <th></th>
                      <th>Documento de Identidad</th>
                      <th>Alias</th>
                      <th>Nombres</th>
                      <th>Apellidos</th>
                      <th>Nivel de Permiso</th>
                      <th>Estado</th>
                      <th></th>
                    </tr>
                  </tfoot>
                  <tbody>";

         $count = 1;
		while($rows=$queryForGetUsers->fetch(PDO
			::FETCH_ASSOC)){ 
				if ($rows['id_genero'] == "1"){
                  $rows['iconGenero'] = "male-user.png"; 
                }elseif ($rows['id_genero'] == "2") {
                  $rows['iconGenero'] = "fermale-user.png"; 
                }

			$table.='
                 <tr>
                    <td>'.$count.'</td>
                    <td><span class="d-none">'.$rows["id_genero"].'</span>
                    <img class="img-profile rounded-circle" width="40" src="'.SERVERURL.'view/img/'.$rows["iconGenero"].'"></td>
		 			<td>'.$rows['doc_identidad_complete'].'</td>
					<td>'.$rows['usuario_alias'].'</td>
                    <td>'.$rows['nombres'].'</td>
                    <td>'.$rows['apellidos'].'</td>
		 			<td>'.$rows['descripcion_nivel_permiso'].'</td>
		 			<td>'.$rows['descripcion_estado'].'</td>
		 			<td>

    <div style="display: inline-block;">
      

	                  <a href="'.SERVERURL.'dataAccount/'.mainModel::encryption($rows['usuario_alias']).'" class="btn btn-info btn-circle btn-sm">
	                    <i class="fas fa-plus"></i>
	                  </a>
		 		
		    </div>

	<div style="display: inline-block;">

		 		<form class="formAjax" action="'.SERVERURL.'ajax/userAjax.php" method="POST" data-form="restart" enctypy="multipart/form-data" autocomplete="off">

					<input name= "id_person" type="hidden" value="'.mainModel::encryption($rows['id_person']).'">
					
					<input name= "aliasUser" type="hidden" value="'.mainModel::encryption($rows['usuario_alias']).'">

					<input name= "id_nacionalidad" type="hidden" value="'.mainModel::encryption($rows['id_nacionalidad']).'">

					<input name= "doc_identidad" type="hidden" value="'.mainModel::encryption($rows['doc_identidad']).'">

						<button type="submit" value = "restart" class="btn btn-warning btn-circle btn-sm">
	                    <i class="fas fa-redo"></i>
	                     </button>
		 			</form>
		    </div>

	<div style="display: inline-block;">

		 		<form class="formAjax" action="'.SERVERURL.'ajax/userAjax.php" method="POST" data-form="delete" enctypy="multipart/form-data" autocomplete="off">

					<input name= "id_person" type="hidden" value="'.mainModel::encryption($rows['id_person']).'">
					
					<input name= "usuario_alias" type="hidden" value="'.mainModel::encryption($rows['usuario_alias']).'">

					<input name= "id_nacionalidad" type="hidden" value="'.mainModel::encryption($rows['id_nacionalidad']).'">

					<input name= "doc_identidad" type="hidden" value="'.mainModel::encryption($rows['doc_identidad']).'">

						<button type="submit" value = "delete" class="btn btn-danger btn-circle btn-sm">
	                    <i class="fas fa-trash"></i>
	                     </button>
		 			</form>
		    </div>
		 			</td>
               </tr>
			';

			$count ++;
			
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


	 public static function printUserCountByTypeController(){
		
		$userAdmins = userModel::userTypeCounterModel('id_nivel_permiso',1);
		
		$userOperators = userModel::userTypeCounterModel('id_nivel_permiso',2);

		$userInviteds = userModel::userTypeCounterModel('id_nivel_permiso',3);

		$userActives = userModel::userTypeCounterModel('id_estado',1);

		$userInactives = userModel::userTypeCounterModel('id_estado',0);

		$userRestarts = userModel::userTypeCounterModel('id_estado',2);

		$usersTotal = userModel::userTypeCounterModel('alias',NULL);

		$dataCounTypeUsers = [
		'userAdmins' => $userAdmins,
		'userOperators' => $userOperators,
		'userInviteds' => $userInviteds,
		'userActives' => $userActives,
		'userInactives' => $userInactives,
		'usersTotal' => $usersTotal,
		'userRestarts' => $userRestarts
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
