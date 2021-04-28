
<!-- Modal -->

  <div class="modal fade modalAjax bd-example-modal-lg" id="reportEpiFilasModal" tabindex="-1" role="dialog" aria-labelledby="reportEpiFilasModal" aria-hidden="true" style="overflow-y: scroll;">


  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="reportEpiFilasModal">Configuracion: Filas del Reporte EPI</h5>
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
              <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#atribsEspecialsEpiModal">
                Atributos Especiales
              </button>
          </div>
          
          </div>
          <br>
          
          <div class='form-row'>
          <br>
            <div class="col-md-3">
              <button type="button" class="btn btn-primary btnOpenRegisterOrUpdateReportEpiFilasModal" data-toggle="modal" data-target="#registerOrUpdateReportEpiFilasModal">
                Registrar
              </button>
          </div>
          
          </div>

<br>
           <!-- FINAL Formulario para limitar fecha mediante el Backend -->
                <table class='table table-striped display' id='dataTableReportEpiFilas' width='100%' cellspacing='0'>
                  <thead>
                    <tr>
                      <th >Nro.</th>
                      <th >Fila</th>
                      <th>Enfermedad/Evento</th>
                      <th></th>
                    </tr>
                  </thead>
                  <tfoot>
                    <tr>
                      <th >Nro.</th>
                      <th >Fila</th>
                      <th>Enfermedad/Evento</th>
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
        <button type="button" id="reportEpiFilasClose" class="btn btn-secondary buttonCancelAjax" data-dismiss="modal">Cancelar</button>
      </div>
     </form>
    </div>
  </div>
</div>


<script>
  
    $( document ).ready(function() {
 
    $("#reportEpiFilasModal").on('show.bs.modal', async function () {
    await getDataReportsEpiFilasDataTables();    


  window.clearTimeout(timer); // prevent errant multiple timeouts from being generated

  var timer = window.setTimeout(() => {

   $($.fn.dataTable.tables(true)).DataTable()
      .columns.adjust()
      .fixedColumns().relayout();
  }, 500);

});

  
    var table = $('#dataTableReportEpiFilas');

    $(table).on('click','button#deleteReportEpiFilas',function(){

    var tr = $(this).parents('tr');

    var data = $(table).DataTable().row(tr).data();
  
    deleteReportEpiFilas(data);
  
  });



    $(table).on('click','button#updateReportEpiFilas',function(){

    var tr = $(this).parents('tr');

    var data = $(table).DataTable().row(tr).data();
  
    updateReportEpiFilas(data);
  
    });

    $(table).on('click','button#configFilasReport',function(){

    var tr = $(this).parents('tr');

    var data = $(table).DataTable().row(tr).data();

    var nro_fila_report = data[1];

    window.location.href = server_url+'reportEpiFilasConfig/'+nro_fila_report;

    });


    function deleteReportEpiFilas(data){

    var nro_fila_report = data[1];


    var textMsjAlert = 'Esta fila y sus datos seran elimnados del sistema';

var dataCasoEpidemi =
  'nro_fila_report='+nro_fila_report+
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

      sendDataAjax(server_url+'ajax/reportsEpiAjax.php',dataCasoEpidemi,'POST',responseProcess,msgBackendProcess);


              }
        });

}

function updateReportEpiFilas(data){

//    $("#nro_fila_report").prop('readonly', true);

    document.getElementById("registerOrUpdateReportEpiFilas").setAttribute("data-form", 'update');

    var nro_fila_report = data[1];

    var enfermedad_evento = data[2];

    $("#nro_fila_report_original").val(nro_fila_report);

    $("#nro_fila_report").val(nro_fila_report);

    $("#enfermedad_evento").val(enfermedad_evento);

    var textMsjAlert = 'Los datos del Reporte EPI seran Modificados';
    
    $("#registerOrUpdateReportEpiFilasModal.modal-title").text("Editar: Fila Reporte EPI");

    $("#btnRegisterOrupdateReportEpiFilas").text("Editar");

      $('#registerOrUpdateReportEpiFilasModal').modal('show');

}

  });

    $("#registerOrUpdateReportEpiFilasModal").on('hidden.bs.modal', function () {

    var data_form = document.getElementById("registerOrUpdateReportEpiFilas").getAttribute("data-form");
    if (data_form == 'update') {
  
    $('#registerOrUpdateReportEpiFilas').trigger("reset");
  
    }
  });


  $('button.btnOpenRegisterOrUpdateReportEpiFilasModal').on('click',function(){

    $('#registerOrUpdateReportEpiFilas').trigger("reset");

    $("#registerOrUpdateReportEpiFilasModal.modal-title").text("Registrar: Fila Reporte EPI");

    $("#btnRegisterOrupdateReportEpiFilas").text("Registrar");
     

  });

</script>