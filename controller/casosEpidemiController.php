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


		 $id_atrib_especial = mainModel::cleanStringSQL($dataCasosEpidemi['id_atrib_especial']);

		$siExistPerson = 0;

	if(isset($dataCasosEpidemi['siExistPerson'])){
		$siExistPerson = 1;
		}

		$is_hospital = 0;
	if(isset($dataCasosEpidemi['is_hospital'])){
		$is_hospital = 1;
		}


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

				$dataCasosEpidemiClean = 
		["id_nacionalidad"=>$id_nacionalidad,
		"doc_identidad"=>$doc_identidad,
		"catalog_key_cie10"=>$catalog_key_cie10,
		"id_parroquia"=>$id_parroquia,
		"direccion"=>$direccion,
		"telefono"=>$telefono,
		"fecha_registro"=>$fecha_registro,
		"siExistPerson"=>$siExistPerson,
		"is_hospital"=>$is_hospital,
		"id_atrib_especial"=>$id_atrib_especial,
		"indicatorEpidemiCaseError"=>'',
		"indicatorPersonError"=>''
		];

		if (isset($dataCasosEpidemi['fecha_nacimiento'])) {

		$dataCasosEpidemiClean["fecha_nacimiento"]= mainModel::cleanStringSQL($dataCasosEpidemi['fecha_nacimiento']);
				}

	self::$personController->msgValidExistPersonForRegister($dataCasosEpidemiClean);

	self::msgsValidDataBasicCaseEpidemi($dataCasosEpidemiClean);

	self::msgValidNotRepeatCasoEpidemi($dataCasosEpidemiClean);

				if (!$siExistPerson) {
				$dataPerson = self::$personController->addPersonControllerr($dataCasosEpidemi);

				$dataCasosEpidemi = array_merge($dataCasosEpidemi,$dataCasosEpidemiClean);

				}

		$year_registro = date("Y", strtotime($fecha_registro));


		$dataCasosEpidemi["year_registro"] = $year_registro;
	

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

		 $doc_identidad = self::ClearUserSeparatedCharacters($doc_identidad);		

		 $doc_identidad = ltrim($doc_identidad, '0');

		$id_genero = mainModel::cleanStringSQL($dataCasosEpidemi['id_genero']);

		 $id_nacionalidad = mainModel::cleanStringSQL($dataCasosEpidemi['id_nacionalidad_update']);

		 $catalog_key_cie10 = mainModel::cleanStringSQL($dataCasosEpidemi['catalogKeyCIE10']);

		 $id_parroquia = mainModel::cleanStringSQL($dataCasosEpidemi['id_parroquia']);
		 $direccion = mainModel::cleanStringSQL($dataCasosEpidemi['direccion']);

	 	$telefono = $dataCasosEpidemi['telefonoPart1'].$dataCasosEpidemi['telefonoPart2'].$dataCasosEpidemi['telefonoPart3'];

		 $telefono = mainModel::cleanStringSQL($telefono);

		 $fecha_registro = mainModel::cleanStringSQL($dataCasosEpidemi['fecha_registro']);

		 // renombramos la el nombre de la posicion para eviatr conflictos con updatePersonaController
		 // 

		 $indicatorEpidemiCaseError = " <br> En id Caso Epidemiologico (".$id_caso_epidemi.")";

		 $dataCasosEpidemi['indicatorPersonError'] = $indicatorEpidemiCaseError;

		 $dataCasosEpidemi['id_nacionalidad'] = $id_nacionalidad;

		 $dataCasosEpidemi['doc_identidad'] = $doc_identidad;

		 $fecha_registro = mainModel::cleanStringSQL($dataCasosEpidemi['fecha_registro']);

		$is_hospital = false;
	if(isset($dataCasosEpidemi['is_hospital'])){
		$is_hospital = true;

		}

		 $id_atrib_especial = mainModel::cleanStringSQL($dataCasosEpidemi['id_atrib_especial']);

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


		$dataCasosEpidemiClean = 
		[
		'indicatorEpidemiCaseError'=>'',
		'id_caso_epidemi'=>$id_caso_epidemi,
		"id_nacionalidad"=>$id_nacionalidad,
		"doc_identidad"=>$doc_identidad,
		"catalog_key_cie10"=>$catalog_key_cie10,
		"id_parroquia"=>$id_parroquia,
		"direccion"=>$direccion,
		"fecha_registro"=>$fecha_registro,
		"telefono"=>$telefono,
		"is_hospital"=>$is_hospital,
		"id_atrib_especial"=>$id_atrib_especial
		
		];


		if (isset($dataCasosEpidemi['fecha_nacimiento'])) {

		$dataCasosEpidemiClean["fecha_nacimiento"]= mainModel::cleanStringSQL($dataCasosEpidemi['fecha_nacimiento']);
				}


	self::msgsValidDataBasicCaseEpidemi($dataCasosEpidemiClean);
	self::msgValidNotRepeatCasoEpidemi($dataCasosEpidemiClean);


		$dataPerson = self::$personController->updatePersonaController($dataCasosEpidemi);

		$dataCasosEpidemi = array_merge($dataCasosEpidemiClean,$dataPerson);


		$year_registro = date("Y", strtotime($fecha_registro));

		$dataCasosEpidemi["year_registro"] = $year_registro;


		// compararemos los datos del formulario con la base de datos
		
 		  $columnsTableToCompare = [
		"catalog_key_cie10",
		"id_parroquia",
		"direccion",
		"fecha_registro",
		"telefono",
		"is_hospital",
		"id_atrib_especial"];

 		 $fieldsForFilter = array('id_caso_epidemi' => $id_caso_epidemi);

		$queryToGetDataCasoEpidemi = self::getCasosEpidemiController($columnsTableToCompare,$fieldsForFilter);

		$ifCasosEpidemiDataUpdateIsSameDatabase = mainModel::isFieldsEqualToThoseInTheDatabase($queryToGetDataCasoEpidemi,$dataCasosEpidemi);

		//var_dump($ifCasosEpidemiDataUpdateIsSameDatabase,
		//	$dataPerson['ifUpdatePerson']);

			if ($ifCasosEpidemiDataUpdateIsSameDatabase && !$dataPerson['ifUpdatePerson']) {

			$alert=[
				"Alert"=>"simple",
				"Title"=>"Datos Duplicados",
				"Text"=>"No se ha encontrado ningun cambio a actualizar",
				"Type"=>"error"
			];

				echo json_encode($alert);

				exit();

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
		"id_tipo_operacion"=>'2', // tipo actualizacion
		"fecha_registro"=>$fecha_registro,
		"catalog_key_cie10"=>$catalog_key_cie10,
		"is_hospital"=>$is_hospital,
		"id_atrib_especial"=>$id_atrib_especial];			

		$dataCasosEpidemi = array_merge($dataCasosEpidemi,$dataCasosEpidemiBitacora);


		echo casosEpidemiModel::updateCasosEpidemiModel($dataCasosEpidemi);

			}

		public static function getCasosEpidemiController($columnsTable,$fieldsForFilter){

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

		if (isset($fieldsForFilter["id_nacionalidad"]) && !mainModel::isDataEmtpy($fieldsForFilter["id_nacionalidad"])) {

		 $id_nacionalidad = mainModel::cleanStringSQL($fieldsForFilter['id_nacionalidad']);

		 array_push($casosEpidemiAttributesFilter, 'id_nacionalidad = :id_nacionalidad');
		$casosEpidemiFilterValues[':id_nacionalidad'] = [
		'value' => $id_nacionalidad,
		'type' => \PDO::PARAM_INT,
		];

		}

		if (isset($fieldsForFilter["doc_identidad"]) && !mainModel::isDataEmtpy($fieldsForFilter["doc_identidad"])) {

		 $doc_identidad = mainModel::cleanStringSQL($fieldsForFilter['doc_identidad']);

		 array_push($casosEpidemiAttributesFilter, 'doc_identidad = :doc_identidad');
		$casosEpidemiFilterValues[':doc_identidad'] = [
		'value' => $doc_identidad,
		'type' => \PDO::PARAM_STR,
		];

		}

		if (isset($fieldsForFilter["fecha_registro"]) && !mainModel::isDataEmtpy($fieldsForFilter["fecha_registro"])) {

		 $fecha_registro = mainModel::cleanStringSQL($fieldsForFilter['fecha_registro']);

		 array_push($casosEpidemiAttributesFilter, 'fecha_registro = :fecha_registro');
		$casosEpidemiFilterValues[':fecha_registro'] = [
		'value' => $fecha_registro,
		'type' => \PDO::PARAM_STR,
		];

		}


		if (isset($fieldsForFilter["catalog_key_cie10"]) && !mainModel::isDataEmtpy($fieldsForFilter["catalog_key_cie10"])) {

		 $catalog_key_cie10 = mainModel::cleanStringSQL($fieldsForFilter['catalog_key_cie10']);

		 array_push($casosEpidemiAttributesFilter, 'catalog_key_cie10 = :catalog_key_cie10');
		$casosEpidemiFilterValues[':catalog_key_cie10'] = [
		'value' => $catalog_key_cie10,
		'type' => \PDO::PARAM_STR,
		];

		}
			return mainModel::querySelectsCreator('casos_epidemi',$columnsTable,$casosEpidemiAttributesFilter,$casosEpidemiFilterValues);
		}

		public function deleteCasosEpidemiController($dataCasosEpidemi){
			
		 $id_caso_epidemi = mainModel::cleanStringSQL($dataCasosEpidemi['id_caso_epidemi']);
		 
		$doc_identidad = mainModel::cleanStringSQL($dataCasosEpidemi['doc_identidad']);

		$id_nacionalidad = mainModel::cleanStringSQL($dataCasosEpidemi['id_nacionalidad']);

		$catalog_key_cie10 = mainModel::cleanStringSQL($dataCasosEpidemi['catalog_key_cie10']);

		$fecha_registro = mainModel::cleanStringSQL($dataCasosEpidemi['fecha_registro']);

		$id_atrib_especial = mainModel::cleanStringSQL($dataCasosEpidemi['id_atrib_especial']);

		$is_hospital = mainModel::cleanStringSQL($dataCasosEpidemi['is_hospital']);

		 			if (mainModel::isDataEmtpy(
						 $id_caso_epidemi,$doc_identidad,$id_nacionalidad,$catalog_key_cie10,$fecha_registro,$is_hospital) || mainModel::isDataEmtpyPermitedZero($id_atrib_especial)) {
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
						"Data"=>"doc_identidad=$doc_identidad&id_caso_epidemi=$id_caso_epidemi&id_nacionalidad=$id_nacionalidad&fecha_registro=$fecha_registro&catalog_key_cie10=$catalog_key_cie10&is_hospital=$is_hospital&id_atrib_especial=$id_atrib_especial&operationType=delete&confirmDelete=true",
						"Method"=>"POST"];
					
					echo json_encode($alert);

					exit();
		}
	}

		$dataCasosEpidemi = ['id_caso_epidemi'=>$id_caso_epidemi,
		'doc_identidad' => $doc_identidad,
		'id_nacionalidad' => $id_nacionalidad,
		'fecha_registro' => $fecha_registro,
		'id_atrib_especial' => $id_atrib_especial,
		'is_hospital' => $is_hospital];

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
    'nombres',
    'apellidos',
     'clave_capitulo_cie10',
     'capitulo_cie10',
    'catalog_key_cie10',
    'nombre_cie10',
    'id_atrib_especial',  
    'atributo_especial',
    'notific_inmediata',  
    'is_hospital',
    'hospitalizado',
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
     'capitulo_cie10',
    'catalog_key_cie10',
    'nombre_cie10',
    'id_atrib_especial',  
    'atributo_especial',  
    'notific_inmediata',  
    'is_hospital',
    'hospitalizado',
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

