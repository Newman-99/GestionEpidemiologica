
<?php 

			ini_set('memory_limit','1024M');

	if($requestAjax){
		require_once "../model/mainModel.php";
	}else{
		require_once "./model/mainModel.php";
	}


class cie10DataController extends mainModel
{



	public function updateCie10DataController($files){
			

if ($files['fileCSVCIE10']['type'] !='text/csv' || mainModel::isDataEmtpy($files['fileCSVCIE10']['size'])){
				$alert=[
					"Alert"=>"simple",
					"Title"=>"Datos Invalidos",
					"Text"=>"El archivo es invalido o esta vacio <br> debe poseer la extension .CSV",
					"Type"=>"error"
				];	

				echo json_encode($alert);

				exit();
	}


if ($files['fileCSVCIE10']['size'] >20000000){
				$alert=[
					"Alert"=>"simple",
					"Title"=>"Datos Invalidos",
					"Text"=>"El archivo no puede ser mayor a 20 Megabytes(MB)",
					"Type"=>"error"
				];	

				echo json_encode($alert);

				exit();
	}


require_once "../view/inc/spout.php";


$filePath = $files['fileCSVCIE10']['tmp_name'];


$reader = $ReaderEntityFactory::createCSVReader();

$typeFileEncoding = mb_detect_encoding(file_get_contents($filePath), mb_list_encodings());

$reader->open($filePath);
// se recolectan los valores del CSV
 
    $count = 0;

    $dataForQuery = array();

    foreach ($reader->getSheetIterator() as $sheet) {   
        foreach ($sheet->getRowIterator() as $row) {

			foreach($row->getCells() as $key => $cell){




		if ($typeFileEncoding == 'UTF-8') {
			$cell = html_entity_decode(htmlentities($cell, ENT_QUOTES, 'UTF-8'), ENT_QUOTES , 'ISO-8859-1');
		}

		$cell=utf8_encode($cell);


			$dataForQuery[$count][$key]=$cell;

//			var_dump($dataForQuery[$count][$key]);

			if ($count == 100) {
				
				//var_dump($dataForQuery);
			}

			        }
			  $count++;
			}   
    }


// iniciamos la transaccion sql

$DB_transacc = mainModel::connectDB();

$DB_transacc->beginTransaction();

try {

$DB_transacc->query(mainModel::$stringQuerydisableForeingDB);


$queryInsertCie10 = 'INSERT INTO data_cie10(CONSECUTIVO,
 LETRA,
 CATALOG_KEY,
 NOMBRE,
 CODIGOX,
 LSEX,
 LINF,
 LSUP,
 TRIVIAL,
 ERRADICADO,
 N_INTER,
 NIN,
 NINMTOBS,
 COD_SIT_LESION,
 NO_CBD,
 CBD,
 NO_APH,
 AF_PRIN,
 DIA_SIS,
 CLAVE_PROGRAMA_SIS,
 COD_COMPLEMEN_MORBI,
 DEF_FETAL_CM,
 DEF_FETAL_CBD,
 CLAVE_CAPITULO,
 CAPITULO,
 LISTA1,
 GRUPO1,
 LISTA5,
 RUBRICA_TYPE,
 YEAR_MODIFI,
 YEAR_APLICACION,
 VALID,
 PRINMORTA,
 PRINMORBI,
 LM_MORBI,
 LM_MORTA,
 LGBD165,
 LOMSBECK,
 LGBD190,
 NOTDIARIA,
 NOTSEMANAL,
 SISTEMA_ESPECIAL,
 BIRMM,
 CVE_CAUSA_TYPE,
 CAUSA_TYPE,
 EPI_MORTA,
 EDAS_E_IRAS_EN_M5,
 CSVE_MATERNAS_SEED_EPID,
 EPI_MORTA_M5,
 EPI_MORBI,
 DEF_MATERNAS,
 ES_CAUSES,
 NUM_CAUSES,
 ES_SUIVE_MORTA,
 ES_SUIVE_MORB,
 EPI_CLAVE,
 EPI_CLAVE_DESC,
 ES_SUIVE_NOTIN,
 ES_SUIVE_EST_EPI,
 ES_SUIVE_EST_BROTE,
 SINAC,
 PRIN_SINAC,
 PRIN_SINAC_GRUPO,
 DESCRIPCION_SINAC_GRUPO,
 PRIN_SINAC_SUBGRUPO,
 DESCRIPCION_SINAC_SUBGRUPO,
 DAGA,
 ASTERISCO) VALUES (
:CONSECUTIVO,
:LETRA,
:CATALOG_KEY,
:NOMBRE,
:CODIGOX,
:LSEX,
:LINF,
:LSUP,
:TRIVIAL,
:ERRADICADO,
:N_INTER,
:NIN,
:NINMTOBS,
:COD_SIT_LESION,
:NO_CBD,
:CBD,
:NO_APH,
:AF_PRIN,
:DIA_SIS,
:CLAVE_PROGRAMA_SIS,
:COD_COMPLEMEN_MORBI,
:DEF_FETAL_CM,
:DEF_FETAL_CBD,
:CLAVE_CAPITULO,
:CAPITULO,
:LISTA1,
:GRUPO1,
:LISTA5,
:RUBRICA_TYPE,
:YEAR_MODIFI,
:YEAR_APLICACION,
:VALID,
:PRINMORTA,
:PRINMORBI,
:LM_MORBI,
:LM_MORTA,
:LGBD165,
:LOMSBECK,
:LGBD190,
:NOTDIARIA,
:NOTSEMANAL,
:SISTEMA_ESPECIAL,
:BIRMM,
:CVE_CAUSA_TYPE,
:CAUSA_TYPE,
:EPI_MORTA,
:EDAS_E_IRAS_EN_M5,
:CSVE_MATERNAS_SEED_EPID,
:EPI_MORTA_M5,
:EPI_MORBI,
:DEF_MATERNAS,
:ES_CAUSES,
:NUM_CAUSES,
:ES_SUIVE_MORTA,
:ES_SUIVE_MORB,
:EPI_CLAVE,
:EPI_CLAVE_DESC,
:ES_SUIVE_NOTIN,
:ES_SUIVE_EST_EPI,
:ES_SUIVE_EST_BROTE,
:SINAC,
:PRIN_SINAC,
:PRIN_SINAC_GRUPO,
:DESCRIPCION_SINAC_GRUPO,
:PRIN_SINAC_SUBGRUPO,
:DESCRIPCION_SINAC_SUBGRUPO,
:DAGA,
:ASTERISCO)';

$ifExistRecordsInDataCIE10 = $DB_transacc->query('SELECT CONSECUTIVO FROM data_cie10 LIMIT 1;');
	// si no hay registros insertamos datos de una vez sin comprobar
if (!$ifExistRecordsInDataCIE10->rowCount()) {
$sqlQuery = $DB_transacc->prepare($queryInsertCie10);
}else{


$sqlQuery = $DB_transacc->prepare($queryInsertCie10."
ON CONFLICT (CATALOG_KEY) DO UPDATE SET
	  CONSECUTIVO=:CONSECUTIVO
	, LETRA=:LETRA
	, CATALOG_KEY=:CATALOG_KEY
	, NOMBRE=:NOMBRE
	, CODIGOX=:CODIGOX
	, LSEX=:LSEX
	, LINF=:LINF
	, LSUP=:LSUP
	, TRIVIAL=:TRIVIAL
	, ERRADICADO=:ERRADICADO
	, N_INTER=:N_INTER
	, NIN=:NIN
	, NINMTOBS=:NINMTOBS
	, COD_SIT_LESION=:COD_SIT_LESION
	, NO_CBD=:NO_CBD
	, CBD=:CBD
	, NO_APH=:NO_APH
	, AF_PRIN=:AF_PRIN
	, DIA_SIS=:DIA_SIS
	, CLAVE_PROGRAMA_SIS=:CLAVE_PROGRAMA_SIS
	, COD_COMPLEMEN_MORBI=:COD_COMPLEMEN_MORBI
	, DEF_FETAL_CM=:DEF_FETAL_CM
	, DEF_FETAL_CBD=:DEF_FETAL_CBD
	, CLAVE_CAPITULO=:CLAVE_CAPITULO
	, CAPITULO=:CAPITULO
	, LISTA1=:LISTA1
	, GRUPO1=:GRUPO1
	, LISTA5=:LISTA5
	, RUBRICA_TYPE=:RUBRICA_TYPE
	, YEAR_MODIFI=:YEAR_MODIFI
	, YEAR_APLICACION=:YEAR_APLICACION
	, VALID=:VALID
	, PRINMORTA=:PRINMORTA
	, PRINMORBI=:PRINMORBI
	, LM_MORBI=:LM_MORBI
	, LM_MORTA=:LM_MORTA
	, LGBD165=:LGBD165
	, LOMSBECK=:LOMSBECK
	, LGBD190=:LGBD190
	, NOTDIARIA=:NOTDIARIA
	, NOTSEMANAL=:NOTSEMANAL
	, SISTEMA_ESPECIAL=:SISTEMA_ESPECIAL
	, BIRMM=:BIRMM
	, CVE_CAUSA_TYPE=:CVE_CAUSA_TYPE
	, CAUSA_TYPE=:CAUSA_TYPE
	, EPI_MORTA=:EPI_MORTA
	, EDAS_E_IRAS_EN_M5=:EDAS_E_IRAS_EN_M5
	, CSVE_MATERNAS_SEED_EPID=:CSVE_MATERNAS_SEED_EPID
	, EPI_MORTA_M5=:EPI_MORTA_M5
	, EPI_MORBI=:EPI_MORBI
	, DEF_MATERNAS=:DEF_MATERNAS
	, ES_CAUSES=:ES_CAUSES
	, NUM_CAUSES=:NUM_CAUSES
	, ES_SUIVE_MORTA=:ES_SUIVE_MORTA
	, ES_SUIVE_MORB=:ES_SUIVE_MORB
	, EPI_CLAVE=:EPI_CLAVE
	, EPI_CLAVE_DESC=:EPI_CLAVE_DESC
	, ES_SUIVE_NOTIN=:ES_SUIVE_NOTIN
	, ES_SUIVE_EST_EPI=:ES_SUIVE_EST_EPI
	, ES_SUIVE_EST_BROTE=:ES_SUIVE_EST_BROTE
	, SINAC=:SINAC
	, PRIN_SINAC=:PRIN_SINAC
	, PRIN_SINAC_GRUPO=:PRIN_SINAC_GRUPO
	, DESCRIPCION_SINAC_GRUPO=:DESCRIPCION_SINAC_GRUPO
	, PRIN_SINAC_SUBGRUPO=:PRIN_SINAC_SUBGRUPO
	, DESCRIPCION_SINAC_SUBGRUPO=:DESCRIPCION_SINAC_SUBGRUPO
	, DAGA=:DAGA
	, ASTERISCO=:ASTERISCO");
}

/*
$queryDeleteAll = $DB_transacc->prepare('DELETE FROM data_cie10;');

$queryDeleteAll->execute();

$queryDeleteAll->closeCursor();
*/


$queryGetRecordsCatalogKeyCie10 = $DB_transacc->query("SELECT CATALOG_KEY FROM data_cie10");

		$recordsCatalogKeyCie10 = array();
		
		while($rows=$queryGetRecordsCatalogKeyCie10->fetch(PDO
			::FETCH_ASSOC)){ 

			$recordsCatalogKeyCie10[] = $rows['catalog_key'];
		}


		$catalogKeyCie10ToRegister = array();

for ($indiceFila = 1; $indiceFila < count($dataForQuery); $indiceFila++) {

$CATALOG_KEY = mainModel::cleanStringSQL($dataForQuery[$indiceFila][2]); 

// si no existe el caso en la hoja y la tabla esta vacia se elemina
$ifExistCaseCIE10 = $DB_transacc->query("SELECT CATALOG_KEY FROM data_cie10 WHERE CATALOG_KEY ='$CATALOG_KEY'");


if (!$ifExistCaseCIE10->rowCount() && $ifExistRecordsInDataCIE10->rowCount()) {

$DB_transacc->query("DELETE FROM data_cie10 WHERE  CATALOG_KEY ='$CATALOG_KEY'");
}

$CONSECUTIVO = mainModel::cleanStringSQL($dataForQuery[$indiceFila][0]); 
$LETRA = mainModel::cleanStringSQL($dataForQuery[$indiceFila][1]); 
$catalogKeyCie10ToRegister[] = $CATALOG_KEY;
$NOMBRE = mainModel::cleanStringSQL($dataForQuery[$indiceFila][3]); 

/*
var_dump($NOMBRE,mb_strtolower($NOMBRE, 'UTF-8'));
exit();
*/
$CODIGOX = mainModel::cleanStringSQL($dataForQuery[$indiceFila][4]); 
$LSEX = mainModel::cleanStringSQL($dataForQuery[$indiceFila][5]); 
$LINF = mainModel::cleanStringSQL($dataForQuery[$indiceFila][6]); 
$LSUP = mainModel::cleanStringSQL($dataForQuery[$indiceFila][7]); 
$TRIVIAL = mainModel::cleanStringSQL($dataForQuery[$indiceFila][8]); 
$ERRADICADO = mainModel::cleanStringSQL($dataForQuery[$indiceFila][9]); 
$N_INTER = mainModel::cleanStringSQL($dataForQuery[$indiceFila][10]); 
$NIN = mainModel::cleanStringSQL($dataForQuery[$indiceFila][11]); 
$NINMTOBS = mainModel::cleanStringSQL($dataForQuery[$indiceFila][12]); 
$COD_SIT_LESION = mainModel::cleanStringSQL($dataForQuery[$indiceFila][13]); 

$NO_CBD = mainModel::cleanStringSQL($dataForQuery[$indiceFila][14]); 
$CBD = mainModel::cleanStringSQL($dataForQuery[$indiceFila][15]); 
$NO_APH = mainModel::cleanStringSQL($dataForQuery[$indiceFila][16]); 
$AF_PRIN = mainModel::cleanStringSQL($dataForQuery[$indiceFila][17]); 
$DIA_SIS = mainModel::cleanStringSQL($dataForQuery[$indiceFila][18]); 
$CLAVE_PROGRAMA_SIS = mainModel::cleanStringSQL($dataForQuery[$indiceFila][19]); 
$COD_COMPLEMEN_MORBI = mainModel::cleanStringSQL($dataForQuery[$indiceFila][20]); 
$DEF_FETAL_CM = mainModel::cleanStringSQL($dataForQuery[$indiceFila][21]); 
$DEF_FETAL_CBD = mainModel::cleanStringSQL($dataForQuery[$indiceFila][22]); 
$CLAVE_CAPITULO = mainModel::cleanStringSQL($dataForQuery[$indiceFila][23]); 
$CAPITULO = mainModel::cleanStringSQL($dataForQuery[$indiceFila][24]); 
$LISTA1 = mainModel::cleanStringSQL($dataForQuery[$indiceFila][25]); 
$GRUPO1 = mainModel::cleanStringSQL($dataForQuery[$indiceFila][26]); 
$LISTA5 = mainModel::cleanStringSQL($dataForQuery[$indiceFila][27]); 
$RUBRICA_TYPE = mainModel::cleanStringSQL($dataForQuery[$indiceFila][28]); 
$YEAR_MODIFI = mainModel::cleanStringSQL($dataForQuery[$indiceFila][29]); 
$YEAR_APLICACION = mainModel::cleanStringSQL($dataForQuery[$indiceFila][30]); 
$VALID = mainModel::cleanStringSQL($dataForQuery[$indiceFila][31]); 
$PRINMORTA = mainModel::cleanStringSQL($dataForQuery[$indiceFila][32]); 
$PRINMORBI = mainModel::cleanStringSQL($dataForQuery[$indiceFila][33]); 
$LM_MORBI = mainModel::cleanStringSQL($dataForQuery[$indiceFila][34]); 
$LM_MORTA = mainModel::cleanStringSQL($dataForQuery[$indiceFila][35]); 
$LGBD165 = mainModel::cleanStringSQL($dataForQuery[$indiceFila][36]); 
$LOMSBECK = mainModel::cleanStringSQL($dataForQuery[$indiceFila][37]); 
$LGBD190 = mainModel::cleanStringSQL($dataForQuery[$indiceFila][38]); 
$NOTDIARIA = mainModel::cleanStringSQL($dataForQuery[$indiceFila][39]); 
$NOTSEMANAL = mainModel::cleanStringSQL($dataForQuery[$indiceFila][40]); 
$SISTEMA_ESPECIAL = mainModel::cleanStringSQL($dataForQuery[$indiceFila][41]); 
$BIRMM = mainModel::cleanStringSQL($dataForQuery[$indiceFila][42]); 
$CVE_CAUSA_TYPE = mainModel::cleanStringSQL($dataForQuery[$indiceFila][43]); 
$CAUSA_TYPE = mainModel::cleanStringSQL($dataForQuery[$indiceFila][44]); 
$EPI_MORTA = mainModel::cleanStringSQL($dataForQuery[$indiceFila][45]); 
$EDAS_E_IRAS_EN_M5 = mainModel::cleanStringSQL($dataForQuery[$indiceFila][46]); 
$CSVE_MATERNAS_SEED_EPID = mainModel::cleanStringSQL($dataForQuery[$indiceFila][47]); 
$EPI_MORTA_M5 = mainModel::cleanStringSQL($dataForQuery[$indiceFila][48]); 
$EPI_MORBI = mainModel::cleanStringSQL($dataForQuery[$indiceFila][49]); 
$DEF_MATERNAS = mainModel::cleanStringSQL($dataForQuery[$indiceFila][50]); 
$ES_CAUSES = mainModel::cleanStringSQL($dataForQuery[$indiceFila][51]); 
$NUM_CAUSES = mainModel::cleanStringSQL($dataForQuery[$indiceFila][52]); 
$ES_SUIVE_MORTA = mainModel::cleanStringSQL($dataForQuery[$indiceFila][53]); 
$ES_SUIVE_MORB = mainModel::cleanStringSQL($dataForQuery[$indiceFila][54]); 
$EPI_CLAVE = mainModel::cleanStringSQL($dataForQuery[$indiceFila][55]); 
$EPI_CLAVE_DESC = mainModel::cleanStringSQL($dataForQuery[$indiceFila][56]); 
$ES_SUIVE_NOTIN = mainModel::cleanStringSQL($dataForQuery[$indiceFila][57]); 
$ES_SUIVE_EST_EPI = mainModel::cleanStringSQL($dataForQuery[$indiceFila][58]); 
$ES_SUIVE_EST_BROTE = mainModel::cleanStringSQL($dataForQuery[$indiceFila][59]); 
$SINAC = mainModel::cleanStringSQL($dataForQuery[$indiceFila][60]); 
$PRIN_SINAC = mainModel::cleanStringSQL($dataForQuery[$indiceFila][61]); 
$PRIN_SINAC_GRUPO = mainModel::cleanStringSQL($dataForQuery[$indiceFila][62]); 
$DESCRIPCION_SINAC_GRUPO = mainModel::cleanStringSQL($dataForQuery[$indiceFila][63]); 
$PRIN_SINAC_SUBGRUPO = mainModel::cleanStringSQL($dataForQuery[$indiceFila][64]); 
$DESCRIPCION_SINAC_SUBGRUPO = mainModel::cleanStringSQL($dataForQuery[$indiceFila][65]); 
$DAGA = mainModel::cleanStringSQL($dataForQuery[$indiceFila][66]); 
$ASTERISCO = mainModel::cleanStringSQL($dataForQuery[$indiceFila][67]);

if (mainModel::isDataEmtpyPermitedZero($CONSECUTIVO,$LETRA,$CATALOG_KEY,$NOMBRE,$CODIGOX,$LSEX,$LINF,$LSUP,$TRIVIAL,$ERRADICADO,$N_INTER,$NIN,$NINMTOBS,$COD_SIT_LESION,$NO_CBD,$CBD,$NO_APH,$AF_PRIN,$DIA_SIS,$CLAVE_PROGRAMA_SIS,$COD_COMPLEMEN_MORBI,$DEF_FETAL_CM,$DEF_FETAL_CBD,$CLAVE_CAPITULO,$CAPITULO,$LISTA1,$GRUPO1,$LISTA5,$RUBRICA_TYPE,$YEAR_MODIFI,$YEAR_APLICACION,$VALID,$PRINMORTA,$PRINMORBI,$LM_MORBI,$LM_MORTA,$LGBD165,$LOMSBECK,$LGBD190,$NOTDIARIA,$NOTSEMANAL,$SISTEMA_ESPECIAL,$BIRMM,$CVE_CAUSA_TYPE,$CAUSA_TYPE,$EPI_MORTA,$EDAS_E_IRAS_EN_M5,$CSVE_MATERNAS_SEED_EPID,$EPI_MORTA_M5,$EPI_MORBI,$DEF_MATERNAS,$ES_CAUSES,$NUM_CAUSES,$ES_SUIVE_MORTA,$ES_SUIVE_MORB,$EPI_CLAVE,$EPI_CLAVE_DESC,$ES_SUIVE_NOTIN,$ES_SUIVE_EST_EPI,$ES_SUIVE_EST_BROTE,$SINAC,$PRIN_SINAC,$PRIN_SINAC_GRUPO,$DESCRIPCION_SINAC_GRUPO,$PRIN_SINAC_SUBGRUPO,$DESCRIPCION_SINAC_SUBGRUPO,$DAGA,$ASTERISCO)){

			$alert=[
				"Alert"=>"simple",
				"Title"=>"Campos Vacios",
				"Text"=>"Todos los datos de los eventos CIE-10 son obligatorios 
				<br><br> Error en la Fila CONSECUTIVO: (".$CONSECUTIVO.")",
				"Type"=>"error"
			];

				echo json_encode($alert);

				exit();
}


$sqlQuery->execute(array("CONSECUTIVO"=>$CONSECUTIVO,
"LETRA"=>$LETRA, 
"CATALOG_KEY"=>$CATALOG_KEY, 
"NOMBRE"=>$NOMBRE, 
"CODIGOX"=>$CODIGOX, 
"LSEX"=>$LSEX, 
"LINF"=>$LINF, 
"LSUP"=>$LSUP, 
"TRIVIAL"=>$TRIVIAL, 
"ERRADICADO"=>$ERRADICADO, 
"N_INTER"=>$N_INTER, 
"NIN"=>$NIN, 
"NINMTOBS"=>$NINMTOBS, 
"COD_SIT_LESION"=>$COD_SIT_LESION, 
"NO_CBD"=>$NO_CBD, 
"CBD"=>$CBD, 
"NO_APH"=>$NO_APH, 
"AF_PRIN"=>$AF_PRIN, 
"DIA_SIS"=>$DIA_SIS, 
"CLAVE_PROGRAMA_SIS"=>$CLAVE_PROGRAMA_SIS, 
"COD_COMPLEMEN_MORBI"=>$COD_COMPLEMEN_MORBI, 
"DEF_FETAL_CM"=>$DEF_FETAL_CM, 
"DEF_FETAL_CBD"=>$DEF_FETAL_CBD, 
"CLAVE_CAPITULO"=>$CLAVE_CAPITULO, 
"CAPITULO"=>$CAPITULO, 
"LISTA1"=>$LISTA1, 
"GRUPO1"=>$GRUPO1, 
"LISTA5"=>$LISTA5, 
"RUBRICA_TYPE"=>$RUBRICA_TYPE, 
"YEAR_MODIFI"=>$YEAR_MODIFI, 
"YEAR_APLICACION"=>$YEAR_APLICACION, 
"VALID"=>$VALID, 
"PRINMORTA"=>$PRINMORTA, 
"PRINMORBI"=>$PRINMORBI, 
"LM_MORBI"=>$LM_MORBI, 
"LM_MORTA"=>$LM_MORTA, 
"LGBD165"=>$LGBD165, 
"LOMSBECK"=>$LOMSBECK, 
"LGBD190"=>$LGBD190, 
"NOTDIARIA"=>$NOTDIARIA, 
"NOTSEMANAL"=>$NOTSEMANAL, 
"SISTEMA_ESPECIAL"=>$SISTEMA_ESPECIAL, 
"BIRMM"=>$BIRMM, 
"CVE_CAUSA_TYPE"=>$CVE_CAUSA_TYPE, 
"CAUSA_TYPE"=>$CAUSA_TYPE, 
"EPI_MORTA"=>$EPI_MORTA, 
"EDAS_E_IRAS_EN_M5"=>$EDAS_E_IRAS_EN_M5, 
"CSVE_MATERNAS_SEED_EPID"=>$CSVE_MATERNAS_SEED_EPID, 
"EPI_MORTA_M5"=>$EPI_MORTA_M5, 
"EPI_MORBI"=>$EPI_MORBI, 
"DEF_MATERNAS"=>$DEF_MATERNAS, 
"ES_CAUSES"=>$ES_CAUSES, 
"NUM_CAUSES"=>$NUM_CAUSES, 
"ES_SUIVE_MORTA"=>$ES_SUIVE_MORTA, 
"ES_SUIVE_MORB"=>$ES_SUIVE_MORB, 
"EPI_CLAVE"=>$EPI_CLAVE, 
"EPI_CLAVE_DESC"=>$EPI_CLAVE_DESC, 
"ES_SUIVE_NOTIN"=>$ES_SUIVE_NOTIN, 
"ES_SUIVE_EST_EPI"=>$ES_SUIVE_EST_EPI, 
"ES_SUIVE_EST_BROTE"=>$ES_SUIVE_EST_BROTE, 
"SINAC"=>$SINAC, 
"PRIN_SINAC"=>$PRIN_SINAC, 
"PRIN_SINAC_GRUPO"=>$PRIN_SINAC_GRUPO, 
"DESCRIPCION_SINAC_GRUPO"=>$DESCRIPCION_SINAC_GRUPO, 
"PRIN_SINAC_SUBGRUPO"=>$PRIN_SINAC_SUBGRUPO, 
"DESCRIPCION_SINAC_SUBGRUPO"=>$DESCRIPCION_SINAC_SUBGRUPO, 
"DAGA"=>$DAGA, 
"ASTERISCO"=>$ASTERISCO));

}

// si un caso registrado no esta en los nuevos registros este se eleminara
if ($ifExistRecordsInDataCIE10->rowCount()) {

for ($i=0; $i <count($recordsCatalogKeyCie10) ; $i++) { 
		
		if (!in_array($recordsCatalogKeyCie10[$i], $catalogKeyCie10ToRegister)) {
			$DB_transacc->query("DELETE FROM data_cie10 WHERE  CATALOG_KEY ='$recordsCatalogKeyCie10[$i]'");
		}
}

}

$sqlQuery->closeCursor();

		$DB_transacc->query(mainModel::$stringQueryEnableForeingDB);

			$alert=[
				"Alert"=>"reload",
				"Title"=>"Operacion Exitosa",
				"Text"=>"Catalogo CIE-10 Actualizado",
				"Type"=>"success"
			];


    $DB_transacc->commit();


		} catch (PDOException $e) {

    $DB_transacc->rollBack();

    	$codeError = $e->getCode();

    	$textDetailsTecnics =  "<br><br> Detalles Tecnicos: ". $e->getMessage();
		
		$textError = mainModel:: getMsgErrorSQL($codeError);

if ($codeError = '23503') {
	$textError.= '.<br> Posiblemente el Evento CIE-10 es requerido por un caso Epidemiologigo';
}
			$alert=[
				"Alert"=>"simple",
				"Title"=>"Ocurrio un error inesperado",
				"Text"=>$textError.$textDetailsTecnics,
				"Type"=>"error"
			];
}
				
				echo json_encode($alert);

}

