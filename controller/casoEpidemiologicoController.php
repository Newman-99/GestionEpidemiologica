<?php 

	if($requestAjax){
		require_once "../model/casoEpidemiologicoModel.php";
	}else{
		require_once "./model/casoEpidemiologicoModel.php";
	}

	class casoEpidemiologicoController extends casoEpidemiologicoModel{

		// para simular la herencia mediante colbaoracion de objetos
	function __construct()
	{
			require_once "../controller/personaController.php";
	}



		public function addCasoEpidemiologicoController($dataCasoEpidemi){

		 $doc_identidad = mainModel::cleanStringSQL($dataCasoEpidemi['doc_identidad']);
		 $catalogKeyCIE10 = mainModel::cleanStringSQL($dataCasoEpidemi['catalogKeyCIE10']);
		 $id_parroquia = mainModel::cleanStringSQL($dataCasoEpidemi['id_parroquia']);
		 $direccion = mainModel::cleanStringSQL($dataCasoEpidemi['direccion']);
		 $telefono = mainModel::cleanStringSQL($dataCasoEpidemi['telefono']);

		 $dateRegisterCasoEpidemi = mainModel::cleanStringSQL($dataCasoEpidemi['dateRegisterCasoEpidemi']);

		if (mainModel::isDataEmtpy(
		 $doc_identidad,
		 $catalogKeyCIE10,
		 $id_parroquia,
		 $direccion,
		 $telefono,
		 $dateRegisterCasoEpidemi)){

				$alert=[
					"Alert"=>"simple",
					"Title"=>"Campos Vacios",
					"Text"=>"Todos los campos del caso epidemiologico son obligatorios",
					"Type"=>"error"
				];

				echo json_encode($alert);

				exit();

		}

		// Registrar como persona

		// Comprobar si existe o no la persona en la BD

		$primaryKeyPersona = [

			"id_nacionalidad"=>$id_nacionalidad,
			"doc_identidad"=>$doc_identidad
		];

			$personaController = new personaController();

			$SQL_isExistPersona = $personaController->getPersonaController($primaryKeyPersona);
			$SQL_isExistPersona->execute();


			if(isset($dataUser['siExistPerson']) && $dataUser['siExistPerson'] == "1" ){

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

			}else{
				// Si no existe y es una persona nueva comprabar que no este repetido en la BD
			if($SQL_isExistPersona->rowCount()){
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


		 $dataCasoEpidemi = array();

		 $dataCasoEpidemi['doc_identidad'] = $doc_identidad;
		 $dataCasoEpidemi['catalogKeyCIE10'] = $catalogKeyCIE10;
		 $dataCasoEpidemi['id_parroquia'] = $id_parroquia;
		 $dataCasoEpidemi['direccion'] = $direccion;
		 $dataCasoEpidemi['telefono'] = $telefono;
		 $dataCasoEpidemi['fecha'] = $dateRegisterCasoEpidemi;

			echo "<h1>REGISTRADO</h1>";

			//var_dump($dataCasoEpidemi);

			 //casoEpidemiologicoModel::addCasoEpidemiologicoModel($dataCasoEpidemi);


				 	
				 }



		public function updateCasoEpidemiologicoController($dataCasoEpidemi){


		 $id_caso_epidemiologico = mainModel::cleanStringSQL($dataCasoEpidemi['id_caso_epidemiologico']);
		 $doc_identidad = mainModel::cleanStringSQL($dataCasoEpidemi['doc_identidad']);
		 $catalogKeyCIE10 = mainModel::cleanStringSQL($dataCasoEpidemi['catalogKeyCIE10']);
		 $id_parroquia = mainModel::cleanStringSQL($dataCasoEpidemi['id_parroquia']);
		 $direccion = mainModel::cleanStringSQL($dataCasoEpidemi['direccion']);
		 $telefono = mainModel::cleanStringSQL($dataCasoEpidemi['telefono']);
		 $dateRegisterCasoEpidemi = mainModel::cleanStringSQL($dataCasoEpidemi['dateRegisterCasoEpidemi']);


		if (mainModel::isDataEmtpy(
		 $doc_identidad,
		 $catalogKeyCIE10,
		 $id_parroquia,
		 $direccion,
		 $telefono,
		 $dateRegisterCasoEpidemi)){

			echo "Algo Vacio";

		}else{


		 $dataCasoEpidemi = array();
		 $dataCasoEpidemi['doc_identidad'] = $doc_identidad;
		 $dataCasoEpidemi['id_caso_epidemiologico'] = $id_caso_epidemiologico;
		 $dataCasoEpidemi['catalogKeyCIE10'] = $catalogKeyCIE10;
		 $dataCasoEpidemi['id_parroquia'] = $id_parroquia;
		 $dataCasoEpidemi['direccion'] = $direccion;
		 $dataCasoEpidemi['telefono'] = $telefono;
		 $dataCasoEpidemi['fecha'] = $dateRegisterCasoEpidemi;

			echo "<h1>Actualizado</h1>";

			var_dump($dataCasoEpidemi);

			 casoEpidemiologicoModel::updateCasoEpidemiologicoModel($dataCasoEpidemi);


				 	}
				 }
		public function deleteCasoEpidemiologicoController($dataCasoEpidemi){
			
		 $id_caso_epidemiologico = mainModel::cleanStringSQL($dataCasoEpidemi['id_caso_epidemiologico']);
		 
		 
		 			if (mainModel::isDataEmtpy(
						 $id_caso_epidemiologico)) {
			 		echo "<h1>id_caso_epidemiologico VACIO</h1>";
				 	}else{


		 $dataCasoEpidemi = array();

		 $dataCasoEpidemi['id_caso_epidemiologico'] = $id_caso_epidemiologico;
		 
			echo "<h1>Eliminado</h1>";

			var_dump($dataCasoEpidemi);

			 casoEpidemiologicoModel::deleteCasoEpidemiologicoModel($dataCasoEpidemi);

				 	}

				 }


				}
								
 ?>