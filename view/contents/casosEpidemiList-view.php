
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
          <h1 class="h3 mb-2 text-gray-800">Casos Epidemiologicos</h1>
          
          <!-- <p class="mb-4">DataTables is a third party plugin that is used to generate the demo table below. For more information about DataTables, pleas>
          -->

        <div class='card shadow mb-4'>
            <div class='card-header py-3'>
              <h6 class='m-0 font-weight-bold text-primary'>Lista de Casos</h6>
            </div>

            <div class='card-body '>



<?php  require_once "./view/inc/formRegisterCasosEpidemi.php";?>

<?php  require_once "./view/inc/formImportCasosEpidemi.php";?>

  <div class='table-responsive'>


           <!-- INPUTS para parametros denviados al Backend -->
      <div class='input-table'>
        <div class="form-row">
           <!-- Se enviara una fecha por defaul en una semana -->

          <?php
            $requestAjax = FALSE;
           require_once "./controller/casosEpidemiController.php";
          $casosEpidemiController= new casosEpidemiController();

        $currentDate = date("Y-m-d");

          //es la feha con el registro mas viejo
          $minDateValueAvailable = $casosEpidemiController-> getFirstDateRecordscasosEpidemiController();
           ?>
           
            <div class="col-md-3">
          <input type='date' class='form-control input-add-table' id='minDateRange' name='minDateRange'
          min ='<?php echo $minDateValueAvailable; ?>' max = '<?php echo $currentDate; ?>'
          >
            
          <input type='date' class='form-control input-add-table' id='maxDateRange' name='maxDateRange' min ='<?php echo $minDateValueAvailable; ?>' max = '<?php echo $currentDate; ?>'>
            </div>


          <input type="hidden" name="actionForAjax" id="actionForAjax"  class='form-control' value='<?php echo SERVERURL; ?>ajax/casosEpidemiAjax.php'>
 
          <input type='hidden' class='form-control' id='requestedPersonEpidemi' name='requestedPersonEpidemi' value='<?php echo $requestedPersonEpidemi; ?>'>
            
          
          
            <div class="col-md-3">
          <input type='number' placeholder = 'Edad Minima'   class='form-control input-add-table' id='minAgeRange' name='minAgeRange' min ='0' max='200' value=''>
            
          <input type='number' placeholder = 'Edad Maxima' class='form-control input-add-table' id='maxAgeRange' name='maxAgeRange' min ='0' max='200' value=''>
              </div>
          
            <div class="col-md-3">
          <input type='text' placeholder = 'Clave Catalogo Minima' class='form-control input-add-table' id='minKeyCIE10' name='minKeyCIE10' value=''>

          <input type='text' placeholder = 'Clave Catalogo Maxima' class='form-control input-add-table' id='maxKeyCIE10' name='maxKeyCIE10' value=''>

          </div>

            <div class="col-md-1">
             <br>

            <button  class="form-control input-add-table btn btn-info btn-square btn-sm" style="margin-left: 30%;" id='searchInputsRanges' name='searchInputsRanges'>
                    <i class="fas  fa-search-plus fa-lg"></i>  
            </button>
          
          </div>
      </div>
    </div>  
          <!-- Button trigger modal -->

          <div class="p-2">
<button type="button" class="btn btn-primary formCasosEpidemiModal" data-toggle="modal" data-target="#formCasosEpidemiModal">
  Registrar
</button>

<button type="button" class="btn btn-primary importCasosEpidemiModal" data-toggle="modal" data-target="#importCasosEpidemiModal">
  Importar
