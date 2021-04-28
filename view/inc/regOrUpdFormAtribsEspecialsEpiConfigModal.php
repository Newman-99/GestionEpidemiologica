<!-- Modal -->
<div class="modal modalAjax fade" id="regOrUpdFormAtribsEspecialsEpiConfigModal" tabindex="-1" role="dialog" aria-labelledby="regOrUpdFormAtribsEspecialsEpiConfigModal" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="regOrUpdFormAtribsEspecialsEpiConfigModal">Registrar Configuracion Atributo Especial EPI</h5>
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

   <form class="formAjax form-group text-center" action="<?php echo SERVERURL; ?>ajax/reportsEpiAjax.php" method="POST" data-form="register" autocomplete="off" name="formAtribEspecialEpiConfigModal" id="formAtribEspecialEpiConfigModal">
            
    <input type="hidden" name="id_atrib_especial_for_configs" id="id_atrib_especial_for_configs"  class='form-control' value=''>

    <input type="hidden" name="id_config_atrib_especial" id="id_config_atrib_especial"  class='form-control' value=''>

<div class="inputs-group-cie10">

          Datos CIE-10 inicio
    
    <br>
        <input type="text" name="searchCIE10inicio_for_atribs_especial" id="searchCIE10inicio_for_atribs_especial" class="form-control" placeholder="Buscar (Clave) Evento CIE-10 inicio">

    <br>

<div class="input-group">
  
    <select name='consecutivo_cie10_inicio_for_atribs_especial' id='consecutivo_cie10_inicio_for_atribs_especial' class="form-control consecutivo_cie10" requireds >

            <option value="">Seleccionar Evento CIE 10 inicio </option>

        </select>

<span id="icon-load-inicio_for_atribs_especial" class="input-group-addon">
<i class="fas fa-circle-notch fa-spin"></i>
</span>

</div>


    <br>

</div>


    <br>

<div class="inputs-group-cie10">

          Datos CIE-10 FINAL
    
    <br>
        <input type="text" name="searchCIE10Final_for_atribs_especial" id="searchCIE10Final_for_atribs_especial" class="form-control" placeholder="Buscar (Clave) Evento CIE-10 Final">

    <br>

<div class="input-group">
  
    <select name='consecutivo_cie10_final_for_atribs_especial' id='consecutivo_cie10_final_for_atribs_especial' class="form-control consecutivo_cie10" requireds >

            <option value="">Seleccionar Evento CIE 10 Final </option>

        </select>

<span id="icon-load-final_for_atribs_especial" class="input-group-addon">
<i class="fas fa-circle-notch fa-spin"></i>
</span>

</div>


    <br>

</div>

     <div class="responseProcessAjax"></div>

    <div class="msgBackendProcess"></div>

              </div>
            </div>
          </div>
        </div>
      </div>

      </div>
      <div class="modal-footer">
        <button type="button" id="btnRegisterOrupdateAtribEspecialEpiConfigCancel" class="btn btn-secondary buttonCancelAjax" data-dismiss="modal">Cancelar</button>
     <button class="btn btn-primary btn-user btn-block" type="submit" value="btnRegisterOrupdateAtribEspecialEpiConfig" id="btnRegisterOrupdateAtribEspecialEpiConfig" name="btnRegisterOrupdateAtribEspecialEpiConfig">Registrar</button>
      </div>
     </form>

    </div>
  </div>
</div>

  <script src="<?php echo SERVERURL; ?>view/js/scriptsSendAndRequestDataFromBakend.js"></script>

      <script type="text/javascript">



          $( document ).ready(function() {



      });





</script>

