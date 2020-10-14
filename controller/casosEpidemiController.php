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

		$id_nacionalidad = mainModel::cleanStringSQL($dataCasosEpidemi['id_nacionalidad']);

		$catalog_key_cie10 = mainModel::cleanStringSQL($dataCasosEpidemi['catalogKeyCIE10']);

		$id_parroquia = mainModel::cleanStringSQL($dataCasosEpidemi['id_parroquia']);
		 
		$direccion = mainModel::cleanStringSQL($dataCasosEpidemi['direccion']);

	 	$telefono = $dataCasosEpidemi['telefonoPart1'].$dataCasosEpidemi['telefonoPart2'].$dataCasosEpidemi['telefonoPart3'];

		 $telefono = mainModel::cleanStringSQL($telefono);

		 $dateRegistercasosEpidemi = mainModel::cleanStringSQL($dataCasosEpidemi['dateRegistercasosEpidemi']);

		$siExistPerson = 0;


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
		
		$queryIsExistcasosEpidemi = mainModel::connectDB()->query("SELECT id_caso_epidemi FROM casos_epidemi WHERE id_nacionalidad = '$id_nacionalidad' AND doc_identidad = '$doc_identidad' AND catalog_key_cie10 = '$catalog_key_cie10' AND fecha_registro = '$dateRegistercasosEpidemi'");

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


			if (!mainModel::checkDate($dateRegistercasosEpidemi)){
			$alert=[
				"Alert"=>"simple",
				"Title"=>"Datos Invalidos",
				"Text"=>"La Fecha de Registro es invalido",
				"Type"=>"error"
			];

				echo json_encode($alert);

				exit();
		}

			if (!self::isValidDateRegistRangeAllowedCaseEpidemi($dateRegistercasosEpidemi)){
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
		 $dateRegistercasosEpidemi)){

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
		$dataCasosEpidemiReady = 
		["id_nacionalidad"=>$id_nacionalidad,
		"doc_identidad"=>$doc_identidad,
		"catalog_key_cie10"=>$catalog_key_cie10,
		"id_parroquia"=>$id_parroquia,
		"direccion"=>$direccion,
		"fecha_registro"=>$dateRegistercasosEpidemi,
		"telefono"=>$telefono
		];


// si no existe la person la validamos
// 

			if(!$siExistPerson){

				$dataPerson = self::$personController->addPersonControllerr($dataCasosEpidemi);
				
				$dataCasosEpidemiReady = array_merge($dataCasosEpidemiReady,$dataPerson);

				$dataCasosEpidemiReady['registerPerson'] = 1;
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

		$dataCasosEpidemiReady = array_merge($dataCasosEpidemiReady,$dataCasosEpidemiBitacora);

			echo casosEpidemiModel::addcasosEpidemiModel($dataCasosEpidemiReady);


				 	
				 }



		public function updatecasosEpidemiController($dataCasosEpidemi){


		 $id_caso_epidemi = mainModel::cleanStringSQL($dataCasosEpidemi['id_caso_epidemi']);
		 $doc_identidad = mainModel::cleanStringSQL($dataCasosEpidemi['doc_identidad']);
		 $catalog_key_cie10 = mainModel::cleanStringSQL($dataCasosEpidemi['catalog_key_cie10']);
		 $id_parroquia = mainModel::cleanStringSQL($dataCasosEpidemi['id_parroquia']);
		 $direccion = mainModel::cleanStringSQL($dataCasosEpidemi['direccion']);
		 $telefono = mainModel::cleanStringSQL($dataCasosEpidemi['telefono']);
		 $dateRegistercasosEpidemi = mainModel::cleanStringSQL($dataCasosEpidemi['dateRegistercasosEpidemi']);


		if (mainModel::isDataEmtpy(
		 $doc_identidad,
		 $catalog_key_cie10,
		 $id_parroquia,
		 $direccion,
		 $telefono,
		 $dateRegistercasosEpidemi)){

			echo "Algo Vacio";

		}else{


		 $dataCasosEpidemi = array();
		 $dataCasosEpidemi['doc_identidad'] = $doc_identidad;
		 $dataCasosEpidemi['id_caso_epidemi'] = $id_caso_epidemi;
		 $dataCasosEpidemi['catalog_key_cie10'] = $catalog_key_cie10;
		 $dataCasosEpidemi['id_parroquia'] = $id_parroquia;
		 $dataCasosEpidemi['direccion'] = $direccion;
		 $dataCasosEpidemi['telefono'] = $telefono;
		 $dataCasosEpidemi['fecha'] = $dateRegistercasosEpidemi;

			echo "<h1>Actualizado</h1>";

			var_dump($dataCasosEpidemi);

			 casosEpidemiModel::updatecasosEpidemiModel($dataCasosEpidemi);


				 	}
				 }
		public function deletecasosEpidemiController($dataCasosEpidemi){
			
		 $id_caso_epidemi = mainModel::cleanStringSQL($dataCasosEpidemi['id_caso_epidemi']);
		 
		 
		 			if (mainModel::isDataEmtpy(
						 $id_caso_epidemi)) {
			 		echo "<h1>id_caso_epidemi VACIO</h1>";
				 	}else{


		 $dataCasosEpidemi = array();

		 $dataCasosEpidemi['id_caso_epidemi'] = $id_caso_epidemi;
		 
			echo "<h1>Eliminado</h1>";

			var_dump($dataCasosEpidemi);

			 casosEpidemiModel::deletecasosEpidemiModel($dataCasosEpidemi);

				 	}

				 }

  public static function getDataTablesCasosEpidemiController() {

  $columnsTable = array(
     'row_number',
    'id_caso_epidemi',
      'id_genero',
      'descripcion_genero',
      'id_nacionalidad_caso',
      'descripcion_nacionalidad',
      'doc_identidad_caso',
    'catalog_key_cie10',
    'nombre_cie10',
    'nombres',
    'apellidos',
    'parroquia',
    'direccion',
    'telefono',
    'fecha_registro',
    'usuario_alias',
     'bitacora_fecha',
     'bitacora_hora' );

    $columnsPrintDataTable = 
array(
     'row_number',
    'id_caso_epidemi',
      'descripcion_genero',
      'descripcion_nacionalidad',
      'doc_identidad_caso',
    'nombres',
    'apellidos',
    'catalog_key_cie10',
    'nombre_cie10',
    'fecha_registro',
    'parroquia',
    'direccion',
    'telefono',
    'usuario_alias',
     'bitacora_fecha',
     'bitacora_hora' );


  try {

    mainModel::connectDB()->query(parent::$queryCreateViewCasosEpidemi);

    $dataToCreateDataTable = mainModel::getDataTableServerSideModel('caso_epidemi_view', 'id_caso_epidemi',
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


        if ($aRow['id_genero'] == '1'){
                  $iconGenero = "male-user.png"; 
                }elseif ($aRow['id_genero'] == "2") {
                  $iconGenero = "fermale-user.png"; 
                }
                   $dataFields = array();

                $dataFields['row_number']=$aRow['row_number'];

                $dataFields['id_caso_epidemi']=$aRow['id_caso_epidemi'];

                 $dataFields['descripcion_genero']= "<span class='d-none'>".$aRow['descripcion_genero']."</span>
                    <img class='img-profile rounded-circle' width='40' src=".SERVERURL."view/img/".$iconGenero.">";

                $dataFields['descripcion_nacionalidad']= $aRow['descripcion_nacionalidad'];

                $dataFields['doc_identidad_caso']= $aRow['doc_identidad_caso'];

                $dataFields['nombres']=$aRow['nombres'];

                $dataFields['apellidos']=$aRow['apellidos'];

                $dataFields['catalog_key_cie10']=$aRow['catalog_key_cie10'];
                $dataFields['nombre_cie10']=$aRow['nombre_cie10'];

                $dataFields['fecha_registro']=$aRow['fecha_registro'];

                $dataFields['parroquia']=$aRow['parroquia'];

                $dataFields['direccion']=$aRow['direccion'];

                $dataFields['telefono']=$aRow['telefono'];

                $dataFields['usuario_alias']=$aRow['usuario_alias'];

                $dataFields['bitacora_fecha']=$aRow['bitacora_fecha'];

                $dataFields['bitacora_hora']=$aRow['bitacora_hora'];

        $row[] = $dataFields[$columnsPrintDataTable[$i]];
            }

        }

        $dataToCreateDataTable['aaData'][] = $row;
    }


    mainModel::connectDB()->query('drop view caso_epidemi_view');

    echo json_encode( $dataToCreateDataTable );

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


}
								
 ?>