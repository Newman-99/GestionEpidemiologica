<?php 	$requestAjax = TRUE;

	if($requestAjax){
		require_once "../model/personaModel.php";
	}else{
		require_once "./model/personaModel.php";
	}

	class personaController extends personaModel{

	// Funciones para manejar datos (CRUD)
		public function addPersonaController($dataPersona){
		 
		$doc_identidad = mainModel::cleanStringSQL($dataPersona['doc_identidad']);
		
		 $doc_identidad = self::ClearUserSeparatedCharacters($doc_identidad);

		 $nombres = mainModel::cleanStringSQL($dataPersona['nombres']);
		 
		 $apellidos = mainModel::cleanStringSQL($dataPersona['apellidos']);

		$nombres=self::filtterNombresApellidos($nombres);

		$apellidos=self::filtterNombresApellidos($apellidos);

		 $fecha_nacimiento = mainModel::cleanStringSQL($dataPersona['fecha_nacimiento']);		 	
		 
		 $id_nacionalidad = mainModel::cleanStringSQL($dataPersona['id_nacionalidad']);
		 
		 $id_genero = mainModel::cleanStringSQL($dataPersona['id_genero']);

		 $id_genero = mainModel::cleanStringSQL($dataPersona['id_genero']);

		 $telefono = mainModel::cleanStringSQL($dataPersona['telefonoPart1'].$dataPersona['telefonoPart2'].$dataPersona['telefonoPart3']);

		 $telefono = self::ClearUserSeparatedCharacters($telefono);


		if (mainModel::isDataEmtpy(
			$doc_identidad,
			$nombres,
			$apellidos,
			$fecha_nacimiento,
			$id_nacionalidad,$id_genero,$telefono)) {

			$alert=[
				"Alert"=>"simple",
				"Title"=>"Campos Vacios",
				"Text"=>"Todos los datos personales son obligatorios",
				"Type"=>"error"
			];

				echo json_encode($alert);

				exit();
			}

			$queryIsExistPerson = mainModel::connectDB()->query("SELECT doc_identidad FROM personas WHERE doc_identidad =
			'$doc_identidad' AND id_nacionalidad =
			'$id_nacionalidad'");

			if($queryIsExistPerson->rowCount()){

			$alert=[
				"Alert"=>"simple",
				"Title"=>"Datos Invalidos",
				"Text"=>"Ya se encuentra una persona con este documento de identidad",
				"Type"=>"error"
			];

				echo json_encode($alert);

				exit();
			}


			if(!self::isValiddoc_identidad($doc_identidad)){

			$alert=[
				"Alert"=>"simple",
				"Title"=>"Datos Invalidos",
				"Text"=>"El documento de identidad es invalido",
				"Type"=>"error"
			];

				echo json_encode($alert);

				exit();
			}

			if(!mainModel::isValidSelectionTwoOptions($id_nacionalidad)){

			$alert=[
				"Alert"=>"simple",
				"Title"=>"Datos Invalidos",
				"Text"=>"El campo de Nacionalidad es invalido",
				"Type"=>"error"
			];

				echo json_encode($alert);

				exit();
			}


			if(!mainModel::isValidSelectionTwoOptions($id_genero)){

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


			if (!mainModel::checkDate($fecha_nacimiento)){
			$alert=[
				"Alert"=>"simple",
				"Title"=>"Datos Invalidos",
				"Text"=>"El campo fecha de  nacimiento es invalido",
				"Type"=>"error"
			];

				echo json_encode($alert);

				exit();
		}


		if (mainModel::isDateGreaterCurrentDate($fecha_nacimiento)) {
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

		 $dataPersona['doc_identidad'] = $doc_identidad;
		 
		 $dataPersona['nombres'] = $nombres;
		 
		 $dataPersona['apellidos'] = $apellidos;
		 
		 $dataPersona['fecha_nacimiento'] = $fecha_nacimiento;

		 $dataPersona['id_nacionalidad'] = $id_nacionalidad;
		 
		 $dataPersona['id_genero'] = $id_genero;
		
		 personaModel::addPersonaModel($dataPersona);

				 	}				


		public static function updatePersonaController($dataPersona){

		 $doc_identidad = mainModel::cleanStringSQL($dataPersona['doc_identidad']);
		 
		 $nombres = mainModel::cleanStringSQL($dataPersona['nombres']);
		 
		 $apellidos = mainModel::cleanStringSQL($dataPersona['apellidos']);
		 
		 $fecha_nacimiento = mainModel::cleanStringSQL($dataPersona['fecha_nacimiento']);
		 
		 $id_nacionalidad = mainModel::cleanStringSQL($dataPersona['id_nacionalidad']);
		 
		 $id_genero = mainModel::cleanStringSQL($dataPersona['id_genero']);
		
		 $telefono = $dataPersona['telefonoPart1'].$dataPersona['telefonoPart2'].$dataPersona['telefonoPart3'];

		 $telefono = mainModel::cleanStringSQL($telefono);

		 			if (!isset(
						 $doc_identidad,
						 $nombres,
						 $apellidos,
						 $fecha_nacimiento,
						 $id_nacionalidad,
						 $id_genero)) {

			$alert=[
				"Alert"=>"simple",
				"Title"=>"Campos Vacios",
				"Text"=>"Faltan campos para la actualizacion",
				"Type"=>"error"
			];
			
				echo json_encode($alert);

				exit();

			}



			$isExistPerson = mainModel::connectDB()->query("SELECT doc_identidad FROM personas WHERE doc_identidad =
			'$doc_identidad' AND id_nacionalidad =
			'$id_nacionalidad'");

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

			if(!self::isValiddoc_identidad($doc_identidad)){

			$alert=[
				"Alert"=>"simple",
				"Title"=>"Datos Invalidos",
				"Text"=>"El documento de identidad es invalido",
				"Type"=>"error"
			];

				echo json_encode($alert);

				exit();
			}


			if(!mainModel::isValidSelectionTwoOptions($id_genero)){

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


			if (!mainModel::checkDate($fecha_nacimiento)){
			$alert=[
				"Alert"=>"simple",
				"Title"=>"Datos Invalidos",
				"Text"=>"El campo fecha de  nacimiento es invalido",
				"Type"=>"error"
			];

				echo json_encode($alert);

				exit();
		}


		if (mainModel::isDateGreaterCurrentDate($fecha_nacimiento)) {
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

		 $dataPersona['doc_identidad'] = $doc_identidad;
		 
		 $dataPersona['nombres'] = $nombres;
		 
		 $dataPersona['apellidos'] = $apellidos;
		 
		 $dataPersona['fecha_nacimiento'] = $fecha_nacimiento;
		 
		 $dataPersona['id_nacionalidad'] = $id_nacionalidad;
		 
		 $dataPersona['id_genero'] = $id_genero;
		 
		return personaModel::updatePersonaModel($dataPersona);

				 	

				 }


		public function deletePersonaController($dataPersona){
			
		 $doc_identidad = mainModel::cleanStringSQL($dataPersona['doc_identidad']);
		 
		 $id_nacionalidad = mainModel::cleanStringSQL($dataPersona['id_nacionalidad']);

		 	if (mainModel::isDataEmtpy($doc_identidad,$id_nacionalidad)) {
				$alert=[
					"Alert"=>"simple",
					"Title"=>"Datos Vacios",
					"Text"=>"Los datos no fueron recibidos",
					"Type"=>"error"];
					
				echo json_encode($alert);

				exit();

				 	}

			$primaryKeyPersona = [

				"id_nacionalidad"=>$id_nacionalidad,
				"doc_identidad"=>$doc_identidad
			];

			$queryIsExistPersona = mainModel::connectDB()->query("select doc_identidad from personas where id_nacionalidad = '$id_nacionalidad' and doc_identidad = '$doc_identidad'");
			
			if(!$queryIsExistPersona->rowCount()){
			$alert=[
				"Alert"=>"simple",
				"Title"=>"Datos no encontrados",
				"Text"=>"No se encuentra una persona con esta cedula registrada ",
				"Type"=>"error"
			];

				echo json_encode($alert);

				exit();
			}

			 return personaModel::deletePersonaModel($primaryKeyPersona);

							 

				 }



		public static function getPersonaController($dataPersona){

		$personAttributesFilter = [];

 		$filterValues = [];

		if (isset($dataPersona["id_nacionalidad"]) && !mainModel::isDataEmtpy($dataPersona["id_nacionalidad"])) {

		 $id_nacionalidad = mainModel::cleanStringSQL($dataPersona['id_nacionalidad']);

		 array_push($personAttributesFilter, 'id_nacionalidad = :id_nacionalidad');
		$filterValues[':id_nacionalidad'] = [
		'value' => $id_nacionalidad,
		'type' => \PDO::PARAM_STR,
		];

		}
	
	if (isset($dataPersona["doc_identidad"]) && !mainModel::isDataEmtpy($dataPersona["doc_identidad"])) {

		 $doc_identidad = mainModel::cleanStringSQL($dataPersona['doc_identidad']);
		
		array_push($personAttributesFilter, 'doc_identidad = :doc_identidad');
		$filterValues[':doc_identidad'] = [
		'value' => $doc_identidad,
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


		if (isset($dataPersona["fecha_nacimiento"]) && !mainModel::isDataEmtpy($dataPersona["fecha_nacimiento"])) {

		array_push($personAttributesFilter, 'fecha_nacimiento = :fecha_nacimiento');
		$filterValues[':fecha_nacimiento'] = [
		'value' => $fecha_nacimiento,
		'type' => \PDO::PARAM_STR,
		];

		 $fecha_nacimiento = mainModel::cleanStringSQL($dataPersona['fecha_nacimiento']);
		 
		 }

		if (isset($dataPersona["id_genero"]) && !mainModel::isDataEmtpy($dataPersona["id_genero"])) {
		 
		 $id_genero = mainModel::cleanStringSQL($dataPersona['id_genero']);

		array_push($personAttributesFilter, 'id_genero = :id_genero');
		$filterValues[':id_genero'] = [
		'value' => $id_genero,
		'type' => \PDO::PARAM_STR,
		];
	}


			return personaModel::getPersonaModel($personAttributesFilter,$filterValues);

		}



// Funciones Para validar DATOS

public static function isValiddoc_identidad($doc_identidad){
    if(preg_match_all("/^[0-9]{7,8}$/",$doc_identidad)){
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