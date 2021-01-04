
<?php 
// Se llamara la libreria para procesar e insetrar los valores del .csv

  require_once '../libraries/spout/src/Spout/Autoloader/autoload.php';

use Box\Spout\Reader\ReaderFactory;
use Box\Spout\Writer\WriterFactory;
use Box\Spout\Common\Type;
use Box\Spout\Reader\Common\Creator\ReaderEntityFactory;
use Box\Spout\Writer\Common\Creator\WriterEntityFactory;
use Box\Spout\Common\Entity\Row;

   $ReaderEntityFactory = new ReaderEntityFactory();

   $WriterEntityFactory = new WriterEntityFactory();

libxml_disable_entity_loader(false);

 ?>
