<?php 	$requestAjax = TRUE;

	if($requestAjax){
		require_once "../model/personaModel.php";
	}else{
		require_once "./model/personaModel.php";
	}

	class personaController extends personaModel{

		public function addPersonaController($dataPersona){
			
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
			 		echo "<h1>ALGO VACIO</h1>";
				 	}else{


		 $dataPersona = array();

		 $dataPersona['docIdentidad'] = $docIdentidad;
		 
		 $dataPersona['nombres'] = $nombres;
		 
		 $dataPersona['apellidos'] = $apellidos;
		 
		 $dataPersona['fechaNacimiento'] = $fechaNacimiento;
		 
		 $dataPersona['idNacionalidad'] = $idNacionalidad;
		 
		 $dataPersona['idGenero'] = $idGenero;
		 

			echo "<h1>REGISTRADO</h1>";

			var_dump($dataPersona);

			 personaModel::addPersonaModel($dataPersona);

				 	}

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
			 		echo "<h1>ALGO VACIO</h1>";
				 	}else{


		 $dataPersona = array();

		 $dataPersona['docIdentidad'] = $docIdentidad;
		 
		 $dataPersona['nombres'] = $nombres;
		 
		 $dataPersona['apellidos'] = $apellidos;
		 
		 $dataPersona['fechaNacimiento'] = $fechaNacimiento;
		 
		 $dataPersona['idNacionalidad'] = $idNacionalidad;
		 
		 $dataPersona['idGenero'] = $idGenero;
		 

			echo "<h1>actualizado</h1>";

			var_dump($dataPersona);

			 personaModel::updatePersonaModel($dataPersona);

				 	}

				 }


		public function deletePersonaController($dataPersona){
			
		 $docIdentidad = mainModel::cleanStringSQL($dataPersona['docIdentidad']);
		 
		 
		 			if (mainModel::isDataEmtpy(
						 $docIdentidad)) {
			 		echo "<h1>docIdentidad VACIO</h1>";
				 	}else{


		 $dataPersona = array();

		 $dataPersona['docIdentidad'] = $docIdentidad;
		 
			echo "<h1>Eliminado</h1>";

			var_dump($dataPersona);

			 personaModel::deletePersonaModel($dataPersona);

				 	}

				 }



		public function getPersonaController($dataPersona){

		 $docIdentidad = mainModel::cleanStringSQL($dataPersona['docIdentidad']);
		 
		 $nombres = mainModel::cleanStringSQL($dataPersona['nombres']);
		 
		 $apellidos = mainModel::cleanStringSQL($dataPersona['apellidos']);
		 
		 $fechaNacimiento = mainModel::cleanStringSQL($dataPersona['fechaNacimiento']);
		 
		 $idNacionalidad = mainModel::cleanStringSQL($dataPersona['idNacionalidad']);
		 
		 $idGenero = mainModel::cleanStringSQL($dataPersona['idGenero']);

		

		// Filtracion de campos en la consulta
		$personAttributesFilter = [];

 		$filterValues = [];

		if (!empty($docIdentidad)) {
		array_push($personAttributesFilter, 'docIdentidad = :docIdentidad');
		$filterValues[':docIdentidad'] = [
		'value' => $docIdentidad,
		'type' => \PDO::PARAM_STR,
		];}

		if (!empty($nombres)) {
		array_push($personAttributesFilter, 'nombres = :nombres');
		$filterValues[':nombres'] = [
		'value' => $nombres,
		'type' => \PDO::PARAM_STR,
		];}

		if (!empty($apellidos)) {
		array_push($personAttributesFilter, 'apellidos = :apellidos');
		$filterValues[':apellidos'] = [
		'value' => $apellidos,
		'type' => \PDO::PARAM_STR,
		];}
		if (!empty($fechaNacimiento)) {
		array_push($personAttributesFilter, 'fechaNacimiento = :fechaNacimiento');
		$filterValues[':fechaNacimiento'] = [
		'value' => $fechaNacimiento,
		'type' => \PDO::PARAM_STR,
		];}


		if (!empty($idNacionalidad)) {
		array_push($personAttributesFilter, '$idNacionalidad = :$idNacionalidad');
		$filterValues[':$idNacionalidad'] = [
		'value' => $idNacionalidad,
		'type' => \PDO::PARAM_STR,
		];}


		if (!empty($idGenero)) {
		array_push($personAttributesFilter, 'idGenero = :idGenero');
		$filterValues[':idGenero'] = [
		'value' => $idGenero,
		'type' => \PDO::PARAM_STR,
		];}


		// Si todos estan vacios
		if (mainModel::isDataEmtpy($docIdentidad) == TRUE &&
		 mainModel::isDataEmtpy($nombres) == TRUE &&
		 mainModel::isDataEmtpy($apellidos) == TRUE &&
		 mainModel::isDataEmtpy($fechaNacimiento) == TRUE &&
		 mainModel::isDataEmtpy($idNacionalidad) == TRUE &&
		 mainModel::isDataEmtpy($idGenero == TRUE)){

			echo "Todos Vacioo, No Permitido";

		}else{


			var_dump(personaModel::getPersonaModel($personAttributesFilter,$filterValues));

		}

		}
}

 ?>