// is_hospital se mostrara como id_hospital en el fronted para menos confusion del usuario

  try {

$queryifExistView = mainModel::connectDB()->query("SELECT where EXISTS  ( SELECT FROM information_schema.tables WHERE table_name = 'caso_epidemi_view' ) = true");

			if(!$queryifExistView->rowCount()){
    
    		mainModel::connectDB()->query(parent::$queryCreateViewCasosEpidemi);
			
			}


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
//var_dump($sQueryForPersonalizedPrint);

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

                $dataFields['id_atrib_especial']=$aRow['id_atrib_especial'];

                $dataFields['atributo_especial']=$aRow['atributo_especial'];

                $dataFields['notific_inmediata']=$aRow['notific_inmediata'];

                $dataFields['is_hospital']=$aRow['is_hospital'];

                $dataFields['hospitalizado']=$aRow['hospitalizado'];

                $dataFields['clave_capitulo_cie10']=$aRow['clave_capitulo_cie10'];

                $dataFields['capitulo_cie10']=$aRow['capitulo_cie10'];

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


   // mainModel::connectDB()->query('drop view caso_epidemi_view');
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

				// el total de todos los sexos por edad
			    $dataRow[] = array(parent::getNroCasesEpidemiForEpiModel($agrupacion_epi["orden"], $startDateRange, $endDateRange,'',$rangeAgesStart[$idAgeRange],$rangeAgesEnd[$idAgeRange]));


		}

		// rango total de edades y genero

         $dataRow[] = parent::getNroCasesEpidemiForEpiModel($agrupacion_epi["orden"], $startDateRange, $endDateRange,'','','','');	
	

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

