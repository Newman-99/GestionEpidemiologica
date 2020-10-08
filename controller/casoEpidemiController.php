<?php 

		// para simular la herencia mediante colaboracion de objetos
		require_once "personController.php";

	if($requestAjax){
		require_once "../model/casoEpidemiModel.php";
	}else{
		require_once "./model/casoEpidemiModel.php";
	}

	class casoEpidemiController extends casoEpidemiModel{
		
		protected static $personController;

		function __construct()
			{

			self::$personController = new personController();
		}


		public function addcasoEpidemiController($datacasoEpidemi){

		$doc_identidad = mainModel::cleanStringSQL($datacasoEpidemi['doc_identidad']);

		$id_nacionalidad = mainModel::cleanStringSQL($datacasoEpidemi['id_nacionalidad']);

		$catalog_key_cie10 = mainModel::cleanStringSQL($datacasoEpidemi['catalogKeyCIE10']);

		$id_parroquia = mainModel::cleanStringSQL($datacasoEpidemi['id_parroquia']);
		 
		$direccion = mainModel::cleanStringSQL($datacasoEpidemi['direccion']);

	 	$telefono = $datacasoEpidemi['telefonoPart1'].$datacasoEpidemi['telefonoPart2'].$datacasoEpidemi['telefonoPart3'];

		 $telefono = mainModel::cleanStringSQL($telefono);

		 $dateRegisterCasoEpidemi = mainModel::cleanStringSQL($datacasoEpidemi['dateRegistercasoEpidemi']);

		$siExistPerson = 0;


		// Comprobar si existe o no la person en la BD

		$queryIsExistPerson = mainModel::connectDB()->query("SELECT id_nacionalidad,doc_identidad FROM personas WHERE id_nacionalidad = '$id_nacionalidad' AND doc_identidad = '$doc_identidad'");

			if(isset($datacasoEpidemi['siExistPerson']) && $datacasoEpidemi['siExistPerson'] == "1" ){

			$siExistPerson = 1;

			if(!$queryIsExistPerson->rowCount()){
			$alert=[
				"Alert"=>"simple",
				"Title"=>"Datos no encontrados",
				"Text"=>"No se encuentra una person con esta cedula registrada ",
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

//  comprobar que no se repita el caso epidemiologico
		
		$queryIsExistCasoEpidemi = mainModel::connectDB()->query("SELECT id_caso_epidemi FROM casos_epidemi WHERE id_nacionalidad = '$id_nacionalidad' AND doc_identidad = '$doc_identidad' AND catalog_key_cie10 = '$catalog_key_cie10' AND fecha_registro = '$dateRegisterCasoEpidemi'");

			if($queryIsExistCasoEpidemi->rowCount()){
			$alert=[
				"Alert"=>"simple",
				"Title"=>"Datos Duplicados",
				"Text"=>"Ya esta registrado un Caso Epidemiologico con estos parametros, (Documento de identidad, Fecha de registro y Caso CIE-10)",
				"Type"=>"error"
			];

				echo json_encode($alert);

				exit();
			}


		   if(strlen($direccion)<5){

			$alert=[
			"Alert"=>"simple",
			"Title"=>"Datos Invalidos",
			"Text"=>"La direccion deben poseer mas de 5 caracteres",
			"Type"=>"error"
				];	
		
				echo json_encode($alert);

				exit();
			}


			if (!mainModel::checkDate($dateRegisterCasoEpidemi)){
			$alert=[
				"Alert"=>"simple",
				"Title"=>"Datos Invalidos",
				"Text"=>"La Fecha de Registro es invalido",
				"Type"=>"error"
			];

				echo json_encode($alert);

				exit();
		}

			if (!self::isValidDateRegistRangeAllowedCaseEpidemi($dateRegisterCasoEpidemi)){
			$alert=[
				"Alert"=>"simple",
				"Title"=>"Datos Invalidos",
				"Text"=>"La fecha de registro no esta en el rango aceptado",
				"Type"=>"error"
			];

				echo json_encode($alert);

				exit();
		}


		if (mainModel::isDataEmtpy(
		 $doc_identidad,
		 $catalog_key_cie10,
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

			//data impia
		$dataCasoEpidemiReady = 
		["id_nacionalidad"=>$id_nacionalidad,
		"doc_identidad"=>$doc_identidad,
		"catalog_key_cie10"=>$catalog_key_cie10,
		"id_parroquia"=>$id_parroquia,
		"direccion"=>$direccion,
		"fecha_registro"=>$dateRegisterCasoEpidemi,
		"telefono"=>$telefono
		];


// si no existe la person la validamos
// 

			if(!$siExistPerson){

				$dataPerson = self::$personController->addPersonControllerr($datacasoEpidemi);
				
				$dataCasoEpidemiReady = array_merge($dataCasoEpidemiReady,$dataPerson);

				$dataCasoEpidemiReady['registerPerson'] = 1;
			}


			// data para registro de bitcora

				$currentDate =  mainModel::getDateCurrentSystem();


				$currentYear = date("Y", $currentDate);

				$currentHour = date("h:i:s a", $currentDate);

				$currentDate = date("Y-m-d", $currentDate);

		session_start(['name'=>'dptoEpidemi']);	

		$dataCasosEpidemiBitacora = 
		["id_nacionalidad_usuario"=>$_SESSION['id_nacionalidad'],
		"doc_identidad_usuario"=>$_SESSION['doc_identidad'],
		"usuario_alias"=>$_SESSION['aliasUser'],
		"bitacora_fecha"=>$currentDate,
		"bitacora_year"=>$currentYear,
		"bitacora_hora"=>$currentHour,
		"id_tipo_operacion"=>'1', // tipo registro
		"catalog_key_cie10"=>$catalog_key_cie10];			

		$dataCasoEpidemiReady = array_merge($dataCasoEpidemiReady,$dataCasosEpidemiBitacora);

			echo casoEpidemiModel::addCasoEpidemiModel($dataCasoEpidemiReady);


				 	
				 }



		public function updatecasoEpidemiController($datacasoEpidemi){


		 $id_caso_epidemi = mainModel::cleanStringSQL($datacasoEpidemi['id_caso_epidemi']);
		 $doc_identidad = mainModel::cleanStringSQL($datacasoEpidemi['doc_identidad']);
		 $catalog_key_cie10 = mainModel::cleanStringSQL($datacasoEpidemi['catalog_key_cie10']);
		 $id_parroquia = mainModel::cleanStringSQL($datacasoEpidemi['id_parroquia']);
		 $direccion = mainModel::cleanStringSQL($datacasoEpidemi['direccion']);
		 $telefono = mainModel::cleanStringSQL($datacasoEpidemi['telefono']);
		 $dateRegisterCasoEpidemi = mainModel::cleanStringSQL($datacasoEpidemi['dateRegisterCasoEpidemi']);


		if (mainModel::isDataEmtpy(
		 $doc_identidad,
		 $catalog_key_cie10,
		 $id_parroquia,
		 $direccion,
		 $telefono,
		 $dateRegisterCasoEpidemi)){

			echo "Algo Vacio";

		}else{


		 $datacasoEpidemi = array();
		 $datacasoEpidemi['doc_identidad'] = $doc_identidad;
		 $datacasoEpidemi['id_caso_epidemi'] = $id_caso_epidemi;
		 $datacasoEpidemi['catalog_key_cie10'] = $catalog_key_cie10;
		 $datacasoEpidemi['id_parroquia'] = $id_parroquia;
		 $datacasoEpidemi['direccion'] = $direccion;
		 $datacasoEpidemi['telefono'] = $telefono;
		 $datacasoEpidemi['fecha'] = $dateRegisterCasoEpidemi;

			echo "<h1>Actualizado</h1>";

			var_dump($datacasoEpidemi);

			 casoEpidemiModel::updatecasoEpidemiModel($datacasoEpidemi);


				 	}
				 }
		public function deletecasoEpidemiController($datacasoEpidemi){
			
		 $id_caso_epidemi = mainModel::cleanStringSQL($datacasoEpidemi['id_caso_epidemi']);
		 
		 
		 			if (mainModel::isDataEmtpy(
						 $id_caso_epidemi)) {
			 		echo "<h1>id_caso_epidemi VACIO</h1>";
				 	}else{


		 $datacasoEpidemi = array();

		 $datacasoEpidemi['id_caso_epidemi'] = $id_caso_epidemi;
		 
			echo "<h1>Eliminado</h1>";

			var_dump($datacasoEpidemi);

			 casoEpidemiModel::deletecasoEpidemiModel($datacasoEpidemi);

				 	}

				 }


	public function getParroquias(){
			
	$queryGetParroquias = "SELECT id_parroquia,parroquia FROM parroquias ORDER BY parroquias";

		// todos los captulos

		$queryGetParroquias = mainModel::connectDB()->query($queryGetParroquias);
		
		$dataJsonParroquias=[];

		while($recordsCasesCie10=$queryGetParroquias->fetch(PDO
			::FETCH_ASSOC)){ 

			$dataJsonParroquias[] = $recordsCasesCie10;
		}
				
		echo json_encode($dataJsonParroquias);
		exit();

		}

	public function isValidDateRegistRangeAllowedCaseEpidemi($fecha_registro){


        $currentDate = date("d-m-Y");

       $maxDateAllowed = date("Y-m-d",strtotime($currentDate."- 1 days"));

       $minDateRange = date("Y-m-d",strtotime($maxDateAllowed."- 7 days"));
       
		if (($fecha_registro < $minDateRange)|| ($fecha_registro > $maxDateAllowed)){
		   return false;
		   	}
			return true;

			}

}
								
 ?>