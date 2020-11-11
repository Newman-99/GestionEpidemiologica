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

		

		$year_registro = date("Y", strtotime($fecha_registro));

		
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
		"year_registro"=>$year_registro,
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
		$year_registro = date("Y", strtotime($fecha_registro));

		$dataCasosEpidemi = 
		[
		'id_caso_epidemi'=>$id_caso_epidemi,
		"id_nacionalidad"=>$id_nacionalidad,
		"doc_identidad"=>$doc_identidad,
		"catalog_key_cie10"=>$catalog_key_cie10,
		"id_parroquia"=>$id_parroquia,
		"direccion"=>$direccion,
		"fecha_registro"=>$fecha_registro,
		"year_registro"=>$year_registro,
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
		"year_registro",
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

		$year_registro = date("Y", strtotime($fecha_registro));
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
     'doc_identidad_usuario_complete',
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
    'doc_identidad_usuario_complete',
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

                 $aRow['descripcion_genero_caso']= "
                    <img class='img-profile rounded-circle' width='40' src=".SERVERURL."view/img/".$iconGenero.">";

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

                $dataFields['doc_identidad_usuario_complete']= $aRow['doc_identidad_usuario_complete'];

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


		function getDataTablesEPIController($dataEpi){

		 $startDateRange = mainModel::cleanStringSQL($dataEpi['startDateRange']);


		 $endDateRange = mainModel::cleanStringSQL($dataEpi['endDateRange']);

      $rangeAgesStart=['', 1, 5, 7, 10, 12, 15, 20, 25, 45, 60, 65,''];

      $rangeAgesEnd = [1, 4, 6, 9, 11, 14, 19, 24, 44, 59, 64,'', ''];		

			if (!mainModel::checkDate($startDateRange,$endDateRange)){
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




$table = "";

$table.="<div class='table-responsive'>
  
  <table class='table table-bordered table-striped table-striped' id='dataTable' width='100%' cellspacing='0'>
		<thead>
		<tr>
            <th class='column0 style13 s style13' rowspan='2'>Orden</th>
            <th class='column1 style14 s style14' rowspan='2'>Enfermedad / Evento</th>
            <th class='column2 style15 s style15' colspan='2'>&lt; 1 año</th>
            <th class='column4 style15 s style15' colspan='2'>1 a 4 años</th>
            <th class='column6 style15 s style15' colspan='2'>5 a 6 años</th>
            <th class='column8 style15 s style15' colspan='2'>7 a 9 años</th>
            <th class='column10 style15 s style15' colspan='2'>10 a 11 años</th>
            <th class='column12 style15 s style15' colspan='2'>12 a 14 años</th>
            <th class='column14 style15 s style15' colspan='2'>15 a 19 años</th>
            <th class='column16 style15 s style15' colspan='2'>20 a 24 años</th>
            <th class='column18 style15 s style15' colspan='2'>25 a 44 años</th>
            <th class='column20 style15 s style15' colspan='2'>45 a 59 años</th>
            <th class='column22 style15 s style15' colspan='2'>60 a 64 años</th>
            <th class='column24 style15 s style15' colspan='2'>65 años y más</th>
            <th class='column26 style15 s style15' colspan='2'>Total</th>
            <th class='column28 style15 s style15' rowspan='2'>Total General</th>
		</tr>
		<tr>
";

for ($i=0; $i < 12; $i++) { 

	$table .='<th>H</th>
		<th>M</th>';
}

$table.="<th class='column26 style21 s'>Hombres</th>
       <th class='column27 style22 s' >Mujeres</th>

		</tr>

		</thead>

<tbody>";

		$queryGetAgrupacionEPI = mainModel::connectDB()->query(parent::$queryGetAgrupacionEPI);
		
		while($agrupacion_epi=$queryGetAgrupacionEPI->fetch(PDO
			::FETCH_ASSOC)){ 


            

         	$table.="<tr>

			<td>".$agrupacion_epi["orden"]."</td>  	
					<td>".$agrupacion_epi["enfermedad_evento"]."</td>";


				/// for obtener los datos por todos los rango de edades
			for ($idAgeRange=0; $idAgeRange < count($rangeAgesStart); $idAgeRange++) { 

			// obtnemos los datos para hembras y machos
			for ($id_genero=1; $id_genero <= 2 ; $id_genero++) { 

         	$table.="
         	<td class='column2 style26 f'>".
            parent::getNroCasesEpidemiForEpiModel($agrupacion_epi["orden"], $startDateRange, $endDateRange,$id_genero,$rangeAgesStart[$idAgeRange],$rangeAgesEnd[$idAgeRange])."</td>";			

			}

		}

		// rango total de edades y genero
         $table.="
         <td class='column2 style26 f'>".
            parent::getNroCasesEpidemiForEpiModel($agrupacion_epi["orden"], $startDateRange, $endDateRange,'','','')."</td>";	

        $table.= "</tr>";
		
	}

		// Columnas vacias y otros eventos no cie-10
$table.= "

          <tr class='row44'>
            <td class='column0 style24 n'>94</td>
            <td class='column1 style41 null'></td>
            <td class='column2 style31 null'></td>
            <td class='column3 style32 null'></td>
            <td class='column4 style31 null'></td>
            <td class='column5 style32 null'></td>
            <td class='column6 style31 null'></td>
            <td class='column7 style32 null'></td>
            <td class='column8 style31 null'></td>
            <td class='column9 style32 null'></td>
            <td class='column10 style31 null'></td>
            <td class='column11 style32 null'></td>
            <td class='column12 style31 null'></td>
            <td class='column13 style32 null'></td>
            <td class='column14 style31 null'></td>
            <td class='column15 style32 null'></td>
            <td class='column16 style31 null'></td>
            <td class='column17 style32 null'></td>
            <td class='column18 style31 null'></td>
            <td class='column19 style32 null'></td>
            <td class='column20 style31 null'></td>
            <td class='column21 style32 null'></td>
            <td class='column22 style31 null'></td>
            <td class='column23 style32 null'></td>
            <td class='column24 style31 null'></td>
            <td class='column25 style32 null'></td>
            <td class='column26 style33 f'>0</td>
            <td class='column27 style34 f'>0</td>
            <td class='column28 style35 f'>0</td>
          </tr>
          <tr class='row45'>
            <td class='column0 style24 n'>95</td>
            <td class='column1 style41 null'></td>
            <td class='column2 style31 null'></td>
            <td class='column3 style32 null'></td>
            <td class='column4 style31 null'></td>
            <td class='column5 style32 null'></td>
            <td class='column6 style31 null'></td>
            <td class='column7 style32 null'></td>
            <td class='column8 style31 null'></td>
            <td class='column9 style32 null'></td>
            <td class='column10 style31 null'></td>
            <td class='column11 style32 null'></td>
            <td class='column12 style31 null'></td>
            <td class='column13 style32 null'></td>
            <td class='column14 style31 null'></td>
            <td class='column15 style32 null'></td>
            <td class='column16 style31 null'></td>
            <td class='column17 style32 null'></td>
            <td class='column18 style31 null'></td>
            <td class='column19 style32 null'></td>
            <td class='column20 style31 null'></td>
            <td class='column21 style32 null'></td>
            <td class='column22 style31 null'></td>
            <td class='column23 style32 null'></td>
            <td class='column24 style31 null'></td>
            <td class='column25 style32 null'></td>
            <td class='column26 style33 f'>0</td>
            <td class='column27 style34 f'>0</td>
            <td class='column28 style35 f'>0</td>
          </tr>

          <tr class=''>
            <td class=''>96</td>
            <td class=''>Total Pacientes Atendidos (atención ambulatoria y emergencia) por todas las causas</td>
            <td class='column2 style33 f'>xx</td>
            <td class='column3 style34 f'>xx</td>
            <td class='column4 style33 f'>xx</td>
            <td class='column5 style34 f'>xx</td>
            <td class='column6 style33 f'>xx</td>
            <td class='column7 style34 f'>xx</td>
            <td class='column8 style33 f'>xx</td>
            <td class='column9 style34 f'>xx</td>
            <td class='column10 style33 f'>xx</td>
            <td class='column11 style34 f'>xx</td>
            <td class='column12 style33 f'>xx</td>
            <td class='column13 style34 f'>xx</td>
            <td class='column14 style33 f'>xx</td>
            <td class='column15 style34 f'>xx</td>
            <td class='column16 style33 f'>xx</td>
            <td class='column17 style34 f'>xx</td>
            <td class='column18 style33 f'>xx</td>
            <td class='column19 style34 f'>xx</td>
            <td class='column20 style33 f'>xx</td>
            <td class='column21 style34 f'>xx</td>
            <td class='column22 style33 f'>xx</td>
            <td class='column23 style34 f'>xx</td>
            <td class='column24 style33 f'>xx</td>
            <td class='column25 style34 f'>xx</td>
            <td class='column26 style33 f'>xx</td>
            <td class='column27 style34 f'>xx</td>
            <td class='column28 style35 f'>xx</td>
          </tr>

          <tr class=''>
            <td class=''>97</td>
            <td class=''>Total Pacientes Hospitalizados por todas causas</td>
            <td class='column2 style45 n'>0</td>
            <td class='column3 style46 n'>0</td>
            <td class='column4 style45 n'>0</td>
            <td class='column5 style46 n'>0</td>
            <td class='column6 style45 n'>0</td>
            <td class='column7 style46 n'>0</td>
            <td class='column8 style45 n'>0</td>
            <td class='column9 style46 n'>0</td>
            <td class='column10 style45 n'>0</td>
            <td class='column11 style46 n'>0</td>
            <td class='column12 style45 n'>0</td>
            <td class='column13 style46 n'>0</td>
            <td class='column14 style45 n'>0</td>
            <td class='column15 style46 n'>0</td>
            <td class='column16 style45 n'>0</td>
            <td class='column17 style46 n'>0</td>
            <td class='column18 style45 n'>0</td>
            <td class='column19 style46 n'>0</td>
            <td class='column20 style45 n'>0</td>
            <td class='column21 style46 n'>0</td>
            <td class='column22 style45 n'>0</td>
            <td class='column23 style46 n'>0</td>
            <td class='column24 style45 n'>0</td>
            <td class='column25 style46 n'>0</td>
            <td class='column26 style47 f'>0</td>
            <td class='column27 style48 f'>0</td>
            <td class='column28 style49 f'>0</td>
          </tr>
";
// Final de la tabla para otros datos
/*
$table.= " <tr class='row48'>
            <td class=''></td>
            <td class=' colspan='11' rowspan='2'><span style='font-weight:bold; color:#000000; font-family:'Arial'; font-size:10pt'>SITUACIONES ESPECIALES: </span><span style='color:#000000; font-family:'Arial'; font-size:10pt'>No incluye los 70 ENO/EVENTOS</span></td>
            <td class='column12 style51 s style51' colspan='17' rowspan='2'>SITUACIONES DE ALERTA</td>
          </tr>
          <tr class=''>
            <td class=''></td>
          </tr>

          <tr class='row50'>
            <td class='column0 style53 null'></td>
            <td class='column1 style54 s'>Tipo de Evento:         </td>
            <td class='column2 style55 s'>En Animales____</td>
            <td class='column3 style56 null'></td>
            <td class='column4 style56 null'></td>
            <td class='column5 style56 s'>Desastre Natural____</td>
            <td class='column6 style56 null'></td>
            <td class='column7 style56 null'></td>
            <td class='column8 style56 s'>Infecciosos_______</td>
            <td class='column9 style57 null'></td>
            <td class='column10 style56 s'>Quimico____</td>
            <td class='column11 style58 null'></td>
            <td class='column12 style59 s'>Fecha de Inicio</td>
            <td class='column13 style59 null'></td>
            <td class='column14 style60 s'>Fecha Fin</td>
            <td class='column15 style61 null'></td>
            <td class='column16 style60 s'>Unidad Geografica </td>
            <td class='column17 style59 null'></td>
            <td class='column18 style62 null'></td>
            <td class='column19 style60 s'>Unidad Sanitaria</td>
            <td class='column20 style62 null'></td>
            <td class='column21 style59 null'></td>
            <td class='column22 style62 null'></td>
            <td class='column23 style63 s'>Enfermedad</td>
            <td class='column24 style62 null'></td>
            <td class='column25 style64 null'></td>
            <td class='column26 style63 s'>Grave</td>
            <td class='column27 style63 s'>Inusitado</td>
            <td class='column28 style65 s'>Nacional</td>
          </tr>
          <tr class='row51'>
            <td class='column0 style66 null'></td>
            <td class='column1 style67 s'>Radionuclear___</td>
            <td class='column2 style68 s'>Alimentario _____________</td>
            <td class='column3 style69 null'></td>
            <td class='column4 style69 null'></td>
            <td class='column5 style69 null'></td>
            <td class='column6 style69 null'></td>
            <td class='column7 style68 s'>Indeterminado___________________</td>
            <td class='column8 style69 null'></td>
            <td class='column9 style69 null'></td>
            <td class='column10 style69 null'></td>
            <td class='column11 style70 null'></td>
            <td class='column12 style71 null'></td>
            <td class='column13 style72 null'></td>
            <td class='column14 style73 null'></td>
            <td class='column15 style74 null'></td>
            <td class='column16 style73 null'></td>
            <td class='column17 style75 null'></td>
            <td class='column18 style75 null'></td>
            <td class='column19 style73 null'></td>
            <td class='column20 style75 null'></td>
            <td class='column21 style75 null'></td>
            <td class='column22 style74 null'></td>
            <td class='column23 style73 null'></td>
            <td class='column24 style75 null'></td>
            <td class='column25 style74 null'></td>
            <td class='column26 style76 null'></td>
            <td class='column27 style76 null'></td>
            <td class='column28 style77 null'></td>
          </tr>
          <tr class='row52'>
            <td class='column0 style53 null'></td>
            <td class='column1 style78 s'>Comunidad</td>
            <td class='column2 style79 null'></td>
            <td class='column3 style79 null'></td>
            <td class='column4 style79 null'></td>
            <td class='column5 style79 null'></td>
            <td class='column6 style79 null'></td>
            <td class='column7 style79 null'></td>
            <td class='column8 style79 null'></td>
            <td class='column9 style79 null'></td>
            <td class='column10 style79 null'></td>
            <td class='column11 style80 null'></td>
            <td class='column12 style81 null'></td>
            <td class='column13 style82 null'></td>
            <td class='column14 style83 null'></td>
            <td class='column15 style84 null'></td>
            <td class='column16 style83 null'></td>
            <td class='column17 style85 null'></td>
            <td class='column18 style85 null'></td>
            <td class='column19 style83 null'></td>
            <td class='column20 style85 null'></td>
            <td class='column21 style85 null'></td>
            <td class='column22 style84 null'></td>
            <td class='column23 style73 null'></td>
            <td class='column24 style75 null'></td>
            <td class='column25 style74 null'></td>
            <td class='column26 style86 null'></td>
            <td class='column27 style86 null'></td>
            <td class='column28 style87 null'></td>
          </tr>
          <tr class='row53'>
            <td class='column0 style66 null'></td>
            <td class='column1 style78 s'>Casos </td>
            <td class='column2 style79 null'></td>
            <td class='column3 style79 null'></td>
            <td class='column4 style79 null'></td>
            <td class='column5 style79 null'></td>
            <td class='column6 style79 null'></td>
            <td class='column7 style79 null'></td>
            <td class='column8 style79 null'></td>
            <td class='column9 style79 null'></td>
            <td class='column10 style79 null'></td>
            <td class='column11 style80 null'></td>
            <td class='column12 style81 null'></td>
            <td class='column13 style82 null'></td>
            <td class='column14 style83 null'></td>
            <td class='column15 style84 null'></td>
            <td class='column16 style83 null'></td>
            <td class='column17 style85 null'></td>
            <td class='column18 style85 null'></td>
            <td class='column19 style83 null'></td>
            <td class='column20 style85 null'></td>
            <td class='column21 style85 null'></td>
            <td class='column22 style84 null'></td>
            <td class='column23 style73 null'></td>
            <td class='column24 style75 null'></td>
            <td class='column25 style74 null'></td>
            <td class='column26 style86 null'></td>
            <td class='column27 style86 null'></td>
            <td class='column28 style87 null'></td>
          </tr>
          <tr class='row54'>
            <td class='column0 style66 null'></td>
            <td class='column1 style78 s'>Muertes</td>
            <td class='column2 style79 null'></td>
            <td class='column3 style79 null'></td>
            <td class='column4 style79 null'></td>
            <td class='column5 style79 null'></td>
            <td class='column6 style79 null'></td>
            <td class='column7 style79 null'></td>
            <td class='column8 style79 null'></td>
            <td class='column9 style79 null'></td>
            <td class='column10 style79 null'></td>
            <td class='column11 style80 null'></td>
            <td class='column12 style88 null'></td>
            <td class='column13 style89 null'></td>
            <td class='column14 style90 null'></td>
            <td class='column15 style91 null'></td>
            <td class='column16 style90 null'></td>
            <td class='column17 style92 null'></td>
            <td class='column18 style92 null'></td>
            <td class='column19 style90 null'></td>
            <td class='column20 style92 null'></td>
            <td class='column21 style92 null'></td>
            <td class='column22 style91 null'></td>
            <td class='column23 style90 null'></td>
            <td class='column24 style92 null'></td>
            <td class='column25 style91 null'></td>
            <td class='column26 style93 null'></td>
            <td class='column27 style93 null'></td>
            <td class='column28 style94 null'></td>
          </tr>
          <tr class='row55'>
            <td class='column0 style53 null'></td>
            <td class='column1 style95 s'>Descripcion del Evento</td>
            <td class='column2 style56 null'></td>
            <td class='column3 style96 null'></td>
            <td class='column4 style96 null'></td>
            <td class='column5 style96 null'></td>
            <td class='column6 style96 null'></td>
            <td class='column7 style96 null'></td>
            <td class='column8 style96 null'></td>
            <td class='column9 style96 null'></td>
            <td class='column10 style96 null'></td>
            <td class='column11 style97 null'></td>
            <td class='column12 style51 s style51' colspan='17'>SITUACIONES DE EPIDEMIA</td>
          </tr>
          <tr class='row56'>
            <td class='column0 style98 null'></td>
            <td class='column1 style99 null'></td>
            <td class='column2 style100 null'></td>
            <td class='column3 style100 null'></td>
            <td class='column4 style100 null'></td>
            <td class='column5 style100 null'></td>
            <td class='column6 style101 null'></td>
            <td class='column7 style101 null'></td>
            <td class='column8 style101 null'></td>
            <td class='column9 style101 null'></td>
            <td class='column10 style101 null'></td>
            <td class='column11 style102 null'></td>
            <td class='column12 style60 s'>Fecha de Inicio</td>
            <td class='column13 style60 null'></td>
            <td class='column14 style60 s'>Fecha Fin</td>
            <td class='column15 style61 null'></td>
            <td class='column16 style60 s'>Unidad Geografica </td>
            <td class='column17 style59 null'></td>
            <td class='column18 style62 null'></td>
            <td class='column19 style60 s'>Unidad Sanitaria</td>
            <td class='column20 style62 null'></td>
            <td class='column21 style59 null'></td>
            <td class='column22 style62 null'></td>
            <td class='column23 style63 s'>Enfermedad</td>
            <td class='column24 style62 null'></td>
            <td class='column25 style64 null'></td>
            <td class='column26 style63 s'>Grave</td>
            <td class='column27 style63 s'>Inusitado</td>
            <td class='column28 style65 s'>Nacional</td>
          </tr>
          <tr class='row57'>
            <td class='column0 style103 null'></td>
            <td class='column1 style104 null'></td>
            <td class='column2 style69 null'></td>
            <td class='column3 style69 null'></td>
            <td class='column4 style69 null'></td>
            <td class='column5 style69 null'></td>
            <td class='column6 style69 null'></td>
            <td class='column7 style69 null'></td>
            <td class='column8 style69 null'></td>
            <td class='column9 style69 null'></td>
            <td class='column10 style69 null'></td>
            <td class='column11 style70 null'></td>
            <td class='column12 style105 null'></td>
            <td class='column13 style72 null'></td>
            <td class='column14 style73 null'></td>
            <td class='column15 style74 null'></td>
            <td class='column16 style73 null'></td>
            <td class='column17 style75 null'></td>
            <td class='column18 style75 null'></td>
            <td class='column19 style73 null'></td>
            <td class='column20 style75 null'></td>
            <td class='column21 style75 null'></td>
            <td class='column22 style74 null'></td>
            <td class='column23 style73 null'></td>
            <td class='column24 style75 null'></td>
            <td class='column25 style74 null'></td>
            <td class='column26 style76 null'></td>
            <td class='column27 style76 null'></td>
            <td class='column28 style77 null'></td>
          </tr>
          <tr class='row58'>
            <td class='column0 style103 null'></td>
            <td class='column1 style95 s'>Medidas Tomadas</td>
            <td class='column2 style106 null'></td>
            <td class='column3 style106 null'></td>
            <td class='column4 style106 null'></td>
            <td class='column5 style106 null'></td>
            <td class='column6 style106 null'></td>
            <td class='column7 style106 null'></td>
            <td class='column8 style106 null'></td>
            <td class='column9 style106 null'></td>
            <td class='column10 style106 null'></td>
            <td class='column11 style107 null'></td>
            <td class='column12 style81 null'></td>
            <td class='column13 style82 null'></td>
            <td class='column14 style83 null'></td>
            <td class='column15 style84 null'></td>
            <td class='column16 style83 null'></td>
            <td class='column17 style85 null'></td>
            <td class='column18 style85 null'></td>
            <td class='column19 style83 null'></td>
            <td class='column20 style85 null'></td>
            <td class='column21 style85 null'></td>
            <td class='column22 style84 null'></td>
            <td class='column23 style73 null'></td>
            <td class='column24 style75 null'></td>
            <td class='column25 style74 null'></td>
            <td class='column26 style86 null'></td>
            <td class='column27 style86 null'></td>
            <td class='column28 style87 null'></td>
          </tr>
          <tr class='row59'>
            <td class='column0 style108 null'></td>
            <td class='column1 style109 null'></td>
            <td class='column2 style100 null'></td>
            <td class='column3 style100 null'></td>
            <td class='column4 style110 null'></td>
            <td class='column5 style110 null'></td>
            <td class='column6 style110 null'></td>
            <td class='column7 style110 null'></td>
            <td class='column8 style110 null'></td>
            <td class='column9 style110 null'></td>
            <td class='column10 style110 null'></td>
            <td class='column11 style111 null'></td>
            <td class='column12 style81 null'></td>
            <td class='column13 style82 null'></td>
            <td class='column14 style83 null'></td>
            <td class='column15 style84 null'></td>
            <td class='column16 style83 null'></td>
            <td class='column17 style85 null'></td>
            <td class='column18 style85 null'></td>
            <td class='column19 style83 null'></td>
            <td class='column20 style85 null'></td>
            <td class='column21 style85 null'></td>
            <td class='column22 style84 null'></td>
            <td class='column23 style73 null'></td>
            <td class='column24 style75 null'></td>
            <td class='column25 style74 null'></td>
            <td class='column26 style86 null'></td>
            <td class='column27 style86 null'></td>
            <td class='column28 style87 null'></td>
          </tr>
          <tr class='row60'>
            <td class='column0 style112 null'></td>
            <td class='column1 style104 null'></td>
            <td class='column2 style113 null'></td>
            <td class='column3 style68 null'></td>
            <td class='column4 style69 null'></td>
            <td class='column5 style69 null'></td>
            <td class='column6 style69 null'></td>
            <td class='column7 style69 null'></td>
            <td class='column8 style69 null'></td>
            <td class='column9 style69 null'></td>
            <td class='column10 style69 null'></td>
            <td class='column11 style70 null'></td>
            <td class='column12 style88 null'></td>
            <td class='column13 style89 null'></td>
            <td class='column14 style90 null'></td>
            <td class='column15 style91 null'></td>
            <td class='column16 style90 null'></td>
            <td class='column17 style92 null'></td>
            <td class='column18 style92 null'></td>
            <td class='column19 style90 null'></td>
            <td class='column20 style92 null'></td>
            <td class='column21 style92 null'></td>
            <td class='column22 style91 null'></td>
            <td class='column23 style90 null'></td>
            <td class='column24 style92 null'></td>
            <td class='column25 style91 null'></td>
            <td class='column26 style93 null'></td>
            <td class='column27 style93 null'></td>
            <td class='column28 style94 null'></td>
          </tr>
          <tr class='row61'>
            <td class='column0'>&nbsp;</td>
            <td class='column1'>&nbsp;</td>
            <td class='column2'>&nbsp;</td>
            <td class='column3'>&nbsp;</td>
            <td class='column4'>&nbsp;</td>
            <td class='column5'>&nbsp;</td>
            <td class='column6'>&nbsp;</td>
            <td class='column7'>&nbsp;</td>
            <td class='column8'>&nbsp;</td>
            <td class='column9'>&nbsp;</td>
            <td class='column10'>&nbsp;</td>
            <td class='column11'>&nbsp;</td>
            <td class='column12'>&nbsp;</td>
            <td class='column13'>&nbsp;</td>
            <td class='column14'>&nbsp;</td>
            <td class='column15'>&nbsp;</td>
            <td class='column16'>&nbsp;</td>
            <td class='column17'>&nbsp;</td>
            <td class='column18'>&nbsp;</td>
            <td class='column19'>&nbsp;</td>
            <td class='column20'>&nbsp;</td>
            <td class='column21'>&nbsp;</td>
            <td class='column22'>&nbsp;</td>
            <td class='column23'>&nbsp;</td>
            <td class='column24'>&nbsp;</td>
            <td class='column25'>&nbsp;</td>
            <td class='column26'>&nbsp;</td>
            <td class='column27'>&nbsp;</td>
            <td class='column28'>&nbsp;</td>
          </tr>
	</tbody>
</table>
</div>";
*/	

echo json_encode($table);

exit();

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