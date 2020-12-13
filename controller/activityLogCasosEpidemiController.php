	<?php 

	if($requestAjax){
		require_once "../model/userModel.php";
	}else{
		require_once "./model/userModel.php";
	} 




	class activityLogCasosEpidemiController extends userModel{



protected static   $queryCreateViewGetCasosEpidemiBitacora = "
CREATE OR REPLACE VIEW casos_epidemi_bitacora_view  AS SELECT DISTINCT ON (id_bitacora) id_bitacora,  ROW_NUMBER() OVER(ORDER BY id_bitacora DESC),

  id_caso_epidemi,
  catalog_key_cie10,fecha_caso_epidemi,
  usuario_alias,

  doc_identidad_usuario,
  id_nacionalidad_usuario,

  doc_identidad_caso,
  id_nacionalidad_caso,

  (get_descripcion_nacionalidad(id_nacionalidad_caso) || '' || doc_identidad_caso) AS doc_identidad_caso_complete,

  (get_descripcion_nacionalidad(id_nacionalidad_usuario) || '' || doc_identidad_usuario) AS doc_identidad_usuario_complete,

  tpo.descripcion_tipo_operacion,

  bitacora_fecha, bitacora_hora

  FROM casos_epidemi_bitacora casos_bit ,tipos_operaciones tpo
  
  WHERE tpo.id_tipo_operacion = casos_bit.id_tipo_operacion 

  ORDER BY id_bitacora DESC";


	public static function getFirstDateRecordsActivityLogCasosEpidemi(){


		$queryFirstDateRecords = mainModel::connectDB()->query('SELECT bitacora_fecha FROM casos_epidemi_bitacora ORDER BY bitacora_fecha ASC LIMIT 1');

		return $firstDateRecords = $queryFirstDateRecords->fetchColumn();

	}

  public static function paginateActivityLogCasosEpidemiController() {

    $columnsTable = array(
      'id_bitacora',
      'row_number',
      'id_caso_epidemi',
      'doc_identidad_caso_complete',
      'catalog_key_cie10',
      'fecha_caso_epidemi',
      'usuario_alias',
      'doc_identidad_usuario_complete',
      'descripcion_tipo_operacion',
      'bitacora_fecha',
      'bitacora_hora');

$queryifExistView = mainModel::connectDB()->query("SELECT where EXISTS  ( SELECT FROM information_schema.tables WHERE table_name = 'casos_epidemi_bitacora_view' ) = true");

      if(!$queryifExistView->rowCount()){
    
    mainModel::connectDB()->query(self::$queryCreateViewGetCasosEpidemiBitacora);
      
      }

    mainModel::getDataTableServerSideModel('casos_epidemi_bitacora_view', 'row_number',
      $columnsTable,$columnsTable);
   
    //mainModel::connectDB()->query('drop view casos_epidemi_bitacora_view');

}
}
?>