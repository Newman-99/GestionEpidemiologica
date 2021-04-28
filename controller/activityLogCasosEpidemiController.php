	<?php 

	if($requestAjax){
		require_once "../model/userModel.php";
	}else{
		require_once "./model/userModel.php";
	} 




	class activityLogCasosEpidemiController extends userModel{

//  (get_descripcion_nacionalidad(id_nacionalidad_caso::integer) || '' || doc_identidad_caso) AS doc_identidad_caso_complete,



  public static function queryCreateViewGetCasosEpidemiBitacora($dataCasosEpidemi){

        $maxDateRange = $dataCasosEpidemi['maxDateRange'];

        $minDateRange = $dataCasosEpidemi['minDateRange'];

return $queryCreateViewGetCasosEpidemiBitacora = "
CREATE OR REPLACE VIEW casos_epidemi_bitacora_view  AS SELECT DISTINCT ON (id_bitacora) id_bitacora,  ROW_NUMBER() OVER(ORDER BY id_bitacora DESC),

  id_caso_epidemi,
  catalog_key_cie10,fecha_caso_epidemi,
  usuario_alias,
  id_person_usuario,
  id_person_caso,
  doc_identidad_caso,
  id_nacionalidad_caso,

  get_doc_identidad_complete(id_nacionalidad_caso,doc_identidad_caso) AS doc_identidad_caso_complete,

  (select get_doc_identidad_complete(id_nacionalidad,doc_identidad) from personas
                       where id_person = id_person_usuario) AS doc_identidad_usuario_complete,

  tpo.descripcion_tipo_operacion,

  bitacora_fecha, bitacora_hora,

  get_descrip_bool_from_int(casos_bit.is_hospital) as hospitalizado,

  atr_esp.descripcion atributo_especial

  FROM casos_epidemi_bitacora casos_bit ,tipos_operaciones_caso tpo, atribs_especials_epi atr_esp
  
  WHERE tpo.id_tipo_operacion = casos_bit.id_tipo_operacion 

  AND casos_bit.id_atrib_especial = atr_esp.id_atrib_especial
  
  AND casos_bit.bitacora_fecha BETWEEN  '$minDateRange' AND '$maxDateRange'  

  ORDER BY id_bitacora DESC;";

}

	public static function getFirstDateRecordsActivityLogCasosEpidemi(){


		$queryFirstDateRecords = mainModel::connectDB()->query('SELECT bitacora_fecha FROM casos_epidemi_bitacora ORDER BY bitacora_fecha ASC LIMIT 1');

		return $firstDateRecords = $queryFirstDateRecords->fetchColumn();

	}

  public static function paginateActivityLogCasosEpidemiController() {
  
//  mainModel::connectDB()->query('drop view casos_epidemi_bitacora_view');

    $columnsTable = array(
      'id_bitacora',
      'row_number',
      'id_caso_epidemi',
      'doc_identidad_caso_complete',
      'catalog_key_cie10',
      'atributo_especial',
      'hospitalizado',
      'fecha_caso_epidemi',
      'usuario_alias',
      'doc_identidad_usuario_complete',
      'descripcion_tipo_operacion',
      'bitacora_fecha',
      'bitacora_hora');


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

    } # code...


$queryifExistView = mainModel::connectDB()->query("SELECT where EXISTS  ( SELECT FROM information_schema.tables WHERE table_name = 'casos_epidemi_bitacora_view' ) = true");

      if(!$queryifExistView->rowCount() || $siRequestNewViewTableCasosEpidemi){
    
    mainModel::connectDB()->query(self::queryCreateViewGetCasosEpidemiBitacora($dataCache));
      
      }

    mainModel::getDataTableServerSideModel('casos_epidemi_bitacora_view', 'row_number',
      $columnsTable,$columnsTable);
   
    //mainModel::connectDB()->query('drop view casos_epidemi_bitacora_view');

}
}
?>