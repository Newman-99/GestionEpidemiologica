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
		 
		 $telefono = mainModel::cleanStringSQL($dataPersona['telefono']);

		 			if (mainModel::isDataEmtpy(
						 $docIdentidad,
						 $nombres,
						 $apellidos,
						 $fechaNacimiento,
						 $idNacionalidad,
						 $idGenero,
						 $telefono)) {
			 		echo "<h1>ALGO VACIO</h1>";
				 	}else{


		 $dataPersona = array();

		 $dataPersona['docIdentidad'] = $docIdentidad;
		 
		 $dataPersona['nombres'] = $nombres;
		 
		 $dataPersona['apellidos'] = $apellidos;
		 
		 $dataPersona['fechaNacimiento'] = $fechaNacimiento;
		 
		 $dataPersona['idNacionalidad'] = $idNacionalidad;
		 
		 $dataPersona['idGenero'] = $idGenero;
		 
		 $dataPersona['telefono'] = $telefono;



			 personaModel::addPersonaModel($dataPersona);

			echo "<h1>REGISTRADO</h1>";

			var_dump($dataPersona);

				 	}

				 }
				
				}

 ?>