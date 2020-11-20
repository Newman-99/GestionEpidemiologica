<?php 

		// para simular la herencia mediante colaboracion de objetos
		require_once "personController.php";

	if($requestAjax){
		require_once "../model/casosEpidemiModel.php";
	}else{
		require_once "./model/casosEpidemiModel.php";
	}

	class casosEpidemiController extends casosEpidemiModel{
		
		protected static $personController;

		function __construct()
			{

			self::$personController = new personController();
		}


		public function addcasosEpidemiController($dataCasosEpidemi){

		$doc_identidad = mainModel::cleanStringSQL($dataCasosEpidemi['doc_identidad']);

		 $doc_identidad = self::ClearUserSeparatedCharacters($doc_identidad);		 

		 $doc_identidad = ltrim($doc_identidad, '0');

		$id_nacionalidad = mainModel::cleanStringSQL($dataCasosEpidemi['id_nacionalidad']);

		$catalog_key_cie10 = mainModel::cleanStringSQL($dataCasosEpidemi['catalogKeyCIE10']);

		$id_parroquia = mainModel::cleanStringSQL($dataCasosEpidemi['id_parroquia']);
		 
		$direccion = mainModel::cleanStringSQL($dataCasosEpidemi['direccion']);

	 	$telefono = $dataCasosEpidemi['telefonoPart1'].$dataCasosEpidemi['telefonoPart2'].$dataCasosEpidemi['telefonoPart3'];

		 $telefono = mainModel::cleanStringSQL($telefono);

		 $fecha_registro = mainModel::cleanStringSQL($dataCasosEpidemi['fecha_registro']);

		$siExistPerson = 0;


		if (mainModel::isDataEmtpy(
		 $id_nacionalidad,
		 $doc_identidad,
		 $catalog_key_cie10,
		 $id_parroquia,
		 $direccion,
		 $telefono,
		 $fecha_registro)){

				$alert=[
					"Alert"=>"simple",
					"Title"=>"Campos Vacios",
					"Text"=>"Todos los campos del caso epidemiologico son obligatorios",
					"Type"=>"error"
				];

				echo json_encode($alert);

				exit();

		}
		// Comprobar si existe o no la person en la BD

		$queryIsExistPerson = mainModel::connectDB()->query("SELECT id_nacionalidad,doc_identidad FROM personas WHERE id_nacionalidad = '$id_nacionalidad' AND doc_identidad = '$doc_identidad'");

			if(isset($dataCasosEpidemi['siExistPerson']) && $dataCasosEpidemi['siExistPerson'] == "1" ){

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
		
		$queryIsExistcasosEpidemi = mainModel::connectDB()->query("SELECT id_caso_epidemi FROM casos_epidemi WHERE id_nacionalidad = '$id_nacionalidad' AND doc_identidad = '$doc_identidad' AND catalog_key_cie10 = '$catalog_key_cie10' AND fecha_registro = '$fecha_registro'");

			if($queryIsExistcasosEpidemi->rowCount()){
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


			if (!mainModel::checkDate($fecha_registro)){
			$alert=[
				"Alert"=>"simple",
				"Title"=>"Datos Invalidos",
				"Text"=>"La Fecha de Registro es invalido",
				"Type"=>"error"
			];

				echo json_encode($alert);

				exit();
		}

			if (!self::isValidDateRegistRangeAllowedCaseEpidemi($fecha_registro)){
			$alert=[
				"Alert"=>"simple",
				"Title"=>"Datos Invalidos",
				"Text"=>"La fecha de registro no esta en el rango aceptado",
				"Type"=>"error"
			];

				echo json_encode($alert);

				exit();
		}

		

		$bitacora_year = date("Y", strtotime($fecha_registro));

		
				if (!$siExistPerson) {
				$dataPerson = self::$personController->addPersonControllerr($dataCasosEpidemi);
				}


					//data completa
		$dataCasosEpidemi = 
		["id_nacionalidad"=>$id_nacionalidad,
		"doc_identidad"=>$doc_identidad,
		"catalog_key_cie10"=>$catalog_key_cie10,
		"id_parroquia"=>$id_parroquia,
		"direccion"=>$direccion,
		"fecha_registro"=>$fecha_registro,
		"bitacora_year"=>$bitacora_year,
		"telefono"=>$telefono,
		"siExistPerson"=>$siExistPerson
		];

				if (isset($dataPerson)) {

				$dataCasosEpidemi = array_merge($dataCasosEpidemi,$dataPerson);
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
		"fecha_registro"=>$fecha_registro,
		"catalog_key_cie10"=>$catalog_key_cie10];			

		$dataCasosEpidemi = array_merge($dataCasosEpidemi,$dataCasosEpidemiBitacora);


			echo casosEpidemiModel::addcasosEpidemiModel($dataCasosEpidemi);


				 	
				 }



		public function updateCasosEpidemiController($dataCasosEpidemi){


		 $id_caso_epidemi = mainModel::cleanStringSQL($dataCasosEpidemi['id_caso_epidemi']);

		 $doc_identidad = mainModel::cleanStringSQL($dataCasosEpidemi['doc_identidad_update']);

		 $id_nacionalidad = mainModel::cleanStringSQL($dataCasosEpidemi['id_nacionalidad_update']);

		 $catalog_key_cie10 = mainModel::cleanStringSQL($dataCasosEpidemi['catalogKeyCIE10']);

		 $id_parroquia = mainModel::cleanStringSQL($dataCasosEpidemi['id_parroquia']);
		 $direccion = mainModel::cleanStringSQL($dataCasosEpidemi['direccion']);

	 	$telefono = $dataCasosEpidemi['telefonoPart1'].$dataCasosEpidemi['telefonoPart2'].$dataCasosEpidemi['telefonoPart3'];

		 $telefono = mainModel::cleanStringSQL($telefono);

		 $fecha_registro = mainModel::cleanStringSQL($dataCasosEpidemi['fecha_registro']);


		if (mainModel::isDataEmtpy(
		 $id_nacionalidad,
		 $doc_identidad,
		 $catalog_key_cie10,
		 $id_parroquia,
		 $direccion,
		 $telefono,
		 $fecha_registro,
		 $id_caso_epidemi
		)){

				$alert=[
					"Alert"=>"simple",
					"Title"=>"Campos Vacios",
					"Text"=>"Todos los campos del caso epidemiologico son obligatorios",
					"Type"=>"error"
				];

				echo json_encode($alert);

				exit();

		}



//  comprobar que no se repita el caso epidemiologico
		

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


			if (!mainModel::checkDate($fecha_registro)){
			$alert=[
				"Alert"=>"simple",
				"Title"=>"Datos Invalidos",
				"Text"=>"La Fecha de Registro es invalido",
				"Type"=>"error"
			];

				echo json_encode($alert);

				exit();
		}

			if (!self::isValidDateRegistRangeAllowedCaseEpidemi($fecha_registro)){
			$alert=[
				"Alert"=>"simple",
				"Title"=>"Datos Invalidos",
				"Text"=>"La fecha de registro no esta en el rango aceptado",
				"Type"=>"error"
			];

				echo json_encode($alert);

				exit();
		}

	
		// renombraremos los sufijos _update para evitar confllictos
		$dataCasosEpidemi['doc_identidad'] =  $dataCasosEpidemi['doc_identidad_update'];

		$dataCasosEpidemi['id_nacionalidad'] =  $dataCasosEpidemi['id_nacionalidad_update'];

		$dataPerson = self::$personController->updatePersonaController($dataCasosEpidemi);

			//data completa
		$bitacora_year = date("Y", strtotime($fecha_registro));

		$dataCasosEpidemi = 
		[
		'id_caso_epidemi'=>$id_caso_epidemi,
		"id_nacionalidad"=>$id_nacionalidad,
		"doc_identidad"=>$doc_identidad,
		"catalog_key_cie10"=>$catalog_key_cie10,
		"id_parroquia"=>$id_parroquia,
		"direccion"=>$direccion,
		"fecha_registro"=>$fecha_registro,
		"bitacora_year"=>$bitacora_year,
		"telefono"=>$telefono,
		];
			

		// compararemos los datos del formulario con la base de datos
		
 		  $columnsTableToCompare = [
		'id_caso_epidemi',
		"id_nacionalidad",
		"doc_identidad",
		"catalog_key_cie10",
		"id_parroquia",
		"direccion",
		"fecha_registro",
		"bitacora_year",
		"telefono"];

		 $tableToCompare = 'casos_epidemi';

 		 $fieldsForFilter = array('id_caso_epidemi' => $id_caso_epidemi);

		$queryToGetDataCasoEpidemi = self::getCasosEpidemiController($tableToCompare,$columnsTableToCompare,$fieldsForFilter);

		$ifCasosEpidemiDataUpdateIsSameDatabase = mainModel::isFieldsEqualToThoseInTheDatabase($queryToGetDataCasoEpidemi,$dataCasosEpidemi);

			if ($ifCasosEpidemiDataUpdateIsSameDatabase && $dataPerson['ifUpdatePerson']) {

			$alert=[
				"Alert"=>"simple",
				"Title"=>"Datos Duplicados",
				"Text"=>"No se ha encontrado ningun cambio a actualizar",
				"Type"=>"error"
			];

				echo json_encode($alert);

				exit();

			}
				
				$dataCasosEpidemi = array_merge($dataCasosEpidemi,$dataPerson);

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
		"id_tipo_operacion"=>'2', // tipo actualizacion
		"fecha_registro"=>$fecha_registro,
		"catalog_key_cie10"=>$catalog_key_cie10];			

		$dataCasosEpidemi = array_merge($dataCasosEpidemi,$dataCasosEpidemiBitacora);

		echo casosEpidemiModel::updateCasosEpidemiModel($dataCasosEpidemi);

			}

		public static function getCasosEpidemiController($table,$columnsTable,$fieldsForFilter){

		$casosEpidemiAttributesFilter = [];

 		$casosEpidemiFilterValues = [];

		if (isset($fieldsForFilter["id_caso_epidemi"]) && !mainModel::isDataEmtpy($fieldsForFilter["id_caso_epidemi"])) {

		 $id_caso_epidemi = mainModel::cleanStringSQL($fieldsForFilter['id_caso_epidemi']);

		 array_push($casosEpidemiAttributesFilter, 'id_caso_epidemi = :id_caso_epidemi');
		$casosEpidemiFilterValues[':id_caso_epidemi'] = [
		'value' => $id_caso_epidemi,
		'type' => \PDO::PARAM_STR,
		];

		}

			return casosEpidemiModel::getCasosEpidemiModel($table,$columnsTable,$casosEpidemiAttributesFilter,$casosEpidemiFilterValues);
		}

		public function deleteCasosEpidemiController($dataCasosEpidemi){
			
		 $id_caso_epidemi = mainModel::cleanStringSQL($dataCasosEpidemi['id_caso_epidemi']);
		 
		$doc_identidad = mainModel::cleanStringSQL($dataCasosEpidemi['doc_identidad']);

		$id_nacionalidad = mainModel::cleanStringSQL($dataCasosEpidemi['id_nacionalidad']);

		$catalog_key_cie10 = mainModel::cleanStringSQL($dataCasosEpidemi['catalog_key_cie10']);

		$fecha_registro = mainModel::cleanStringSQL($dataCasosEpidemi['fecha_registro']);

		 			if (mainModel::isDataEmtpy(
						 $id_caso_epidemi,$doc_identidad,$id_nacionalidad,$catalog_key_cie10,$fecha_registro)) {
			$alert=[
				"Alert"=>"simple",
				"Title"=>"Datos Vacios",
				"Text"=>"Datos no recibidos",
				"Type"=>"error"
			];

				echo json_encode($alert);

				exit();	 	
			
			}


if (!isset($dataCasosEpidemi['confirmDelete'])) {

		// Si la person  solo tiene un caso epidemiy no posee un usuario en el sistema elimnamos


		$queryIfExistUserPerPerson = mainModel::connectDB()->query("SELECT alias FROM usuarios WHERE id_nacionalidad = '$id_nacionalidad' AND doc_identidad =
			'$doc_identidad'");


		$queryIsExistPersonPerCasoEpidemi = mainModel::connectDB()->query("SELECT doc_identidad FROM casos_epidemi WHERE id_nacionalidad = '$id_nacionalidad' AND doc_identidad =
			'$doc_identidad'");


		if ($queryIfExistUserPerPerson->rowCount()==0 && $queryIsExistPersonPerCasoEpidemi->rowCount() == 1) {

					$alert=[

						"Alert"=>"confirmation",
						"Text"=>"Esta persona no presenta otro  caso epidemiologico ni posee algun usuario  por lo que se eliminara del sistema completamente",
						"Url"=>"".SERVERURL."ajax/casosEpidemiAjax.php",
						"Data"=>"doc_identidad=$doc_identidad&id_caso_epidemi=$id_caso_epidemi&id_nacionalidad=$id_nacionalidad&fecha_registro=$fecha_registro&operationType=delete&confirmDelete=true",
						"Method"=>"POST"];
					
					echo json_encode($alert);

					exit();
		}
	}

		$dataCasosEpidemi = ['id_caso_epidemi'=>$id_caso_epidemi,
		'doc_identidad' => $doc_identidad,

		'id_nacionalidad' => $id_nacionalidad,
		'fecha_registro' => $fecha_registro];

		if (isset($dataCasosEpidemi['confirmDelete'])) {
		
		$primaryKeyperson = [
			"id_nacionalidad"=>$id_nacionalidad,
			"doc_identidad"=>$doc_identidad];
		
		// si hay algun error se detiene el code e imprime msj
		self::$personController->deletePersonController($primaryKeyperson);
		
		$dataCasosEpidemi['deletePerson'] = TRUE;
		}

			// data para registro de bitcora

				$currentDate =  mainModel::getDateCurrentSystem();


				$currentYear = date("Y", $currentDate);

				$currentHour = date("h:i:s a", $currentDate);

				$currentDate = date("Y-m-d", $currentDate);

		session_start(['name'=>'dptoEpidemi']);	

		$bitacora_year = date("Y", strtotime($fecha_registro));
		$dataCasosEpidemiBitacora = 
		["id_nacionalidad_usuario"=>$_SESSION['id_nacionalidad'],
		"doc_identidad_usuario"=>$_SESSION['doc_identidad'],
		"usuario_alias"=>$_SESSION['aliasUser'],
		"bitacora_fecha"=>$currentDate,
		"bitacora_year"=>$currentYear,
		"bitacora_hora"=>$currentHour,
		"id_tipo_operacion"=>'3', // tipo eliminacion
		"fecha_registro"=>$fecha_registro,			
		"catalog_key_cie10"=>$catalog_key_cie10];			

		$dataCasosEpidemi = array_merge($dataCasosEpidemiBitacora,$dataCasosEpidemi);
		
		echo casosEpidemiModel::deleteCasosEpidemiModel($dataCasosEpidemi);

				 

				 }

  public static function getDataTablesCasosEpidemiController() {
  $columnsTable = array(
     'row_number',
    'id_caso_epidemi',
      'id_genero',
      'descripcion_genero_caso',
           'id_nacionalidad_caso',
      'doc_identidad_caso',
      'doc_identidad_caso_complete',
          'fecha_nacimiento',
          'edad',          
    'clave_capitulo_cie10',
    'catalog_key_cie10',
    'nombre_cie10',
    'nombres',
    'apellidos',
    'id_parroquia',
    'parroquia',
    'direccion',
    'telefono',
    'fecha_registro',
    'usuario_alias',
    'id_nacionalidad_usuario',
    'doc_identidad_usuario',
     'doc_identidad_usuario_complete',
     'bitacora_year',
     'bitacora_fecha',
     'bitacora_hora' );

    $columnsPrintDataTable = 
array(
     'row_number',
      'id_caso_epidemi',
      	'id_genero',
      	'descripcion_genero_caso',
      'id_nacionalidad_caso',
      'doc_identidad_caso',
      'doc_identidad_caso_complete',
    'fecha_nacimiento',
      'edad',          
    'nombres',
    'apellidos',
     'clave_capitulo_cie10',
    'catalog_key_cie10',
    'nombre_cie10',
    'fecha_registro',
    'id_parroquia',
    'parroquia',
    'direccion',
    'telefono',
    'usuario_alias',
    'id_nacionalidad_usuario',
    'doc_identidad_usuario',
    'doc_identidad_usuario_complete',
     'bitacora_year',
     'bitacora_fecha',
     'bitacora_hora' );


  try {

    mainModel::connectDB()->query(parent::$queryCreateViewCasosEpidemi);

    $dataToCreateDataTable = mainModel::getDataTableServerSideModel('caso_epidemi_view', 'row_number',
      $columnsTable,$columnsPrintDataTable,TRUE);

 $sTable = $dataToCreateDataTable['sTable'];
 $sWhere = $dataToCreateDataTable['sWhere'];
 $sOrder = $dataToCreateDataTable['sOrder'];
 $sLimit = $dataToCreateDataTable['sLimit'];

    $sQueryForPersonalizedPrint = "
        SELECT ".str_replace(" , ", " ", implode(", ", $columnsTable))."
        FROM   $sTable
        $sWhere
        $sOrder
        $sLimit
    ";


    $rResult = mainModel::connectDB()->query($sQueryForPersonalizedPrint);

      }catch (Exception $e) {
       echo  $e->getMessage();
      }

   //$columnsPrintDataTable[] = 'btnDelete';

    while($aRow=$rResult->fetch(PDO
      ::FETCH_ASSOC)){ 

        $row = array();
        for ( $i=0 ; $i<count($columnsPrintDataTable) ; $i++ )
        {

            if ( $columnsPrintDataTable[$i] == "version" )
            {
                /* Special dataToCreateDataTable formatting for 'version' column */
                $row[] = ($aRow[ $columnsPrintDataTable[$i] ]=="0") ? '-' : $aRow[ $columnsPrintDataTable[$i] ];
            }
            else if ( $columnsPrintDataTable[$i] != ' ' ){
                /* General dataToCreateDataTable */

                   $dataFields = array();

                $dataFields['row_number']=$aRow['row_number'];
                
                $dataFields['id_caso_epidemi']=$aRow['id_caso_epidemi'];

        if ($aRow['id_genero'] == '1'){
                  $iconGenero = "male-user.png"; 
                }elseif ($aRow['id_genero'] == "2") {
                  $iconGenero = "fermale-user.png"; 
                }

                $dataFields['id_genero']=$aRow['id_genero'];

                $dataFields['descripcion_genero_caso']=$aRow['descripcion_genero_caso'];
/*
                 $aRow['descripcion_genero_caso']= "
                    <img class='img-profile rounded-circle' width='40' src=".SERVERURL."view/img/".$iconGenero.">";
*/
                 $dataFields['descripcion_genero_caso']=$aRow['descripcion_genero_caso'];

                $dataFields['doc_identidad_caso']= $aRow['doc_identidad_caso'];

                $dataFields['id_nacionalidad_caso']= $aRow['id_nacionalidad_caso'];

                $dataFields['doc_identidad_caso_complete']= $aRow['doc_identidad_caso_complete'];

                $dataFields['fecha_nacimiento']=$aRow['fecha_nacimiento'];
                
                if ($aRow['edad'] == 0) {
                	$aRow['edad']= '< 1';
                }

                $dataFields['edad']=$aRow['edad'];

                $dataFields['nombres']=$aRow['nombres'];

                $dataFields['apellidos']=$aRow['apellidos'];

                $dataFields['catalog_key_cie10']=$aRow['catalog_key_cie10'];

                $dataFields['clave_capitulo_cie10']=$aRow['clave_capitulo_cie10'];

                $dataFields['nombre_cie10']=$aRow['nombre_cie10'];

                $dataFields['fecha_registro']=$aRow['fecha_registro'];

                $dataFields['id_parroquia']=$aRow['id_parroquia'];

                $dataFields['parroquia']=$aRow['parroquia'];

                $dataFields['direccion']=$aRow['direccion'];

                $dataFields['telefono']=$aRow['telefono'];

                $dataFields['usuario_alias']=$aRow['usuario_alias'];

                $dataFields['id_nacionalidad_usuario']= $aRow['id_nacionalidad_usuario'];

                $dataFields['doc_identidad_usuario']= $aRow['doc_identidad_usuario'];

                $dataFields['doc_identidad_usuario_complete']= $aRow['doc_identidad_usuario_complete'];

                $dataFields['bitacora_year']=$aRow['bitacora_year'];

                $dataFields['bitacora_fecha']=$aRow['bitacora_fecha'];

                $dataFields['bitacora_hora']=$aRow['bitacora_hora'];

		        $row[] = $dataFields[$columnsPrintDataTable[$i]];
            }

        }

        $dataToCreateDataTable['aaData'][] = $row;
    }


    mainModel::connectDB()->query('drop view caso_epidemi_view');
/*
header("Content-type: application/json; charset=utf-8");
echo json_encode($dataToCreateDataTable,JSON_UNESCAPED_UNICODE);
*/
//	
echo json_encode($dataToCreateDataTable);

//	echo json_encode($dataToCreateDataTable, JSON_HEX_QUOT | JSON_HEX_TAG);

		}

		public static function validDatatoGetDataTablesEPIController($dataEpi){

		 $startDateRange = mainModel::cleanStringSQL($dataEpi['startDateRange']);


		 $endDateRange = mainModel::cleanStringSQL($dataEpi['endDateRange']);


			if (!mainModel::checkDate($startDateRange,$endDateRange) || $startDateRange > $endDateRange){
			$alert=[
				"Alert"=>"simple",
				"Title"=>"Datos Invalidos",
				"Text"=>"El Rango de Fechas es invalido",
				"Type"=>"error"
			];

				echo json_encode($alert);

				exit();
		}

			if (parent::getNroCasesEpidemiForEpiModel('', $startDateRange, $endDateRange,'','','') == 0){
			$alert=[
				"Alert"=>"simple",
				"Title"=>"Datos Vacios",
				"Text"=>"No se encuentra ningun dato en el rango de fechas",
				"Type"=>"error"
			];

				echo json_encode($alert);

				exit();
		}

				echo json_encode('');

				exit();

		}
		
		public static function getDataTablesEPIController($dataEpi){

		 $startDateRange = mainModel::cleanStringSQL($dataEpi['startDateRange']);


		 $endDateRange = mainModel::cleanStringSQL($dataEpi['endDateRange']);

      $rangeAgesStart=['', 1, 5, 7, 10, 12, 15, 20, 25, 45, 60, 65,''];

      $rangeAgesEnd = [1, 4, 6, 9, 11, 14, 19, 24, 44, 59, 64,'', ''];		

$dataForDataTables = array();

		$queryGetAgrupacionEPI = mainModel::connectDB()->query(parent::$queryGetAgrupacionEPI);
		
		while($agrupacion_epi=$queryGetAgrupacionEPI->fetch(PDO
			::FETCH_ASSOC)){             

			$dataRow=array();

			$dataRow[] = $agrupacion_epi["orden"];

			$dataRow[] = $agrupacion_epi["enfermedad_evento"];


				/// for obtener los datos por todos los rango de edades
			for ($idAgeRange=0; $idAgeRange < count($rangeAgesStart); $idAgeRange++) { 

			// obtnemos los datos para hembras y machos
			for ($id_genero=1; $id_genero <= 2 ; $id_genero++) { 

			    $dataRow[] = array(parent::getNroCasesEpidemiForEpiModel($agrupacion_epi["orden"], $startDateRange, $endDateRange,$id_genero,$rangeAgesStart[$idAgeRange],$rangeAgesEnd[$idAgeRange]));

			}


		}

		// rango total de edades y genero

         $dataRow[] = parent::getNroCasesEpidemiForEpiModel($agrupacion_epi["orden"], $startDateRange, $endDateRange,'','','');	
	
		$dataForDataTables[] = $dataRow;


	}	
		$iFilteredTotal = count($dataForDataTables);

		$iTotal = $iFilteredTotal;


		echo json_encode(array(
        "sEcho" => intval($_GET['sEcho']),
        "iTotalRecords" => $iTotal,
        "iTotalDisplayRecords" => $iFilteredTotal,
        "aaData" => $dataForDataTables
		));
	
		exit();
		}
	

public function importCasosEpidemiController($files){
			
			ini_set('memory_limit','512M');

if ($files['fileCSVCIE10']['type'] !='text/csv' || mainModel::isDataEmtpy($files['fileCSVCIE10']['size'])){
				$alert=[
					"Alert"=>"simple",
					"Title"=>"Datos Invalidos",
					"Text"=>"El archivo es invalido o esta vacio <br> debe poseer la extension .CSV",
					"Type"=>"error"
				];	

				echo json_encode($alert);

				exit();
	}

// Se llamara la libreria para procesar e insetrar los valores del .csv

require_once "../view/inc/spout.php";

$filePath = $files['fileCSVCIE10']['tmp_name'];

$reader = $ReaderEntityFactory::createCSVReader();

$reader->open($filePath);

// se recolectan los valores del CSV
 
    $count = 0;

    $dataForQuery = array();

    foreach ($reader->getSheetIterator() as $sheet) {   
        foreach ($sheet->getRowIterator() as $row) {

			foreach($row->getCells() as $key => $cell){
			
			$ceilUTF8=utf8_encode($cell);
				
			$dataForQuery[$count][$key]=$ceilUTF8;

			        }
			  $count++;
			}   
    }


for ($indiceFila = 1; $indiceFila < count($dataForQuery); $indiceFila++) {


    $id_caso_epidemi = $dataForQuery[$indiceFila][1];

    $id_genero = $dataForQuery[$indiceFila][2];

    $id_nacionalidad = $dataForQuery[$indiceFila][4];

    $doc_identidad = $dataForQuery[$indiceFila][5];

    $fecha_nacimiento = $dataForQuery[$indiceFila][7];

    $nombres = $dataForQuery[$indiceFila][9];

    $apellidos = $dataForQuery[$indiceFila][10];

    $clave_capitulo_cie10 = $dataForQuery[$indiceFila][11];

    $catalog_key_cie10 = $dataForQuery[$indiceFila][12];

    $fecha_registro = $dataForQuery[$indiceFila][14];

    $id_parroquia = $dataForQuery[$indiceFila][15];

    $direccion = $dataForQuery[$indiceFila][17];
    
    $telefono = $dataForQuery[$indiceFila][18];

    $usuario = $dataForQuery[$indiceFila][18];

    $id_nacionalidad_usuario = $dataForQuery[$indiceFila][20];

    $doc_identidad_usuario = $dataForQuery[$indiceFila][21];

    $bitacora_year = $dataForQuery[$indiceFila][23];

    $bitacora_fecha = $dataForQuery[$indiceFila][24];

    $bitacora_fecha = $dataForQuery[$indiceFila][25];


    $id_caso_epidemi 

    $id_genero 

    $id_nacionalidad 

    $doc_identidad 

    $fecha_nacimiento 

    $nombres 

    $apellidos 

    $clave_capitulo_cie10 

    $catalog_key_cie10 

    $fecha_registro 

    $id_parroquia 

    $direccion 
    
    $telefono 

    $usuario 

    $id_nacionalidad_usuario 

    $doc_identidad_usuario 

    $bitacora_year 

    $bitacora_fecha 

    $bitacora_fecha 
	

		$dataPerson = 
		'doc_identidad'=>$doc_identidad,
		"nombres"=>$nombres,
		"apellidos"=>$apellidos,
		"fecha_nacimiento"=>$fecha_nacimiento,
		"id_nacionalidad"=>$id_nacionalidad,
		"direccion"=>$direccion,
		"id_genero"=>$id_genero,
		'id_caso_epidemi'=>$id_caso_epidemi,
		"catalog_key_cie10"=>$catalog_key_cie10,
		"id_parroquia"=>$id_parroquia,
		"direccion"=>$direccion,
		"fecha_registro"=>$fecha_registro,
		"telefono"=>$telefono,
		"id_nacionalidad_usuario"=>$_SESSION['id_nacionalidad'],
		"doc_identidad_usuario"=>$_SESSION['doc_identidad'],
		"usuario_alias"=>$_SESSION['aliasUser'],
		"bitacora_fecha"=>$currentDate,
		"bitacora_year"=>$currentYear,
		"bitacora_hora"=>$currentHour,
		"id_tipo_operacion"=>'2', // tipo actualizacion
		"fecha_registro"=>$fecha_registro,
		"catalog_key_cie10"=>$catalog_key_cie10;			


	}


}


	public function getFirstDateRecordscasosEpidemiController(){

		$queryFirstDateRecords = mainModel::connectDB()->query('SELECT fecha_registro FROM casos_epidemi ORDER BY fecha_registro ASC  LIMIT 1');

		return $firstDateRecords = $queryFirstDateRecords->fetchColumn();

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

function getInicialGeneroController($id_genero){
	if ($id_genero == 1) {
		return 'M';
	}else{

	if ($id_genero == 2) {
		return 'H';
	}
}

}

}
								
 ?>