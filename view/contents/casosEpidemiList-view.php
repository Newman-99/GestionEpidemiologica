
<?php 


  // solicitar dara de person en especifico
  $userEncryptURl= explode("/",$_GET['views']);

// En caso de busca los casos en especifico
  $requestedPersonEpidemi = $loginController->decryption($userEncryptURl[1]);

  if($_SESSION['id_nivel_permiso']>2){
    echo $loginController->forceClosureController();
    exit();
  }

?>

          <!-- Page Heading -->
          <h1 class="h3 mb-2 text-gray-800">Lista de Casos Epidemioloficos</h1>
          
          <!-- <p class="mb-4">DataTables is a third party plugin that is used to generate the demo table below. For more information about DataTables, pleas>
          -->

          <?php
  
            $requestAjax = FALSE;
           require_once "./controller/casosEpidemiController.php";
          $casosEpidemiController= new casosEpidemiController();

        $currentDate = date("d-m-Y");

// Esta vendira siendo la fecha de hoy

         $maxDateAllowed = date("Y-m-d",strtotime($currentDate.'- 1 days'));

           $minDateRangeDefault = date("Y-m-d",strtotime($currentDate."- 8 days"));

//es la feha con el registro mas viejo
$minDateValueAvailable = $casosEpidemiController-> getFirstDateRecordscasosEpidemiController();
           ?>

        <div class='card shadow mb-4'>
            <div class='card-header py-3'>
              <h6 class='m-0 font-weight-bold text-primary'>Lista de Usuarios</h6>
            </div>
            <div class='card-body'>
  
  <div class='table-responsive'>


           <!-- Formulario para limitar fecha mediante el Backend -->
          <div class='form-group col-sm-2'>

          <input type='date' class='form-control' id='minDateRange' name='minDateRange'
          min ='<?php echo $minDateValueAvailable; ?>' max = '<?php echo $maxDateAllowed; ?>'
          >

          <input type='date' class='form-control' id='maxDateRange' name='maxDateRange' min ='<?php echo $minDateValueAvailable; ?>' max = '<?php echo $maxDateAllowed; ?>'>

          <input type="hidden" name="urlToRequestQuery" id="urlToRequestQuery"  class='form-control' value='<?php echo SERVERURL; ?>ajax/casosEpidemiAjax.php'>
         
          <input type='hidden' class='form-control' id='requestedPersonEpidemi' name='requestedPersonEpidemi' value='<?php echo $requestedPersonEpidemi; ?>'>

          </div>
           <!-- FINAL Formulario para limitar fecha mediante el Backend -->

                <table class='table table-bordered' id='dataTable' width='100%' cellspacing='0'>
                  <thead>
                    <tr>
                      <th>Nro. </th>
                      <th >Id Caso</th>
                      <th></th>
                      <th></th>
                      <th>Documento de Identidad</th>
                      <th>Nombres</th>
                      <th>Apellidos</th>
                      <th>Codigo CIE-10</th>
                      <th>Nombre CIE-10</th>
                      <th>Fecha</th>
                      <th>Parroquia</th>
                      <th>Direccion</th>
                      <th>Telefono</th>
                      <th>Usuario</th>
                      <th>Fecha de Registro</th>
                      <th>Hora de Registro</th>
                    </tr>
                  </thead>

                  <tfoot>
                    <tr>
                      <th>Nro. </th>
                      <th >Id Caso</th>
                      <th></th>
                      <th></th>
                      <th>Documento de Identidad</th>
                      <th>Nombres</th>
                      <th>Apellidos</th>
                      <th>Codigo CIE-10</th>
                      <th>Nombre CIE-10</th>
                      <th>Fecha</th>
                      <th>Parroquia</th>
                      <th>Direccion</th>
                      <th>Telefono</th>
                      <th>Usuario</th>
                      <th>Fecha de Registro</th>
                      <th>Hora de Registro</th>
                    </tr>
                  </tfoot>
                  <tbody>
                    
                    </tbody>
                </table>
              </div>
           </div>
      </div>



  <script src="<?php echo SERVERURL; ?>view/js/scriptsRequestDataFromBakend.js"></script>


<script type="text/javascript">

//  limitación de consulta personlizada
//  Si hace click en btnQueryLimiter usa los valores de los neuvos campos
//  si no hace click usa los datos por default

// para que solo se llame la funcion una vez

  $( document ).ready(function() {
 
requestQueryByActionToAction();

function requestQueryByActionToAction(){

    var url = $('#urlToRequestQuery').val();
    var requestedPersonEpidemi = $('#requestedPersonEpidemi').val();

$('#minDateRange,#maxDateRange').change(function() {
    var minDateRange  = $('#minDateRange').val();
    var maxDateRange = $('#maxDateRange').val();
// ambos rangos de fecha deben poseer valores

if (!isBlank(minDateRange) && !isBlank(maxDateRange)) {
return getDataCasosEpidemiForDataTables(requestedPersonEpidemi,minDateRange,maxDateRange,url);  
}

})

// si no se dio click pero si se actualizo;

// Esta vendira siendo la fecha de hoy
var maxDateAllowed = new Date;

var maxDateAllowed = addOrRemoveDaysToDate(maxDateAllowed,1,false);

var maxDateAllowedPHP = maxDateAllowed.toISOString().split('T')[0];

var minDateRangeDefault = addOrRemoveDaysToDate(maxDateAllowed,7,false);

// [ara pasar de formato js a aaaa-mm-dd de PHP
var minDateRangeDefaulPHP = minDateRangeDefault.toISOString().split('T')[0];


//alert($('#maxDateRange').attr('min'));
$('#minDateRange').val(minDateRangeDefaulPHP)
$('#maxDateRange').val(maxDateAllowedPHP)

return getDataCasosEpidemiForDataTables(requestedPersonEpidemi,minDateRangeDefaulPHP,maxDateAllowedPHP,url);    

}

  });




</script>

