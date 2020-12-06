<?php 

		use PhpDbCloud\Filesystems\Destination;

		$fileName="gestionEpidemi"; 

		//$ruta='../backups_temp/'; 

		$date = date("d-m-Y_");
		$date.= 'H'.date("H-m-s");
		$nameBackup =$fileName.'-'.$date.'.sql';

			$sync = require '../config/boostrap-phpcloud.php';

			$sync
			    ->makeBackup()
			    ->run('production', [
			        new Destination('local',$nameBackup),
			    ], 'gzip');


 ?>