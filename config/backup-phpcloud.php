<?php 

		use PhpDbCloud\Filesystems\Destination;

		$fileName="gestion-epidemi"; 

 		$currentDate =  mainModel::getDateCurrentSystem();

     	$date = date("d-m-Y_", strtotime($currentDate));
		$date.= date("H-i-s", strtotime($currentDate));

		$nameBackup =$fileName.'_'.$date.'.sql';

			$sync = require '../config/boostrap-phpcloud.php';

			$sync
			    ->makeBackup()
			    ->run('production', [
			        new Destination('local',$nameBackup),
			    ], 'gzip');

 ?>