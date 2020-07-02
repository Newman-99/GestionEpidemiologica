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
		
		 $docIdentidad = self::cleanStrDocIdentidad($docIdentidad);

		 $nombres = mainModel::cleanStringSQL($dataPersona['nombres']);
		 
		 $apellidos = mainModel::cleanStringSQL($dataPersona['apellidos']);

		$nombres=self::filtterNombresApellidos($nombres);

		$apellidos=self::filtterNombresApellidos($apellidos);

		 $fechaNacimiento = mainModel::cleanStringSQL($dataPersona['fechaNacimiento']);		 	
		 
		 $idNacionalidad = mainModel::cleanStringSQL($dataPersona['idNacionalidad']);
		 
		 $idGenero = mainModel::cleanStringSQL($dataPersona['idGenero']);

var_dump(mainModel::isDateGreaterCurrentDate($fechaNacimiento));
	

		if (mainModel::isDataEmtpy(
			$docIdentidad,
			$nombres,
			$apellidos,
			$fechaNacimiento,
			$idNacionalidad,$idGenero)) {

			$alert=[
				"Alert"=>"simple",
				"Title"=>"Campos Vacios",
				"Text"=>"Todos los datos personales deben ser llenados",
				"Type"=>"error"
			];

				echo json_encode($alert);

				exit();
			}

		 $primaryKeyPersona = array();

		 $primaryKeyPersona['idNacionalidad'] = $idNacionalidad;

		 $primaryKeyPersona['docIdentidad'] = $docIdentidad;

			if(isset($dataPersona['siExistPerson']) && $dataPersona['siExistPerson'] == 1 ){

			if(!self::getPersonaController($primaryKeyPersona)){
			$alert=[
				"Alert"=>"simple",
				"Title"=>"Datos no encontrados",
				"Text"=>"No se encuentra una persona con esta cedula registrada ".$dataPersona['siExistPerson'],
				"Type"=>"error"
			];

				echo json_encode($alert);

				exit();
			}

			}else{

			if(is_array(self::getPersonaController($primaryKeyPersona))){
			$alert=[
				"Alert"=>"simple",
				"Title"=>"Datos Duplicados",
				"Text"=>"Ya se encuentra una persona con esta cedula registrada ".$dataPersona['siExistPerson'],
				"Type"=>"error"
			];

				echo json_encode($alert);

				exit();
			}
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

			if(!self::isValidSelectionTwoOptions($idNacionalidad)){

			$alert=[
				"Alert"=>"simple",
				"Title"=>"Datos Invalidos",
				"Text"=>"El campo de Nacionalidad es invalido",
				"Type"=>"error"
			];

				echo json_encode($alert);

				exit();
			}


			if(!self::isValidSelectionTwoOptions($idGenero)){

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

		 $dataPersona = array();

		 $dataPersona['docIdentidad'] = $docIdentidad;
		 
		 $dataPersona['nombres'] = $nombres;
		 
		 $dataPersona['apellidos'] = $apellidos;
		 
		 $dataPersona['fechaNacimiento'] = $fechaNacimiento;

		 $dataPersona['idNacionalidad'] = $idNacionalidad;
		 
		 $dataPersona['idGenero'] = $idGenero;
		 
			$alert=[
				"Alert"=>"simple",
				"Title"=>"Operacion Exitosa",
				"Text"=>"Datos personales registrados",
				"Type"=>"success"
			];

			
				echo json_encode($alert);


			// personaModel::addPersonaModel($dataPersona);

				 	}				


		public function updatePersonaController($dataPersona){
			
		 $docIdentidad = mainModel::cleanStringSQL($dataPersona['docIdentidad']);
		 
		 $nombres = mainModel::cleanStringSQL($dataPersona['nombres']);
		 
		 $apellidos = mainModel::cleanStringSQL($dataPersona['apellidos']);
		 
		 $fechaNacimiento = mainModel::cleanStringSQL($dataPersona['fechaNacimiento']);
		 
		 $idNacionalidad = mainModel::cleanStringSQL($dataPersona['idNacionalidad']);
		 
		 $idGenero = mainModel::cleanStringSQL($dataPersona['idGenero']);
		 
		 			if (mainModel::isDataEmtpy(
						 $docIdentidad,
						 $nombres,
						 $apellidos,
						 $fechaNacimiento,
						 $idNacionalidad,
						 $idGenero)) {


				 	}else{


		 $dataPersona = array();

		 $dataPersona['docIdentidad'] = $docIdentidad;
		 
		 $dataPersona['nombres'] = $nombres;
		 
		 $dataPersona['apellidos'] = $apellidos;
		 
		 $dataPersona['fechaNacimiento'] = $fechaNacimiento;
		 
		 $dataPersona['idNacionalidad'] = $idNacionalidad;
		 
		 $dataPersona['idGenero'] = $idGenero;
		 

			 personaModel::updatePersonaModel($dataPersona);

				 	}

				 }


		public function deletePersonaController($dataPersona){
			
		 $docIdentidad = mainModel::cleanStringSQL($dataPersona['docIdentidad']);
		 
		 
		 			if (mainModel::isDataEmtpy(
						 $docIdentidad)) {
				 	}else{


		 $dataPersona = array();

		 $dataPersona['docIdentidad'] = $docIdentidad;
		 

			 personaModel::deletePersonaModel($dataPersona);

				 	}

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

public static function cleanStrDocIdentidad($docIdentidad){

    $docIdentidad=preg_replace("/\.|-|\s/", "",$docIdentidad);
    return $docIdentidad;

}

public static function isValidDocIdentidad($docIdentidad){
    if(preg_match_all("/^[0-9]{7,8}$/",$docIdentidad)){
        return TRUE;
    }
        return FALSE;
	}



public static function isValidSelectionTwoOptions($idOption){

	// si no concide con los id en la BD
    if (strcmp($idOption,"1") == 0 || strcmp($idOption,"2") == 0) {
		return TRUE;
	}	
	else FALSE;
}


public static function isValidNombresApellidos(...$NombresApellidos){
	    foreach ($NombresApellidos as $NombreApellido) {
        
       if(!preg_match("/^(?=.{2,36}$)[a-zñA-ZÑ](\s?[a-zñA-ZÑ])*$/",$NombreApellido)){
        
        return FALSE; 
         }
     } 
        return TRUE;
    }


public static function filtterNombresApellidos($nombreApellido){

       $nombreApellido=trim($nombreApellido);

        $nombreApellido=ucwords(strtolower($nombreApellido));
        
        return $nombreApellido; 

}

}

 ?>