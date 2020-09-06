
<?php 
// Se llamara la libreria para procesar e insetrar los valores del .csv

  require_once '../vendor/spout/src/Spout/Autoloader/autoload.php';

use Box\Spout\Reader\ReaderFactory;
use Box\Spout\Writer\WriterFactory;
use Box\Spout\Common\Type;
use Box\Spout\Reader\Common\Creator\ReaderEntityFactory;

   $ReaderEntityFactory = new ReaderEntityFactory();

libxml_disable_entity_loader(false);

 ?>