	public static function paginatecie10DataController(){

mainModel::getDataTableServerSideModel('data_cie10', 'consecutivo',
	array('consecutivo',
'letra',
'catalog_key',
'nombre',
'codigox',
'lsex',
'linf',
'lsup',
'trivial',
'erradicado',
'n_inter', 
'nin', 
'ninmtobs', 
'cod_sit_lesion', 
'no_cbd', 
'cbd', 
'no_aph', 
'af_prin', 
'dia_sis', 
'clave_programa_sis', 
'cod_complemen_morbi', 
'def_fetal_cm', 
'def_fetal_cbd', 
'clave_capitulo', 
'capitulo', 
'lista1', 
'grupo1', 
'lista5', 
'rubrica_type', 
'year_modifi', 
'year_aplicacion', 
'valid', 
'prinmorta', 
'prinmorbi', 
'lm_morbi', 
'lm_morta', 
'lgbd165', 
'lomsbeck', 
'lgbd190', 
'notdiaria', 
'notsemanal', 
'sistema_especial', 
'birmm', 
'cve_causa_type', 
'causa_type', 
'epi_morta', 
'edas_e_iras_en_m5', 
'csve_maternas_seed_epid', 
'epi_morta_m5', 
'epi_morbi', 
'def_maternas', 
'es_causes', 
'num_causes', 
'es_suive_morta', 
'es_suive_morb', 
'epi_clave', 
'epi_clave_desc', 
'es_suive_notin', 
'es_suive_est_epi', 
'es_suive_est_brote', 
'sinac', 
'prin_sinac', 
'prin_sinac_grupo', 
'descripcion_sinac_grupo', 
'prin_sinac_subgrupo', 
'descripcion_sinac_subgrupo', 
'daga', 
'asterisco'));
	}

