<?php


	if ($requestAjax) {
		require_once "../config/server.php";

	} else {
		require_once "./config/server.php";

	}
	

	class mainModel{


	public static $stringQuerydisableForeingDB = "select 'ALTER TABLE DISABLE TRIGGER ALL;' from information_schema.tables where table_schema = 'public'";


	public static $stringQueryEnableForeingDB = "select 'ALTER TABLE ENABLE TRIGGER ALL;' from information_schema.tables where table_schema = 'public';";

	public static $stringQueryDeleteBitacora = "DELETE FROM usuario_bitacora WHERE  usuario_alias = :usuario_alias;";


        public static $msjErrorRequestData404="

          <div class='text-center'>
            <div class='error mx-auto' data-text='404'>404</div>
            <p class='lead text-gray-800 mb-5'>Error de Solicitud de Datos</p>
            <a href=".SERVERURL.">&larr; Regresar al Tablero de Inicio</a>
          </div>

          </div>
        </div>

            </div>
          </div>
        </div>
      </div>

        ";


	function __construct(){
    date_default_timezone_set("America/Caracas");
    	}


		public static function connectDB(){

 		try {

if (IF_LOCAL_SERVER) {

				$DB = new PDO("pgsql:host=".SERVER_PATH.";port=".PORT.";dbname=".DB."",USER,PASS, array(
							PDO::ATTR_PERSISTENT => true, PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8'));
			    $DB->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
					return $DB;

			}else{
			return (function(){
			    $parts = (parse_url(getenv('DATABASE_URL') ?: 'postgres://ilsmpwdzrresby:7879db47bd3be54c574eab3a81a1bc2db477bc890a756eccc406992832a0fd8e@ec2-54-246-87-132.eu-west-1.compute.amazonaws.com:5432/d4hub5gh1m9jjj'));
			    extract($parts);
			    $path = ltrim($path, "/");
			    return new PDO("pgsql:host={$host};port={$port};dbname={$path}", $user, $pass);
			})();
		
			}


		} catch (PDOException $e) {
		    var_dump("Fallo al conectar con la base de datos: ".$e->getMessage());
		}
	}




public static function backupDatabase(){

				$alert=[
					"Alert"=>"simple",
					"Title"=>"Ocurrio un error inesperado",
					"Text"=>"Funcion no disponible en este servidor",
					"Type"=>"error"
				];

				echo json_encode($alert);
				exit();
		try {


		self::cleanBackupsTempDirectory();

		require_once '../config/backup-phpcloud.php';

				$operationElementHtml=[
					"idSetAtribute"=>"backup",
					"valueSetAtribute"=>SERVERURL."backups_temp/".$nameBackup.'.gz',
					"typeSetAtribute"=>"href",

					"idAddClass"=>"#backup",
					"valueAddClass"=>"btn-success",

					"idRemoveClass"=>"#backup",
					"valueRemoveClass"=>"btn-secondary"
				];

		    echo json_encode($operationElementHtml);

	}catch (Exception $e) {

				$alert=[
					"Alert"=>"simple",
					"Title"=>"Ocurrio un error inesperado",
					"Text"=>"Error en el Respalado de la base de datos <br> Error: ". $e->getMessage()."",
					"Type"=>"error"
				];


				echo json_encode($alert);
	}


}

public static function backupClouConfig($dataConfigBackup){

		$email = mainModel::cleanStringSQL($dataConfigBackup["email"]);
		$typeCloud = mainModel::cleanStringSQL($dataConfigBackup["typeCloud"]);
		$key = mainModel::cleanStringSQL($dataConfigBackup["key"]);
		$secret = mainModel::cleanStringSQL($dataConfigBackup["secret"]);
		$root = mainModel::cleanStringSQL($dataConfigBackup["root"]);


if (self::isDataEmtpy($typeCloud,$key,$secret,$root,$email)) {
				$alert=[
					"Alert"=>"simple",
					"Title"=>"Campos Vacios",
					"Text"=>"Todos los campos de configuracion son obligatorios",
					"Type"=>"error"
				];
				echo json_encode($alert);

				exit();
}

$ifGcsOrAw3sDataEmpty = 0;

if ($typeCloud == 1 || $typeCloud == 3){

		$bucket = mainModel::cleanStringSQL($dataConfigBackup["bucket"]);

	 	$ifGcsOrAw3sDataEmpty = (self::isDataEmtpy($bucket));

	}

$ifDropboxDataEmpty = '';

if ($typeCloud == 2){
		$token = mainModel::cleanStringSQL($dataConfigBackup["token"]);

		$app = mainModel::cleanStringSQL($dataConfigBackup["app"]);

	 	$ifDropboxDataEmpty = (self::isDataEmtpy($token,$app));
}

if ($ifDropboxDataEmpty || $ifGcsOrAw3sDataEmpty) {
				$alert=[
					"Alert"=>"simple",
					"Title"=>"Campos Vacios",
					"Text"=>"Todos los campos de configuracion son obligatorios",
					"Type"=>"error"
				];
				echo json_encode($alert);

				exit();
}

$DB_transacc = mainModel::connectDB();

$DB_transacc->beginTransaction();

	try {

		$typeCloud = mainModel::cleanStringSQL($dataConfigBackup["typeCloud"]);
		$key = mainModel::cleanStringSQL($dataConfigBackup["key"]);
		$secret = mainModel::cleanStringSQL($dataConfigBackup["secret"]);
		$root = mainModel::cleanStringSQL($dataConfigBackup["root"]);
		$token = mainModel::cleanStringSQL($dataConfigBackup["token"]);
		$app = mainModel::cleanStringSQL($dataConfigBackup["app"]);
		$bucket = mainModel::cleanStringSQL($dataConfigBackup["bucket"]);

		$sqlQuery = $DB_transacc->query("TRUNCATE table cuenta_nube");

		$sqlQuery = $DB_transacc->prepare("INSERT INTO cuenta_nube(
		type,
		email,
	 	key,
	 	secret,
	 	root,
	 	token,
	 	app,
	 	bucket) VALUES (
		:type,
	 	:email,
	 	:key,
	 	:secret,
	 	:root,
	 	:token,
	 	:app,
	 	:bucket)");

			$sqlQuery->execute(array(
		"type"=>$typeCloud,
		"email"=>$email,
		"key"=>$key,
		"secret"=>$secret,
		"root"=>$root,
		"token"=>$token,
		"app"=>$app,
		"bucket"=>$bucket));

		$sqlQuery->closeCursor();

			$DB_transacc->commit();


			$alert=[
				"Alert"=>"reload",
				"Title"=>"Operacion Exitosa",
				"Text"=>"Nueva Cuenta de la Nube Cofigurada",
				"Type"=>"success"
			];
			
			}catch (Exception $e) {

			$DB_transacc->rollBack();

			    	$codeError = $e->getCode();

			    	$textDetailsTecnics =  "<br><br> Detalles Tecnicos: ". $e->getMessage();
					
					$textError = mainModel:: getMsgErrorSQL($codeError);

						$alert=[
							"Alert"=>"simple",
							"Title"=>"Ocurrio un error inesperado",
							"Text"=>$textError.$textDetailsTecnics,
							"Type"=>"error"
						];
			}
							
							echo json_encode($alert);
}

public static function restoreDatabase($files){

				$alert=[
					"Alert"=>"simple",
					"Title"=>"Ocurrio un error inesperado",
					"Text"=>"Error en el Respalado de la base de datos <br> Error: ". $e->getMessage()."",
					"Type"=>"error"
				];


				echo json_encode($alert);

		try {

			ini_set('memory_limit','512M');
if ($files['restore']['type'] !='application/gzip' || mainModel::isDataEmtpy($files['restore']['size'])){
				$alert=[
					"Alert"=>"simple",
					"Title"=>"Datos Invalidos",
					"Text"=>"El archivo de Respaldo es invalido o esta vacio <br> debe poseer la extension .gz",
					"Type"=>"error"
				];

				echo json_encode($alert);

				exit();
	}

	self::cleanBackupsTempDirectory();

	$uploadDirectory = $files['restore']['tmp_name'];

	$nameFileRestore = $files['restore']['name'];

$mewUploaddDirectory = BASE_DIRECTORY.'backups_temp/';

$uploadFile = $mewUploaddDirectory . basename($files['restore']['name']);

move_uploaded_file($uploadDirectory, $uploadFile);

	require_once '../config/restore-phpcloud.php';

			$alert=[
				"Alert"=>"reload",
				"Title"=>"Operacion Exitosa",
				"Text"=>"Base de datos restaurada",
				"Type"=>"success"
			];

}catch (Exception $e) {

			$alert=[
				"Alert"=>"simple",
				"Title"=>"Ocurrio un error inesperado",
				"Text"=>"Error en la restauracion de la base de datos <br> Error: ". $e->getMessage()."",
				"Type"=>"error"
			];

}


				echo json_encode($alert);
				exit();

}



		protected static function cleanBackupsTempDirectory(){
		

$filesBackupsTemp = glob(BASE_DIRECTORY.'backups_temp/*');

foreach($filesBackupsTemp as $file){ // iterate files

    $resultDeleteBackups = unlink($file);
    
    if (!$resultDeleteBackups) {
				$alert=[
					"Alert"=>"simple",
					"Title"=>"Ha ocurrido un error inesperado",
					"Text"=>"Los archivos de respaldo de datos no han podido ser borrados en la carpeta (backups_temp)",
					"Type"=>"error"
				];

				echo json_encode($alert);
    }
}

		}

		protected static function runSimpleQuery($stringQuery){

		$requestedSimpleQuery = self::connectDB()->prepare($stringQuery);
		return $requestedSimpleQuery->execute();
	}

		public static function encryption($string){
			self::cleanStringSQL($string);			
			$output=FALSE;
			$key=hash('sha256', SECRET_KEY);
			$iv=substr(hash('sha256', SECRET_IV), 0, 16);
			$output=openssl_encrypt($string, METHOD, $key, 0, $iv);
			$output=base64_encode($output);
			return $output;
		}

		public static function decryption($string){
			self::cleanStringSQL($string);			
			$key=hash('sha256', SECRET_KEY);
			$iv=substr(hash('sha256', SECRET_IV), 0, 16);
			$output=openssl_decrypt(base64_decode($string), METHOD, $key, 0, $iv);
			return $output;
		}

	protected function generateRandomCode($Codeletter,$lenghtCode,$identifierNumber){

	for ($i=1; $i <=$lenghtCode ; $i++) {
		$numberRandom = rand(0,9);
		$Codeletter.=$numberRandom;
	}
	$RamdonCode = "";
	$RamdonCode.=$Codeletter.$identifierNumber;
	return $RamdonCode;

}

public static function cleanStringSQL($string){

	$string = trim($string);
	$string = stripcslashes($string);
	$string = str_ireplace("<script>","",$string);
	$string = str_ireplace("null","",$string);
	$string = str_ireplace("NULL","",$string);
	$string = str_ireplace("</script>","",$string);
	$string = str_ireplace("<script src","",$string);
	$string = str_ireplace("<script type =","",$string);
	$string = str_ireplace("SELECT * FROM","",$string);
	$string = str_ireplace("DELETE FROM","",$string);
	$string = str_ireplace("INSERT INTO","",$string);
	$string = str_ireplace("DROP TABLE","",$string);
	$string = str_ireplace("DROP DATABASE","",$string);
	$string = str_ireplace("TRUNCATE TABLE","",$string);
	$string = str_ireplace("SHOW TABLES","",$string);
	$string = str_ireplace("<?php","",$string);
	$string = str_ireplace("?>","",$string);
	$string = str_ireplace("--","",$string);
	$string = str_ireplace("^","",$string);
	$string = str_ireplace("<","",$string);
	$string = str_ireplace(">","",$string);
	$string = str_ireplace("]","",$string);
	$string = str_ireplace("]","",$string);
	$string = str_ireplace("==","",$string);
	$string=str_ireplace("{","",$string);
    $string=str_ireplace("}","",$string);
    $string=str_ireplace("´","",$string);
    $string=str_ireplace("*","",$string);
    $string=str_ireplace(";","",$string);
	$string = stripcslashes($string);
	$string = trim($string);

	return $string;
}


protected static function checkPatterns($pattern,$string){

	if (preg_match("/^".$pattern."$/",$string)) {
		return false;

	} else {
		return true;
		// Si hay errors
	}
}
	

	protected static function checkDate ($date){

		$values = explode("-", $date);

		if (count($values) == 3 && checkdate($values[1],$values[2],$values[0])) {
			return TRUE;
		} else {
			return FALSE;
			// Si hay errors
		}
	}
	

	protected static function dateIsValidAccordingToformat($date, $format = 'Y-m-d')
{
    $d = DateTime::createFromFormat($format, $date);
    return $d && $d->format($format) == $date;
}
	

	protected static function paginateTables ($currentPage,$nroMaxPages,$linksForButtons,$nroButtons){

		$table = '<nav aria-label="Page navigation example">
					<ul class="pagination justify-content-center">';

		if ($currentPage == 1) {
			$table.= '
		<li class=" page-item"> <a class="page-link disabled" >  <i class="fas fa-angle-double-left"></i></a>
						</li>';
		} else {
			$table.= '
		<li class=" page-item"> <a class="page-link" href = "'.$linksForButtons.'1/">  <i class="fas fa-angle-double-left"></i></a>
						</li>

		<li class=" page-item"> <a class="page-link" href = "'.$linksForButtons.($currentPage-1).'/">Anterior</a>
						</li>';

		}


		$countBotons = 0;

		for ($i=$currentPage; $i <= $nroButtons ; $i++) {
			if ($countBotons >= $nroButtons ) {
				break;
			}

			if ($currentPage == $i) {
				$table.= '<li class=" page-item"> <a class="page-link active" href = "'.$linksForButtons.$i.'/">'.$i.'<i class="fas fa-angle-double-left"></i></a>
						</li>';
			} else {						}
									
			$countBotons ++;
		}
		
		if ($currentPage == $nroMaxPages) {
			$table.= '
		<li class=" page-item disabled"> <a class="page-link"><i class="fas fa-angle-double-right"></i></a>
						</li>';
		} else {
			$table.= '
		<li class=" page-item"> <a class="page-link" href = "'.$linksForButtons.($currentPage-1).'/">Anterior</a>
						</li>

		<li class=" page-item"> <a class="page-link" href = "'.$linksForButtons.$nroMaxPages.'/">  <i class="fas fa-angle-double-right"></i></a>
						</li>';


		}

		$table .= '</ul></nav>';
		return $table;
	}


		public static function isDataEmtpy(...$data){

		foreach ($data as $value) {
		    
		    if(empty($value) || is_null($value) || self::isStringOnlyHasSpaces($value)){
		        return true;
		    }
		}

		return false;
		}

		public static function isDataEmtpyPermitedZero(...$data){

		foreach ($data as $value) {
		    
		    if(empty($value) || is_null($value) || self::isStringOnlyHasSpaces($value)){
		    	
		    	if (!is_numeric($value)) {
		        return true;
		    	      }
		    }
		}

		return false;
		}


		public static function isStringOnlyHasSpaces($str){
		        $count_arr=0;
		        $count_str=strlen($str);

		        $arr=str_split($str);

		          foreach ($arr as $pos){

		                if (preg_match_all('/\s/',$pos)) {
		                    $count_arr++;
		                }
		            }
		        if ($count_arr==$count_str)  {
		            return TRUE;
		        }else{
		            return FALSE;
		        }
		}

protected static function disableForeingDB(){

self::runSimpleQuery("select 'ALTER TABLE DISABLE TRIGGER ALL;' from information_schema.tables where table_schema = 'public';");

}

protected static function enableForeingDB(){
self::runSimpleQuery("select 'ALTER TABLE ENABLE TRIGGER ALL;' from information_schema.tables where table_schema = 'public';");
}



protected static function isDateGreaterCurrentDate($dateReviewed){
	
	$currentDate =  self::getDateCurrentSystem();

	$currentDate = date("Y-m-d", strtotime($currentDate));

        if($dateReviewed > $currentDate){
            return TRUE;
        }else{
            return FALSE;

        }
}



public static function getDateCurrentSystem(){
      
    date_default_timezone_set("America/Caracas");

     return $currentDate = date("Y-m-d H:i:s");

}

protected static function isValidNroTlf(...$nrosTlfs){
    foreach ($nrosTlfs as $nroTlf) {

    if(preg_match("/^[0-9]{11}$/",$nroTlf)){
        return true;
    }
}

return false;
}

// Para caracteres que usuarios usualmente usam para separar en un input
public static function ClearUserSeparatedCharacters($inputString){
    $inputString=preg_replace("/\.|-|\s/", "",$inputString);
   
    return $inputString;
	}


public static function isValidSelectionTwoOptions($idOption){

    if (strcmp($idOption,"1") == 0 || strcmp($idOption,"2") == 0) {
		return TRUE;
	}
	else FALSE;
}


public static function isTwoValuesEquals($value1,$value2){
    if(strcmp($value1,$value2)){
        return true;
    }else{
        return false;
    }
}


protected static function  isStringInRange($string,$rangeMin,$rangeMax){
    
    if(strlen($string)<$rangeMin or strlen($string)>$rangeMax){
        return false;
    }else{
        return true;
    }
}

// funciones para la bitacora

protected function  addUsuarioBitacora($dataUserBitacora){

	$sqlQuery = self::connectDB()->prepare("INSERT INTO usuario_bitacora(
		usuario_alias
		,bitacora_codigo
		,bitacora_fecha
		,bitacora_hora_inicio
		,bitacora_hora_final
		,bitacora_nivel_usuario
		,bitacora_year) VALUES (
		:usuario_alias,
		:bitacora_codigo,
		:bitacora_fecha,
		:bitacora_hora_inicio,
		:bitacora_hora_final,
		:bitacora_nivel_usuario,
		:bitacora_year)");

			return $sqlQuery->execute(array(
		"usuario_alias"=>$dataUserBitacora['usuario_alias'],
		"bitacora_codigo"=>$dataUserBitacora['bitacora_codigo'],
		"bitacora_fecha"=>$dataUserBitacora['bitacora_fecha'],
		"bitacora_hora_inicio"=>$dataUserBitacora['bitacora_hora_inicio'],
		"bitacora_hora_final"=>$dataUserBitacora['bitacora_hora_final'],
		"bitacora_nivel_usuario"=>$dataUserBitacora['bitacora_nivel_usuario'],
		"bitacora_year"=>$dataUserBitacora['bitacora_year']));

}

protected function updateUsuarioBitacora($dataUserBitacora){

		$DB_transacc = mainModel::connectDB();

		$DB_transacc->beginTransaction();


	try {

$sqlQuery = $DB_transacc->prepare("UPDATE usuario_bitacora SET
		bitacora_hora_final=:bitacora_hora_final WHERE bitacora_codigo = :bitacora_codigo");

			$sqlQuery->execute(array(
		"bitacora_hora_final"=>$dataUserBitacora['bitacora_hora_final'],
		"bitacora_codigo"=>$dataUserBitacora['bitacora_codigo']));

		$sqlQuery->closeCursor();

			$DB_transacc->commit();


		$alert= ["Alert"=>"redirecting",
				"URL"=>SERVERURL];
			
			}catch (Exception $e) {

			$DB_transacc->rollBack();

				$alert=[
					"Alert"=>"simple",
					"Title"=>"Ocurrio un error inesperado",
					"Text"=>"No se pudo cerrar la sesion en el sistema <br>
					Error".$e->getMessage()."",
					"Type"=>"error"

				];


		}
			return $alert;


	}



protected static function deleteBitacora($usuario_alias){

	self::disableForeingDB();
 	
 	$sqlQuery = self::connectDB()->prepare(self::$stringQueryDeleteBitacora);
	
	$resultQuery = $sqlQuery->execute(array("usuario_alias"=>$usuario_alias));

	self::enableForeingDB();

	return $resultQuery;
}


	public static function querySelectsCreator($table,$columnsTable,$attributesFilter,$filterValues){
			
		try{
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

//			$sqlQuery->bindValue($key,$values['value']);

			$sqlQuery->bindParam($key, $values['value'], $values['type']);

		}

		return $sqlQuery;

		} catch (PDOException $e) {
		    var_dump("Fallo al conectar con la base de datos: ".$e->getMessage());
		}

		}

	
// Comrpueba que un conjuntos de campos enviados comparar tienen los mismo valores a los registrados en la base de datos

public static function isFieldsEqualToThoseInTheDatabase($queryToGet,$fieldstoCompare){

 		$queryToGet->execute();

		$records = $queryToGet->fetch(PDO::FETCH_ASSOC);


 		$matchCounterDatabaseFields = 0;
		 
		 $counterFieldsToCompare = 0;


		 if (!$records) {
				return false;
		 }

		foreach ($records as $databaseKey => $databaseValue) {
 			$counterFieldsToCompare++;
 				// si encuentra uno diferente los datos no son iguales


				if (strcmp($databaseValue,$fieldstoCompare[$databaseKey])!=0) {
				$matchCounterDatabaseFields++;

				return false;

				}
			}

			return true;
		}

	protected static function getDataTableServerSideModel($table, $index_column, $columnsTable,$columnsPrintDataTable='',$ifPersonalizedPrint=false) {


		if (empty($columnsPrintDataTable)) {
			$columnsPrintDataTable = $columnsTable;

		}

		// Paging
    /*
     * Script:    DataTables server-side script for PHP and PostgreSQL
     * Copyright: 2010 - Allan Jardine
     * License:   GPL v2 or BSD (3-point)
     */
     
    /* * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
     * Easy set variables
     */
     
    /* Array of database columns which should be read and sent back to DataTables. Use a space where
     * you want to insert a non-database field (for example a counter or static image)
     */
    $aColumns = $columnsTable;
     
    /* Indexed column (used for fast and accurate table cardinality) */
    $sIndexColumn = $index_column;
     
    /* DB table to use */
    $sTable = $table;

    /* Database connection information */

    $gaSql['user']       = USER;
    $gaSql['password']   = PASS;
    $gaSql['db']         = DB;
    $gaSql['server']     = SERVER_PATH;
  
    /* * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
     * If you just want to use the basic configuration for DataTables with PHP server-side, there is
     * no need to edit below this line
     */
     
    
    //* DB connection

if (IF_LOCAL_SERVER) {

    $gaSql['link'] = pg_connect(
        " host=".$gaSql['server'].
        " dbname=".$gaSql['db'].
        " user=".$gaSql['user'].
        " password=".$gaSql['password']
    ) or die('Could not connect: ' . pg_last_error());

}else{


 $db_url = getenv("DATABASE_URL") ?: "postgres://ilsmpwdzrresby:7879db47bd3be54c574eab3a81a1bc2db477bc890a756eccc406992832a0fd8e@ec2-54-246-87-132.eu-west-1.compute.amazonaws.com:5432/d4hub5gh1m9jjj";

$gaSql['link'] = pg_connect($db_url);
 }
    
    /*
     * Paging
     */
    $sLimit = "";
    if ( isset( $_GET['iDisplayStart'] ) && $_GET['iDisplayLength'] != '-1' )
    {
        $sLimit = "LIMIT ".intval( $_GET['iDisplayLength'] )." OFFSET ".
            intval( $_GET['iDisplayStart'] );
    }
     
     
    /*
     * Ordering
     */
    if ( isset( $_GET['iSortCol_0'] ) )
    {
        $sOrder = "ORDER BY  ";
        for ( $i=0 ; $i<intval( $_GET['iSortingCols'] ) ; $i++ )
        {
            if ( $_GET[ 'bSortable_'.intval($_GET['iSortCol_'.$i]) ] == "true" )
            {
                $sOrder .= $aColumns[ intval( $_GET['iSortCol_'.$i] ) ]."
                    ".($_GET['sSortDir_'.$i]==='asc' ? 'asc' : 'desc').", ";
            }
        }
         
        $sOrder = substr_replace( $sOrder, "", -2 );
        if ( $sOrder == "ORDER BY" )
        {
            $sOrder = "";
        }
    }
     
     
    /*
     * Filtering
     * NOTE This assumes that the field that is being searched on is a string typed field (ie. one
     * on which ILIKE can be used). Boolean fields etc will need a modification here.
     */

//                    $where .= 'UNACCENT('.$columnsSearch[$i]."::text) ILIKE UNACCENT('%".$valueSearch."%') OR ";

    $sWhere = "";
    if ( $_GET['sSearch'] != "" )
    {
        $sWhere = "WHERE (";
        for ( $i=0 ; $i<count($columnsPrintDataTable) ; $i++ )
        {
            if ( $_GET['bSearchable_'.$i] == "true" )
            {
                $sWhere .= 'UNACCENT('.$columnsPrintDataTable[$i]."::text) ILIKE UNACCENT('%".pg_escape_string( $_GET['sSearch'] )."%'::text) OR ";
            }
        }
        $sWhere = substr_replace( $sWhere, "", -3 );
        $sWhere .= ")";
    }
     



    /* Individual column filtering */

//	var_dump($_GET);


    for ( $i=0 ; $i<count($columnsPrintDataTable) ; $i++ )
    {
/*
var_dump($_GET['bSearchable_'.$i]);
var_dump($_GET['sSearch_'.$i]);
*/
        if ($_GET['bSearchable_'.$i] == "true" && $_GET['sSearch_'.$i] != '' )        {
/*


	var_dump($_GET['sSearch_'.$i=+2]);
	var_dump($_GET['bSearchable_'.$i]);
	var_dump($columnsPrintDataTable[$i]);
	echo "<hr><br>";
*/

//                    $where .= 'UNACCENT('.$columnsSearch[$i]."::text) ILIKE UNACCENT('%".$valueSearch."%') OR ";

            if ( $sWhere == "" )
            {
                $sWhere = "WHERE ";
            }
            else
            {
                $sWhere .= " AND ";
            }
            $sWhere .=  'UNACCENT('.$columnsPrintDataTable[$i]."::text) ILIKE UNACCENT('%".pg_escape_string($_GET['sSearch_'.$i])."%'::text)";
/*if (condition) {
	# code...
}*/

}

//	var_dump($columnsPrintDataTable[$i+1],$_GET['sSearch_'.$i]);

    }

    if (isset($_GET['minDateRange']) && isset($_GET['maxDateRange']) &&
        !empty($_GET['minDateRange']) && !empty($_GET['maxDateRange']) ) {

     $minDateRange = mainModel::cleanStringSQL($_GET['minDateRange']);

     $maxDateRange = mainModel::cleanStringSQL($_GET['maxDateRange']);

     $nameDateFieldDB = mainModel::cleanStringSQL($_GET['nameDateFieldDB']);

            if ( $sWhere == "" )
            {
                $sWhere = "WHERE ";
            }
            else
            {
                $sWhere .= " AND ";
            }
      $sWhere.= $nameDateFieldDB." BETWEEN '$minDateRange' AND '$maxDateRange'";
       }



if (isset($_GET['minAgeRange']) && isset($_GET['maxAgeRange']) && !self::isDataEmtpyPermitedZero($_GET['minAgeRange']) && !self::isDataEmtpyPermitedZero($_GET['maxAgeRange']) ) {


     $minAgeRange = mainModel::cleanStringSQL($_GET['minAgeRange']);

     $maxAgeRange = mainModel::cleanStringSQL($_GET['maxAgeRange']);

     $nameAgeFieldDB = 'edadINT';

            if ( $sWhere == "" )
            {
                $sWhere = "WHERE ";
            }
            else
            {
                $sWhere .= " AND ";
            }
      $sWhere.= $nameAgeFieldDB." BETWEEN $minAgeRange AND $maxAgeRange";

     //var_dump ($sWhere);
      //exit();

       }
       

if (isset($_GET['minKeyCIE10']) && isset($_GET['maxKeyCIE10']) &&
  !empty($_GET['minKeyCIE10']) && !empty($_GET['maxKeyCIE10']) ) {

     $minKeyCIE10 = strtoupper(mainModel::cleanStringSQL($_GET['minKeyCIE10']));

     $maxKeyCIE10 = strtoupper(mainModel::cleanStringSQL($_GET['maxKeyCIE10']));

       $queryGetConsecutivoCIE10 = self::connectDB()->query("SELECT consecutivo from data_cie10 where catalog_key = '".$minKeyCIE10."' LIMIT 1");

       $minConsecutivoCie10 = $queryGetConsecutivoCIE10->fetchColumn();

       $queryGetConsecutivoCIE10 = self::connectDB()->query("SELECT consecutivo from data_cie10 where catalog_key = '".$maxKeyCIE10."' LIMIT 1");

       $maxConsecutivoCie10 = $queryGetConsecutivoCIE10->fetchColumn();

     $nameKeyCIE10FieldDB = 'consecutivo_cie10';

     if (mainModel::isDataEmtpy($minConsecutivoCie10,$maxConsecutivoCie10)) {
     		$minConsecutivoCie10 = 0;
     		$maxConsecutivoCie10 = 0;
     }

            if ( $sWhere == "" )
            {
                $sWhere = "WHERE ";
            }
            else
            {
                $sWhere .= " AND ";
            }
      $sWhere.= $nameKeyCIE10FieldDB." BETWEEN '$minConsecutivoCie10' AND '$maxConsecutivoCie10'";
       }
       

          // Script para solictar la data del CIE10 por capitulos
 	if (isset($_GET['idCapitulo'] ) && !self::isDataEmtpy($_GET['idCapitulo'] )) {
      		$idCapitulo = self::cleanStringSQL($_GET['idCapitulo']);
            if ( $sWhere == "" )
            {
                $sWhere = "WHERE ";
            }
            else
            {
                $sWhere .= " AND ";
            }
			$sWhere.=" CLAVE_CAPITULO = '$idCapitulo' ";
		}
		
		

		// para paginar en base a un usuario especifico

 	if (isset($_GET['requestedAliasUser']) && !self::isDataEmtpy($_GET['requestedAliasUser'] )) {
      		$requestedAliasUser = self::cleanStringSQL($_GET['requestedAliasUser']);
            if ( $sWhere == "" )
            {
                $sWhere = "WHERE ";
            }
            else
            {
                $sWhere .= " AND ";
            }
			$sWhere.=" alias = '$requestedAliasUser' ";
		}

 	if (isset($_GET['requestedPersonEpidemi']) && !self::isDataEmtpy($_GET['requestedPersonEpidemi'])) {
      		$requestedPersonEpidemi = self::cleanStringSQL($_GET['requestedPersonEpidemi']);
            if ( $sWhere == "" )
            {
                $sWhere = "WHERE ";
            }
            else
            {
                $sWhere .= " AND ";
            }
			$sWhere.=" alias = '$requestedPersonEpidemi' ";
		}
     
    $sQuery = "
        SELECT ".str_replace(" , ", " ", implode(", ", $aColumns))."
        FROM   $sTable
        $sWhere
        $sOrder
        $sLimit
    ";


//var_dump($sQuery);

    $rResult = pg_query( $gaSql['link'], $sQuery ) or die(pg_last_error());
     
    $sQuery = "
        SELECT $sIndexColumn
        FROM   $sTable
    ";

    $rResultTotal = pg_query( $gaSql['link'], $sQuery ) or die(pg_last_error());
    $iTotal = pg_num_rows($rResultTotal);
    pg_free_result( $rResultTotal );
     
    if ( $sWhere != "" )
    {
        $sQuery = "
            SELECT $sIndexColumn
            FROM   $sTable
            $sWhere
        ";


        $rResultFilterTotal = pg_query( $gaSql['link'], $sQuery ) or die(pg_last_error());
        $iFilteredTotal = pg_num_rows($rResultFilterTotal);
        pg_free_result( $rResultFilterTotal );
    }
    else
    {
        $iFilteredTotal = $iTotal;
    }

    // solo retronaremos los valores si queremos armar una impresion personalizada
    if ($ifPersonalizedPrint) {
		    return $output = array(
		        "sEcho" => intval($_GET['sEcho']),
		        "iTotalRecords" => $iTotal,
		        "iTotalDisplayRecords" => $iFilteredTotal,
		        "aaData" => array(),
		        "sTable" => $sTable,
		        "sWhere" => $sWhere,
		        "sOrder" => $sOrder,
		        "sLimit" => $sLimit,

		    );
     }


    /*
     * Output
     */
    $output = array(
        "sEcho" => intval($_GET['sEcho']),
        "iTotalRecords" => $iTotal,
        "iTotalDisplayRecords" => $iFilteredTotal,
        "aaData" => array()
    );
     
    while ( $aRow = pg_fetch_array($rResult, null, PGSQL_ASSOC) )
    {
        $row = array();
        for ( $i=0 ; $i<count($aColumns) ; $i++ )
        {
            if ( $aColumns[$i] == "version" )
            {
                /* Special output formatting for 'version' column */
                $row[] = ($aRow[ $aColumns[$i] ]=="0") ? '-' : $aRow[ $aColumns[$i] ];
            }
            else if ( $aColumns[$i] != ' ' )
            {
                /* General output */
                $row[] = $aRow[ $aColumns[$i] ];
            }
        }
        $output['aaData'][] = $row;
    }

    echo json_encode( $output );
     
    // Free resultset
    pg_free_result( $rResult );
     
    // Closing connection
    pg_close( $gaSql['link'] );

    	}


    	public static function arrayInsert($array,$arrayInsert,$pos){
            $arrayResult = array_merge(
            array_slice($array, 0, $pos),
            $arrayInsert,
            array_slice($array, $pos));
            
            return $arrayResult;
		}


	protected static function getMsgErrorSQL($codeError) {
	

		switch ($codeError) {
			case '23503':

			return 'El Registro a actualizar o eliminar  ya esta siendo usado en otra parte del sistema';

				break;

			case '22P02':
			return 'Se ha encontrado un valor invalido en una fila';
				break;

			case '23001':
			return 'Un campo que funciona como identificador es invalido o no puede estar repetido';
				break;

			case '23502':
			return 'Un campo que funciona como identificador puede estar invalido o no puede estar repetido';
				break;

			case '23505':
			return 'Un campo que funciona como identificador puede estar invalido o no puede estar repetido';
				break;

			case '42830':
			return 'Un campo que funciona como identificador es invalido o no puede estar repetido';
				break;

			case '22001':
			return 'Se ha encontrado un valor demasiado largo en un campo';
				break;

			default:

			return "Error Desconocido en la Operacion";

				break;
		}



	}

	
public static function utf8_converter($array){
    /*array_walk_recursive($array, function(&$item, $key){
    $entry = mb_convert_encoding(
        $entry,
        'UTF-8'
    );

    });
    return $array;*/

    for ($i=0; $i < count($array) ; $i++) {

		$array[$i] = mb_convert_encoding($array[$i], 'UTF-16LE', 'UTF-8');

    }

    return $array;
}



public static function msgIfNotHaveIdentityDoc($doc_identidad){
	if (empty($doc_identidad)){
		return "No Posee";
	}
		return $doc_identidad;
}

}
