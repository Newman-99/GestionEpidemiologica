<?php 

		$DB_transacc = $loginController->connectDB();

		$DB_transacc->beginTransaction();

	try {

		$sqlQuery = $DB_transacc->prepare('INSERT INTO personas(
		 doc_identidad,
		 nombres,
		 apellidos,
		 fecha_nacimiento,
		 id_nacionalidad,
		 id_genero) VALUES (
		 :doc_identidad,
		 :nombres,
		 :apellidos,
		 :fecha_nacimiento,
		 :id_nacionalidad,
		 :id_genero);');

		$sqlQuery->execute(array(
		 "doc_identidad"=>'1729380',
		"id_nacionalidad"=>'1',
		 "nombres"=>'carlos',
		 "apellidos"=>'rodriguez',
		 "fecha_nacimiento"=>'2020-12-12',
		 "id_genero"=>1));

		$sqlQuery->closeCursor();

			var_dump("Si se hizo");

			}catch (Exception $e) {

			$DB_transacc->rollBack();

			var_dump("No se ha podido importar los Casos Epidemiologicos en el sistema<br>
					Error".$e->getMessage()."");
	}

 ?>
