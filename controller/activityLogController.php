	<?php 

	if($requestAjax){
		require_once "../model/userModel.php";
	}else{
		require_once "./model/userModel.php";
	} 




	class activityLogController extends userModel{


	protected static $stringQueryForGetActivityLogUser = "SELECT SQL_CALC_FOUND_ROWS usr.alias aliasUsuario, usr.docIdentidad,
	pers.docIdentidad, pers.nombres, pers.apellidos, pers.idNacionalidad, pers.idGenero,
	nacion.descripcionNacionalidad,
	gnro.descripcionGenero,
	usrBit.idBitacora,usrBit.bitacoraCodigo,usrBit.bitacoraFecha,usrBit.bitacoraHoraInicio,usrBit.bitacoraHoraFinal,
	usrBit.bitacoraNivelUsuario,usrNivl.descripcionNivelPermiso descripNivelPermisoBitacora ,usrBit.bitacoraYear
	FROM usuarios usr
	INNER JOIN personas pers ON usr.docIdentidad = pers.docIdentidad
	INNER JOIN nacionalidades nacion ON pers.idNacionalidad = nacion.idNacionalidad 
	INNER JOIN generos gnro ON pers.idGenero = gnro.idGenero 
	INNER JOIN usuarioBitacora usrBit ON usr.alias = usrBit.usuarioAlias 
	INNER JOIN usuariosNiveles usrNivl ON usrBit.bitacoraNivelUsuario =  usrNivl.idNivelPermiso ";


	public static function getFirstDateRecordsActivityLogUserController(){

		$queryFirstDateRecords = mainModel::runSimpleQuery('SELECT bitacoraFecha FROM `usuarioBitacora` ORDER BY bitacoraFecha ASC  LIMIT 1');

		$queryFirstDateRecords->execute();

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

	array_push($AttributesFilterForQuery," bitacoraFecha BETWEEN '$minDateRange' AND '$maxDateRange'");
}

	if (!empty($AttributesFilterForQuery)) {
		   $queryForGetActivityLogUser .= ' WHERE ' . implode(' AND ', $AttributesFilterForQuery);
		  }

	// Orden por default, en la vista DataTables se encargara de otras opciones de orden
	$queryForGetActivityLogUser = mainModel::runSimpleQuery($queryForGetActivityLogUser." ORDER BY usrBit.idBitacora DESC");

			$recordsCount = 1;

 	$queryForGetActivityLogUser->execute();
                   
			$dataJsonRocords = array();

			while($rows = $queryForGetActivityLogUser->fetch(PDO::FETCH_ASSOC)) {

                   $dataFields=array();				

				if ($rows['idGenero'] == "1"){
                  $rows['iconGenero'] = "male-user.png"; 
                }elseif ($rows['idGenero'] == "2") {
                  $rows['iconGenero'] = "fermale-user.png"; 
                }

             	if ($rows['idNacionalidad'] === "1") {
					$nacionalidad = "V";
				}else{

					$nacionalidad = "E";				
				}


             	if (userModel::isDataEmtpy($rows['bitacoraHoraFinal'])) {
					$rows['bitacoraHoraFinal'] = "No Registrada";
				}

				$rows['recordsCount']=$recordsCount++;	
                   
                 $dataFields['recordsCount']=$rows['recordsCount'];

                 $dataFields['genero']= "<span class='d-none'>".$rows['idGenero']."</span>
                    <img class='img-profile rounded-circle' width='40' src=".SERVERURL."view/img/".$rows['iconGenero'].">";

                $dataFields['docIdentidad']=$nacionalidad.'-'.$rows['docIdentidad'];

                $dataFields['aliasUsuario']=$rows['aliasUsuario'];

                $dataFields['nombres']=$rows['nombres'];

                $dataFields['apellidos']=$rows['apellidos'];

                $dataFields['descripNivelPermisoBitacora']=$rows['descripNivelPermisoBitacora'];

                $dataFields['bitacoraFecha']=$rows['bitacoraFecha'];

                $dataFields['bitacoraHoraInicio']=$rows['bitacoraHoraInicio'];

                $dataFields['bitacoraHoraFinal']=$rows['bitacoraHoraFinal'];
				
				$dataJsonRocords[] = $dataFields;
			}

			echo json_encode($dataJsonRocords, JSON_UNESCAPED_UNICODE);

			exit();

	}


	}
?>