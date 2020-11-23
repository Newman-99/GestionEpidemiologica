<?php 	require_once "personModel.php";

	class casosEpidemiModel extends personModel
	
{
				protected static $queryAddBitacoraCasoEpidemi = "INSERT INTO public.casos_epidemi_bitacora(
		 usuario_alias,
		 bitacora_fecha,
		 bitacora_hora,
		 bitacora_year,
		 id_tipo_operacion,
		 fecha_caso_epidemi,
		 id_caso_epidemi,
		 catalog_key_cie10,
		 id_nacionalidad_caso,
		 doc_identidad_caso,
		 id_nacionalidad_usuario,
		 doc_identidad_usuario)
	VALUES (
		:usuario_alias, 
		:bitacora_fecha, 
		:bitacora_hora, 
		:bitacora_year, 
		:id_tipo_operacion, 
		:fecha_caso_epidemi, 
		:id_caso_epidemi, 
		:catalog_key_cie10, 
		:id_nacionalidad_caso, 
		:doc_identidad_caso, 
		:id_nacionalidad_usuario, 
		:doc_identidad_usuario)";

protected static $queryGetAgrupacionEPI =	"SELECT  orden, enfermedad_evento, key_cie10_Inicio, key_cie10_final 
			FROM agrupacion_epi12";


protected static $queryCreateViewCasosEpidemi = "

CREATE OR REPLACE VIEW caso_epidemi_view  AS SELECT DISTINCT ON (caso.id_caso_epidemi) caso.id_caso_epidemi,  ROW_NUMBER() OVER(ORDER BY caso.id_caso_epidemi desc),
 caso.telefono, 
