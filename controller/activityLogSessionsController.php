	<?php 

	if($requestAjax){
		require_once "../model/userModel.php";
	}else{
		require_once "./model/userModel.php";
	} 




	class activityLogSessionsController extends userModel{


	protected static   $queryInnerJoinGetActivityLogSessions =" SELECT 
  usr_bit.id_bitacora,
    usr.doc_identidad,
    usr.alias,
    pers.nombres,
  pers.apellidos,   
    usr.id_nacionalidad,
  pers.id_genero,
  usr_bit.bitacora_fecha,
  usr_bit.bitacora_hora_inicio,
  usr_bit.bitacora_hora_final,
  usrNivl.descripcion_nivel_permiso FROM usuarios usr
  INNER JOIN personas pers ON usr.doc_identidad = pers.doc_identidad
  INNER JOIN nacionalidades nacion ON pers.id_nacionalidad = nacion.id_nacionalidad 
  INNER JOIN generos gnro ON pers.id_genero = gnro.id_genero 
  INNER JOIN usuario_bitacora usr_bit ON usr.alias = usr_bit.usuario_alias 
  INNER JOIN usuarios_niveles usrNivl ON usr_bit.bitacora_nivel_usuario =  usrNivl.id_nivel_permiso

  AND pers.id_nacionalidad = nacion.id_nacionalidad 
  AND pers.id_genero = gnro.id_genero 
  AND usr.alias = usr_bit.usuario_alias 
  AND usr_bit.bitacora_nivel_usuario =  usrNivl.id_nivel_permiso

  ";

protected static   $queryCreateViewGetActivityLogSessions = "
CREATE OR REPLACE VIEW activity_log_sessions_view AS SELECT 
    usr_bit.id_bitacora,
  ROW_NUMBER() OVER(ORDER BY usr_bit.id_bitacora desc),
  pers.id_genero,
  gnro.descripcion_genero,
    pers.id_nacionalidad,
    nacion.descripcion_nacionalidad,
  (nacion.descripcion_nacionalidad || '' || pers.doc_identidad) AS doc_identidad_complete,
  usr.doc_identidad,
    usr.alias,
    pers.nombres,
  pers.apellidos,
  usr_nivl.descripcion_nivel_permiso,
  usr_bit.bitacora_fecha,
  usr_bit.bitacora_hora_inicio,
  usr_bit.bitacora_hora_final
   FROM usuarios usr,personas pers, nacionalidades nacion,
  generos gnro, usuarios_niveles usr_nivl, usuario_bitacora usr_bit
  WHERE usr.doc_identidad = pers.doc_identidad
  AND pers.id_nacionalidad = nacion.id_nacionalidad 
  AND pers.id_genero = gnro.id_genero 
  AND usr.alias = usr_bit.usuario_alias
  AND usr_bit.bitacora_nivel_usuario = usr_nivl.id_nivel_permiso; ";


	public static function getFirstDateRecordsActivityLogSessionsController(){


		$queryFirstDateRecords = mainModel::connectDB()->query('SELECT bitacora_fecha FROM usuario_bitacora ORDER BY bitacora_fecha ASC  LIMIT 1');

		return $firstDateRecords = $queryFirstDateRecords->fetchColumn();

	}

  public static function paginateActivityLogSessionsController() {

    $columnsTable = array(
      'id_bitacora',
      'row_number',
      'id_genero',
      'descripcion_genero',
      'id_nacionalidad',
      'descripcion_nacionalidad',
      'doc_identidad',
      'doc_identidad_complete',
      'descripcion_genero',
      'alias', 
      'nombres',
      'apellidos',
      'descripcion_nivel_permiso',
      'bitacora_fecha',
      'bitacora_hora_inicio',
      'bitacora_hora_final');

    $columnsPrintDataTable = array(
      'id_bitacora',
      'row_number',
      'descripcion_genero',
      'doc_identidad_complete',
      'alias', 
      'nombres',
      'apellidos',
      'descripcion_nivel_permiso',
      'bitacora_fecha',
      'bitacora_hora_inicio',
      'bitacora_hora_final');

  try {


$queryifExistView = mainModel::connectDB()->query("SELECT where EXISTS  ( SELECT FROM information_schema.tables WHERE table_name = 'activity_log_sessions_view' ) = true");

      if(!$queryifExistView->rowCount()){
    
    mainModel::connectDB()->query(self::$queryCreateViewGetActivityLogSessions);
      
      }

    $dataToCreateDataTable = mainModel::getDataTableServerSideModel('activity_log_sessions_view', 'id_bitacora',
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

        if ($aRow['descripcion_genero'] == 'Masculino'){
                  $iconGenero = "male-user.png"; 
                }elseif ($aRow['descripcion_genero'] == "Femenino") {
                  $iconGenero = "fermale-user.png"; 
                }
                   $dataFields = array();

                $dataFields['id_bitacora']=$aRow['id_bitacora'];

                $dataFields['row_number']=$aRow['row_number'];

                 $dataFields['descripcion_genero']= "<span class='d-none'>".$aRow['descripcion_genero']."</span>
                    <img class='img-profile rounded-circle' width='40' src=".SERVERURL."view/img/".$iconGenero.">";

                $dataFields['doc_identidad_complete']= $aRow['doc_identidad_complete'];


                $dataFields['alias']=$aRow['alias'];

                $dataFields['nombres']=$aRow['nombres'];

                $dataFields['apellidos']=$aRow['apellidos'];

                $dataFields['descripcion_nivel_permiso']=$aRow['descripcion_nivel_permiso'];

                $dataFields['bitacora_fecha']=$aRow['bitacora_fecha'];

                $dataFields['bitacora_hora_inicio']=$aRow['bitacora_hora_inicio'];
        

              if (mainModel::isDataEmtpy($aRow['bitacora_hora_final'])) {
          $dataFields['bitacora_hora_final'] = "No Registrada";
        }else{

           $dataFields['bitacora_hora_final']=$aRow['bitacora_hora_final'];
        }

        $row[] = $dataFields[$columnsPrintDataTable[$i]];
            }

        }

        $dataToCreateDataTable['aaData'][] = $row;
    }


//    mainModel::connectDB()->query('drop view activity_log_sessions_view');

    echo json_encode( $dataToCreateDataTable );
}
}
?>