</button>
          </div>

           <!-- FINAL Formulario para limitar fecha mediante el Backend -->
                <table class='table hover table-striped display' id='dataTable' name = 'dataTable' width='100%' cellspacing='0'>
                  <thead>
                    <tr>
                      
                      <th >Nro. </th>
                      <th >id Caso</th>
                      <th >id Persona</th>
                      <th >id Genero</th>
                      <th >Genero</th>
                      <th >id Nacionalidad (Caso)</th>
                      <th >Nro. Documento de Identidad (Caso)</th>
                      <th >Documento de Identidad</th>
                      <th >Fecha de Nacimiento</th>
                      <th >Edad</th>
                      <th >Nombres</th>
                      <th >Apellidos</th>
                      <th >Clave Capitulo CIE-10</th>
                      <th >Capitulo</th>
                      <th >Codigo CIE-10</th>
                      <th >Nombre CIE-10</th>
                      <th >id atributo especial</th>
                      <th >Atributo Especial</th>
           <!-- 16 --> <th >Id Tipo Entrada Caso </th>
           <!-- 17 --> <th >Tipo de Entrada</th>
                       <th >Notificacion Inmediata</th>
                       <th >is hospital</th>
                      <th >Hospitalizado o Referido</th>
                      <th >Fecha de Registro</th>
                      <th >id Parroquia</th>
                      <th >Parroquia</th>
                      <th >Direccion</th>
                      <th >Telefono</th>
                      <th >Usuario</th>
                      <th >Documento de Identidad</th>
                       <th >Anio de Operacion</th>
                      <th >Fecha de Operacion</th>
                      <th >Hora de Operacion</th>
                      <th class="remove-item-child"></th>                   
                    </tr>

                    <tr>
                      <th>Nro. </th>
                      <th >id Caso</th>
                      <th >id Persona</th>
                      <th>id Genero</th>
                      <th>Genero</th>
                      <th>id Nacionalidad (Caso)</th>
                      <th>Nro. Documento de Identidad (Caso)</th>
                      <th>Documento de Identidad</th>
                      <th>Fecha de Nacimiento</th>
                      <th>Edad</th>
                      <th>Nombres</th>
                      <th>Apellidos</th>
                      <th>Clave Capitulo CIE-10</th>
                      <th>Capitulo</th>
                      <th>Codigo CIE-10</th>
                      <th>Nombre CIE-10</th>
                      <th>id atributo especial</th>
                      <th>Atributo Especial</th>
           <!-- 16 --> <th>Id Tipo Entrada Caso </th>
           <!-- 17 --> <th>Tipo de Entrada</th>
                       <th>Notificacion Inmediata</th>
                       <th>is hospital</th>
                      <th>Hospitalizado o Referido</th>
                      <th>Fecha de Registro</th>
                      <th>id Parroquia</th>
                      <th>Parroquia</th>
                      <th>Direccion</th>
                      <th>Telefono</th>
                      <th>Usuario</th>
                      <th>Documento de Identidad</th>
                       <th>Anio de Operacion</th>
                      <th>Fecha de Operacion</th>
                      <th>Hora de Operacion</th>
                      <th class="remove-item-child"></th>
                    </tr>
                  </thead> 

                  <tfoot>
                    <tr>
           <!--  0 --> <th>Nro. </th>
           <!--  1 --> <th >id Caso</th>
           <!--  2 --> <th >id Persona</th>
           <!--  3 --> <th>id Genero</th>
           <!--  4 --> <th>Genero</th>
           <!--  5 --> <th>id Nacionalidad (Caso)</th>
           <!--  6 --> <th>Nro. Documento de Identidad (Caso)</th>
           <!--  7 --> <th>Documento de Identidad</th>
           <!--  8 --> <th>Fecha de Nacimiento</th>
           <!--  9 --> <th>Edad</th>
           <!--  10 --> <th>Nombres</th>
           <!-- 11 --> <th>Apellidos</th>
           <!-- 12 --> <th>Clave Capitulo CIE-10</th>
           <!-- 13 --> <th>Capitulo</th>
           <!-- 14 --> <th>Codigo CIE-10</th>
           <!-- 15 --> <th>Nombre CIE-10</th>
           <!-- 16 --> <th>id atributo especial</th>
           <!-- 17 --> <th>Atributo Especial</th>
           <!-- 18 --> <th>Id Tipo  Caso </th>
           <!-- 19 --> <th>Tipo de Entrada</th>
           <!-- 20 --> <th>Notificacion Inmediata</th>
           <!-- 21 --> <th>is hospital</th>
           <!-- 22 --> <th>Hospitalizado o Referido</th>
           <!-- 23 --> <th>Fecha de Registro</th>
           <!-- 24 --> <th>id Parroquia</th>
           <!-- 25 --> <th>Parroquia</th>
           <!-- 26 --> <th>Direccion</th>
           <!-- 27 --> <th>Telefono</th>
           <!-- 28 --> <th>Usuario</th>
           <!-- 29 --> <th>Documento de Identidad</th>
           <!-- 30 --> <th>Anio de Operacion</th>
           <!-- 31 --> <th>Fecha de Operacion</th>
           <!-- 32 --> <th>Hora de Operacion</th>
           <!-- 33 --> <th class="remove-item-child"> </th>
                    </tr>

                    <div class="responseProcessAjax"></div>

                    <div class="msgBackendProcess"></div>

                  </tfoot>
                  
                  <tbody>
                    
                    </tbody>
            
                </table>

              </div>
           </div>
      </div>

