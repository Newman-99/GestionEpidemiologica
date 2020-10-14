
          <!-- Page Heading -->
          <h1 class="h3 mb-4 text-gray-800">Blank Page</h1>
<?php  

  $indexsAndNamesColumnsJoin = [];

  foreach ($columnsInnerJoin as $indexsAndNamesColumns) {
  $indexsAndNamesColumnsJoin[] = explode(".", $indexsAndNamesColumns);
}

  $indexsJoin=[];

for ($i = 0; $i < count($indexsAndNamesColumnsJoin); $i++) {
     $indexsJoin[] = $indexsAndNamesColumnsJoin[$i][0];
}


$nameColumnsJoin=[];
for ($i = 0; $i < count($indexsAndNamesColumnsJoin); $i++) {
     $nameColumnsJoin[] = $indexsAndNamesColumnsJoin[$i][1];
}
  // Array inicial en caso de anadir mas colums despues
  
  // Principalmente para obviar la column rowNumber
 $nameInitialJoinColumns = $nameColumnsJoin;

//para agregar la funcion de conteo de filas en la query
if (!empty($orderForRowCounts)) {

$row_number = "row_number() over(".$orderForRowCounts.")";

$columnsInnerJoin = self::arrayInsert($columnsInnerJoin,array($row_number),1);
$nameColumnsJoin = self::arrayInsert($nameColumnsJoin,array('row_number'),1);
}
z


    /* Indexed column (used for fast and accurate table cardinality) */
//    $sIndexColumn = $sIndexColumn;
     
    /* DB tables joins to use */
    //$sTable = $tablesJoins;

 ?>