


<!-- Modal -->
<div class="modal modalAjax fade" id="backupModal" tabindex="-1" role="dialog" style="overflow-y: scroll;" aria-labelledby="backupModal" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="backupModal">Respaldo de la Base de Datos</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">

    <div class="card o-hidden border-0 shadow-lg my-5">
      <div class="card-body p-0">
        <!-- Nested Row within Card Body -->
        <div class="row">
          <div class="col-lg-12">
            <div class="p-5">

                  <a href="#" target="_blank" class="btn btn-secondary btn-icon-split" id="backup" name="backup">
                    <span class="icon text-white-50">
                      <i class="fas fa-download"></i>
                    </span>
                    <span class="text">Obtener Copia de Seguridad</span>
                  </a>

                  <br><br>
                                  </button>


     <div class="responseProcessAjax"></div>

    <div class="msgBackendProcess"></div>

              </div>
            </div>
          </div>
        </div>
      </div>

      </div>
      <div class="modal-footer">
        <button type="button" id="importBackupClose" class="btn btn-secondary buttonCancelAjax" data-dismiss="modal">Cancelar</button>
      </div>
     </form>
    </div>
  </div>
</div>



<script type="text/javascript">
    $( document ).ready(function() {


    $('#btnBackupClouConfig').on('click', function() {
      alert('show');
    $("#backupModal").modal('hide');

    $('#backupClouConfig').modal('show');

    });

    $('#backupClouConfig').on('hidden.bs.modal', function () {
        $("#backupModal").modal('show');
    });

    $('#typeCloudFor').on('change', function () {
      alert($('#typeCloudFor').val());
    });


$('#backupModal').on('show.bs.modal', function () {

 server_url = $('#server_url').val();

  var modal = $(this);
  let method = "POST";
  let action = server_url+'ajax/mainAjax.php';
  let responseProcess=modal.find('.responseProcessAjax');
  let msgBackendProcess=modal.find('.msgBackendProcess');

  console.log(msgBackendProcess);

var data = 
  'operationType=backup';

 sendDataAjax(action,data,method,responseProcess,msgBackendProcess);

      });


    $("#backupModal").on('hidden.bs.modal', function () {


      $('#backup').removeClass('btn-success');

      $('#backup').addClass('btn-secondary');

    var elementAtribute = document.getElementById('backup');
    
    elementAtribute.setAttribute('href',''); 

      });

// enviar dato de configuracion de datos  cloud

/*$('#backupClouConfig').on('change', function () {

    alert('here');

    });
*/
    });

</script>

