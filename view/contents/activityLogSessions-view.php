          <!-- Page Heading -->
          <h1 class="h3 mb-2 text-gray-800">Usuarios</h1>
          
          <!-- <p class="mb-4">DataTables is a third party plugin that is used to generate the demo table below. For more information about DataTables, pleas>
          -->
        <div class='card shadow mb-4'>
            <div class='card-header py-3'>
              <h6 class='m-0 font-weight-bold text-primary'>Registro de Sesiones</h6>
            </div>
            <div class='card-body'>

<?php 


  $userEncryptURl= explode("/",$_GET['views']);

          $requestedAliasUser = $loginController->decryption($userEncryptURl[1]);

  if($_SESSION['id_nivel_permiso']!=1 && strcmp($_SESSION["aliasUser"],$requestedAliasUser) != 0){
    echo $loginController->forceClosureController();
    exit();
  }

            $msjError = $loginController::$msjErrorRequestData404;


            $dataUrl= explode("/",$_GET['views']);
                if (!empty($userEncryptURl[1])){

                 $requestAjax =  FALSE;

                require_once "./controller/userController.php";
              
                $userController = new userController();

  
                      $userAttributesFilter =  [];

                      $userFilterValues = [];

                      array_push($userAttributesFilter, 'alias = :aliasUser');
                      $userFilterValues[':aliasUser'] = [
                      'value' => $requestedAliasUser,
                      'type' => \PDO::PARAM_STR,
                      ];
                                 $queryUserRequested=$userController->getQueryInnerJoimForUser($userAttributesFilter,$userFilterValues);
                                
                                  $queryUserRequested->execute();

                      if (empty($requestedAliasUser) || !$queryUserRequested->rowCount()) {
                                  echo $msjError;
                                  exit;
                      }
                }
 ?>

          
          <!-- <p class="mb-4">DataTables is a third party plugin that is used to generate the demo table below. For more information about DataTables, pleas>
          -->

          <?php
  
            $requestAjax = FALSE;
           require_once "./controller/activityLogSessionsController.php";
          $activityLogSessionsController= new activityLogSessionsController();

          $currentDate = date("d-m-Y");

// Esta vendira siendo la fecha de hoy
           $todayDate = date("Y-m-d",strtotime($currentDate));

           $minDateRangeDefault = date("Y-m-d",strtotime($currentDate."- 7 days"));

//es la feha con el registro mas viejo
$minDateValueAvailable = $activityLogSessionsController-> getFirstDateRecordsActivityLogSessionsController();
           ?>

  
  <div class='table-responsive-disabled'>


           <!-- Formulario para limitar fecha mediante el Backend -->
          
        <div class="input-table "> 
          <div class='form-row'>
            <div class="col-md-3">
          <input type='date' class='form-control input-add-table' id='minDateRange' name='minDateRange'
          min ='<?php echo $minDateValueAvailable; ?>' max = '<?php echo $todayDate; ?>'>
            </div>

            <div class="col-md-3">
          <input type='date' class='form-control input-add-table' id='maxDateRange' name='maxDateRange' min ='<?php echo $minDateValueAvailable; ?>' max = '<?php echo $todayDate; ?>'>
            </div>
              
          <input type="hidden" name="urlToRequestQuery" id="urlToRequestQuery"  class='form-control' value='<?php echo SERVERURL; ?>ajax/activityLogSessionsAjax.php'>
         
          <input type='hidden' class='form-control' id='requestedAliasUser' name='requestedAliasUser' value='<?php echo $requestedAliasUser; ?>'>
              
          </div>
        </div>
           <!-- FINAL Formulario para limitar fecha mediante el Backend -->

                <table class='table table-striped display' id='dataTable' width='100%' cellspacing='0'>
                  <thead>
                    <tr>

                      <th >id_bitacora</th>
                      <th>Nro. </th>
                      <th></th>
                      <th>Documento de Identidad</th>
                      <th>Alias de Usuario</th>
                      <th>Nombres</th>
                      <th>Apellidos</th>
                      <th>Nivel de Permiso</th>
                      <th>Fecha</th>
                      <th>Hora de Entrada</th>
                      <th>Hora de Cierre</th>
                    </tr>
                  </thead>
                  <tfoot>
                    <tr>
                      <th>id_bitacora</th>
                      <th>Nro. </th>
                      <th></th>
                      <th>Documento de Identidad</th>
                      <th>Alias de Usuario</th>
                      <th>Nombres</th>
                      <th>Apellidos</th>
                      <th>Nivel de Permiso</th>
                      <th>Fecha</th>
                      <th>Hora de Entrada</th>
                      <th>Hora de Cierre</th>
                    </tr>
                  </tfoot>
                  <tbody>


                    </tbody>
                </table>
              </div>
           </div>
      </div>



  <script src="<?php echo SERVERURL; ?>view/js/scriptsSendAndRequestDataFromBakend.js"></script>


<script type="text/javascript">

//  limitación de consulta personlizada
//  Si hace click en btnQueryLimiter usa los valores de los neuvos campos
//  si no hace click usa los datos por default

// para que solo se llame la funcion una vez

  $( document ).ready(function() {
 
requestQueryByActionToAction();

function requestQueryByActionToAction(){

    var url = $('#urlToRequestQuery').val();
    var requestedAliasUser = $('#requestedAliasUser').val();

$('#minDateRange,#maxDateRange').change(function() {
    var minDateRange  = $('#minDateRange').val();
    var maxDateRange = $('#maxDateRange').val();
// ambos rangos de fecha deben poseer valores

if (!isBlank(minDateRange) && !isBlank(maxDateRange)) {
return getDataActivityLogSessionsForDataTables(requestedAliasUser,minDateRange,maxDateRange,url);  
}

})

// si no se dio click pero si se actualizo;

// Esta vendira siendo la fecha de hoy
var todayDate = new Date;

var todayDatePHP = todayDate.toISOString().split('T')[0];

var minDateRangeDefault = addOrRemoveDaysToDate(todayDate,7,false);

// [ara pasar de formato js a aaaa-mm-dd de PHP
var minDateRangeDefaulPHP = minDateRangeDefault.toISOString().split('T')[0];


//alert($('#maxDateRange').attr('min'));
$('#minDateRange').val(minDateRangeDefaulPHP)
$('#maxDateRange').val(todayDatePHP)

return getDataActivityLogSessionsForDataTables(requestedAliasUser,minDateRangeDefaulPHP,todayDatePHP,url);    

}

  });




</script>

