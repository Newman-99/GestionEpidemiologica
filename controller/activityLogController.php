	<?php 

	if($requestAjax){
		require_once "../model/userModel.php";
	}else{
		require_once "./model/userModel.php";
	} 




	class activityLogController extends userModel{


	protected static $stringQueryForGetActivityLogSessions = "SELECT usr.alias usuario_alias,usr.id_nacionalidad, usr.doc_identidad, 
	pers.nombres, pers.apellidos, pers.id_genero,
	nacion.descripcion_nacionalidad,
	gnro.descripcion_genero,
	usrBit.id_bitacora,usrBit.bitacora_codigo,usrBit.bitacora_fecha,usrBit.bitacora_hora_inicio,usrBit.bitacora_hora_final,
	usrBit.bitacora_nivel_usuario,usrNivl.descripcion_nivel_permiso,usrBit.bitacora_year
	FROM usuarios usr
	INNER JOIN personas pers ON usr.doc_identidad = pers.doc_identidad
	INNER JOIN nacionalidades nacion ON pers.id_nacionalidad = nacion.id_nacionalidad 
	INNER JOIN generos gnro ON pers.id_genero = gnro.id_genero 
	INNER JOIN usuario_bitacora usrBit ON usr.alias = usrBit.usuario_alias 
	INNER JOIN usuarios_niveles usrNivl ON usrBit.bitacora_nivel_usuario =  usrNivl.id_nivel_permiso ";


	public static function getFirstDateRecordsActivityLogSessionsController(){

		$queryFirstDateRecords = mainModel::connectDB()->query('SELECT bitacora_fecha FROM usuario_bitacora ORDER BY bitacora_fecha ASC  LIMIT 1');

		return $firstDateRecords = $queryFirstDateRecords->fetchColumn();

	}

  public static function getTableDataActivityLogSessionsController() {

  $columnsInnerJoin =array(
  "usrBit.id_bitacora",
    "usr.doc_identidad",
    "usr.alias",
    "pers.nombres",
  "pers.apellidos",   
    "usr.id_nacionalidad",
  "pers.id_genero",
  "usrBit.bitacora_fecha",
  "usrBit.bitacora_hora_inicio",
  "usrBit.bitacora_hora_final",
  "usrNivl.descripcion_nivel_permiso",
);
  // las 
  $nameColumnsTable = array(
    'id_bitacora',
    'row_number',
    'genero',
    'doc_identidad',
    'alias',
    'nombres',
    'apellidos',
    'descripcion_nivel_permiso',
    'bitacora_fecha',
    'bitacora_hora_inicio',     
    'bitacora_hora_final');      

  $tablesJoins='usuarios usr
  INNER JOIN personas pers ON usr.doc_identidad = pers.doc_identidad
  INNER JOIN nacionalidades nacion ON pers.id_nacionalidad = nacion.id_nacionalidad 
  INNER JOIN generos gnro ON pers.id_genero = gnro.id_genero 
  INNER JOIN usuario_bitacora usrBit ON usr.alias = usrBit.usuario_alias 
  INNER JOIN usuarios_niveles usrNivl ON usrBit.bitacora_nivel_usuario =  usrNivl.id_nivel_permiso';

    $sIndexColumn = 'usrBit.id_bitacora';

    $orderForRowCounts = 'order by usrBit.id_bitacora desc';

    mainModel:: getTableForJoins($columnsInnerJoin,$tablesJoins,$sIndexColumn,$orderForRowCounts,$nameColumnsTable);
    exit();


  }  
	
}
?>