caso.catalog_key_cie10,caso.fecha_registro,caso.direccion,
		

			    parr.parroquia,
			    parr.id_parroquia,			        
			    casos_bit.id_bitacora, casos_bit.usuario_alias,casos_bit.bitacora_year, casos_bit.bitacora_fecha, casos_bit.bitacora_hora, 

			    pers.nombres, pers.apellidos, pers.fecha_nacimiento,pers.id_genero,
					date_part('year',age(caso.fecha_registro, pers.fecha_nacimiento))::int as edad,
	
				casos_bit.id_nacionalidad_caso, casos_bit.doc_identidad_caso,

				(nacion.descripcion_nacionalidad || '' || casos_bit.doc_identidad_caso) AS doc_identidad_caso_complete,

				casos_bit.id_nacionalidad_usuario, casos_bit.doc_identidad_usuario,				
				(get_descripcion_nacionalidad(casos_bit.id_nacionalidad_usuario) || '' || casos_bit.doc_identidad_usuario) AS doc_identidad_usuario_complete,

			    gnro.descripcion_genero descripcion_genero_caso,

			    cie10.NOMBRE nombre_cie10,
			    cie10.CLAVE_CAPITULO clave_capitulo_cie10
				
			    FROM casos_epidemi caso,casos_epidemi_bitacora casos_bit,personas pers,parroquias parr,generos gnro,
				nacionalidades nacion, usuarios usr, data_cie10 cie10

				WHERE caso.id_caso_epidemi = casos_bit.id_caso_epidemi 
				
				AND  casos_bit.doc_identidad_caso = pers.doc_identidad 
				
				AND casos_bit.id_nacionalidad_caso = pers.id_nacionalidad 

				AND caso.id_parroquia = parr.id_parroquia 
				
				AND pers.id_genero = gnro.id_genero 
				
				AND casos_bit.id_nacionalidad_caso = nacion.id_nacionalidad

				AND usr.alias = casos_bit.usuario_alias 

				AND casos_bit.id_tipo_operacion =  1
				
				AND caso.catalog_key_cie10 = cie10.CATALOG_KEY ORDER BY caso.id_caso_epidemi DESC";


			protected static function addcasosEpidemiModel($dataCasosEpidemi){


		$DB_transacc = mainModel::connectDB();

		$DB_transacc->beginTransaction();


	try {

//		$DB_transacc->query("ALTER TABLE casos_epidemi DISABLE TRIGGER ALL");

		//si no existe la persona
	if(!$dataCasosEpidemi['siExistPerson']){
		// registrar como person
		$sqlQuery  = personModel::stringQueryAddPersonModel();

		$sqlQuery = $DB_transacc->prepare($sqlQuery);

		$sqlQuery->execute(array(
		 "doc_identidad"=>$dataCasosEpidemi['doc_identidad'],
		"id_nacionalidad"=>$dataCasosEpidemi['id_nacionalidad'],
		 "nombres"=>$dataCasosEpidemi['nombres'],
		 "apellidos"=>$dataCasosEpidemi['apellidos'],
		 "fecha_nacimiento"=>$dataCasosEpidemi['fecha_nacimiento'],
		 "id_genero"=>$dataCasosEpidemi['id_genero']));


		$sqlQuery->closeCursor();
		}		

		//registrar caso epidemiologico
		
		$sqlQuery = $DB_transacc->prepare("INSERT INTO casos_epidemi(
		 doc_identidad,
		 id_nacionalidad,
		 catalog_key_cie10,
		 id_parroquia,
		 direccion,
		 telefono,
		 fecha_registro,
		 year_registro) VALUES (		
		 :doc_identidad,
		 :id_nacionalidad,
		 :catalog_key_cie10,
		 :id_parroquia,
		 :direccion,
		 :telefono,
		 :fecha_registro,
		 :year_registro);");

			$sqlQuery->execute(array(
		 "doc_identidad"=>$dataCasosEpidemi['doc_identidad'],
		 "id_nacionalidad"=>$dataCasosEpidemi['id_nacionalidad'],
		 "catalog_key_cie10"=>$dataCasosEpidemi['catalog_key_cie10'],
		 "id_parroquia"=>$dataCasosEpidemi['id_parroquia'],
		 "direccion"=>$dataCasosEpidemi['direccion'],
		 "telefono"=>$dataCasosEpidemi['telefono'],
		 "fecha_registro"=>$dataCasosEpidemi['fecha_registro'],
		 "year_registro"=>$dataCasosEpidemi['year_registro']));

		$sqlQuery->closeCursor();

		// registrar bitacora
		// 

           $queryGetIdEpidemiCaseToRegister = mainModel::connectDB()->query("SELECT id_caso_epidemi FROM public.casos_epidemi ORDER BY id_caso_epidemi DESC limit 1;");

			$idEpidemiCaseToRegister = $queryGetIdEpidemiCaseToRegister->fetchColumn();


			$dataCasosEpidemi["id_caso_epidemi"]=$idEpidemiCaseToRegister;

		$sqlQuery = $DB_transacc->prepare(self::$queryAddBitacoraCasoEpidemi);

			$sqlQuery->execute(array(
		 "usuario_alias"=>$dataCasosEpidemi['usuario_alias'],
		 "bitacora_fecha"=>$dataCasosEpidemi['bitacora_fecha'],
		 "bitacora_hora"=>$dataCasosEpidemi['bitacora_hora'],
		 "bitacora_year"=>$dataCasosEpidemi['bitacora_year'],
		 "id_tipo_operacion"=>$dataCasosEpidemi['id_tipo_operacion'],
		 "id_caso_epidemi"=>$dataCasosEpidemi['id_caso_epidemi'],
		 "fecha_caso_epidemi"=>$dataCasosEpidemi['fecha_registro'],
		 "catalog_key_cie10"=>$dataCasosEpidemi['catalog_key_cie10'],
		 "id_nacionalidad_caso"=>$dataCasosEpidemi['id_nacionalidad'],
		 "doc_identidad_caso"=>$dataCasosEpidemi['doc_identidad'],
		 "id_nacionalidad_usuario"=>$dataCasosEpidemi['id_nacionalidad_usuario'],
		 "doc_identidad_usuario"=>$dataCasosEpidemi['doc_identidad_usuario'],
		));

//		$DB_transacc->query("ALTER TABLE casos_epidemi ENABLE TRIGGER ALL");

		$sqlQuery->closeCursor();

			$DB_transacc->commit();

			$alert=[
				"Alert"=>"simple",
				"Title"=>"Operacion Exitosa",
				"Text"=>"Caso Epidemiologico Registrado",
				"Type"=>"success",
				"reloadDataTable"=>"true"
			];

			}catch (Exception $e) {

			$DB_transacc->rollBack();

			$alert=[
				"Alert"=>"simple",
				"Title"=>"Ha ocurrido un error inesperado",
				"Text"=>"No se ha podido registar el Caso Epidemiologico en el sistema <br>
					Error".$e->getMessage()."",
				"Type"=>"error"
			];

		}

		 return json_encode($alert);

	}	
	
	protected static function updatecasosEpidemiModel($dataCasosEpidemi){
		
		$DB_transacc = mainModel::connectDB();

		$DB_transacc->beginTransaction();

	try {
// si no son los mismos datos personales acualizamos
if (!$dataCasosEpidemi['ifUpdatePerson']) {
		$sqlQuery  = personModel::stringQueryUpdatePersonModel();

		$sqlQuery = $DB_transacc->prepare($sqlQuery);

		 $sqlQuery->execute(array(
		 "id_nacionalidad"=>$dataCasosEpidemi['id_nacionalidad'],
		 "doc_identidad"=>$dataCasosEpidemi['doc_identidad'],
		 "nombres"=>$dataCasosEpidemi['nombres'],
		 "apellidos"=>$dataCasosEpidemi['apellidos'],
		 "fecha_nacimiento"=>$dataCasosEpidemi['fecha_nacimiento'],
		 "id_nacionalidad"=>$dataCasosEpidemi['id_nacionalidad'],
		 "id_genero"=>$dataCasosEpidemi['id_genero']));

		$sqlQuery->closeCursor();
		}		

		// actualizar como caso epidemiologivo
		$sqlQuery = "UPDATE casos_epidemi  SET 
		 catalog_key_cie10 = :catalog_key_cie10,
		 id_parroquia = :id_parroquia,
		 direccion = :direccion,
		 telefono = :telefono,
		 fecha_registro = :fecha_registro,
		 year_registro = :year_registro 
		 WHERE id_caso_epidemi = :id_caso_epidemi;";

		$sqlQuery = $DB_transacc->prepare($sqlQuery);

			$sqlQuery->execute(array(
		 "id_caso_epidemi" => $dataCasosEpidemi['id_caso_epidemi'],
		 "catalog_key_cie10" => $dataCasosEpidemi['catalog_key_cie10'],
		 "id_parroquia" => $dataCasosEpidemi['id_parroquia'],
		 "direccion" => $dataCasosEpidemi['direccion'],
		 "telefono" => $dataCasosEpidemi['telefono'],
		 "year_registro" => $dataCasosEpidemi['year_registro'],
		 "fecha_registro" => $dataCasosEpidemi['fecha_registro']));


		$sqlQuery->closeCursor();

		$sqlQuery = $DB_transacc->prepare(self::$queryAddBitacoraCasoEpidemi);

			$sqlQuery->execute(array(
		 "usuario_alias"=>$dataCasosEpidemi['usuario_alias'],
		 "bitacora_fecha"=>$dataCasosEpidemi['bitacora_fecha'],
		 "bitacora_hora"=>$dataCasosEpidemi['bitacora_hora'],
		 "bitacora_year"=>$dataCasosEpidemi['bitacora_year'],
		 "id_tipo_operacion"=>$dataCasosEpidemi['id_tipo_operacion'],
		 "id_caso_epidemi"=>$dataCasosEpidemi['id_caso_epidemi'],
		 "fecha_caso_epidemi"=>$dataCasosEpidemi['fecha_registro'],
		 "catalog_key_cie10"=>$dataCasosEpidemi['catalog_key_cie10'],
		 "id_nacionalidad_caso"=>$dataCasosEpidemi['id_nacionalidad'],
		 "doc_identidad_caso"=>$dataCasosEpidemi['doc_identidad'],
		 "id_nacionalidad_usuario"=>$dataCasosEpidemi['id_nacionalidad_usuario'],
		 "doc_identidad_usuario"=>$dataCasosEpidemi['doc_identidad_usuario'],
		));

		$sqlQuery->closeCursor();

			$alert=[
				"Alert"=>"simple",
				"Title"=>"Operacion Exitosa",
				"Text"=>"Datos del Caso Epidemiologico actualizados",
				"Type"=>"success",
				"reloadDataTable"=>"true"

			];

		  	$DB_transacc->commit();
			
			}catch (Exception $e) {

			$DB_transacc->rollBack();

			$alert=[
				"Alert"=>"simple",
				"Title"=>"Ocurrio un error inesperado",
				"Text"=>"Error en la actualizacion del Caso Epidemiologico <br>
					Error".$e->getMessage()."",
				"Type"=>"error"
			];

		}

			return json_encode($alert);


		}


			protected static function deleteCasosEpidemiModel($dataCasosEpidemi){

		$DB_transacc = mainModel::connectDB();

		$DB_transacc->beginTransaction();

	try {

		$DB_transacc->query(parent::$stringQuerydisableForeingDB);


		$DB_transacc->query("ALTER TABLE casos_epidemi_bitacora DISABLE TRIGGER ALL");
		$DB_transacc->query("ALTER TABLE casos_epidemi DISABLE TRIGGER ALL");


		$sqlQuery = $DB_transacc->prepare("DELETE FROM casos_epidemi WHERE id_caso_epidemi = :id_caso_epidemi;");

			$sqlQuery->execute(array(
		 "id_caso_epidemi"=>$dataCasosEpidemi['id_caso_epidemi']));

		  $sqlQuery->closeCursor();

		  //si existe elimnamos persona
		if (isset($dataCasosEpidemi['deletePerson'])) {
		
		$stringQueryDeletePersonModel = personModel::stringQueryDeletePersonModel();

		$sqlQuery = $DB_transacc->prepare($stringQueryDeletePersonModel);

		  $sqlQuery->execute(array(
		 "id_nacionalidad"=>$dataCasosEpidemi['id_nacionalidad'],
		 "doc_identidad"=>$dataCasosEpidemi['doc_identidad']));
		 
		  $sqlQuery->closeCursor();	

		}


		$sqlQuery = $DB_transacc->prepare(self::$queryAddBitacoraCasoEpidemi);

			$sqlQuery->execute(array(
		 "usuario_alias"=>$dataCasosEpidemi['usuario_alias'],
		 "bitacora_fecha"=>$dataCasosEpidemi['bitacora_fecha'],
		 "bitacora_hora"=>$dataCasosEpidemi['bitacora_hora'],
		 "bitacora_year"=>$dataCasosEpidemi['bitacora_year'],
		 "id_tipo_operacion"=>$dataCasosEpidemi['id_tipo_operacion'],
		 "id_caso_epidemi"=>$dataCasosEpidemi['id_caso_epidemi'],
		 "fecha_caso_epidemi"=>$dataCasosEpidemi['fecha_registro'],
		 "catalog_key_cie10"=>$dataCasosEpidemi['catalog_key_cie10'],
		 "id_nacionalidad_caso"=>$dataCasosEpidemi['id_nacionalidad'],
		 "doc_identidad_caso"=>$dataCasosEpidemi['doc_identidad'],
		 "id_nacionalidad_usuario"=>$dataCasosEpidemi['id_nacionalidad_usuario'],
		 "doc_identidad_usuario"=>$dataCasosEpidemi['doc_identidad_usuario'],
		));

		$sqlQuery->closeCursor();



		$DB_transacc->query(parent::$stringQueryEnableForeingDB);

		$DB_transacc->query("ALTER TABLE casos_epidemi ENABLE TRIGGER ALL");

		$DB_transacc->query("ALTER TABLE casos_epidemi_bitacora ENABLE TRIGGER ALL");

		  	$alert=[
				"Alert"=>"simple",
				"Title"=>"Operacion Exitosa",
				"Text"=>"El Caso Epidemiologico ha sido eliminado",
				"Type"=>"success",
				"reloadDataTable"=>"true"

			];

			// en variable para eviatr error de doble cierre de transacc
			$DB_transacc->commit();
			
			}catch (Exception $e) {

			//$DB_transacc->rollBack();


			$alert=[
				"Alert"=>"simple",
				"Title"=>"Ocurrio un error inesperado",
				"Text"=>"Error en la eliminacion del caso epidemiologico<br>
					Error".$e->getMessage()."",
				"Type"=>"error"
			];

		}

			return json_encode($alert);
		

		}



	protected static function getCasosEpidemiModel($table,$columnsTable,$attributesFilter,$filterValues){
			

	   $where = '';
		if (!empty($attributesFilter)) {
		$where .= ' WHERE ' . implode(' AND ', $attributesFilter);
		}

		$sqlQuery = "
        SELECT ".str_replace(" , ", " ", implode(", ", $columnsTable))."
        FROM  $table
        $where
	    ";

		$sqlQuery = mainModel::connectDB()->prepare($sqlQuery);
		foreach($filterValues as $key => $values) {
			$sqlQuery->bindParam($key, $values['value'], $values['type']); 
		}

		return $sqlQuery;

		}

