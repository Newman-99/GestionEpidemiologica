
<!-- Modal -->

  <div class="modal fade modalAjax bd-example-modal-lg" id="atribsEspecialsEpiModal" tabindex="-1" role="dialog" aria-labelledby="atribsEspecialsEpiModal" aria-hidden="true" style="overflow-y: scroll;">


  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="atribsEspecialsEpiModal">Configuracion: Atributos Especiales EPI</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">

    <div class="card o-hidden border-0 shadow-lg my-5">
      <div class="card-body p-0">
        <!-- Nested Row within Card Body -->
            <div class='card-body'>
  
  <div class='table-responsive-disabled'>


          <div class='form-row'>
          <br>
            <div class="col-md-3">
              <button type="button" class="btn btn-primary" data-toggle="modal" id="btnOpenRegOrUpdFormAtribsEspecialsEpiModal" data-target="#regOrUpdFormAtribsEspecialsEpiModal">
                Registrar
              </button>
          </div>
          
          </div>
<br>
           <!-- FINAL Formulario para limitar fecha mediante el Backend -->
                <table class='table table-striped display' id='dataTableAtribsEspecialsEpi' width='100%' cellspacing='0'>
                  <thead>
                    <tr>
                      <th >Nro.</th>
                      <th>Nro Atributo Especial</th>
                      <th >Atributos Especial</th>
                      <th></th>
                    </tr>
                  </thead>
                  <tfoot>
                    <tr>
                      <th >Nro.</th>
                      <th>Nro Atributo Especial</th>
                      <th >Atributo Especial</th>
                      <th></th>
                    </tr>
                  </tfoot>
                  <tbody>


                    </tbody>
                </table>
              </div>
           </div>
             <div class="msgBackendProcess"></div>

        </div>
      </div>

      </div>
      <div class="modal-footer">
        <button type="button" id="AtribsEspecialsEpiClose" class="btn btn-secondary buttonCancelAjax" data-dismiss="modal">Cancelar</button>
      </div>
     </form>
    </div>
  </div>
</div>


<script>
  
    $( document ).ready(function() {
 
    $("#atribsEspecialsEpiModal").on('show.bs.modal', async function () {


    await getDataAtribsEspecialsEpiDataTables();    

  window.clearTimeout(timer); // prevent errant multiple timeouts from being generated

  var timer = window.setTimeout(() => {

   $($.fn.dataTable.tables(true)).DataTable()
      .columns.adjust()
      .fixedColumns().relayout();
  }, 500);

});

    var table = $('#dataTableAtribsEspecialsEpi');


    $(table).on('click','button#deleteAtribsEspecialsEpi',function(){


    var tr = $(this).parents('tr');

    var data = $(table).DataTable().row(tr).data();
  
    deleteAtribsEspecialsEpi(data);
  
  });



    $(table).on('click','button#updateAtribsEspecialsEpi',function(){

    var tr = $(this).parents('tr');

    var data = $(table).DataTable().row(tr).data();
  
    updateAtribsEspecialsEpi(data); 
  
    });


    $(table).on('click','button#configAtribsEspecialsEpi',function(){

    var tr = $(this).parents('tr');

    var data = $(table).DataTable().row(tr).data();

    var id_atrib_especial = data[1];

    window.location.href = server_url+'atribsEspecialEpiConfig/'+id_atrib_especial;

    });

    function deleteAtribsEspecialsEpi(data){

    var id_atrib_especial = data[1];

    var textMsjAlert = 'Este Atributo Especial EPI y sus datos seran elimnados del sistema';

var dataAtribsEspecialEpi =
  'id_atrib_especial='+id_atrib_especial+
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

      sendDataAjax(server_url+'ajax/reportsEpiAjax.php',dataAtribsEspecialEpi,'POST',responseProcess,msgBackendProcess);


              }
        });

}

function updateAtribsEspecialsEpi(data){

  //$("#id_atrib_especial").prop('readonly', true);

    document.getElementById("formRegOrUpdFormAtribsEspecialsEpi").setAttribute("data-form", 'update');

    var id_atrib_especial = data[1]; 

    var id_atrib_especial_original = data[1]; 

    var descrip_atrib_especial = data[2];

    $("#nro_atrib_especial").val(id_atrib_especial);

    $("#descrip_atrib_especial").val(descrip_atrib_especial);

    $("#id_atrib_especial_original").val(id_atrib_especial);

    var textMsjAlert = 'Los datos del Atributo Especial EPI seran Modificados';
    
    $("#regOrUpdFormAtribsEspecialsEpiModal.modal-title").text("Editar: Atributo Especial EPI");

    $("#btnRegOrUpdFormAtribsEspecialsEpiModal").text("Editar");

      $('#regOrUpdFormAtribsEspecialsEpiModal').modal('show');

}

    $("#regOrUpdFormAtribsEspecialsEpiModal").on('hidden.bs.modal', function () {

    var data_form = document.getElementById("formRegOrUpdFormAtribsEspecialsEpi").getAttribute("data-form");
    if (data_form == 'update') {
  
    $('#formRegOrUpdFormAtribsEspecialsEpi').trigger("reset");
  
    }
  });


  $('#btnOpenRegOrUpdFormAtribsEspecialsEpiModal').on('click',function(){

    $("#regOrUpdFormAtribsEspecialsEpiModal.modal-title").text("Registrar: Atributo Especial EPI");

    $("#btnRegOrUpdFormAtribsEspecialsEpiModal").text("Registrar");
     
    document.getElementById("formRegOrUpdFormAtribsEspecialsEpi").setAttribute("data-form", 'register');

//  $("#id_atrib_especial").prop('readonly', false);

  });

  });

</script>