	// funcion para mostrar datos en el select dinamico y buscador del cie-10
	public static function getCasesCIE10($dataGetCIE10){
	

	if(isset($dataGetCIE10['searchByChapter'])) {

	$idCapituloCIE10 = mainModel::cleanStringSQL($dataGetCIE10['idCapituloCIE10']);

	$queryGetCasesCie10 = "SELECT catalog_key,nombre FROM data_cie10";

		// obtnener data por captulos


		$queryGetCasesCie10 = mainModel::connectDB()->prepare($queryGetCasesCie10." WHERE clave_capitulo = '$idCapituloCIE10' order by catalog_key");
		
		 $queryGetCasesCie10->execute();

		$dataJsonCasesCIE10=[];

		 if (!$queryGetCasesCie10->rowCount()) {
			$dataJsonCasesCIE10[] = array('nombre' =>'Casos epidemologicos no encontrados','catalog_key'=>'');

		echo json_encode($dataJsonCasesCIE10);
		exit();

		 }

		while($recordsCasesCie10=$queryGetCasesCie10->fetch(PDO
			::FETCH_ASSOC)){ 

			$dataJsonCasesCIE10[] = $recordsCasesCie10;
		}
				
		echo json_encode($dataJsonCasesCIE10);
		exit();
	}


	// buscar por patron
	if(isset($dataGetCIE10['valueSearch'])) {

	$idCapituloCIE10 = mainModel::cleanStringSQL($dataGetCIE10['idCapituloCIE10']);

	$valueSearch = mainModel::cleanStringSQL($dataGetCIE10['valueSearch']);

	$valueSearch = pg_escape_string($valueSearch);

	$columnsSearch = array('catalog_key','nombre');

		// buscar patron en las columnas

        $where = "WHERE (";
        for ( $i=0 ; $i<count($columnsSearch) ; $i++ )
        {
                $where .= 'UNACCENT('.$columnsSearch[$i]."::text) ILIKE UNACCENT('%".$valueSearch."%') OR ";
        }
        $where = substr_replace( $where, "", -3 );
        $where .= ")";
	
		// si ha selecionado un capitulo
	 	if (!mainModel::isDataEmtpy($idCapituloCIE10)) {
                $where .= " AND ";

				$where.=" clave_capitulo = '$idCapituloCIE10' ";    	
		}

	// armar query


	$querySearchPatternCIE10 = "
        SELECT ".str_replace(" , ", " ", implode(", ",$columnsSearch))."
        FROM   data_cie10
        $where";

		$querySearchPatternCIE10 = mainModel::connectDB()->prepare($querySearchPatternCIE10);
		
		 $querySearchPatternCIE10->execute();
	
			$dataJsonCasesCIE10=[];
			
			// verficar resultado query
		 if (!$querySearchPatternCIE10->rowCount()) {

			$dataJsonCasesCIE10[] = array('nombre' =>'Casos epidemologicos no encontrados','catalog_key'=>'');

		echo json_encode($dataJsonCasesCIE10);
		exit();

		 }

		 // recoger data de la query
		 
		while($recordsCasesCie10=$querySearchPatternCIE10->fetch(PDO::FETCH_ASSOC)){ 

			$dataJsonCasesCIE10[] = $recordsCasesCie10;
		}
				
		echo json_encode($dataJsonCasesCIE10);
		exit();
	}


	if(isset($dataGetCIE10['getFullDataCie10'])) {

		//var_dump($dataGetCIE10);
	$catalog_key = mainModel::cleanStringSQL($dataGetCIE10['catalog_key']);
                
                $attributesFilter =  [];

                $filterValues = [];

                array_push($attributesFilter, 'catalog_key = :catalog_key');
                $filterValues[':catalog_key'] = [
                'value' => $catalog_key,
                'type' => \PDO::PARAM_STR,
                ];


$queryFullDataCaseCie10 = mainModel::querySelectsCreator('data_cie10',
	array('consecutivo',
'letra',
'catalog_key',
'nombre',
'codigox',
'lsex',
'linf',
'lsup',
'trivial',
'erradicado',
'n_inter', 
'nin', 
'ninmtobs', 
'cod_sit_lesion', 
'no_cbd', 
'cbd', 
'no_aph', 
'af_prin', 
'dia_sis', 
'clave_programa_sis', 
'cod_complemen_morbi', 
'def_fetal_cm', 
'def_fetal_cbd', 
'clave_capitulo', 
'capitulo', 
'lista1', 
'grupo1', 
'lista5', 
'rubrica_type', 
'year_modifi', 
'year_aplicacion', 
'valid', 
'prinmorta', 
'prinmorbi', 
'lm_morbi', 
'lm_morta', 
'lgbd165', 
'lomsbeck', 
'lgbd190', 
'notdiaria', 
'notsemanal', 
'sistema_especial', 
'birmm', 
'cve_causa_type', 
'causa_type', 
'epi_morta', 
'edas_e_iras_en_m5', 
'csve_maternas_seed_epid', 
'epi_morta_m5', 
'epi_morbi', 
'def_maternas', 
'es_causes', 
'num_causes', 
'es_suive_morta', 
'es_suive_morb', 
'epi_clave', 
'epi_clave_desc', 
'es_suive_notin', 
'es_suive_est_epi', 
'es_suive_est_brote', 
'sinac', 
'prin_sinac', 
'prin_sinac_grupo', 
'descripcion_sinac_grupo', 
'prin_sinac_subgrupo', 
'descripcion_sinac_subgrupo', 
'daga', 
'asterisco'),
$attributesFilter,
$filterValues);
		
		 $queryFullDataCaseCie10->execute();

			$dataJsonCaseCIE10=[];

		while($recordsCasesCie10=$queryFullDataCaseCie10->fetch(PDO
			::FETCH_ASSOC)){ 

			$dataJsonCaseCIE10[] = $recordsCasesCie10;
		}
				
		echo json_encode($dataJsonCaseCIE10);
		exit();

	}
}

