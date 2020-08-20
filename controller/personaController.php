<?php 	$requestAjax = TRUE;

	if($requestAjax){
		require_once "../model/personaModel.php";
	}else{
		require_once "./model/personaModel.php";
	}

	class personaController extends personaModel{

	// Funciones para manejar datos (CRUD)
		public function addPersonaController($dataPersona){
		 
		$docIdentidad = mainModel::cleanStringSQL($dataPersona['docIdentidad']);
		
		 $docIdentidad = self::ClearUserSeparatedCharacters($docIdentidad);

		 $nombres = mainModel::cleanStringSQL($dataPersona['nombres']);
		 
		 $apellidos = mainModel::cleanStringSQL($dataPersona['apellidos']);

		$nombres=self::filtterNombresApellidos($nombres);

		$apellidos=self::filtterNombresApellidos($apellidos);

		 $fechaNacimiento = mainModel::cleanStringSQL($dataPersona['fechaNacimiento']);		 	
		 
		 $idNacionalidad = mainModel::cleanStringSQL($dataPersona['idNacionalidad']);
		 
		 $idGenero = mainModel::cleanStringSQL($dataPersona['idGenero']);

		 $idGenero = mainModel::cleanStringSQL($dataPersona['idGenero']);

		 $telefono = mainModel::cleanStringSQL($dataPersona['telefonoPart1'].$dataPersona['telefonoPart2'].$dataPersona['telefonoPart3']);

		 $telefono = self::ClearUserSeparatedCharacters($telefono);


		if (mainModel::isDataEmtpy(
			$docIdentidad,
			$nombres,
			$apellidos,
			$fechaNacimiento,
			$idNacionalidad,$idGenero,$telefono)) {

			$alert=[
				"Alert"=>"simple",
				"Title"=>"Campos Vacios",
				"Text"=>"Todos los datos personales son obligatorios",
				"Type"=>"error"
			];

				echo json_encode($alert);

				exit();
			}

			$isExistPerson = mainModel::runSimpleQuery("SELECT docIdentidad FROM `personas` WHERE docIdentidad =
			'$docIdentidad' AND idNacionalidad =
			'$idNacionalidad'");

			if($isExistPerson->rowCount()){

			$alert=[
				"Alert"=>"simple",
				"Title"=>"Datos Invalidos",
				"Text"=>"Ya se encuentra una persona con este documento de identidad",
				"Type"=>"error"
			];

				echo json_encode($alert);

				exit();
			}


			if(!self::isValidDocIdentidad($docIdentidad)){

			$alert=[
				"Alert"=>"simple",
				"Title"=>"Datos Invalidos",
				"Text"=>"El documento de identidad es invalido",
				"Type"=>"error"
			];

				echo json_encode($alert);

				exit();
			}

			if(!mainModel::isValidSelectionTwoOptions($idNacionalidad)){

			$alert=[
				"Alert"=>"simple",
				"Title"=>"Datos Invalidos",
				"Text"=>"El campo de Nacionalidad es invalido",
				"Type"=>"error"
			];

				echo json_encode($alert);

				exit();
			}


			if(!mainModel::isValidSelectionTwoOptions($idGenero)){

			$alert=[
				"Alert"=>"simple",
				"Title"=>"Datos Invalidos",
				"Text"=>"El campo de Genero es invalido",
				"Type"=>"error"
			];

				echo json_encode($alert);

				exit();
			}

			if(!self::isValidNombresApellidos($nombres,$apellidos)){

			$alert=[
				"Alert"=>"simple",
				"Title"=>"Datos Invalidos",
				"Text"=>"El Nombre o Apellido ingresado es invalido",
				"Type"=>"error"
			];

				echo json_encode($alert);

				exit();
			}


			if (!mainModel::checkDate($fechaNacimiento)){
			$alert=[
				"Alert"=>"simple",
				"Title"=>"Datos Invalidos",
				"Text"=>"El campo fecha de  nacimiento es invalido",
				"Type"=>"error"
			];

				echo json_encode($alert);

				exit();
		}


		if (mainModel::isDateGreaterCurrentDate($fechaNacimiento)) {
				$alert=[
					"Alert"=>"simple",
					"Title"=>"Datos Invalidos",
					"Text"=>"La Fecha de Nacimiento es mayor a la del sistema",
					"Type"=>"error"
				];

					echo json_encode($alert);

					exit();
		}

		if(!mainModel::isValidNroTlf($telefono)){
			
			$alert=[
				"Alert"=>"simple",
				"Title"=>"Datos Invalidos",
				"Text"=>"El Nro de Telefono es invalido",
				"Type"=>"error"
			];

				echo json_encode($alert);

				exit();
			}



		 $dataPersona = array();

		 $dataPersona['docIdentidad'] = $docIdentidad;
		 
		 $dataPersona['nombres'] = $nombres;
		 
		 $dataPersona['apellidos'] = $apellidos;
		 
		 $dataPersona['fechaNacimiento'] = $fechaNacimiento;

		 $dataPersona['idNacionalidad'] = $idNacionalidad;
		 
		 $dataPersona['idGenero'] = $idGenero;
		
		 personaModel::addPersonaModel($dataPersona);

				 	}				


		public static function updatePersonaController($dataPersona){

		 $docIdentidad = mainModel::cleanStringSQL($dataPersona['docIdentidad']);
		 
		 $nombres = mainModel::cleanStringSQL($dataPersona['nombres']);
		 
		 $apellidos = mainModel::cleanStringSQL($dataPersona['apellidos']);
		 
		 $fechaNacimiento = mainModel::cleanStringSQL($dataPersona['fechaNacimiento']);
		 
		 $idNacionalidad = mainModel::cleanStringSQL($dataPersona['idNacionalidad']);
		 
		 $idGenero = mainModel::cleanStringSQL($dataPersona['idGenero']);
		
		 $telefono = $dataPersona['telefonoPart1'].$dataPersona['telefonoPart2'].$dataPersona['telefonoPart3'];

		 $telefono = mainModel::cleanStringSQL($telefono);

		 			if (!isset(
						 $docIdentidad,
						 $nombres,
						 $apellidos,
						 $fechaNacimiento,
						 $idNacionalidad,
						 $idGenero)) {

			$alert=[
				"Alert"=>"simple",
				"Title"=>"Campos Vacios",
				"Text"=>"Faltan campos para la actualizacion",
				"Type"=>"error"
			];
			
				echo json_encode($alert);

				exit();

			}



			$isExistPerson = mainModel::runSimpleQuery("SELECT docIdentidad FROM `personas` WHERE docIdentidad =
			'$docIdentidad' AND idNacionalidad =
			'$idNacionalidad'");

			if(!$isExistPerson->rowCount()){

			$alert=[
				"Alert"=>"simple",
				"Title"=>"Datos Invalidos",
				"Text"=>"Ya se encuentra una persona con este documento de identidad",
				"Type"=>"error"
			];

				echo json_encode($alert);

				exit();
			}

			if(!self::isValidDocIdentidad($docIdentidad)){

			$alert=[
				"Alert"=>"simple",
				"Title"=>"Datos Invalidos",
				"Text"=>"El documento de identidad es invalido",
				"Type"=>"error"
			];

				echo json_encode($alert);

				exit();
			}


			if(!mainModel::isValidSelectionTwoOptions($idGenero)){

			$alert=[
				"Alert"=>"simple",
				"Title"=>"Datos Invalidos",
				"Text"=>"El campo de Genero es invalido",
				"Type"=>"error"
			];

				echo json_encode($alert);

				exit();
			}

			if(!self::isValidNombresApellidos($nombres,$apellidos)){

			$alert=[
				"Alert"=>"simple",
				"Title"=>"Datos Invalidos",
				"Text"=>"El Nombre o Apellido ingresado es invalido",
				"Type"=>"error"
			];

				echo json_encode($alert);

				exit();
			}


			if (!mainModel::checkDate($fechaNacimiento)){
			$alert=[
				"Alert"=>"simple",
				"Title"=>"Datos Invalidos",
				"Text"=>"El campo fecha de  nacimiento es invalido",
				"Type"=>"error"
			];

				echo json_encode($alert);

				exit();
		}


		if (mainModel::isDateGreaterCurrentDate($fechaNacimiento)) {
				$alert=[
					"Alert"=>"simple",
					"Title"=>"Datos Invalidos",
					"Text"=>"La Fecha de Nacimiento es mayor a la del sistema",
					"Type"=>"error"
				];

					echo json_encode($alert);

					exit();
		}

		if(!mainModel::isValidNroTlf($telefono)){
			
			$alert=[
				"Alert"=>"simple",
				"Title"=>"Datos Invalidos",
				"Text"=>"El Nro de Telefono es invalido",
				"Type"=>"error"
			];

				echo json_encode($alert);

				exit();
			}



		 $dataPersona = array();

		 $dataPersona['docIdentidad'] = $docIdentidad;
		 
		 $dataPersona['nombres'] = $nombres;
		 
		 $dataPersona['apellidos'] = $apellidos;
		 
		 $dataPersona['fechaNacimiento'] = $fechaNacimiento;
		 
		 $dataPersona['idNacionalidad'] = $idNacionalidad;
		 
		 $dataPersona['idGenero'] = $idGenero;
		 
		return personaModel::updatePersonaModel($dataPersona);

				 	

				 }


		public function deletePersonaController($dataPersona){
			
		 $docIdentidad = mainModel::cleanStringSQL($dataPersona['docIdentidad']);
		 
		 $idNacionalidad = mainModel::cleanStringSQL($dataPersona['idNacionalidad']);

		 	if (mainModel::isDataEmtpy($docIdentidad,$idNacionalidad)) {
				$alert=[
					"Alert"=>"simple",
					"Title"=>"Datos Vacios",
					"Text"=>"Los datos no fueron recibidos",
					"Type"=>"error"];
					
				echo json_encode($alert);

				exit();

				 	}

			$primaryKeyPersona = [

				"idNacionalidad"=>$idNacionalidad,
				"docIdentidad"=>$docIdentidad
			];

			$SQL_isExistPersona = self::getPersonaController($primaryKeyPersona);
			
			$SQL_isExistPersona->execute();

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

			 personaModel::deletePersonaModel($primaryKeyPersona);

							 

				 }



		public static function getPersonaController($dataPersona){

		$personAttributesFilter = [];

 		$filterValues = [];

		if (isset($dataPersona["idNacionalidad"]) && !mainModel::isDataEmtpy($dataPersona["idNacionalidad"])) {

		 $idNacionalidad = mainModel::cleanStringSQL($dataPersona['idNacionalidad']);

		 array_push($personAttributesFilter, 'idNacionalidad = :idNacionalidad');
		$filterValues[':idNacionalidad'] = [
		'value' => $idNacionalidad,
		'type' => \PDO::PARAM_STR,
		];

		}
	
	if (isset($dataPersona["docIdentidad"]) && !mainModel::isDataEmtpy($dataPersona["docIdentidad"])) {

		 $docIdentidad = mainModel::cleanStringSQL($dataPersona['docIdentidad']);
		
		array_push($personAttributesFilter, 'docIdentidad = :docIdentidad');
		$filterValues[':docIdentidad'] = [
		'value' => $docIdentidad,
		'type' => \PDO::PARAM_STR,
		];

	}		

		if (isset($dataPersona["nombres"]) && !mainModel::isDataEmtpy($dataPersona["nombres"])) {

		 $nombres = mainModel::cleanStringSQL($dataPersona['nombres']);

		array_push($personAttributesFilter, 'nombres = :nombres');
		$filterValues[':nombres'] = [
		'value' => $nombres,
		'type' => \PDO::PARAM_STR,
		];

		}
		 
		if (isset($dataPersona["apellidos"]) && !mainModel::isDataEmtpy($dataPersona["apellidos"])) {

		 $apellidos = mainModel::cleanStringSQL($dataPersona['apellidos']);
			
		array_push($personAttributesFilter, 'apellidos = :apellidos');
		$filterValues[':apellidos'] = [
		'value' => $apellidos,
		'type' => \PDO::PARAM_STR,
		];

		}


		if (isset($dataPersona["fechaNacimiento"]) && !mainModel::isDataEmtpy($dataPersona["fechaNacimiento"])) {

		array_push($personAttributesFilter, 'fechaNacimiento = :fechaNacimiento');
		$filterValues[':fechaNacimiento'] = [
		'value' => $fechaNacimiento,
		'type' => \PDO::PARAM_STR,
		];

		 $fechaNacimiento = mainModel::cleanStringSQL($dataPersona['fechaNacimiento']);
		 
		 }

		if (isset($dataPersona["idGenero"]) && !mainModel::isDataEmtpy($dataPersona["idGenero"])) {
		 
		 $idGenero = mainModel::cleanStringSQL($dataPersona['idGenero']);

		array_push($personAttributesFilter, 'idGenero = :idGenero');
		$filterValues[':idGenero'] = [
		'value' => $idGenero,
		'type' => \PDO::PARAM_STR,
		];
	}


			return personaModel::getPersonaModel($personAttributesFilter,$filterValues);

		}



// Funciones Para validar DATOS

public static function isValidDocIdentidad($docIdentidad){
    if(preg_match_all("/^[0-9]{7,8}$/",$docIdentidad)){
        return TRUE;
    }
        return FALSE;
	}


public static function isValidNombresApellidos(...$NombresApellidos){
	    foreach ($NombresApellidos as $NombreApellido) {
        
       if(!preg_match("/^(?=.{2,36}$)[a-zñA-ZÑ](\s?[a-zñA-ZÑ])*$/",$NombreApellido)){
        
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