<script type="text/javascript">

//  limitación de consulta personlizada
//  Si hace click en btnQueryLimiter usa los valores de los neuvos campos
//  si no hace click usa los datos por default

// para que solo se llame la funcion una vez

  $( document ).ready(function() {

// indicar si la pogina se ha cargada la primera vez


requestQueryByActionToAction();

 async function  requestQueryByActionToAction(){

    var url = $('#actionForAjax').val();
    var requestedPersonEpidemi = $('#requestedPersonEpidemi').val();

 var parameterPreGetDataTables = '';

// ambos rangos deben poseer valores

 $('#searchInputsRanges').on('click', function () {

    var minDateRange  = $('#minDateRange').val();
    var maxDateRange = $('#maxDateRange').val();

    var minDateRange  = $('#minDateRange').val();
    var maxDateRange = $('#maxDateRange').val();

    var minKeyCIE10  = $('#minKeyCIE10').val();
    var maxKeyCIE10 = $('#maxKeyCIE10').val();

    var minAgeRange  = $('#minAgeRange').val();
    var maxAgeRange = $('#maxAgeRange').val();

  
if (!isBlank(minDateRange) && !isBlank(maxDateRange)) {
  parameterPreGetDataTables+=
  '&minDateRange='+minDateRange+
  '&maxDateRange='+maxDateRange; 
}




if (!isBlank(minAgeRange) && !isBlank(maxAgeRange) || isBlank(minAgeRange) && isBlank(maxAgeRange)) {
  parameterPreGetDataTables+=
  '&minAgeRange='+minAgeRange+
  '&maxAgeRange='+maxAgeRange;

}


if (!isBlank(minKeyCIE10) && !isBlank(maxKeyCIE10) || isBlank(minKeyCIE10) && isBlank(maxKeyCIE10)) {

  parameterPreGetDataTables+=
  '&minKeyCIE10='+minKeyCIE10+
  '&maxKeyCIE10='+maxKeyCIE10; 
}

return  getDataCasosEpidemiForDataTablesAsync(parameterPreGetDataTables,url);

});

// si no se dio click pero si se actualizo;

// Esta vendira siendo la fecha de hoy
var currentDate = new Date;

//var maxDateAllowed = addOrRemoveDaysToDate(maxDateAllowed,1,false);

// para pasar de formato js a aaaa-mm-dd de PHP
var maxDateAllowedPHP = currentDate.toISOString().split('T')[0];

var minDateRangeDefault = addOrRemoveDaysToDate(currentDate,7,false);

var minDateRangeDefaulPHP = minDateRangeDefault.toISOString().split('T')[0];

$('#minDateRange').val(minDateRangeDefaulPHP)
$('#maxDateRange').val(maxDateAllowedPHP)

 var parameterPreGetDataTables ='&minDateRange='+minDateRangeDefaulPHP+'&maxDateRange='+maxDateAllowedPHP;
    
    return  getDataCasosEpidemiForDataTablesAsync(parameterPreGetDataTables,url);
  

}


  var table = $('#dataTable');

  $('button.formCasosEpidemiModal').on('click',function(){

    $(".modal-title").text("Registrar Caso Epidemiologico");

    $(".btn-caso-epidemi").text("Registrar");
     
           var person_not_ci = document.getElementById('person_not_ci');

          person_not_ci.style.display = "block";

      // Establecer parametros de fecha de registro del caso epidmi
      
      // la fecha recomendada de registro de casos, es del dia de ayer, pero e ocaciones puede ser cambiada

var currentDate = new Date;

var maxDateAllowed = addOrRemoveDaysToDate(currentDate,1,false);

var maxDateAllowedPHP = maxDateAllowed.toISOString().split('T')[0];

var minDateRangeDefault = addOrRemoveDaysToDate(maxDateAllowed,7,false);

var minDateRangeDefaulPHP = minDateRangeDefault.toISOString().split('T')[0];

//         document.getElementById("fecha_registro").setAttribute("min",minDateRangeDefaulPHP );

    document.getElementById("fecha_registro").setAttribute("max", maxDateAllowedPHP);

      $('#fecha_registro').val(maxDateAllowedPHP);

      $('#id_atrib_especial').empty();

     $('#id_atrib_especial').append('<option value=0>Seleccionar Atributo Especial</option>');

    document.getElementById("id_caso_epidemi").setAttribute("value",'');

    document.getElementById("form_caso_epidemi").setAttribute("data-form", 'register');

      $("#si-exist-person").css("display", "block");

  $("#doc_identidad").prop('readonly', $('#ifNotHaveIdentityDocument').checked);
  $("#id_nacionalidad").prop('disabled', $('#ifNotHaveIdentityDocument').checked);



  // osea si la persona existe dale la opcion de inserar id persona


  });

  //para enviar los datos a registrar como los otros forms pero primero pasando por una validacion de ajax
  //

  $(table).on('click','button#delete',function(){

    var tr = $(this).parents('tr');

    var data = $(table).DataTable().row(tr).data();
  
    deleteCasosEpidemi(data);
  
  });

  $(table).on('click','button#update',function(e){
    

  e.preventDefault();

    var tr = $(this).parents('tr');
   
    var data = $(table).DataTable().row(tr).data();
  
    updateCasosEpidemi(data);
  
  });

function deleteCasosEpidemi(data){

    var id_caso_epidemi = data[1];

    var id_person = data[2];

    var id_nacionalidad = data[5];

    var doc_identidad = data[6];

    var catalog_key_cie10 = data[13];

    var id_atrib_especial = data[16];

    var is_hospital = data[21];

    var fecha_registro = data[23];

    var textMsjAlert = 'Los datos del Caso Epidemiologico seran elimnados del sistema';

/*
var dataCasoEpidemi = {
  id_nacionalidad: id_nacionalidad,
  doc_identidad: doc_identidad,
  id_caso_epidemi: id_caso_epidemi,
  catalog_key_cie10: catalog_key_cie10,
  fecha_registro: fecha_registro,
  operationType: 'delete'

 };
*/
var dataCasoEpidemi =
  'id_nacionalidad='+id_nacionalidad+
  '&doc_identidad='+doc_identidad+
  '&id_person='+id_person+
  '&id_caso_epidemi='+id_caso_epidemi+
  '&catalog_key_cie10='+catalog_key_cie10+
  '&id_atrib_especial='+id_atrib_especial+
  '&is_hospital='+is_hospital+
  '&fecha_registro='+fecha_registro+
  '&operationType='+'delete';

    var server_url = $('#server_url').val();

          Swal.fire({
            title: '¿Estás seguro?',
            text: textMsjAlert,
            type: 'question',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Aceptar',
            cancelButtonText: 'Cancelar'
          }).then((result) => {
            if(result.value){

  let responseProcess=table.find('.responseProcessAjax');
  let msgBackendProcess=table.find('.msgBackendProcess');

      sendDataAjax(server_url+'ajax/casosEpidemiAjax.php',dataCasoEpidemi,'POST',responseProcess,msgBackendProcess);

//      $('#dataTable').DataTable().ajax.reload( null, false );

              }
        });

}

  // al salir del modal update limpiara los input para el modo register
    $("#formCasosEpidemiModal").on('hidden.bs.modal', function () {

    var data_form = document.getElementById("form_caso_epidemi").getAttribute("data-form");
    
    if (data_form == 'update') {
  
  $('#catalogKeyCIE10').empty().append('<option value="">Selecionar Capitulo  o CIE-10 Buscar Nombre </option>');

  $(".form-control-person").prop('disabled', false);


  $('#form_caso_epidemi').trigger("reset");


    }
      });

function updateCasosEpidemi(data){

    document.getElementById("form_caso_epidemi").setAttribute("data-form", 'update');

      var person_not_ci = document.getElementById('person_not_ci');

      var ifNotHaveIdentityDocument = document.getElementById('ifNotHaveIdentityDocument');


    var id_caso_epidemi = data[1];

    var id_person = data[2];

    var id_genero = data[3];

    var id_nacionalidad = data[5];

    var doc_identidad = data[6];

    var fecha_nacimiento = data[8];

    var nombres = data[10];

    var apellidos = data[11];

    var clave_capitulo_cie10 = data[12];

    var catalog_key_cie10 = data[14];

    var id_atrib_especial = data[16];

    var id_tipo_entrada = data[18];

    var is_hospital = data[21];
  
    var fecha_registro = data[23];

    var id_parroquia = data[24];

    var direccion = data[26];
    
    var telefono = data[27];
    
    $("#id_caso_epidemi").val(id_caso_epidemi);

    $("#id_nacionalidad").val(id_nacionalidad);

    $("#doc_identidad").val(doc_identidad);

    $("#id_person").val(id_person);

    $("#id_person_update").val(id_person);

    $("#id_nacionalidad_update").val(id_nacionalidad);

    $("#doc_identidad_update").val(doc_identidad);

    $("#fecha_nacimiento").val(fecha_nacimiento);

    $("#nombres").val(nombres);

    $("#apellidos").val(apellidos);

    $("#idCapituloCIE10").val(clave_capitulo_cie10);

    $("#id_tipo_entrada").val(id_tipo_entrada);



    
      $('#is_hospital').prop('checked', is_hospital);

    $("#idCapituloCIE10").val(clave_capitulo_cie10);

    $("#fecha_registro").val(fecha_registro);

    $("#id_parroquia").val(id_parroquia);

    $("#direccion").val(direccion);
    
    telefono = telefono.match(/.{1,4}/g);
    
    $("#telefonoPart1").val(telefono[0]);

    $("#telefonoPart2").val(telefono[1]);

    $("#telefonoPart3").val(telefono[2]);

    $("#id_genero").val(id_genero);
    
    $("#id_parroquia").val(id_parroquia);


var actionAjaxForCie10 = $('#actionAjaxForCie10').val();

setCIE10ToFormUpdateCaseEpidemiAsync(clave_capitulo_cie10,catalog_key_cie10,actionAjaxForCie10,id_atrib_especial);

    var textMsjAlert = 'Los datos del Caso Epidemiologico seran Modificados';
    
    $(".modal-title").text("Editar Caso Epidemiologico");

    $(".btn-caso-epidemi").text("Editar");

    $('#formCasosEpidemiModal').modal('show');

    $(".form-control-person").prop('disabled', false);

    $("#si-exist-person").css("display", "none");
    // disbled por que nunca puede cambiarse
    $("#id_person").prop('readonly', true);

    $("#id_nacionalidad").prop('disabled', false);
    $("#doc_identidad").prop('readonly', false);

    ifNotHaveIdentityDocument.checked= false;

    if (isBlank(doc_identidad) || isBlank(id_nacionalidad)) {

    person_not_ci.style.display = "block";

    $("#id_nacionalidad").val('');

    $("#id_nacionalidad").prop('disabled', true);

    $("#doc_identidad").prop('readonly', true);

    ifNotHaveIdentityDocument.checked= true;

    }else{

    person_not_ci.style.display = "none";

    }

  $(".form-control-person").prop('readonly', false);
  
}

  
  });

$(document).ready(function() {


//$("#dataTable thead tr:eq(1)").before($("#dataTable thead tr:eq(0)"));


 $('.buttons-colvisGroup').on('click', function () {

  var timer;


$('#dataTable thead tr:eq(1) th').each(function () {
        $('input',this).on('keyup change', function () {

  window.clearTimeout(timer); // prevent errant multiple timeouts from being generated

  timer = window.setTimeout(() => {

            table.column($(this).parent().index() + ':visible')
                .search(this.value)
                .draw();

  }, 1000);

    $('#dataTable thead tr:eq(1)  th:eq(33)').html('');

    $('#dataTable thead tr:eq(0)  th:eq(33)').html('');

        });
    });


    });

    var table = $('#dataTable').DataTable();


/*
    var th = $('.not_order').parent('th');
    
    th.removeClass('sorting');

      $(th).off("keypress");

      $(th).off("click");
*/
 }
 
 );

</script>