protected static function getNroCasesEpidemiForEpiModel($epiOrder, $startRegistrationDate, $endRegistrationDate,$id_genero ='',$startAge = '',$ageEnd = ''){

$queryFunctionGetAge = " AND date_part('year',age(casos.fecha_registro, pers.fecha_nacimiento)) ";


// solo un rango indica Inicio o final
if ($startAge == '') {
	$ageRangeForQuery = $queryFunctionGetAge." < $ageEnd";
}


if ($ageEnd == '') {
	$ageRangeForQuery = $queryFunctionGetAge." > $startAge";
		
}

if (!empty($ageEnd) && !empty($startAge)){
	// si no usamos dos rangos para la edad
	$ageRangeForQuery = $queryFunctionGetAge." BETWEEN $startAge AND $ageEnd ";	
}

if (empty($ageEnd) && empty($startAge)){
	$ageRangeForQuery='';
}

// si esta vacio seran ambos generos

$genreSelededForQuery = '';

if (!empty($id_genero)){
$genreSelededForQuery = " AND pers.id_genero = $id_genero";
}


$epiOrderSelededForQuery = "AND epi12.orden  =".$epiOrder;

if (empty($epiOrder)){
$epiOrderSelededForQuery = '';
}

$queryGetDataCIE10ForEPI = "SELECT DISTINCT ON (casos.id_caso_epidemi) 
ROW_NUMBER() OVER(ORDER BY casos.id_caso_epidemi desc)
from agrupacion_epi12 epi12, casos_epidemi casos,personas pers 
WHERE casos.catalog_key_cie10 BETWEEN epi12.key_cie10_Inicio AND epi12.key_cie10_final 
 ".$genreSelededForQuery." ".$ageRangeForQuery."
AND pers.doc_identidad = casos.doc_identidad AND pers.id_nacionalidad = casos.id_nacionalidad ".
$epiOrderSelededForQuery." AND casos.fecha_registro BETWEEN '$startRegistrationDate' AND '$endRegistrationDate' LIMIT 1";


		$queryGetDataCIE10ForEPI = mainModel::connectDB()->query($queryGetDataCIE10ForEPI);

		$nroCasesEpidemi = $queryGetDataCIE10ForEPI->fetchColumn();

		if (empty($nroCasesEpidemi)) {
			$nroCasesEpidemi = 0;
		}

		return $nroCasesEpidemi;
}
	}

