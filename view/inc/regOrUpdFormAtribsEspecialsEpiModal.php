<!-- Modal -->
<div class="modal modalAjax fade" id="regOrUpdFormAtribsEspecialsEpiModal" tabindex="-1" role="dialog" aria-labelledby="regOrUpdFormAtribsEspecialsEpiModal" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="regOrUpdFormAtribsEspecialsEpiModal">Registrar Atributo Especial</h5>
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

   <form class="formAjax form-group text-center user" action="<?php echo SERVERURL; ?>ajax/reportsEpiAjax.php" method="POST" data-form="register" autocomplete="off" enctype="multipart/form-data" id="formRegOrUpdFormAtribsEspecialsEpi"	>


                    <div class="form-group">

                  <input type="hidden" class="form-control" id="id_atrib_especial_original" name="id_atrib_especial_original" placeholder="Nro Atributo Especial"
                  required
                  >

                  <input type="number" class="form-control" id="nro_atrib_especial" name="nro_atrib_especial" placeholder="Nro Atributo Especial"
                  required
                  >
                  <br>
                  <input type="text" class="form-control" id="descrip_atrib_especial" name="descrip_atrib_especial" placeholder="Descripcion"
                  required
                  minlength = '2' maxlength = '50'  
                  >
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
        <button type="button" id="RegOrUpdFormAtribsEspecialsEpiModalCancel" class="btn btn-secondary buttonCancelAjax" data-dismiss="modal">Cancelar</button>
     <button class="btn btn-primary btn-user btn-block" type="submit" value="btnRegOrUpdFormAtribsEspecialsEpiModal" id="btnRegOrUpdFormAtribsEspecialsEpiModal" name="btnRegOrUpdFormAtribsEspecialsEpiModal">Registrar</button>
      </div>
     </form>

    </div>
  </div>
</div>
