<?php 
		// para simular la herencia mediante colaboracion de objetos
		require_once "casosEpidemiController.php";


	if($requestAjax){
		require_once "../model/reportsEpiModel.php";
		require '../vendor_archives/autoload.php';

	}else{
		require_once "./model/reportsEpiModel.php";
		require './vendor_archives/autoload.php';

	}

		use PhpOffice\PhpSpreadsheet\Spreadsheet;
		use PhpOffice\PhpSpreadsheet\Writer\Xlsx;


	class reportsEpiController extends reportsEpiModel{
		
		public static $casosEpidemiController;

		function __construct()
			{

			self::$casosEpidemiController = new casosEpidemiController();
		}


		 public static function getDataReportsEpiFilasDataTables(){

    $columnsTable = array(
      'row_number',
      'nro_fila_report',
      'enfermedad_evento');



$queryifExistView = mainModel::connectDB()->query("SELECT where EXISTS  ( SELECT FROM information_schema.tables WHERE table_name = 'report_epi_filas_view' ) = true");

      if(!$queryifExistView->rowCount()){

    mainModel::connectDB()->query(self::$queryCreateViewReportsEpi);

      }

      //if(!$queryifExistView->rowCount()){
    
      
      //}

    mainModel::getDataTableServerSideModel('report_epi_filas_view', 'row_number',
      $columnsTable);


}

		 public static function getDataReportsEpiFilasConfigsDataTables($dataReportsEpiFilasConfigsDataTables){

		$nro_fila_report = mainModel::cleanStringSQL($dataReportsEpiFilasConfigsDataTables['nro_fila_report']);		 

//mainModel::connectDB()->query("drop view report_epi_filas_configs_view");

  $columnsTable = array(
                      'row_number',
                      'key_cie10_inicio',
                      'key_cie10_final',
                      'descrip_atrib_especial_inicio',
                      'descrip_atrib_especial_final',
                      /*'edad_inicio',
                      'edad_final',
                      'hospital',
                      'tipo_entrada',*/
                      'id_config_epi',
                      'consecutivo_cie10_inicio',
                      'consecutivo_cie10_final',
                      'id_atrib_especial_inicio',
                      'id_atrib_especial_final');

//$queryifExistView = mainModel::connectDB()->query("SELECT where EXISTS  ( SELECT FROM information_schema.tables WHERE table_name = 'report_epi_filas_configs_view' ) = true");

  //    if(!$queryifExistView->rowCount()){
    
    mainModel::connectDB()->query(self::queryCreateViewConfigsReportsEpi($nro_fila_report));
      
//      }

    mainModel::getDataTableServerSideModel('report_epi_filas_configs_view', 'row_number',
      $columnsTable);


}

		public static function addReportFilaEpiController($dataReportEpi){

		$enfermedad_evento = mainModel::cleanStringSQL($dataReportEpi['enfermedad_evento']);		 

		$nro_fila_report = mainModel::cleanStringSQL($dataReportEpi['nro_fila_report']);		 

			 
		if (mainModel::isDataEmtpy(
		 $enfermedad_evento,$nro_fila_report)){

				$alert=[
					"Alert"=>"simple",
					"Title"=>"Campos Vacios",
					"Text"=>"Todos los campos del Reporte EPI son obligatorios",
					"Type"=>"error"
				];

				echo json_encode($alert);

				exit();

		}


				$dataReportEpi =
		["operationType"=>'register',
		"nro_fila_report"=>$nro_fila_report,
		"enfermedad_evento"=>$enfermedad_evento];

			self::msgsValidDataBasicReportEpiFila($dataReportEpi);

//			var_dump($dataReportEpi);
		 reportsEpiModel::addReportEpiFilaModel($dataReportEpi);


				 }

		public static function updateReportEpiFilasController($dataReportEpi){

		$enfermedad_evento = mainModel::cleanStringSQL($dataReportEpi['enfermedad_evento']);		 

		$nro_fila_report = mainModel::cleanStringSQL($dataReportEpi['nro_fila_report']);		 
		
		$nro_fila_report_original = mainModel::cleanStringSQL($dataReportEpi['nro_fila_report_original']);		 

		if (mainModel::isDataEmtpy(
			$nro_fila_report,
		 $enfermedad_evento,$nro_fila_report_original)){

				$alert=[
					"Alert"=>"simple",
					"Title"=>"Campos Vacios",
					"Text"=>"Todos los campos del Reporte EPI son obligatorios",
					"Type"=>"error"
				];

				echo json_encode($alert);

				exit();

		}


				$dataReportEpi =
		["operationType"=>'update',
		"nro_fila_report_original"=>$nro_fila_report_original,
		"nro_fila_report"=>$nro_fila_report,
		"enfermedad_evento"=>$enfermedad_evento];


			self::msgsValidDataBasicReportEpiFila($dataReportEpi);

//			var_dump($dataReportEpi);
		 reportsEpiModel::updateReportEpiFilasModel($dataReportEpi);


				 }

		public static function deleteReportEpiFilasController($dataReportEpi){

		$nro_fila_report = mainModel::cleanStringSQL($dataReportEpi['nro_fila_report']);		 
			 
		if (mainModel::isDataEmtpy($nro_fila_report)){

				$alert=[
					"Alert"=>"simple",
					"Title"=>"Campos Vacios",
					"Text"=>"Datos para la eliminacion no enviados",
					"Type"=>"error"
				];

				echo json_encode($alert);

				exit();

		}


				$dataReportEpi =
		["operationType"=>'delete',
		"nro_fila_report"=>$nro_fila_report];



			self::msgsValidDataBasicReportEpiFila($dataReportEpi);
		 
		 	reportsEpiModel::deleteReportEpiFilasModel($dataReportEpi);

				 }

		public static function addReportEpiFilaConfigController($dataReportEpiConfig){


		$consecutivo_cie10_inicio = mainModel::cleanStringSQL($dataReportEpiConfig['consecutivo_cie10_inicio']);

		$consecutivo_cie10_final = mainModel::cleanStringSQL($dataReportEpiConfig['consecutivo_cie10_final']);

		$id_atrib_especial_inicio = mainModel::cleanStringSQL($dataReportEpiConfig['id_atrib_especial_inicio']);

		$id_atrib_especial_final = mainModel::cleanStringSQL($dataReportEpiConfig['id_atrib_especial_final']);
/*
		$id_tipo_entrada = mainModel::cleanStringSQL($dataReportEpiConfig['id_tipo_entrada_report_epi']);

		$is_hospital = mainModel::cleanStringSQL($dataReportEpiConfig['is_hospital_report_epi']);

		$edad_inicio = mainModel::cleanStringSQL($dataReportEpiConfig['edad_inicio']);

		$edad_final = mainModel::cleanStringSQL($dataReportEpiConfig['edad_final']);
*/

		$nro_fila_report = mainModel::cleanStringSQL($dataReportEpiConfig['nro_fila_report_for_configs']);			 

		if (mainModel::isDataEmtpy(
		$consecutivo_cie10_inicio,
		$consecutivo_cie10_final
  		//$id_tipo_entrada,
		)
		||
		mainModel::isDataEmtpyPermitedZero(		
/*		$edad_inicio,
		$edad_final*/
		$nro_fila_report
	)){

				$alert=[
					"Alert"=>"simple",
					"Title"=>"Campos Vacios",
					"Text"=>"Todos los campos del la Configuracion EPI son obligatorios",
					"Type"=>"error"
				];

				echo json_encode($alert);

				exit();

		}




/*
		$id_tipo_entrada_inicio = mainModel::cleanStringSQL($dataReportEpiConfig['id_tipo_entrada_report_epi']);

		$id_tipo_entrada_final = mainModel::cleanStringSQL($dataReportEpiConfig['id_tipo_entrada_report_epi']);

		$is_hospital_inicio = mainModel::cleanStringSQL($dataReportEpiConfig['is_hospital_report_epi']);

		$is_hospital_final = mainModel::cleanStringSQL($dataReportEpiConfig['is_hospital_report_epi']);

			if ($id_tipo_entrada == 3) {
			$id_tipo_entrada_inicio = 1;
			$id_tipo_entrada_final = 2;
			}

			if ($is_hospital == 3) {
			$is_hospital_inicio = 0;
			$is_hospital_final = 1;
			}
*/


				$dataReportEpiConfig =
		['operationType' =>'register',
		'nro_fila_report' => $nro_fila_report,
		'consecutivo_cie10_inicio' => $consecutivo_cie10_inicio,
		'consecutivo_cie10_final' => $consecutivo_cie10_final,
  		'id_atrib_especial_inicio' => $id_atrib_especial_inicio,
  		'id_atrib_especial_final' => $id_atrib_especial_final
  		/*'id_tipo_entrada' => $id_tipo_entrada,	
		'is_hospital' => $is_hospital,
  		'is_hospital_inicio' => $is_hospital_inicio,	
  		'is_hospital_final' => $is_hospital_final,	
  		'id_tipo_entrada_inicio' => $id_tipo_entrada_inicio,	
  		'id_tipo_entrada_final' => $id_tipo_entrada_final,	
		'edad_inicio' => $edad_inicio,
		'edad_final' => $edad_final*/];


			self::msgsValidDataBasicReportEpiFilaConfigs($dataReportEpiConfig);

		 reportsEpiModel::addReportEpiConfigsModel($dataReportEpiConfig);



				 }

		public static function updateReportEpiConfigController($dataReportEpiConfig){

		$consecutivo_cie10_inicio = mainModel::cleanStringSQL($dataReportEpiConfig['consecutivo_cie10_inicio']);

		$consecutivo_cie10_final = mainModel::cleanStringSQL($dataReportEpiConfig['consecutivo_cie10_final']);

		$id_atrib_especial_inicio = mainModel::cleanStringSQL($dataReportEpiConfig['id_atrib_especial_inicio']);

		$id_atrib_especial_final = mainModel::cleanStringSQL($dataReportEpiConfig['id_atrib_especial_final']);

/*
		$id_tipo_entrada = mainModel::cleanStringSQL($dataReportEpiConfig['id_tipo_entrada_report_epi']);

		$is_hospital = mainModel::cleanStringSQL($dataReportEpiConfig['is_hospital_report_epi']);

		$edad_inicio = mainModel::cleanStringSQL($dataReportEpiConfig['edad_inicio']);

		$edad_final = mainModel::cleanStringSQL($dataReportEpiConfig['edad_final']);

*/

		$id_config_epi = mainModel::cleanStringSQL($dataReportEpiConfig['id_config_epi']);

		$nro_fila_report = mainModel::cleanStringSQL($dataReportEpiConfig['nro_fila_report_for_configs']);			 

		if (mainModel::isDataEmtpy(
		$consecutivo_cie10_inicio,
		$consecutivo_cie10_final,
  	//	$id_tipo_entrada,
		$id_config_epi
	)
		||
		mainModel::isDataEmtpyPermitedZero(		
/*	$is_hospital,
		$edad_inicio,
		$edad_final*/$nro_fila_report)){

				$alert=[
					"Alert"=>"simple",
					"Title"=>"Campos Vacios",
					"Text"=>"Todos los campos del la Configuracion EPI son obligatorios",
					"Type"=>"error"
				];

				echo json_encode($alert);

				exit();

		}

/*


		$id_tipo_entrada_inicio = mainModel::cleanStringSQL($dataReportEpiConfig['id_tipo_entrada_report_epi']);

		$id_tipo_entrada_final = mainModel::cleanStringSQL($dataReportEpiConfig['id_tipo_entrada_report_epi']);

		$is_hospital_inicio = mainModel::cleanStringSQL($dataReportEpiConfig['is_hospital_report_epi']);

		$is_hospital_final = mainModel::cleanStringSQL($dataReportEpiConfig['is_hospital_report_epi']);

			if ($id_tipo_entrada == 3) {
			$id_tipo_entrada_inicio = 1;
			$id_tipo_entrada_final = 2;
			}

			if ($is_hospital == 3) {
			$is_hospital_inicio = 0;
			$is_hospital_final = 1;
			}
*/


				$dataReportEpiConfig =
		['operationType' =>'update',
		'id_config_epi' => $id_config_epi,
		'nro_fila_report' => $nro_fila_report,
		'consecutivo_cie10_inicio' => $consecutivo_cie10_inicio,
		'consecutivo_cie10_final' => $consecutivo_cie10_final,
  		'id_atrib_especial_inicio' => $id_atrib_especial_inicio,
  		'id_atrib_especial_final' => $id_atrib_especial_final,
  		/*'id_tipo_entrada' => $id_tipo_entrada,	
		'is_hospital' => $is_hospital,
  		'is_hospital_inicio' => $is_hospital_inicio,	
  		'is_hospital_final' => $is_hospital_final,	
  		'id_tipo_entrada_inicio' => $id_tipo_entrada_inicio,	
  		'id_tipo_entrada_final' => $id_tipo_entrada_final,
		'edad_inicio' => $edad_inicio,
		'edad_final' => $edad_final*/];

			self::msgsValidDataBasicReportEpiFilaConfigs($dataReportEpiConfig);


			//var_dump($dataReportEpiConfig);
		 reportsEpiModel::updateReportEpiConfigsModel($dataReportEpiConfig);



				 }


		public static function deleteReportEpiFilaConfigController($dataReportEpiConfig){

		$id_config_epi = mainModel::cleanStringSQL($dataReportEpiConfig['id_config_epi']);		 

		$nro_fila_report = mainModel::cleanStringSQL($dataReportEpiConfig['nro_fila_report_for_configs']);		 
			 
		if (mainModel::isDataEmtpy($id_config_epi,$nro_fila_report)){

				$alert=[
					"Alert"=>"simple",
					"Title"=>"Campos Vacios",
					"Text"=>"Datos para la eliminacion no enviados",
					"Type"=>"error"
				];

				echo json_encode($alert);

				exit();

		}

//nro_fila_report
				$dataReportEpiConfig =
		["operationType"=>'delete',
		"nro_fila_report"=>$nro_fila_report,
		"id_config_epi"=>$id_config_epi];



			self::msgsValidDataBasicReportEpiFilaConfigs($dataReportEpiConfig);
		 
		 	reportsEpiModel::deleteReportEpiFilaConfigsModel($dataReportEpiConfig);

		 }
		protected static function msgsValidDataBasicReportEpiFilaConfigs($dataReportEpiConfig){

			extract($dataReportEpiConfig);

     		session_start(['name'=>'dptoEpidemi']);	


		if ($operationType == "register" || $operationType == 'update' || $operationType == 'delete' ){


			if ($_SESSION['id_nivel_permiso'] != '1' && $_SESSION['id_nivel_permiso'] != '2') {


							$alert=[
								"Alert"=>"simple",
								"Title"=>"Permiso Denegado",
								"Text"=>"Esta operacion no es permitida",
								"Type"=>"error"
							];

							echo json_encode($alert);

							exit();

			}

			if(!is_numeric($nro_fila_report) || $nro_fila_report ===  false || $nro_fila_report < 0){

		            $alert=[
		              "Alert"=>"simple",
		              "Title"=>"Datos Invalidos",
		              "Text"=>"El id Reporte es invalido",
		              "Type"=>"error"
		            ];

		              echo json_encode($alert);

		              exit();
		        }



		}

		$queryGetIdFilaReport = mainModel::connectDB()->query("SELECT id_report_fila FROM report_epi_filas WHERE nro_fila_report = '$nro_fila_report'  LIMIT 1");
		
		$id_report_fila = $queryGetIdFilaReport->fetchColumn();


			if ( intval($id_report_fila) === 0) {

		            $alert=[
		              "Alert"=>"simple",
		              "Title"=>"Operacion Invalida",
		              "Text"=>"Esta Fila es por Defecto, No se puede Editar Su Configuracion",
		              "Type"=>"error"
		            ];
		
				echo json_encode($alert);

				exit();

			}

		if ($operationType == "register" || $operationType == 'update'  ) {

			if(!is_numeric($nro_fila_report) || $nro_fila_report == 0){

		            $alert=[
		              "Alert"=>"simple",
		              "Title"=>"Datos Invalidos",
		              "Text"=>"El Nro de Fila es invalido",
		              "Type"=>"error"
		            ];

		              echo json_encode($alert);

		              exit();
		        }
/*

			if(!is_numeric($is_hospital) || $is_hospital < 0 || $is_hospital > 3){

		            $alert=[
		              "Alert"=>"simple",
		              "Title"=>"Datos Invalidos",
		              "Text"=>"El Campo Hospitalizado es invalido",
		              "Type"=>"error"
		            ];

		              echo json_encode($alert);

		              exit();
		        }


			if(!is_numeric($id_tipo_entrada) || $id_tipo_entrada < 0 || $id_tipo_entrada > 3){

		            $alert=[
		              "Alert"=>"simple",
		              "Title"=>"Datos Invalidos",
		              "Text"=>"El Campo Tipo Entrada es invalido",
		              "Type"=>"error"
		            ];

		              echo json_encode($alert);

		              exit();
		        }
*/
			if(!is_numeric($consecutivo_cie10_inicio) || $consecutivo_cie10_inicio < 0
			|| !is_numeric($consecutivo_cie10_final) || $consecutivo_cie10_final < 0
		){

		            $alert=[
		              "Alert"=>"simple",
		              "Title"=>"Datos Invalidos",
		              "Text"=>"El Campo Clave Catalogo es invalido",
		              "Type"=>"error"
		            ];

		              echo json_encode($alert);

		              exit();
		        }


		if($consecutivo_cie10_inicio > $consecutivo_cie10_final || $consecutivo_cie10_final < $consecutivo_cie10_inicio){

				$alert=[
				"Alert"=>"simple",
				"Title"=>"Datos Invalidos",
				"Text"=>"El codigo de catalogo CIE-10 Inicio es Mayor 
							al codigo Final o Viceversa",
				"Type"=>"error"
			];

				echo json_encode($alert);

				exit();

			}
/*

			if(!is_numeric($edad_inicio) || $edad_inicio < 0 || $edad_inicio > 200 ||
				!is_numeric($edad_final) || $edad_final < 0 || $edad_final > 200){
				$alert=[
				"Alert"=>"simple",
				"Title"=>"Datos Invalidos",
				"Text"=>"Algun Campo Edad es Invalido",
				"Type"=>"error"
			];

				echo json_encode($alert);

				exit();

			}


		if($edad_inicio > $edad_final || $edad_final < $edad_inicio){

				$alert=[
				"Alert"=>"simple",
				"Title"=>"Datos Invalidos",
				"Text"=>"La Edad Inicio es Mayor 
							al Final o Viceversa",
				"Type"=>"error"
			];

				echo json_encode($alert);

				exit();

			}*/


 $queryIsExistReportEpiConfig = 'SELECT nro_fila_report, consecutivo_cie10_inicio, nro_fila_report, id_atrib_especial_inicio, consecutivo_cie10_final, id_atrib_especial_final
        FROM  report_epi_filas_configs
         WHERE nro_fila_report = '.$nro_fila_report.' 
         AND consecutivo_cie10_inicio = '.$consecutivo_cie10_inicio.' 
         AND nro_fila_report = '.$nro_fila_report.' 
         AND id_atrib_especial_inicio = '.$id_atrib_especial_inicio.' 
         AND consecutivo_cie10_final = '.$consecutivo_cie10_final.' 
         AND id_atrib_especial_final = '.$id_atrib_especial_final.' ';


$alertIsExistReportEpiConfig =[
				"Alert"=>"simple",
				"Title"=>"Datos Duplicados",
				"Text"=>"Ya Existe una Configuracion EPI con estos Parametros:<br>
					(Nro fila reporte,<br>
					Evento cie10 inicio,<br>
					Evento cie10 final,<br>
					Atributo especial inicio,<br>
					Atributo especial final)
				",
				"Type"=>"error"
			];
			
			}
		

		if ($operationType == "delete" || $operationType == 'update' ) {

			if(!is_numeric($id_config_epi) || $id_config_epi == 0){

		            $alert=[
		              "Alert"=>"simple",
		              "Title"=>"Datos Invalidos",
		              "Text"=>"El Nro de Fila es invalido",
		              "Type"=>"error"
		            ];

		              echo json_encode($alert);

		              exit();
		        }
		    }

		if ($operationType == "register") {

		$queryIsExistReportEpiConfig = mainModel::connectDB()->query($queryIsExistReportEpiConfig);

if ($queryIsExistReportEpiConfig->rowCount()) {
	
echo json_encode($alertIsExistReportEpiConfig);

exit();
}

		}

		if ($operationType == "update") {

				$queryIsExistReportEpiConfig = mainModel::connectDB()->query($queryIsExistReportEpiConfig. ' AND id_config_epi = '.$id_config_epi.' ');

				if ($queryIsExistReportEpiConfig->rowCount()) {

				echo json_encode($alertIsExistReportEpiConfig);

				exit();
				}

		}

}


		protected static function msgsValidDataBasicReportEpiFila($dataReportEpi){

			extract($dataReportEpi);

     		session_start(['name'=>'dptoEpidemi']);	

		$queryGetIdFilaReport = mainModel::connectDB()->query("SELECT id_report_fila FROM report_epi_filas WHERE nro_fila_report = '$nro_fila_report'  LIMIT 1");

		$id_report_fila = $queryGetIdFilaReport->fetchColumn();

		if ($operationType == "register" || $operationType == 'update' || $operationType == 'delete' ){

			if ($_SESSION['id_nivel_permiso'] != '1' && $_SESSION['id_nivel_permiso'] != '2') {


							$alert=[
								"Alert"=>"simple",
								"Title"=>"Permiso Denegado",
								"Text"=>"Esta operacion no es permitida",
								"Type"=>"error"
							];

							echo json_encode($alert);

							exit();

			}


		}

		if ($operationType == "register" || $operationType == 'update'  ) {

		if(strlen($enfermedad_evento)<2 || strlen($enfermedad_evento)>100){

				$alert=[
				"Alert"=>"simple",
				"Title"=>"Datos Invalidos",
				"Text"=>"Logintud nombre del reporte invalido, debe tener:
					<br>
					Entre 2 y 100 caracteres",
				"Type"=>"error"
			];

				echo json_encode($alert);

				exit();

			}
			
			}

		

		if ($operationType == "delete" || $operationType == 'update' ) {

			if(!is_numeric($nro_fila_report) || $nro_fila_report == 0){

		            $alert=[
		              "Alert"=>"simple",
		              "Title"=>"Datos Invalidos",
		              "Text"=>"El Nro de Fila Reporte es invalido",
		              "Type"=>"error"
		            ];

		              echo json_encode($alert);

		              exit();
		        }

		}


		if ($operationType == "register") {

		$queryIsExistReportEpi = mainModel::connectDB()->query("SELECT enfermedad_evento FROM report_epi_filas WHERE enfermedad_evento = '$enfermedad_evento' OR nro_fila_report = '$nro_fila_report' LIMIT 1");

			if($queryIsExistReportEpi->rowCount()){
			$alert=[
				"Alert"=>"simple",
				"Title"=>"Datos Invalidos",
				"Text"=>"El Nombre o Nro de Fila Reporte EPI ya Existe",
				"Type"=>"error"
			];

				echo json_encode($alert);

				exit();
			}

		}

		if ($operationType == "update") {


		$queryIsExistReportEpi = mainModel::connectDB()->query("SELECT enfermedad_evento FROM report_epi_filas WHERE enfermedad_evento = '$enfermedad_evento' AND nro_fila_report != $nro_fila_report AND nro_fila_report != $nro_fila_report_original  LIMIT 1");


			if($queryIsExistReportEpi->rowCount()){

			$alert=[
				"Alert"=>"simple",
				"Title"=>"Datos Invalidos",
				"Text"=>"El Nombre o Nro de Fila ya esta ocupado por otra Fila del Reporte EPI",
				"Type"=>"error"
			];

				echo json_encode($alert);

				exit();
			}


if ($nro_fila_report_original != $nro_fila_report) {

		$queryIsExistReportEpi = mainModel::connectDB()->query("SELECT enfermedad_evento FROM report_epi_filas WHERE nro_fila_report = '$nro_fila_report'  LIMIT 1");




			if($queryIsExistReportEpi->rowCount()){
			$alert=[
				"Alert"=>"simple",
				"Title"=>"Datos Invalidos",
				"Text"=>"El Nombre o Nro de Fila ya esta ocupado por otra Fila del Reporte EPI",
				"Type"=>"error"
			];

				echo json_encode($alert);

				exit();
			}

		}


			if ( $id_report_fila === 0 && strcmp($enfermedad_evento,"PACIENTES HOSPITALIZADOS O REFERIDOS PARA HOSPITALIZACION") != 0) {

		            $alert=[
		              "Alert"=>"simple",
		              "Title"=>"Operacion Invalida",
		              "Text"=>"Esta Fila ($nro_fila_report, PACIENTES HOSPITALIZADOS O REFERIDOS PARA HOSPITALIZACION), es por Defecto, No se puede Editar Su Descripcion",
		              "Type"=>"error"
		            ];

		              echo json_encode($alert);

		              exit();
		        }



	}


 //&& 
		if ($operationType == "delete") {
		
			if ( intval($id_report_fila === 0)) {

		            $alert=[
		              "Alert"=>"simple",
		              "Title"=>"Operacion Invalida",
		              "Text"=>"Esta Fila($nro_fila_report, PACIENTES HOSPITALIZADOS O REFERIDOS PARA HOSPITALIZACION),  es por Defecto, No se puede Eliminar",
		              "Type"=>"error"
		            ];

		              echo json_encode($alert);

		              exit();
		        }

		}

}

	public static function getDataSimpleReportEpiFila($nro_fila_report){

			// no tiene_documento de identidad busca por num
		
				$queryDataSimpleReportEpiFila = mainModel::connectDB()->query("SELECT nro_fila_report,enfermedad_evento FROM report_epi_filas where nro_fila_report = $nro_fila_report");


				return $queryDataSimpleReportEpiFila;

			}

	public static function getDataSimpleAtribEspecialEpi($id_atrib_especial){

			// no tiene_documento de identidad busca por num
		
				$queryDataSimpleAtribEspecial = mainModel::connectDB()->query("SELECT id_atrib_especial,descripcion FROM atribs_especials_epi where id_atrib_especial = $id_atrib_especial");


				return $queryDataSimpleAtribEspecial;

			}


		 public static function getDataAtribsEspecialsEpiDataTables($dataAtribsEspecialsEpiDataTables){
	
//mainModel::connectDB()->query("drop view atribs_especials_epi_view");

  $columnsTable = array('row_number','id_atrib_especial',
                      'descripcion');

$queryifExistView = mainModel::connectDB()->query("SELECT where EXISTS  ( SELECT FROM information_schema.tables WHERE table_name = 'atribs_especials_epi_view' ) = true");

      if(!$queryifExistView->rowCount()){
    
    mainModel::connectDB()->query(self::$queryCreateViewAtribsEspecialsEpi);
      
     }

    mainModel::getDataTableServerSideModel('atribs_especials_epi_view', 'row_number',
      $columnsTable);


}


		public static function addAtribEspecialEpiController($dataAtribEspecialEpi){

		$id_atrib_especial = mainModel::cleanStringSQL($dataAtribEspecialEpi['nro_atrib_especial']);		 

		$descrip_atrib_especial = mainModel::cleanStringSQL($dataAtribEspecialEpi['descrip_atrib_especial']);		 
			 
		if (mainModel::isDataEmtpy(
		 $descrip_atrib_especial) || mainModel::isDataEmtpyPermitedZero($id_atrib_especial)){

				$alert=[
					"Alert"=>"simple",
					"Title"=>"Campos Vacios",
					"Text"=>"Todos los campos de Atributo Especial EPI son obligatorios",
					"Type"=>"error"
				];

				echo json_encode($alert);

				exit();

		}


				$dataAtribEspecialEpi =
		["operationType"=>'register',
		"id_atrib_especial"=>$id_atrib_especial,
		"descrip_atrib_especial"=>$descrip_atrib_especial];

			self::msgsValidDataBasicAtribEspecialEpiFila($dataAtribEspecialEpi);

//			var_dump($dataAtribEspecialEpi);
		 reportsEpiModel::addAtribEspecialReportEpiModel($dataAtribEspecialEpi);


				 }

		public static function updateAtribEspecialEpiController($dataAtribEspecialEpi){

		$id_atrib_especial_original = mainModel::cleanStringSQL($dataAtribEspecialEpi['id_atrib_especial_original']);		 

		$id_atrib_especial = mainModel::cleanStringSQL($dataAtribEspecialEpi['nro_atrib_especial']);		 

		$descrip_atrib_especial = mainModel::cleanStringSQL($dataAtribEspecialEpi['descrip_atrib_especial']);		 
			 
		if (mainModel::isDataEmtpy(
		 $descrip_atrib_especial) || mainModel::isDataEmtpyPermitedZero($id_atrib_especial)){

				$alert=[
					"Alert"=>"simple",
					"Title"=>"Campos Vacios",
					"Text"=>"Todos los campos del Atributo Especial EPI son obligatorios",
					"Type"=>"error"
				];

				echo json_encode($alert);

				exit();

		}


				$dataAtribEspecialEpi =
		["operationType"=>'update',
		"id_atrib_especial_original"=>$id_atrib_especial_original,
		"id_atrib_especial"=>$id_atrib_especial,
		"descrip_atrib_especial"=>$descrip_atrib_especial];


			self::msgsValidDataBasicAtribEspecialEpiFila($dataAtribEspecialEpi);

//			var_dump('msgsValidDataBasicAtribEspecialEpiFila');

			 reportsEpiModel::updateAtribEspecialReportEpiModel($dataAtribEspecialEpi);


				 }

		public static function deleteAtribEspecialEpiController($dataAtribEspecialEpi){

		$id_atrib_especial = mainModel::cleanStringSQL($dataAtribEspecialEpi['id_atrib_especial']);		 
			 
		if (mainModel::isDataEmtpyPermitedZero($id_atrib_especial)){

				$alert=[
					"Alert"=>"simple",
					"Title"=>"Campos Vacios",
					"Text"=>"Datos para la eliminacion no enviados",
					"Type"=>"error"
				];

				echo json_encode($alert);

				exit();

		}


				$dataAtribEspecialEpi =
		["operationType"=>'delete',
		"id_atrib_especial"=>$id_atrib_especial];



			self::msgsValidDataBasicAtribEspecialEpiFila($dataAtribEspecialEpi);
		 
		 	reportsEpiModel::deleteAtribEspecialReportEpiModel($dataAtribEspecialEpi);

		}


		protected static function msgsValidDataBasicAtribEspecialEpiFila($dataAtribEspecialEpi){


			extract($dataAtribEspecialEpi);

     		session_start(['name'=>'dptoEpidemi']);	


		if ($operationType == "register" || $operationType == 'update' || $operationType == 'delete' ){

			if ($_SESSION['id_nivel_permiso'] != '1' && $_SESSION['id_nivel_permiso'] != '2') {


							$alert=[
								"Alert"=>"simple",
								"Title"=>"Permiso Denegado",
								"Text"=>"Esta operacion no es permitida",
								"Type"=>"error"
							];

							echo json_encode($alert);

							exit();

			}	

			if(!is_numeric($id_atrib_especial) || $id_atrib_especial < 0 || $id_atrib_especial === false ){

		            $alert=[
		              "Alert"=>"simple",
		              "Title"=>"Datos Invalidos",
		              "Text"=>"El Nro del Atributo Especial EPI es invalido",
		              "Type"=>"error"
		            ];

		              echo json_encode($alert);

		              exit();
		        }

			if ( intval($id_atrib_especial) === 0) {

		            $alert=[
		              "Alert"=>"simple",
		              "Title"=>"Operacion Invalida",
		              "Text"=>"Este Atributo es por defecto, No se puede Editar Su Configuracion",
		              "Type"=>"error"
		            ];
		
				echo json_encode($alert);

				exit();

			}


		}

		if ($operationType == "register" || $operationType == 'update'  ) {

		if(strlen($descrip_atrib_especial)<2 || strlen($descrip_atrib_especial)>60){

				$alert=[
				"Alert"=>"simple",
				"Title"=>"Datos Invalidos",
				"Text"=>"Logintud nombre del Atributo Especial EPI invalido, debe tener:
					<br>
					Entre 2 y 60 caracteres",
				"Type"=>"error"
			];

				echo json_encode($alert);

				exit();

			}
			

			}

		

		if ($operationType == "delete" || $operationType == 'update' ) {


		}

		if ($operationType == "register") {

		$queryIsExistReportEpi = mainModel::connectDB()->query("SELECT descripcion FROM atribs_especials_epi WHERE descripcion = '$descrip_atrib_especial' OR id_atrib_especial = '$id_atrib_especial' LIMIT 1");

			if($queryIsExistReportEpi->rowCount()){
			$alert=[
				"Alert"=>"simple",
				"Title"=>"Datos Invalidos",
				"Text"=>"El Nombre o Nro Atributo Especial EPI ya Existe",
				"Type"=>"error"
			];

				echo json_encode($alert);

				exit();
			}

		}

		if ($operationType == "update") {


		$queryIsExistAtribEspecial = mainModel::connectDB()->query("SELECT descripcion FROM atribs_especials_epi WHERE descripcion = '$descrip_atrib_especial' AND id_atrib_especial != $id_atrib_especial_original LIMIT 1");

			if($queryIsExistAtribEspecial->rowCount()){
			$alert=[
				"Alert"=>"simple",
				"Title"=>"Datos Invalidos",
				"Text"=>"El Nombre o Nro de Fila ya esta ocupado por otra Nro Atributo Especial EPI",
				"Type"=>"error"
			];

				echo json_encode($alert);

				exit();
			}


		if ($id_atrib_especial_original != $id_atrib_especial) {

			$queryIsExistReportEpi = mainModel::connectDB()->query("SELECT id_atrib_especial FROM atribs_especials_epi WHERE id_atrib_especial = '$id_atrib_especial'  LIMIT 1");

				if($queryIsExistReportEpi->rowCount()){
					
				$alert=[
					"Alert"=>"simple",
					"Title"=>"Datos Invalidos",
					"Text"=>"El Nombre o Nro de Fila ya esta ocupado por otra Nro Atributo Especial EPI",
					"Type"=>"error"
				];

					echo json_encode($alert);

					exit();
				}

			}
		}

	}




		 public static function getDataAtribsEspecialsEpiConfigsDataTables($dataAtribsEspecialsEpiDataTables){
	
//mainModel::connectDB()->query("drop view atribs_especials_configs_epi_view");

		$id_atrib_especial = mainModel::cleanStringSQL($dataAtribsEspecialsEpiDataTables['id_atrib_especial']);		 

  $columnsTable = array(
                      'row_number',
                      'key_cie10_inicio',
                      'key_cie10_final',
                      'id_config',
                      'consecutivo_cie10_inicio',
                      'consecutivo_cie10_final');


/*$queryifExistView = mainModel::connectDB()->query("SELECT where EXISTS  ( SELECT FROM information_schema.tables WHERE table_name = 'atribs_especials_configs_epi_view' ) = true");

      if(!$queryifExistView->rowCount()){
  */  
    mainModel::connectDB()->query(self::queryCreateViewAtribsEspecialsConfigsEpi($id_atrib_especial));
      
    // }

    mainModel::getDataTableServerSideModel('atribs_especials_configs_epi_view', 'row_number',
      $columnsTable);


}


		public static function addAtribEspecialEpiConfigsController($dataAtribEspecialEpi){

		$id_atrib_especial = mainModel::cleanStringSQL($dataAtribEspecialEpi['id_atrib_especial_for_configs']);		 

		$consecutivo_cie10_inicio = mainModel::cleanStringSQL($dataAtribEspecialEpi['consecutivo_cie10_inicio_for_atribs_especial']);		 			 
		$consecutivo_cie10_final = mainModel::cleanStringSQL($dataAtribEspecialEpi['consecutivo_cie10_final_for_atribs_especial']);		 

		if (mainModel::isDataEmtpy($consecutivo_cie10_inicio,$consecutivo_cie10_final) || mainModel::isDataEmtpyPermitedZero($id_atrib_especial)){

				$alert=[
					"Alert"=>"simple",
					"Title"=>"Campos Vacios",
					"Text"=>"Todos los campos de la Configuracion Atributo Especial EPI son obligatorios",
					"Type"=>"error"
				];

				echo json_encode($alert);

				exit();

		}


				$dataAtribEspecialEpi =
		["operationType"=>'register',
		"consecutivo_cie10_inicio"=>$consecutivo_cie10_inicio,
		"consecutivo_cie10_final"=>$consecutivo_cie10_final,
		"id_atrib_especial"=>$id_atrib_especial];

			self::msgsValidDataBasicAtribEspecialEpiConfig($dataAtribEspecialEpi);

//			var_dump($dataAtribEspecialEpi);
		 reportsEpiModel::addAtribEspecialReportEpiConfigModel($dataAtribEspecialEpi);



				 }

		public static function updateAtribEspecialEpiConfigsController($dataAtribEspecialEpi){

		$id_atrib_especial = mainModel::cleanStringSQL($dataAtribEspecialEpi['id_atrib_especial_for_configs']);		 

		$id_config_atrib_especial = mainModel::cleanStringSQL($dataAtribEspecialEpi['id_config_atrib_especial']);		 

		$consecutivo_cie10_inicio = mainModel::cleanStringSQL($dataAtribEspecialEpi['consecutivo_cie10_inicio_for_atribs_especial']);		 			 
		$consecutivo_cie10_final = mainModel::cleanStringSQL($dataAtribEspecialEpi['consecutivo_cie10_final_for_atribs_especial']);		 

		if (mainModel::isDataEmtpy($consecutivo_cie10_inicio,$consecutivo_cie10_final,$id_config_atrib_especial) || mainModel::isDataEmtpyPermitedZero($id_atrib_especial)){

				$alert=[
					"Alert"=>"simple",
					"Title"=>"Campos Vacios",
					"Text"=>"Todos los campos de la Configuracion Atributo Especial EPI son obligatorios",
					"Type"=>"error"
				];

				echo json_encode($alert);

				exit();

		}


				$dataAtribEspecialEpi =
		["operationType"=>'register',
		"id_config_atrib_especial"=>$id_config_atrib_especial,
		"consecutivo_cie10_inicio"=>$consecutivo_cie10_inicio,
		"consecutivo_cie10_final"=>$consecutivo_cie10_final,
		"id_atrib_especial"=>$id_atrib_especial];

			self::msgsValidDataBasicAtribEspecialEpiConfig($dataAtribEspecialEpi);

//			var_dump($dataAtribEspecialEpi);
		 reportsEpiModel::updateAtribEspecialReportEpiConfigModel($dataAtribEspecialEpi);


				 }

		public static function deleteAtribEspecialEpiConfigsController($dataAtribEspecialEpi){

		$id_atrib_especial = mainModel::cleanStringSQL($dataAtribEspecialEpi['id_atrib_especial_for_configs']);		 

		$id_config_atrib_especial = mainModel::cleanStringSQL($dataAtribEspecialEpi['id_config_atrib_especial']);		 

		if (mainModel::isDataEmtpy($id_config_atrib_especial) || mainModel::isDataEmtpyPermitedZero($id_atrib_especial)){

				$alert=[
					"Alert"=>"simple",
					"Title"=>"Campos Vacios",
					"Text"=>"Datos para la eliminacion no enviados",
					"Type"=>"error"
				];

				echo json_encode($alert);

				exit();

		}


				$dataAtribEspecialEpi =
		["operationType"=>'delete',
		"id_atrib_especial"=>$id_atrib_especial,
		"id_config_atrib_especial"=>$id_config_atrib_especial];



			self::msgsValidDataBasicAtribEspecialEpiConfig($dataAtribEspecialEpi);
		 
		 	reportsEpiModel::deleteAtribEspecialReportEpiConfigModel($dataAtribEspecialEpi);

		}


		protected static function msgsValidDataBasicAtribEspecialEpiConfig($dataAtribEspecialEpiConfig){

			extract($dataAtribEspecialEpiConfig);

     		session_start(['name'=>'dptoEpidemi']);	


		if ($operationType == "register" || $operationType == 'update' || $operationType == 'delete' ){

			if ($_SESSION['id_nivel_permiso'] != '1' && $_SESSION['id_nivel_permiso'] != '2') {


							$alert=[
								"Alert"=>"simple",
								"Title"=>"Permiso Denegado",
								"Text"=>"Esta operacion no es permitida",
								"Type"=>"error"
							];

							echo json_encode($alert);

							exit();

			}	

			if(!is_numeric($id_atrib_especial) || $id_atrib_especial < 0){

		            $alert=[
		              "Alert"=>"simple",
		              "Title"=>"Datos Invalidos",
		              "Text"=>"El Nro del Atributo Especial EPI es invalido",
		              "Type"=>"error"
		            ];

		              echo json_encode($alert);

		              exit();		
		        }


			if ( intval($id_atrib_especial) === 0) {

		            $alert=[
		              "Alert"=>"simple",
		              "Title"=>"Operacion Invalida",
		              "Text"=>"Este Atributo es por defecto, No se puede Editar Su Configuracion",
		              "Type"=>"error"
		            ];
		
				echo json_encode($alert);

				exit();

			}



		}

		if ($operationType == "register" || $operationType == 'update'  ) {
			
			}

		

		if ($operationType == "delete" || $operationType == 'update' ) {

			
			if(!is_numeric($id_config_atrib_especial) || $id_config_atrib_especial <= 0){

		            $alert=[
		              "Alert"=>"simple",
		              "Title"=>"Datos Invalidos",
		              "Text"=>"El id Configuracion del Atributo Especial EPI es invalido",
		              "Type"=>"error"
		            ];

		              echo json_encode($alert);

		              exit();		
		        }

		}

			$alertIsExistAtribEspecialConfig =[
							"Alert"=>"simple",
							"Title"=>"Datos Duplicados",
							"Text"=>"Ya Existe una Configuracion de Atributos Especiales EPI con estos Parametros:<br>
								(Atributo especial<br>
								Evento cie10 inicio,<br>
								Evento cie10 final)
							",
							"Type"=>"error"
						];

		if ($operationType == "register") {

		$queryIsExistAtribEspecialConfig = mainModel::connectDB()->query("SELECT id_config FROM atribs_especials_epi_configs WHERE 
			 id_atrib_especial = $id_atrib_especial AND consecutivo_cie10_inicio = $consecutivo_cie10_inicio  AND consecutivo_cie10_final = $consecutivo_cie10_final  LIMIT 1");

			if($queryIsExistAtribEspecialConfig->rowCount()){
		
				echo json_encode($alertIsExistAtribEspecialConfig);

				exit();
			}

		}

		if ($operationType == "update") {

		$queryIsExistAtribEspecialConfig = mainModel::connectDB()->query("SELECT id_config FROM atribs_especials_epi_configs WHERE 
			 id_atrib_especial = $id_atrib_especial AND consecutivo_cie10_inicio = $consecutivo_cie10_inicio  AND consecutivo_cie10_final = $consecutivo_cie10_final  AND id_config != $id_config_atrib_especial AND LIMIT 1");

			if($queryIsExistAtribEspecialConfig->rowCount()){

				echo json_encode($alertIsExistAtribEspecialConfig);

				exit();
			}

		}


	}


		public static function getDataTablesEPIController($dataEpi){

				$siRequestNewViewTableCasosEpidemi = false;


		$dataCache = array();

				$dataCache['minDateRange'] = mainModel::cleanStringSQL($_GET['minDateRange']);

				 $dataCache['maxDateRange'] = mainModel::cleanStringSQL($_GET['maxDateRange']);



		if (!isset($_SESSION['maxDateRange']) || !isset($_SESSION['minDateRange']) || (strcmp($_SESSION['maxDateRange'], $_GET['maxDateRange']) != 0) || (strcmp($_SESSION['minDateRange'], $_GET['minDateRange']) != 0)) {
				$_SESSION['minDateRange'] = mainModel::cleanStringSQL($_GET['minDateRange']);

				 $_SESSION['maxDateRange'] = mainModel::cleanStringSQL($_GET['maxDateRange']);

				$dataCache['maxDateRange'] = $_SESSION['maxDateRange'];

				$dataCache['minDateRange'] = $_SESSION['minDateRange'];

				$siRequestNewViewTableCasosEpidemi = true;

		}	# code...
		


$queryifExistView = mainModel::connectDB()->query("SELECT where EXISTS  ( SELECT FROM information_schema.tables WHERE table_name = 'caso_epidemi_view' ) = true");


			if(!$queryifExistView->rowCount() || $siRequestNewViewTableCasosEpidemi){ 
    		
    		mainModel::connectDB()->query(self::$casosEpidemiController->queryCreateViewCasosEpidemi($dataCache));
			

			}

		 $minDateRange = mainModel::cleanStringSQL($dataEpi['minDateRange']);


		 $maxDateRange = mainModel::cleanStringSQL($dataEpi['maxDateRange']);

      $rangeAgesStart=[0, 1, 5, 7, 10, 12, 15, 20, 25, 45, 60, 65,0];

      $rangeAgesEnd = [0, 4, 6, 9, 11, 14, 19, 24, 44, 59, 64,120,120];

		$dataForDataTables = array();


		$queryGetReportFilasEpi = mainModel::connectDB()->query('SELECT enfermedad_evento, nro_fila_report,id_report_fila FROM public.report_epi_filas order by nro_fila_report');
		
		while($reportFilasEpi=$queryGetReportFilasEpi->fetch(PDO
			::FETCH_ASSOC)){

			$dataRow=array();

			$dataRow[] = $reportFilasEpi["nro_fila_report"];

			$dataRow[] = $reportFilasEpi["enfermedad_evento"];

				/// for obtener los datos por ntodos los rango de edades
			for ($idAgeRange=0; $idAgeRange < count($rangeAgesStart); $idAgeRange++) {

			// obtnemos los datos por generors y tipo de entrada
			for ($id_tipo_entrada=1; $id_tipo_entrada <= 2 ; $id_tipo_entrada++) {

				$generos = array(2,1);
				
				for ($id_genero=0; $id_genero <= 1 ; $id_genero++) {

					//var_dump('nro_fila_report- '.$reportFilasEpi["nro_fila_report"], 'minDateRange- '.$minDateRange, 'maxDateRange- '.$maxDateRange,'id_genero- '. $id_genero,' idAgeRange- '.$rangeAgesStart[$idAgeRange],'idAgeRange- '.$rangeAgesEnd[$idAgeRange],'id_tipo_entrada- '.$id_tipo_entrada);

				   $dataRow[] = array(self::getNroCasesEpidemiForEpiModel($reportFilasEpi["nro_fila_report"],$reportFilasEpi["id_report_fila"], $minDateRange, $maxDateRange,$generos[$id_genero],$rangeAgesStart[$idAgeRange],$rangeAgesEnd[$idAgeRange],$id_tipo_entrada));


				}

			}

				// total por tipo de entrada
				    
					for ($id_tipo_entrada=1; $id_tipo_entrada <= 2 ; $id_tipo_entrada++) {

					$dataRow[] = array(self::getNroCasesEpidemiForEpiModel($reportFilasEpi["nro_fila_report"],$reportFilasEpi["id_report_fila"], $minDateRange, $maxDateRange,'',$rangeAgesStart[$idAgeRange],$rangeAgesEnd[$idAgeRange],$id_tipo_entrada));
					
					}
							// total por tipo entrada y genero
							$dataRow[] = array(self::getNroCasesEpidemiForEpiModel($reportFilasEpi["nro_fila_report"],$reportFilasEpi["id_report_fila"], $minDateRange, $maxDateRange,'',$rangeAgesStart[$idAgeRange],$rangeAgesEnd[$idAgeRange],''));
		}


		// total de edades, genero, tipoEntrada
         $dataRow[] = self::getNroCasesEpidemiForEpiModel($reportFilasEpi["nro_fila_report"],$reportFilasEpi["id_report_fila"], $minDateRange, $maxDateRange,'','','','','');
	

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


		public static function validDatatoGetDataTablesEPIController($dataEpi){

		 $minDateRange = mainModel::cleanStringSQL($dataEpi['minDateRange']);


		 $maxDateRange = mainModel::cleanStringSQL($dataEpi['maxDateRange']);


			if (!mainModel::checkDate($minDateRange,$maxDateRange) || $minDateRange > $maxDateRange){
			$alert=[
				"Alert"=>"simple",
				"Title"=>"Datos Invalidos",
				"Text"=>"El Rango de Fechas es invalido",
				"Type"=>"error"
			];

				echo json_encode($alert);

				exit();
		}

			if (self::getNroCasesEpidemiForEpiModel('','', $minDateRange, $maxDateRange) == 0){
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


public static function getNroCasesEpidemiForEpiModel($nro_fila_report,$id_report_fila, $startRegistrationDate, $endRegistrationDate,$id_genero ='',$startAge = '',$ageEnd = '',$id_tipo_entrada = '',$is_hospital = ''){

    $DB_transacc = mainModel::connectDB();

    $DB_transacc->beginTransaction();

  try {

	$ageRangeForQuery='';


if (!mainModel::isDataEmtpyPermitedZero($ageEnd) && !mainModel::isDataEmtpyPermitedZero($startAge)){
	// si no usamos dos rangos para la edad
	$ageRangeForQuery = "AND edadINT BETWEEN $startAge AND $ageEnd ";	
}


$genreSelectedForQuery = '';

if (!empty($id_genero)){
$genreSelectedForQuery = " AND id_genero = $id_genero ";
}


$isHospitalSelectedForQuery = '';

if (!empty($is_hospital)){
$isHospitalSelectedForQuery = " AND is_hospital = $is_hospital ";
}
$idTipoEntradaSelectedForQuery="";

if (!empty($id_tipo_entrada)){
$idTipoEntradaSelectedForQuery = " AND id_tipo_entrada = $id_tipo_entrada ";
}

if ($id_report_fila == 0){
$isHospitalSelectedForQuery = " AND is_hospital = 1 ";
}

$nroFilaReportSelectedForQuery = '';

$queryGetCasosEpi = "SELECT DISTINCT ON (id_caso_epidemi,row_number) ROW_NUMBER() OVER(ORDER BY id_caso_epidemi)
	FROM public.caso_epidemi_view ";

$queryGetCasosFilterGeneral = " fecha_registro BETWEEN '$startRegistrationDate' AND '$endRegistrationDate' 

	".$isHospitalSelectedForQuery." "

	.$genreSelectedForQuery." "

	.$ageRangeForQuery." "

	.$idTipoEntradaSelectedForQuery." ";


if (!empty($nro_fila_report)){

$nroFilaReportSelectedForQuery = " WHERE nro_fila_report = $nro_fila_report ";


$queryGetCasosEpi = "SELECT DISTINCT ON (id_caso_epidemi,row_number) ROW_NUMBER() OVER(ORDER BY id_caso_epidemi)
	FROM public.caso_epidemi_view WHERE";



		$queryGetReportFilasConfigsEpi = $DB_transacc->query('
SELECT nro_fila_report, id_atrib_especial_inicio, id_atrib_especial_final, consecutivo_cie10_inicio, consecutivo_cie10_final, id_config_epi
	FROM public.report_epi_filas_configs '.$nroFilaReportSelectedForQuery);


$queryGetCasosReportFilasConfig = '';

		while($dataFilasConfigEpi=$queryGetReportFilasConfigsEpi->fetch(PDO
			::FETCH_ASSOC)){


            if ( $queryGetCasosReportFilasConfig == "" )
            {
                $queryGetCasosReportFilasConfig.= $queryGetCasosFilterGeneral." AND ";
            }
            else
            {
                $queryGetCasosReportFilasConfig.=" OR ".$queryGetCasosFilterGeneral.'AND';
            }

			$queryGetCasosReportFilasConfig.= " 

			 id_atrib_especial BETWEEN ".$dataFilasConfigEpi['id_atrib_especial_inicio']." AND ".
					  $dataFilasConfigEpi['id_atrib_especial_final']." 

			AND consecutivo_cie10 BETWEEN ".$dataFilasConfigEpi['consecutivo_cie10_inicio']." AND ".
					  $dataFilasConfigEpi['consecutivo_cie10_final']." /**/";


//		var_dump('nro_fila_report - '.$dataFilasConfigEpi['nro_fila_report']);


//		var_dump($queryGetCasosReportFilasConfig);


//		echo "<br><br><hr>";


			  		}


			$queryGetCasosEpiForReportFilaEpi = $queryGetCasosEpi.' '.$queryGetCasosReportFilasConfig. ' ORDER BY row_number desc 
 			LIMIT 1 ';




}else{

//var_dump($nro_fila_report,$id_report_fila, $startRegistrationDate, $endRegistrationDate,$id_genero,$startAge,$ageEnd,$id_tipo_entrada,$is_hospital);

	$queryGetCasosEpiForReportFilaEpi = $queryGetCasosEpi.' WHERE '.$queryGetCasosFilterGeneral.' ORDER BY row_number desc 
 			LIMIT 1 ';


}

/*if ($nro_fila_report == 10 AND $id_genero == '' AND $startAge == '' AND $ageEnd == '' AND $id_tipo_entrada == '' AND $is_hospital =='') {
	
}*/

		
		$queryGetCasosEpiForReportFilaEpi = $DB_transacc->query($queryGetCasosEpiForReportFilaEpi);

		$nroCasesEpidemi = $queryGetCasosEpiForReportFilaEpi->fetchColumn();
/*
if ($nro_fila_report=13) {
	var_dump($dataFilasConfigEpi);
	exit();
	}
*/

		if (empty($nroCasesEpidemi)) {
			$nroCasesEpidemi = 0;
		}

		//var_dump($nroCasesEpidemi,$queryGetCasosEpiForReportFilaEpi);

//		echo "<br><br><hr>";

		return $nroCasesEpidemi;

      $DB_transacc->commit();
      
     	 }catch (Exception $e) {

      		$DB_transacc->rollBack();

			$nroCasesEpidemi = 'Error/Nulo';

    	}

    	return $nroCasesEpidemi;
	}

}


 ?>