 public static function exportCatalogCIE10($typeArchive){

$filesBackupsTemp = glob(BASE_DIRECTORY.'reports_temp/*');

foreach($filesBackupsTemp as $file){ // iterate files

    $resultDeleteBackups = unlink($file);
    
    if (!$resultDeleteBackups) {
				$alert=[
					"Alert"=>"simple",
					"Title"=>"Ha ocurrido un error inesperado",
					"Text"=>"Los archivos de respaldo de datos no han podido ser borrados en la carpeta (reports_temp)",
					"Type"=>"error"
				];	

				echo json_encode($alert);
    }
}

require_once "../view/inc/spout.php";

header('Content-Encoding: UTF-8');
header("Content-type: text/csv; charset=UTF-8");
header("Content-Disposition: attachment; filename=processed_devices.csv");
header("Pragma: no-cache");
header("Expires: 0");

      //fopen(BASE_DIRECTORY."reports_temp/catalog_cie10.csv", 'w+') or die("Se produjo un error al crear el archivo");

     set_time_limit(0);
     ini_set('memory_limit', -1);



//     $writer = $WriterEntityFactory::createCSVWriter();

if ($typeArchive == 'csv') {
     $writer = $WriterEntityFactory::createCSVWriter();
}else{

$typeArchivo = 'xlsx';
    $writer = $WriterEntityFactory::createXLSXWriter();
    $writer->setShouldUseInlineStrings(true);
}
 
 		$fileName="catalog-cie10"; 
  				$currentDate =  mainModel::getDateCurrentSystem();
   
     		$date = date("d-m-Y_", strtotime($currentDate));
		$date.= date("H-i-s", strtotime($currentDate));
		$fileName =$fileName.'_'.$date.'.'.$typeArchive;

$filePath =  '../reports_temp/'.$fileName;

$writer->openToFile($filePath);


//$writer->openToBrowser($fileName);

$header = array('CONSECUTIVO',
 'LETRA',
 'CATALOG_KEY',
 'NOMBRE',
 'CODIGOX',
 'LSEX',
 'LINF',
 'LSUP',
 'TRIVIAL',
 'ERRADICADO',
 'N_INTER',
 'NIN',
 'NINMTOBS',
 'COD_SIT_LESION',
 'NO_CBD',
 'CBD',
 'NO_APH',
 'AF_PRIN',
 'DIA_SIS',
 'CLAVE_PROGRAMA_SIS',
 'COD_COMPLEMEN_MORBI',
 'DEF_FETAL_CM',
 'DEF_FETAL_CBD',
 'CLAVE_CAPITULO',
 'CAPITULO',
 'LISTA1',
 'GRUPO1',
 'LISTA5',
 'RUBRICA_TYPE',
 'YEAR_MODIFI',
 'YEAR_APLICACION',
 'VALID',
 'PRINMORTA',
 'PRINMORBI',
 'LM_MORBI',
 'LM_MORTA',
 'LGBD165',
 'LOMSBECK',
 'LGBD190',
 'NOTDIARIA',
 'NOTSEMANAL',
 'SISTEMA_ESPECIAL',
 'BIRMM',
 'CVE_CAUSA_TYPE',
 'CAUSA_TYPE',
 'EPI_MORTA',
 'EDAS_E_IRAS_EN_M5',
 'CSVE_MATERNAS_SEED_EPID',
 'EPI_MORTA_M5',
 'EPI_MORBI',
 'DEF_MATERNAS',
 'ES_CAUSES',
 'NUM_CAUSES',
 'ES_SUIVE_MORTA',
 'ES_SUIVE_MORB',
 'EPI_CLAVE',
 'EPI_CLAVE_DESC',
 'ES_SUIVE_NOTIN',
 'ES_SUIVE_EST_EPI',
 'ES_SUIVE_EST_BROTE',
 'SINAC',
 'PRIN_SINAC',
 'PRIN_SINAC_GRUPO',
 'DESCRIPCION_SINAC_GRUPO',
 'PRIN_SINAC_SUBGRUPO',
 'DESCRIPCION_SINAC_SUBGRUPO',
 'DAGA',
 'ASTERISCO');

    $rowFromValues = $WriterEntityFactory::createRowFromArray($header);

    $writer->addRow($rowFromValues);

    $queryGetCatalogCIE10 = "SELECT consecutivo, letra, catalog_key, nombre, codigox, lsex, linf, lsup, trivial, erradicado, n_inter, nin, ninmtobs, cod_sit_lesion, no_cbd, cbd, no_aph, af_prin, dia_sis, clave_programa_sis, cod_complemen_morbi, def_fetal_cm, def_fetal_cbd, clave_capitulo, capitulo, lista1, grupo1, lista5, rubrica_type, year_modifi, year_aplicacion, valid, prinmorta, prinmorbi, lm_morbi, lm_morta, lgbd165, lomsbeck, lgbd190, notdiaria, notsemanal, sistema_especial, birmm, cve_causa_type, causa_type, epi_morta, edas_e_iras_en_m5, csve_maternas_seed_epid, epi_morta_m5, epi_morbi, def_maternas, es_causes, num_causes, es_suive_morta, es_suive_morb, epi_clave, epi_clave_desc, es_suive_notin, es_suive_est_epi, es_suive_est_brote, sinac, prin_sinac, prin_sinac_grupo, descripcion_sinac_grupo, prin_sinac_subgrupo, descripcion_sinac_subgrupo, daga, asterisco FROM data_cie10 ORDER BY consecutivo asc";

        $queryGetCatalogCIE10 = mainModel::connectDB()->query($queryGetCatalogCIE10);

$dataForWrite = [];

        while($rows=$queryGetCatalogCIE10->fetch(PDO
            ::FETCH_NUM)){           



    $rowFromValues = $WriterEntityFactory::createRowFromArray($rows);


    $writer->addRow($rowFromValues);



         }


       //  $writer->addRows($dataForWrite);
         // add multiple rows at a time
     $writer->close();

			$dataFile=[
				"filePath"=>$filePath,
				"fileName"=>$fileName,
			];
 
 		    echo json_encode($dataFile);
 }


}

 ?>