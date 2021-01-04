<?php 

		use PhpDbCloud\Filesystems\Destination;

		$fileName="gestion-epidemi"; 

 		$currentDate =  mainModel::getDateCurrentSystem();

     	$date = date("d-m-Y_", $currentDate);
		$date.= date("H-i-s", $currentDate);

		$nameBackup =$fileName.'_'.$date.'.sql';

			$sync = require '../config/boostrap-phpcloud.php';

			$sync
			    ->makeBackup()
			    ->run('production', [
			        new Destination('local',$nameBackup),
			    ], 'gzip');


 ?>