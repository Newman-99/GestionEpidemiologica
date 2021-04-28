<?php 
			$requestAjax = TRUE;

		require_once "../config/app.php";

		  require_once "../controller/reportsEpiController.php";


		  $reportsEpiController = new reportsEpiController();

	if (isset($_GET['getDataReportsEpiFilasDataTables'])) {
   
              $reportsEpiController->getDataReportsEpiFilasDataTables();
              // operaciones para las configuraciones del reporte

		}elseif (isset($_POST['operationType']) && $_POST['operationType'] == 'register' && isset($_POST['nro_fila_report_for_configs'])) {

		   	$reportsEpiController->addReportEpiFilaConfigController($_POST);

		}elseif (isset($_POST['operationType']) && $_POST['operationType'] == 'delete' && isset($_POST['nro_fila_report_for_configs'])) {
		              $reportsEpiController->deleteReportEpiFilaConfigController($_POST);
		}elseif (isset($_POST['operationType']) && $_POST['operationType'] == 'update' && isset($_POST['nro_fila_report_for_configs'])) {

		              $reportsEpiController->updateReportEpiConfigController($_POST);


		}elseif (isset($_GET['getDataAtribsEspecialsEpiDataTables'])) {

		              $reportsEpiController->getDataAtribsEspecialsEpiDataTables($_GET);

		}elseif (isset($_POST['operationType']) && $_POST['operationType'] == 'register'  && isset($_POST['nro_atrib_especial'])) {
		   	$reportsEpiController->addAtribEspecialEpiController($_POST);
		}elseif (isset($_POST['operationType']) && $_POST['operationType'] == 'delete' && isset($_POST['id_atrib_especial'])) {
		              $reportsEpiController->deleteAtribEspecialEpiController($_POST);
		}elseif (isset($_POST['operationType']) && $_POST['operationType'] == 'update' && isset($_POST['nro_atrib_especial'])) {
		              $reportsEpiController->updateAtribEspecialEpiController($_POST);

		}elseif (isset($_GET['getDataAtribsEspecialsEpiConfigsDataTables'])) {

		              $reportsEpiController->getDataAtribsEspecialsEpiConfigsDataTables($_GET);

		}elseif (isset($_POST['operationType']) && $_POST['operationType'] == 'register'  && isset($_POST['id_atrib_especial_for_configs'])) {
		   	$reportsEpiController->addAtribEspecialEpiConfigsController($_POST);
		}elseif (isset($_POST['operationType']) && $_POST['operationType'] == 'delete' && isset($_POST['id_atrib_especial_for_configs'])) {
		              $reportsEpiController->deleteAtribEspecialEpiConfigsController($_POST);
		}elseif (isset($_POST['operationType']) && $_POST['operationType'] == 'update' && isset($_POST['id_atrib_especial_for_configs'])) {
		              $reportsEpiController->updateAtribEspecialEpiConfigsController($_POST);


		}elseif (isset($_GET['getDataReportsEpiFilasConfigsDataTables'])) {
			
		              $reportsEpiController->getDataReportsEpiFilasConfigsDataTables($_GET);
			
		}elseif (isset($_POST['operationType']) && $_POST['operationType'] == 'register') {

		   		              $reportsEpiController->addReportFilaEpiController($_POST);

		}elseif (isset($_POST['operationType']) && $_POST['operationType'] == 'delete')
		 {
		              $reportsEpiController->deleteReportEpiFilasController($_POST);

		}elseif (isset($_POST['operationType']) && $_POST['operationType'] == 'update') {
		              $reportsEpiController->updateReportEpiFilasController($_POST);


}elseif (isset($_POST['validDataToReportEpi'])) {

	 	$reportsEpiController->validDatatoGetDataTablesEPIController($_POST);	
}elseif (isset($_GET['viewReportEpi'])) {

	 	$reportsEpiController->getDataTablesEPIController($_GET);

              // operaciones para solo el reporte


				}	
 
 ?>