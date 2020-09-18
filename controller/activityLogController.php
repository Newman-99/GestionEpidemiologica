	<?php 

	if($requestAjax){
		require_once "../model/userModel.php";
	}else{
		require_once "./model/userModel.php";
	} 




	class activityLogController extends userModel{


	protected static $stringQueryForGetActivityLogUser = "SELECT usr.alias usuario_alias,usr.id_nacionalidad, usr.doc_identidad, 
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


	public static function getFirstDateRecordsActivityLogUserController(){

		$queryFirstDateRecords = mainModel::connectDB()->query('SELECT bitacora_fecha FROM usuario_bitacora ORDER BY bitacora_fecha ASC  LIMIT 1');

		return $firstDateRecords = $queryFirstDateRecords->fetchColumn();

	}

	public static function paginateActivityLogUserController($dataActivityLog){

		 $minDateRange = mainModel::cleanStringSQL($dataActivityLog['minDateRange']);

		 $maxDateRange = mainModel::cleanStringSQL($dataActivityLog['maxDateRange']);

		 $requestedAliasUser = mainModel::cleanStringSQL($dataActivityLog['requestedAliasUser']);

	$queryForGetActivityLogUser = self::$stringQueryForGetActivityLogUser;

$AttributesFilterForQuery = [];

// Si no esta consultando las actividades de un user en especifico estra vacio y se conultrara a todo los users
if (!empty($requestedAliasUser)) {
	
	array_push($AttributesFilterForQuery," alias =
			'$requestedAliasUser'");
}

// Operacionws para limitar la query segun la fecha
if (!empty($minDateRange) AND !empty($maxDateRange) ) {

	array_push($AttributesFilterForQuery," bitacora_fecha BETWEEN '$minDateRange' AND '$maxDateRange'");
}

	if (!empty($AttributesFilterForQuery)) {
		   $queryForGetActivityLogUser .= ' WHERE ' . implode(' AND ', $AttributesFilterForQuery);
		  }

	// Orden por default, en la vista DataTables se encargara de otras opciones de orden
	$queryForGetActivityLogUser = mainModel::connectDB()->query($queryForGetActivityLogUser." ORDER BY usrBit.id_bitacora DESC");

			$recordsCount = 1;
                   
			$dataJsonRocords = array();

			while($rows = $queryForGetActivityLogUser->fetch(PDO::FETCH_ASSOC)) {

                   $dataFields=array();				

				if ($rows['id_genero'] == "1"){
                  $rows['iconGenero'] = "male-user.png"; 
                }elseif ($rows['id_genero'] == "2") {
                  $rows['iconGenero'] = "fermale-user.png"; 
                }

             	if ($rows['id_nacionalidad'] == "1") {
					$nacionalidad = "V";
				}else{
					$nacionalidad = "E";				
				}


             	if (userModel::isDataEmtpy($rows['bitacora_hora_final'])) {
					$rows['bitacora_hora_final'] = "No Registrada";
				}

				$rows['recordsCount']=$recordsCount++;	
                   
                 $dataFields['recordsCount']=$rows['recordsCount'];

                 $dataFields['genero']= "<span class='d-none'>".$rows['id_genero']."</span>
                    <img class='img-profile rounded-circle' width='40' src=".SERVERURL."view/img/".$rows['iconGenero'].">";

                $dataFields['doc_identidad']=$nacionalidad.'-'.$rows['doc_identidad'];

                $dataFields['usuario_alias']=$rows['usuario_alias'];

                $dataFields['nombres']=$rows['nombres'];

                $dataFields['apellidos']=$rows['apellidos'];

                $dataFields['descripcion_nivel_permiso']=$rows['descripcion_nivel_permiso'];

                $dataFields['bitacora_fecha']=$rows['bitacora_fecha'];

                $dataFields['bitacora_hora_inicio']=$rows['bitacora_hora_inicio'];

                $dataFields['bitacora_hora_final']=$rows['bitacora_hora_final'];
				
				$dataJsonRocords[] = $dataFields;
			}

			echo json_encode($dataJsonRocords, JSON_UNESCAPED_UNICODE);

			exit();

	}


	}
?>