<?php

	if($requestAjax){
		require_once "../model/personModel.php";
	}else{
		require_once "./model/personModel.php";
	}

	class personController extends personModel{

	// Funciones para manejar datos (CRUD)
		public function addPersonControllerr($dataPerson){


		 	$indicatorPersonError='';
		 
		 if (isset($dataPerson['indicatorPersonError'])) {
		 	$indicatorPersonError = $dataPerson['indicatorPersonError'];
		 }


		$ifNotHaveIdentityDocument = mainModel::cleanStringSQL($dataPerson['ifNotHaveIdentityDocument']);

		$ifExistPerson = mainModel::cleanStringSQL($dataPerson['ifExistPerson']);

		$id_person = mainModel::cleanStringSQL($dataPerson['id_person']);

		$doc_identidad = mainModel::cleanStringSQL($dataPerson['doc_identidad']);
		
		 $doc_identidad = self::ClearUserSeparatedCharacters($doc_identidad);
		 $doc_identidad = ltrim($doc_identidad, '0');
		
		 $nombres = mainModel::cleanStringSQL($dataPerson['nombres']);
		 
		 $apellidos = mainModel::cleanStringSQL($dataPerson['apellidos']);

		$nombres=self::filtterNombresApellidos($nombres);

		$apellidos=self::filtterNombresApellidos($apellidos);

		 $fecha_nacimiento = mainModel::cleanStringSQL($dataPerson['fecha_nacimiento']);
		 		 
		 $id_genero = mainModel::cleanStringSQL($dataPerson['id_genero']);

		 $id_nacionalidad = mainModel::cleanStringSQL($dataPerson['id_nacionalidad']);

		 // en las importaciones de datos no tendran los nros separados
if (!isset($dataPerson['telefono'])) {
		 $telefono = mainModel::cleanStringSQL($dataPerson['telefonoPart1'].$dataPerson['telefonoPart2'].$dataPerson['telefonoPart3']);
		}else{
		 $telefono = mainModel::cleanStringSQL($dataPerson['telefono']);
		}

		 $telefono = self::ClearUserSeparatedCharacters($telefono);


			// si posee doc identidad. comprueba que estem vacios

		$ifDataEmptyIndentityPerson = (mainModel::isDataEmtpy(
		 $id_nacionalidad,
		 $doc_identidad) && !$ifNotHaveIdentityDocument);


		if (mainModel::isDataEmtpy(
			$nombres,
			$apellidos,
			$fecha_nacimiento,$id_genero,$telefono) || $ifDataEmptyIndentityPerson) {

			$alert=[
				"Alert"=>"simple",
				"Title"=>"Campos Vacios",
				"Text"=>"Todos los datos personles son obligatorios",
				"Type"=>"error"
			];

				echo json_encode($alert);

				exit();
			}
			

				$dataPerson =
		["id_nacionalidad"=>$id_nacionalidad,
		"doc_identidad"=>$doc_identidad,
		"nombres"=>$nombres,
		"apellidos"=>$apellidos,
		"fecha_nacimiento"=>$fecha_nacimiento,
		"id_genero"=>$id_genero,
		"telefono"=>$telefono,
		"id_person"=>$id_person,
		"ifExistPerson"=>$ifExistPerson,
		"ifNotHaveIdentityDocument"=>$ifNotHaveIdentityDocument,
		"indicatorPersonError"=>$indicatorPersonError
		];


		self::msgValidiFieldsBasicPersona($dataPerson);

		return $dataPerson;
		
				 	}


		public static function updatePersonaController($dataPerson){


		$ifNotHaveIdentityDocument = $dataPerson['ifNotHaveIdentityDocument'];

		 $dataPerson['id_person'] = mainModel::cleanStringSQL($dataPerson['id_person_update']);

		 $id_person = mainModel::cleanStringSQL($dataPerson['id_person_update']);

		 	$indicatorPersonError='';
		 
		 if (isset($dataPerson['indicatorPersonError'])) {
		 	$indicatorPersonError = $dataPerson['indicatorPersonError'];
		 }

		 $doc_identidad = mainModel::cleanStringSQL($dataPerson['doc_identidad']);
		 
		 $doc_identidad = self::ClearUserSeparatedCharacters($doc_identidad);

		 $doc_identidad = ltrim($doc_identidad, '0');

		 $nombres = mainModel::cleanStringSQL($dataPerson['nombres']);
		 
		 $apellidos = mainModel::cleanStringSQL($dataPerson['apellidos']);

		$nombres=self::filtterNombresApellidos($nombres);		

		$apellidos=self::filtterNombresApellidos($apellidos);


		 
		 $fecha_nacimiento = mainModel::cleanStringSQL($dataPerson['fecha_nacimiento']);
		 
		 $id_nacionalidad = mainModel::cleanStringSQL($dataPerson['id_nacionalidad']);
		 
		 $id_genero = mainModel::cleanStringSQL($dataPerson['id_genero']);
		
if (!isset($dataPerson['operationImportCaseEpidemi'])) {
		 $telefono = mainModel::cleanStringSQL($dataPerson['telefonoPart1'].$dataPerson['telefonoPart2'].$dataPerson['telefonoPart3']);
		}else{
		 $telefono = mainModel::cleanStringSQL($dataPerson['telefono']);
		}

			$ifDataEmptyDocIndentityPerson = (mainModel::isDataEmtpy(
		 $doc_identidad) && !$ifNotHaveIdentityDocument || mainModel::isDataEmtpyPermitedZero($id_nacionalidad) && !$ifNotHaveIdentityDocument);


		 $telefono = self::ClearUserSeparatedCharacters($telefono);

		 			if (mainModel::isDataEmtpy(
						 $nombres,
						 $apellidos,
						 $fecha_nacimiento,
						 $id_genero,
						 $telefono) || $ifDataEmptyDocIndentityPerson || mainModel::isDataEmtpy($id_person)) {

			$alert=[
				"Alert"=>"simple",
				"Title"=>"Campos Vacios",
				"Text"=>"Faltan campos para la actualizacion",
				"Type"=>"error"
			];
			
				echo json_encode($alert);

				exit();

			}


				$dataPerson =
		["id_nacionalidad"=>$id_nacionalidad,
		"doc_identidad"=>$doc_identidad,
		"nombres"=>$nombres,
		"apellidos"=>$apellidos,
		"fecha_nacimiento"=>$fecha_nacimiento,
		"id_genero"=>$id_genero,
		"telefono"=>$telefono,
		"indicatorPersonError"=>$indicatorPersonError,
		"ifNotHaveIdentityDocument"=>$ifNotHaveIdentityDocument,
		"id_person"=>$id_person,
		"operationType"=>'update'

		];

		self::msgValidiFieldsBasicPersona($dataPerson);

		self::msgValidisExistPersona($dataPerson);

	 		// Campos del usuario como person a comparar con la BD

		$columnsTableToCompare =
		[
		"id_nacionalidad",
		"doc_identidad",
		"nombres",
		"apellidos",
		"fecha_nacimiento",
		"id_genero",
		];
				 	

	 	$queryToGetPerson = self::getpersonController($columnsTableToCompare,array("id_person"=>$id_person));

		$ifPersonDataUpdateIsSameDatabase = mainModel::isFieldsEqualToThoseInTheDatabase($queryToGetPerson,$dataPerson);

			// si la datos nuevos son los mismos a los de la BD,
			// inclueremos un elemento que indique que se proceda actualizar
		 $dataPerson['ifUpdatePerson']  = true;

		 // si los datos son lo mismos no actualice
		if ($ifPersonDataUpdateIsSameDatabase){
		 $dataPerson['ifUpdatePerson']  = false;
		}

		 return $dataPerson;
	
				 }


		public function deletePersonController($dataPerson){
			
		 $doc_identidad = mainModel::cleanStringSQL($dataPerson['doc_identidad']);
		 
		 $id_nacionalidad = mainModel::cleanStringSQL($dataPerson['id_nacionalidad']);

		 $id_person = mainModel::cleanStringSQL($dataPerson['id_person']);


		 	if (mainModel::isDataEmtpy($doc_identidad,$id_nacionalidad)) {

					$dataPerson['ifNotHaveIdentityDocument'] = true; 
				}

		 	if (mainModel::isDataEmtpy($id_person)) {

				$alert=[
					"Alert"=>"simple",
					"Title"=>"Datos Vacios",
					"Text"=>"Los datos no fueron recibidos",
					"Type"=>"error"];

				echo json_encode($alert);

				exit();
								
				}				

					
				self::msgValidisExistPersona($dataPerson);
							 

				 }



		public static function getpersonController($columnsTable,$fieldsForFilter){

		$personAttributesFilter = [];

 		$filterValues = [];

		if (isset($fieldsForFilter["id_person"]) && !mainModel::isDataEmtpy($fieldsForFilter["id_person"])) {

		 $id_person = mainModel::cleanStringSQL($fieldsForFilter['id_person']);

		 array_push($personAttributesFilter, 'id_person = :id_person');
		$filterValues[':id_person'] = [
		'value' => $id_person,
		'type' => \PDO::PARAM_INT,
		];

		}

		if (isset($fieldsForFilter["id_nacionalidad"]) && !mainModel::isDataEmtpy($fieldsForFilter["id_nacionalidad"])) {

		 $id_nacionalidad = mainModel::cleanStringSQL($fieldsForFilter['id_nacionalidad']);

		 array_push($personAttributesFilter, 'id_nacionalidad = :id_nacionalidad');
		$filterValues[':id_nacionalidad'] = [
		'value' => $id_nacionalidad,
		'type' => \PDO::PARAM_STR,
		];

		}
	
	if (isset($fieldsForFilter["doc_identidad"]) && !mainModel::isDataEmtpy($fieldsForFilter["doc_identidad"])) {

		 $doc_identidad = mainModel::cleanStringSQL($fieldsForFilter['doc_identidad']);
		
		array_push($personAttributesFilter, 'doc_identidad = :doc_identidad');
		$filterValues[':doc_identidad'] = [
		'value' => $doc_identidad,
		'type' => \PDO::PARAM_STR,
		];

	}

		if (isset($fieldsForFilter["nombres"]) && !mainModel::isDataEmtpy($fieldsForFilter["nombres"])) {

		 $nombres = mainModel::cleanStringSQL($fieldsForFilter['nombres']);

		array_push($personAttributesFilter, 'nombres = :nombres');
		$filterValues[':nombres'] = [
		'value' => $nombres,
		'type' => \PDO::PARAM_STR,
		];

		}
		 
		if (isset($fieldsForFilter["apellidos"]) && !mainModel::isDataEmtpy($fieldsForFilter["apellidos"])) {

		 $apellidos = mainModel::cleanStringSQL($fieldsForFilter['apellidos']);
			
		array_push($personAttributesFilter, 'apellidos = :apellidos');
		$filterValues[':apellidos'] = [
		'value' => $apellidos,
		'type' => \PDO::PARAM_STR,
		];

		}


		if (isset($fieldsForFilter["fecha_nacimiento"]) && !mainModel::isDataEmtpy($fieldsForFilter["fecha_nacimiento"])) {

		array_push($personAttributesFilter, 'fecha_nacimiento = :fecha_nacimiento');
		$filterValues[':fecha_nacimiento'] = [
		'value' => $fecha_nacimiento,
		'type' => \PDO::PARAM_STR,
		];

		 $fecha_nacimiento = mainModel::cleanStringSQL($fieldsForFilter['fecha_nacimiento']);
		 
		 }

		if (isset($fieldsForFilter["id_genero"]) && !mainModel::isDataEmtpy($fieldsForFilter["id_genero"])) {
		 
		 $id_genero = mainModel::cleanStringSQL($fieldsForFilter['id_genero']);

		array_push($personAttributesFilter, 'id_genero = :id_genero');
		$filterValues[':id_genero'] = [
		'value' => $id_genero,
		'type' => \PDO::PARAM_STR,
		];
	}


			return mainModel::querySelectsCreator('personas',$columnsTable,$personAttributesFilter,$filterValues);

		}




// Funciones Para validar DATOS

	protected static function msgValidisExistPersona($dataPerson){

			extract($dataPerson);
			// no tiene_documento de identidad busca por num
		
		if (isset($ifNotHaveIdentityDocument) || $ifNotHaveIdentityDocument = 1) {

				$queryIsExistPerson = mainModel::connectDB()->query("select id_person from personas where id_person = '$id_person'");

				}else{
					$queryIsExistPerson = mainModel::connectDB()->query("select doc_identidad from personas where id_nacionalidad = '$id_nacionalidad' and doc_identidad = '$doc_identidad'");
				}
			
			if(!$queryIsExistPerson->rowCount()){
			$alert=[
				"Alert"=>"simple",
				"Title"=>"Datos no encontrados",
				"Text"=>"No se encuentra una persona con esta cedula registrada ".$indicatorPersonError,
				"Type"=>"error"
			];

				echo json_encode($alert);

				exit();
			}

	}


	public static function getIdPerson($id_nacionalidad,$doc_identidad){

						$queryIdPersona = mainModel::connectDB()->prepare("select id_person from personas where doc_identidad = '$doc_identidad' AND id_nacionalidad
							= '$id_nacionalidad' LIMIT 1
							");

						$queryIdPersona->execute();
						
						$dataDocIdentidadPerson = $queryIdPersona->fetchColumn();
						return $dataDocIdentidadPerson;
			
	}
	


	public static function msgValidDocIndetity($dataPerson){


extract($dataPerson);

		// si posee documento de identidad
		if ($ifNotHaveIdentityDocument && isset($ifExistPerson) && $ifExistPerson || isset($operationType) && $operationType == 'update') {

			            if(!is_numeric($id_person) || $id_person == 0){

		            $alert=[
		              "Alert"=>"simple",
		              "Title"=>"Datos Invalidos",
		              "Text"=>"El id persona es invalido".$indicatorPersonError,
		              "Type"=>"error"
		            ];

		              echo json_encode($alert);

		              exit();

		        }


						//  s3 revisa si ya posee cedula de identidad

						$queryGetDataDocIdentidadPerson = mainModel::connectDB()->query("select doc_identidad,id_nacionalidad from personas where id_person = '$id_person'");


						$dataDocIdentidadPerson = $queryGetDataDocIdentidadPerson->fetchAll(PDO::FETCH_ASSOC);

						if ($queryGetDataDocIdentidadPerson->rowCount() && !mainModel::isDataEmtpy($dataDocIdentidadPerson[0]['doc_identidad'],$dataDocIdentidadPerson[0]['id_nacionalidad']) && $ifNotHaveIdentityDocument) {
								$alert=[
									"Alert"=>"simple",
									"Title"=>"Datos Invalidos",
									"Text"=>"La persona ya posee documento de identidad, use este ultimo".$indicatorPersonError,
									"Type"=>"error"
								];

									echo json_encode($alert);

									exit();					
						}

			}


if (!$ifNotHaveIdentityDocument){
								if(!self::isValidDocIdentidad($doc_identidad)){
								$alert=[
									"Alert"=>"simple",
									"Title"=>"Datos Invalidos",
									"Text"=>"El documento de identidad es invalido".$indicatorPersonError,
									"Type"=>"error"
								];

									echo json_encode($alert);

									exit();
								}
						


					if(!mainModel::isValidSelectionTwoOptions($id_nacionalidad)){

					$alert=[
						"Alert"=>"simple",
						"Title"=>"Datos Invalidos",
						"Text"=>"El campo de Nacionalidad es invalido".$indicatorPersonError,
						"Type"=>"error"
					];

						echo json_encode($alert);

						exit();
					}


			}
	}

	protected static function msgValidiFieldsBasicPersona($dataPerson){


extract($dataPerson);

			
			self::msgValidDocIndetity($dataPerson);


			if(!mainModel::isValidSelectionTwoOptions($id_genero)){

			$alert=[
				"Alert"=>"simple",
				"Title"=>"Datos Invalidos",
				"Text"=>"El campo de Genero es invalido".$indicatorPersonError,
				"Type"=>"error"
			];

				echo json_encode($alert);

				exit();
			}

			if(!self::isValidNombresApellidos($nombres,$apellidos)){

			$alert=[
				"Alert"=>"simple",
				"Title"=>"Datos Invalidos",
				"Text"=>"El Nombre o Apellido ingresado es invalido".$indicatorPersonError,
				"Type"=>"error"
			];

				echo json_encode($alert);

				exit();
			}


			if (!mainModel::checkDate($fecha_nacimiento)){
			$alert=[
				"Alert"=>"simple",
				"Title"=>"Datos Invalidos",
				"Text"=>"El campo fecha de  nacimiento es invalido".$indicatorPersonError,
				"Type"=>"error"
			];

				echo json_encode($alert);

				exit();
		}


		if (mainModel::isDateGreaterCurrentDate($fecha_nacimiento)) {
				$alert=[
					"Alert"=>"simple",
					"Title"=>"Datos Invalidos",
					"Text"=>"La Fecha de Nacimiento es mayor a la del sistema".$indicatorPersonError,
					"Type"=>"error"
				];

					echo json_encode($alert);

					exit();
		}


		self::msgValidNroTlf($dataPerson);


			}

	public static function msgValidNroTlf($dataPerson){
	
		if(!mainModel::isValidNroTlf($dataPerson['telefono'])){
			
			$alert=[
				"Alert"=>"simple",
				"Title"=>"Datos Invalidos",
				"Text"=>"El Nro de Telefono es invalido".$dataPerson['indicatorPersonError'],
				"Type"=>"error"
			];

				echo json_encode($alert);

				exit();
			}
	
	}
	

	public static function msgValidExistPersonForRegister($dataPerson){

	extract($dataPerson);


		// Comprobar si existe o no la person en la BD

if ($ifNotHaveIdentityDocument) {


			if($ifExistPerson){
	
			$queryIsExistPerson = mainModel::connectDB()->query("SELECT id_person FROM personas WHERE id_person = $id_person");	

			$ifExistPerson = 1;

			if(!$queryIsExistPerson->rowCount()){
			$alert=[
				"Alert"=>"simple",
				"Title"=>"Datos no encontrados",
				"Text"=>"No se encuentra una persona con este id registrada ",
				"Type"=>"error"
			];

				echo json_encode($alert);

				exit();
			}

			}
}else{

		$queryIsExistPerson = mainModel::connectDB()->query("SELECT id_nacionalidad,doc_identidad FROM personas WHERE id_nacionalidad = '$id_nacionalidad' AND doc_identidad = '$doc_identidad'");	

			if($ifExistPerson){

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
				// Si no existe y es una person nueva comprobar que no este repetido en la BD
			if($queryIsExistPerson->rowCount()){
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
}

	}


public static function isValidDocIdentidad($doc_identidad){
    if(preg_match_all("/^[0-9]{7,9}$/",$doc_identidad)){
        return TRUE;
    }
        return FALSE;
	}

public static function isValidNombresApellidos(...$NombresApellidos){
	    foreach ($NombresApellidos as $NombreApellido) {
        
       if(!preg_match("/^(?=.{2,40}$)[a-zñA-ZÑ](\s?[a-zñA-ZÑ])*$/",$NombreApellido)){
        
        return FALSE;
         }
     }
        return TRUE;
    }


// Funciones Para Limpiar/filtrar DATOS

public static function filtterNombresApellidos($nombreApellido){

       $nombreApellido=trim($nombreApellido);

        $nombreApellido=ucwords(strtolower($nombreApellido));
        
        return $nombreApellido;

}

}

 ?>