if ($files['fileCSVImportCaseEpidemi']['type'] !='text/csv' || mainModel::isDataEmtpy($files['fileCSVImportCaseEpidemi']['size'])){
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

$filePath = $files['fileCSVImportCaseEpidemi']['tmp_name'];

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

		$DB_transacc = mainModel::connectDB();

		$DB_transacc->beginTransaction();

		session_start(['name'=>'dptoEpidemi']);	

	try {

	$countOperations=0;


for ($indiceFila = 1; $indiceFila < count($dataForQuery); $indiceFila++) {


$id_caso_epidemi = mainModel::cleanStringSQL($dataForQuery[$indiceFila][1]);

$id_genero = mainModel::cleanStringSQL($dataForQuery[$indiceFila][2]);

$id_nacionalidad = mainModel::cleanStringSQL($dataForQuery[$indiceFila][4]);


$doc_identidad = mainModel::cleanStringSQL($dataForQuery[$indiceFila][5]);

$fecha_nacimiento = mainModel::cleanStringSQL($dataForQuery[$indiceFila][7]);

$nombres = mainModel::cleanStringSQL($dataForQuery[$indiceFila][9]);

$apellidos = mainModel::cleanStringSQL($dataForQuery[$indiceFila][10]);


$catalog_key_cie10 = mainModel::cleanStringSQL($dataForQuery[$indiceFila][13]);

$id_atrib_especial = mainModel::cleanStringSQL($dataForQuery[$indiceFila][15]);

$is_hospital = mainModel::cleanStringSQL($dataForQuery[$indiceFila][18]);

$fecha_registro = mainModel::cleanStringSQL($dataForQuery[$indiceFila][20]);

$id_parroquia = mainModel::cleanStringSQL($dataForQuery[$indiceFila][21]);

$direccion = mainModel::cleanStringSQL($dataForQuery[$indiceFila][23]);


$telefono = mainModel::cleanStringSQL($dataForQuery[$indiceFila][24]);

		
		 $indicatorEpidemiCaseError = " <br> En id Caso Epidemiologico (".$id_caso_epidemi.")";


		$dataCasosEpidemi=[
		'indicatorPersonError'=>$indicatorEpidemiCaseError,
		'indicatorEpidemiCaseError'=>$indicatorEpidemiCaseError,
		'doc_identidad'=>$doc_identidad,
		"nombres"=>$nombres,
		"apellidos"=>$apellidos,
		"fecha_nacimiento"=>$fecha_nacimiento,
		"id_nacionalidad"=>$id_nacionalidad,
		"id_genero"=>$id_genero,
		"catalog_key_cie10"=>$catalog_key_cie10,
		"is_hospital"=>$is_hospital,
		"id_atrib_especial"=>$id_atrib_especial,
		"id_parroquia"=>$id_parroquia,
		"direccion"=>$direccion,
		"fecha_registro"=>$fecha_registro,
		"telefono"=>$telefono];

		if (mainModel::isDataEmtpy(
			    $id_caso_epidemi,
			    $id_genero,
			    $id_nacionalidad,
			    $doc_identidad,
			    $fecha_nacimiento,
			    $nombres,
			   	$apellidos,
				$catalog_key_cie10,
				$is_hospital,
				$fecha_registro,
				$id_parroquia,
				$direccion,
			   	$telefono) || mainModel::isDataEmtpyPermitedZero($id_atrib_especial)){

				$alert=[
					"Alert"=>"simple",
					"Title"=>"Campos Vacios",
					"Text"=>"Todos los campos del caso epidemiologico son obligatorios".$indicatorEpidemiCaseError,
					"Type"=>"error"
				];

				echo json_encode($alert);

				exit();

		}


	self::msgsValidDataBasicCaseEpidemi($dataCasosEpidemi);

		   if($is_hospital !== "false" && $is_hospital !== "true"){

			$alert=[
			"Alert"=>"simple",
			"Title"=>"Datos Invalidos",
			"Text"=>"El atribtuto is hospital solo debe ser un true o un false ".$indicatorEpidemiCaseError,
			"Type"=>"error"
				];	
		
				echo json_encode($alert);

				exit();
			}


		$currentDate =  mainModel::getDateCurrentSystem();

		$currentYear = date("Y", $currentDate);

		$currentHour = date("h:i:s a", $currentDate);

		$currentDate = date("Y-m-d", $currentDate);

		$fecha_registro_values = explode("-", $fecha_registro);

		$dataCasosEpidemiBitacora=[
		'indicatorPersonError'=>$indicatorEpidemiCaseError,
		'operationImportCaseEpidemi'=>true,
		"year_registro"=>$fecha_registro_values[0],
		"id_nacionalidad_usuario"=>$_SESSION['id_nacionalidad'],
		"doc_identidad_usuario"=>$_SESSION['doc_identidad'],
		"usuario_alias"=>$_SESSION['aliasUser'],
		"bitacora_fecha"=>$currentDate,
		"bitacora_year"=>$currentYear,
		"bitacora_hora"=>$currentHour
	];

		$dataCasosEpidemi = array_merge($dataCasosEpidemi,$dataCasosEpidemiBitacora);

		$queryIsExistcasosEpidemi = $DB_transacc->query("SELECT id_caso_epidemi FROM casos_epidemi WHERE id_nacionalidad = '$id_nacionalidad' AND doc_identidad = '$doc_identidad' AND catalog_key_cie10 = '$catalog_key_cie10' AND fecha_registro = '$fecha_registro'");

			$id_tipo_operacion = 1;


		if($queryIsExistcasosEpidemi->rowCount() > 0){
			
			$id_tipo_operacion = 2;

	$dataPerson = self::$personController->updatePersonaController($dataCasosEpidemi);

	$dataCasosEpidemi = array_merge($dataCasosEpidemi,$dataPerson);

			// si caso de actualizacion verificamos si son los mismos datos
		
 		  $columnsTableToCompare = [
		"catalog_key_cie10",
		"id_parroquia",
		"direccion",
		"fecha_registro",
		"telefono"];

 		 $fieldsForFilter = array('doc_identidad'=>$doc_identidad,"id_nacionalidad"=>$id_nacionalidad,"catalog_key_cie10"=>$catalog_key_cie10,'fecha_registro'=>$fecha_registro);

		$queryToGetDataCasoEpidemi = self::getCasosEpidemiController($columnsTableToCompare,$fieldsForFilter);

		$ifCasosEpidemiDataUpdateIsSameDatabase = mainModel::isFieldsEqualToThoseInTheDatabase($queryToGetDataCasoEpidemi,$dataCasosEpidemi);

		}else{

	$dataPerson = self::$personController->addPersonControllerr($dataCasosEpidemi);

	$dataCasosEpidemi = array_merge($dataCasosEpidemi,$dataPerson);

			// para que de paso a la consulta
		 $ifCasosEpidemiDataUpdateIsSameDatabase = false;
		 $dataCasosEpidemi['ifUpdatePerson']  = true;

}

// si updatePersonaController tiene ifUpdatePerson con true y los datos de caos epidemi no son lo mismo hagan las operaiones

$dataCasosEpidemi['ifCasosEpidemiDataUpdateIsSameDatabase'] = $ifCasosEpidemiDataUpdateIsSameDatabase;

	if ($dataCasosEpidemi['ifUpdatePerson'] == true || $ifCasosEpidemiDataUpdateIsSameDatabase == false) {


	$queryInsertPerson  = personModel::stringQueryAddPersonModel();

$sqlQuery = $DB_transacc->prepare($queryInsertPerson."
ON CONFLICT ON CONSTRAINT personas_key DO UPDATE SET nombres = :nombres,
		 apellidos = :apellidos,
		 fecha_nacimiento = :fecha_nacimiento,
		 id_genero = :id_genero");

		$sqlQuery->execute(array(
		 "id_nacionalidad"=>$dataCasosEpidemi['id_nacionalidad'],
		 "doc_identidad"=>$dataCasosEpidemi['doc_identidad'],
		 "nombres"=>$dataCasosEpidemi['nombres'],
		 "apellidos"=>$dataCasosEpidemi['apellidos'],
		 "fecha_nacimiento"=>$dataCasosEpidemi['fecha_nacimiento'],
		 "id_nacionalidad"=>$dataCasosEpidemi['id_nacionalidad'],
		 "id_genero"=>$dataCasosEpidemi['id_genero']));

		
		$queryAddCasosEpidemi = parent::$queryAddCasosEpidemi;

$sqlQuery = $DB_transacc->prepare($queryAddCasosEpidemi."
ON CONFLICT ON CONSTRAINT casos_epidemi_bitacora_unq_1 DO UPDATE SET 
		 catalog_key_cie10 = :catalog_key_cie10,
		 id_parroquia = :id_parroquia,
		 direccion = :direccion,
		 telefono = :telefono,
		 fecha_registro = :fecha_registro,
		 year_registro = :year_registro ;");	

		$sqlQuery->execute(array(
		 "doc_identidad" => $dataCasosEpidemi['doc_identidad'],
		 "id_nacionalidad" => $dataCasosEpidemi['id_nacionalidad'],
		 "catalog_key_cie10" => $dataCasosEpidemi['catalog_key_cie10'],
		 "id_atrib_especial" => $dataCasosEpidemi['id_atrib_especial'],
		 "is_hospital" => $dataCasosEpidemi['is_hospital'],		 
		 "id_parroquia" => $dataCasosEpidemi['id_parroquia'],
		 "direccion" => $dataCasosEpidemi['direccion'],
		 "telefono" => $dataCasosEpidemi['telefono'],
		 "year_registro" => $dataCasosEpidemi['year_registro'],
		 "fecha_registro" => $dataCasosEpidemi['fecha_registro']));


    $queryGetIdEpidemi = $DB_transacc->query("SELECT id_caso_epidemi FROM public.casos_epidemi WHERE catalog_key_cie10 = '$catalog_key_cie10' AND id_nacionalidad = '$id_nacionalidad' AND doc_identidad = '$doc_identidad' limit 1;");

	$idEpidemiCase = $queryGetIdEpidemi->fetchColumn();
		
	$dataCasosEpidemi["id_caso_epidemi"]=$idEpidemiCase;

		$sqlQuery = $DB_transacc->prepare(self::$queryAddBitacoraCasoEpidemi);

		$sqlQuery->execute(array(
		 "usuario_alias"=>$dataCasosEpidemi['usuario_alias'],
		 "bitacora_fecha"=>$dataCasosEpidemi['bitacora_fecha'],
		 "bitacora_hora"=>$dataCasosEpidemi['bitacora_hora'],
		 "bitacora_year"=>$dataCasosEpidemi['bitacora_year'],
		 "id_tipo_operacion"=>$id_tipo_operacion,
		 "id_caso_epidemi"=>$dataCasosEpidemi['id_caso_epidemi'],
		 "fecha_caso_epidemi"=>$dataCasosEpidemi['fecha_registro'],
		 "catalog_key_cie10"=>$dataCasosEpidemi['catalog_key_cie10'],
		 "id_atrib_especial" => $dataCasosEpidemi['id_atrib_especial'],
		 "is_hospital" => $dataCasosEpidemi['is_hospital'],
		 "id_nacionalidad_caso"=>$dataCasosEpidemi['id_nacionalidad'],
		 "doc_identidad_caso"=>$dataCasosEpidemi['doc_identidad'],
		 "id_nacionalidad_usuario"=>$dataCasosEpidemi['id_nacionalidad_usuario'],
		 "doc_identidad_usuario"=>$dataCasosEpidemi['doc_identidad_usuario']));

	$countOperations++;
	}

	}


//var_dump($countOperations);

if ($countOperations != 0) {
	 $DB_transacc->commit();
}
	
			$alert=[
				"cleanInput"=>"true",
				"reloadDataTable"=>"true",
				"Alert"=>"simple",
				"Title"=>"Operacion Exitosa",
				"Text"=>"Casos Epidemiologicos Importados",
				"Type"=>"success"
			];

	}catch (Exception $e) {

			$error = '';

if ($countOperations == 0) {

		$DB_transacc->rollBack();

    	$codeError = $e->getCode();

    	$textDetailsTecnics =  "<br><br> Detalles Tecnicos: ". $e->getMessage();
		
		$textError = mainModel:: getMsgErrorSQL($codeError);

			$alert=[
				"Alert"=>"simple",
				"Title"=>"Ocurrio un error inesperado",
				"Text"=>$textError.$textDetailsTecnics,
				"Type"=>"error"
			];

	}else{
					$alert=[
				"cleanInput"=>"true",		
				"reloadDataTable"=>"true",
				"Alert"=>"clean",
				"Title"=>"Operacion Exitosa",
				"Text"=>"Casos Epidemiologicos Importados",
				"Type"=>"success"
			];
	}


	}


	return json_encode($alert);
	exit();


}

	public static function getEspecialAttributesCIE10($dataCasosEpidemi){

	$catalog_key = mainModel::cleanStringSQL($dataCasosEpidemi['catalog_key']);


		$queryGetAttribEspecial = mainModel::connectDB()->prepare(parent::$queryGetAttribEspecial);

		$queryGetAttribEspecial->execute(array(
		 "catalog_key"=>$dataCasosEpidemi['catalog_key']));		
		
		$dataJsonAtribEspecial=[];

		 if (!$queryGetAttribEspecial->rowCount()) {
			$dataJsonAtribEspecial[] = array('descripcion' =>'Seleccionar Atributo Especial','id_atrib_especial'=>'0');

		echo json_encode($dataJsonAtribEspecial);
		exit();

		 }

		while($recordsAtribEspecial=$queryGetAttribEspecial->fetch(PDO
			::FETCH_ASSOC)){ 

			$dataJsonAtribEspecial[] = $recordsAtribEspecial;
		}
				
		echo json_encode($dataJsonAtribEspecial);
		exit();
	}



	 public static function printEpidemiCaseCountController(){
		
				$currentDate =  mainModel::getDateCurrentSystem();

       			$dateYesterday = date("Y-m-d",strtotime($currentDate."- 1 days"));

       			$dateDay = date("d",strtotime($currentDate."- 1 days"));

				$currentMounth = date("m", $currentDate);

				$currentYear = date("Y", $currentDate);

				$currentDate = date("y-m-d", $currentDate);
				    
		$queryCountCasosEpidemiCurrentYear = mainModel::connectDB()->query("SELECT count(id_caso_epidemi) FROM casos_epidemi where year_registro = '$currentYear'");

		$queryCountCasosEpidemiMounth = mainModel::connectDB()->query("SELECT count(id_caso_epidemi) FROM casos_epidemi where DATE_PART('month',fecha_registro) = '$currentMounth';");

		$queryCountCasosEpidemiWeek = mainModel::connectDB()->query("SELECT count(id_caso_epidemi)
        FROM casos_epidemi where DATE_PART('week',fecha_registro) = DATE_PART('week','$dateYesterday'::date);");

		$queryCountCasosEpidemiYesterday = mainModel::connectDB()->query("SELECT count(id_caso_epidemi)
        FROM casos_epidemi where fecha_registro = '$dateYesterday'");

		$queryCountCasosEpidemiTotal = mainModel::connectDB()->query("SELECT count(id_caso_epidemi) FROM casos_epidemi");

		$countCasosEpidemiCurrentYear = $queryCountCasosEpidemiCurrentYear->fetchColumn();

		$countCasosEpidemiMounth = $queryCountCasosEpidemiMounth->fetchColumn();

		$countCasosEpidemiWeek = $queryCountCasosEpidemiWeek->fetchColumn();

		$countCasosEpidemiYesterday = $queryCountCasosEpidemiYesterday->fetchColumn();

		$countCasosEpidemiTotal = $queryCountCasosEpidemiTotal->fetchColumn();
        
        return "
  		Año ($currentYear) : ".$countCasosEpidemiCurrentYear." 
  		<br>
        Mes ($currentMounth) : ".$countCasosEpidemiMounth."
  		<br>
        Semana: ".$countCasosEpidemiWeek."
  		<br>
        Hoy : ".$countCasosEpidemiYesterday."
  		<br>
        Total: ".$countCasosEpidemiTotal."
		<br>";
		
}

//  comprobar que no se repita el caso epidemiologico
		protected static function msgsValidDataBasicCaseEpidemi($dataCasosEpidemi){

	self::msgValidExistCatalogKeyCIE10($dataCasosEpidemi);

	self::msgValididGenreAssingnEventCIE10($dataCasosEpidemi);

	self::msgValididAgeAssingnEventCIE10($dataCasosEpidemi);

	self::msgValidIdAtribEspecialCIE10($dataCasosEpidemi);

	self::msgValididDateRegisterCaseEpidemi($dataCasosEpidemi);

	self::$personController->msgValidNroTlf($dataCasosEpidemi);

	self::msgValididAdress($dataCasosEpidemi);

		}

	protected static function msgValidNotRepeatCasoEpidemi($dataCasosEpidemi){

	extract($dataCasosEpidemi);

	$sqlForOperationsUpdateCaseEpidemi = '';
	if (isset($id_caso_epidemi)) {
		$sqlForOperationsUpdateCaseEpidemi = ' AND id_caso_epidemi != '.$id_caso_epidemi;
	}
		
		$queryIsExistcasosEpidemi = mainModel::connectDB()->query("SELECT id_caso_epidemi FROM casos_epidemi WHERE id_nacionalidad = '$id_nacionalidad' AND doc_identidad = '$doc_identidad' AND catalog_key_cie10 = '$catalog_key_cie10' AND fecha_registro = '$fecha_registro' ".$sqlForOperationsUpdateCaseEpidemi);

			if($queryIsExistcasosEpidemi->rowCount()){
			$alert=[
				"Alert"=>"simple",
				"Title"=>"Datos Duplicados",
				"Text"=>"Ya esta registrado otro Caso Epidemiologico con estos parametros, (Documento de identidad, Fecha de registro y Caso CIE-10)".$indicatorEpidemiCaseError,
				"Type"=>"error"
			];

				echo json_encode($alert);

				exit();
			}

		}


	protected static function msgValidExistCatalogKeyCIE10($dataCasosEpidemi){
			
			extract($dataCasosEpidemi);

		$queryIsExistCasesCIE10 = mainModel::connectDB()->query("SELECT catalog_key FROM data_cie10 WHERE catalog_key = '$catalog_key_cie10' LIMIT 1");

			if(!$queryIsExistCasesCIE10->rowCount()){
			$alert=[
				"Alert"=>"simple",
				"Title"=>"Datos Invalidos",
				"Text"=>"La clave del catalogo CIE-10 no existe".$indicatorEpidemiCaseError,
				"Type"=>"error"
			];

				echo json_encode($alert);

				exit();
			}

			}

		// para comprobar el  caso cei-10 no tenga un sexo asignado obligatorio


	protected static function msgValididGenreAssingnEventCIE10($dataCasosEpidemi){

					extract($dataCasosEpidemi);

		$queryGetLsexCIE10 = mainModel::connectDB()->query("SELECT lsex FROM data_cie10 where catalog_key = '$catalog_key_cie10' LIMIT 1");

		// si no existe id_genero en el form por que la persona ya esta registrada
		$sexAssignedToCIE10 = $queryGetLsexCIE10->fetchColumn();
		
		if (!isset($id_genero)) {

		$queryGetIdGeneroPerson = mainModel::connectDB()->query("SELECT id_genero FROM personas WHERE id_nacionalidad = '$id_nacionalidad' AND doc_identidad = '$doc_identidad'");

		$id_genero = $queryGetIdGeneroPerson->fetchColumn();

		}else{
			$id_genero = mainModel::cleanStringSQL($id_genero);
		}

		// quiere decir que no tiene un sexo asginado, si es asi lo ignoramos
		if ($sexAssignedToCIE10 != "NO") {
			if ($sexAssignedToCIE10 != $id_genero) {

			$alert=[
			"Alert"=>"simple",
			"Title"=>"Datos Invalidos",
			"Text"=>"Este Evento CIE 10 no permite este Genero".$indicatorEpidemiCaseError,
			"Type"=>"error"
				];	
		
				echo json_encode($alert);

				exit();
			}

			}

			}


	protected static function msgValididAgeAssingnEventCIE10($dataCasosEpidemi){

					extract($dataCasosEpidemi);

		$queryGetAgeCIE10 = mainModel::connectDB()->query("SELECT linf, lsup FROM data_cie10 where catalog_key = '$catalog_key_cie10' LIMIT 1");
		
		    $row = $queryGetAgeCIE10->fetch(PDO::FETCH_ASSOC);

		    $infAge=intval(preg_replace('/[^0-9]+/', '', $row["linf"]), 10);;
		    $supAge=intval(preg_replace('/[^0-9]+/', '', $row["lsup"]), 10);;

		if ($infAge != "NO" || $supAge != "NO") {

		if (!isset($fecha_nacimiento)) {

		$queryGetIdGeneroPerson = mainModel::connectDB()->query("SELECT date_part('year',age('$fecha_registro', fecha_nacimiento))::int as edad FROM personas WHERE id_nacionalidad = '$id_nacionalidad' AND doc_identidad = '$doc_identidad'");

		$ageCaseEpidemi = $queryGetIdGeneroPerson->fetchColumn();

		}else{
			$fecha_nacimiento = mainModel::cleanStringSQL($fecha_nacimiento);

		$queryGetIdGeneroPerson = mainModel::connectDB()->query("SELECT date_part('year',age('$fecha_registro', '$fecha_nacimiento'))::int as edad");

		$ageCaseEpidemi = $queryGetIdGeneroPerson->fetchColumn();

		}

			if ($ageCaseEpidemi < $infAge  || $ageCaseEpidemi > $supAge) {

			$alert=[
			"Alert"=>"simple",
			"Title"=>"Datos Invalidos",
			"Text"=>"Este Evento CIE 10 no permite esta edad, Revise su rango de edad".$indicatorEpidemiCaseError,
			"Type"=>"error"
				];	
		
				echo json_encode($alert);

				exit();
			}

			}
		}



	protected static function msgValididAdress($dataCasosEpidemi){


		   if(strlen($dataCasosEpidemi['direccion'])<5){

			$alert=[
			"Alert"=>"simple",
			"Title"=>"Datos Invalidos",
			"Text"=>"La direccion deben poseer mas de 5 caracteres".$dataCasosEpidemi['indicatorEpidemiCaseError'],
			"Type"=>"error"
				];	
		
				echo json_encode($alert);

				exit();
			}

			}

	protected static function msgValidIdAtribEspecialCIE10($dataCasosEpidemi){

		$id_atrib_especial = intval($dataCasosEpidemi['id_atrib_especial']);

		if (!is_int($id_atrib_especial) || $id_atrib_especial < 0){

			$alert=[
			"Alert"=>"simple",
			"Title"=>"Datos Invalidos",
			"Text"=>"El id Atributo Especial es Invalido".$dataCasosEpidemi['indicatorEpidemiCaseError'],
			"Type"=>"error"
				];	
		
				echo json_encode($alert);

				exit();
			}


		$queryIdAtribEspecialCIE10 = mainModel::connectDB()->query("SELECT id_atrib_especial FROM atribs_especiales_cie10 WHERE  id_atrib_especial =
			".$id_atrib_especial);

		if (!$queryIdAtribEspecialCIE10->rowCount()){

			$alert=[
			"Alert"=>"simple",
			"Title"=>"Datos Invalidos",
			"Text"=>"El id Atributo Especial no existe".$dataCasosEpidemi['indicatorEpidemiCaseError'],
			"Type"=>"error"
				];	
		
				echo json_encode($alert);

				exit();
			}

			// el atribtuto especial 0 (es ninguno) asi que  no  es necesario verificar que si es valido para el evento CIE 10
			

			if($id_atrib_especial ==! 0) {

//				var_dump($dataCasosEpidemi['catalog_key_cie10']);
		$queryGetAttribEspecial = mainModel::connectDB()->prepare(parent::$queryGetAttribEspecial);

		$queryGetAttribEspecial->execute(array(
		 "catalog_key"=>$dataCasosEpidemi['catalog_key_cie10']));


		if (!$queryGetAttribEspecial->rowCount()){

			$alert=[
			"Alert"=>"simple",
			"Title"=>"Datos Invalidos",
			"Text"=>"El id Atributo Especial No esta Disponible para este Evento CIE 10 ".$dataCasosEpidemi['indicatorEpidemiCaseError'],
			"Type"=>"error"
				];	
		
				echo json_encode($alert);

				exit();
			}

			}

			}

	protected static function msgValididDateRegisterCaseEpidemi($dataCasosEpidemi){

			if (!mainModel::checkDate($dataCasosEpidemi['fecha_registro'])){
			$alert=[
				"Alert"=>"simple",
				"Title"=>"Datos Invalidos",
				"Text"=>"La Fecha de Registro es invalido",
				"Type"=>"error"
			];

				echo json_encode($alert);

				exit();
		}

			if (!self::isValidDateRegistRangeAllowedCaseEpidemi($dataCasosEpidemi['fecha_registro'])){
			$alert=[
				"Alert"=>"simple",
				"Title"=>"Datos Invalidos",
				"Text"=>"La fecha de registro no esta en el rango aceptado",
				"Type"=>"error"
			];

				echo json_encode($alert);

				exit();
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

	public static function isValidDateRegistRangeAllowedCaseEpidemi($fecha_registro){


        $currentDate = date("d-m-Y");

       $maxDateAllowed = date("Y-m-d",strtotime($currentDate."- 1 days"));

//       $minDateRange = date("Y-m-d",strtotime($maxDateAllowed."- 7 days"));
       
		if (/*($fecha_registro < $minDateRange)||*/ $fecha_registro > $maxDateAllowed){
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