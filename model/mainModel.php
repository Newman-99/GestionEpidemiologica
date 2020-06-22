<?php 

$requestAjax = TRUE;
	if ($requestAjax) {
		require_once "../config/server.php";

	} else {
		require_once "./config/server.php";
	}
	

	class mainModel{
		
		protected static function connectDB(){
		$linkBD = new PDO(SGBD,USER,PASS);
		$linkBD->exec("SET CHARACTER SET utf8");
		return $linkBD;
	}

		protected static function runSimpleQuery($stringQuery){
		$requestedSimpleQuery = self::connectDB()->prepare($stringQuery);
		$requestedSimpleQuery->execute();
		return $requestedSimpleQuery;
	}

		public function encryption($string){
			$output=FALSE;
			$key=hash('sha256', SECRET_KEY);
			$iv=substr(hash('sha256', SECRET_IV), 0, 16);
			$output=openssl_encrypt($string, METHOD, $key, 0, $iv);
			$output=base64_encode($output);
			return $output;
		}

		public static function decryption($string){
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

	$RamdonCode.=$Codeletter.$identifierNumber;

	return $RamdonCode;

}

public function cleanStringSQL($string){

	$string = trim($string);
	$string = stripcslashes($string);
	$string = str_ireplace("<script>","",$string);
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
			return false;
		} else {
			return true;
			// Si hay errors
		}
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
		    
		    if(empty($value) || self::isStringOnlyHasSpaces($value)){        
		        return true;
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
    return "SET FOREIGN_KEY_CHECKS=0; ";
}

protected static function enableForeingDB(){
    return " SET FOREIGN_KEY_CHECKS=1; ";
}


	}





