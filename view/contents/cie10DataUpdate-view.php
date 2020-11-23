    <div class="card o-hidden border-0 shadow-lg my-5">
      <div class="card-body p-0">
        <!-- Nested Row within Card Body -->
        <div class="row">
          <div class="col-lg-7">
            <div class="p-5">
              <div class="text-center">
                <h1 class="h3 mb-2 text-gray-800">Actualizar Catalogo CIE-10</h1>
              </div>

                    <p class="mb-4">El catalogo CIE-10 que se subira sobreescribira al actual, por lo se debe verificar los datos correctamente y debe asegurarse si este proceso es necesario.
                    </p>

                    <p class="mb-4">Importante: Asegurese de convertir solo una hoja del archivo de Hojas de Calculo con los casos CIE-10 a un archivo CSV. 
                    </p>

   <form class="formAjax form-update form-group text-center user" action="<?php echo SERVERURL; ?>ajax/cie10DataAjax.php" method="POST" data-form="files" autocomplete="off" enctype="multipart/form-data">

                <div class="form-group" id="update-cie-10">
                	<label for="">Elegir Archivo CSV:</label>
                    <input type="file" class="form-control files" id="fileCSVCIE10" name="fileCSVCIE10" accept=".csv">
              </div>

		  
		 <button class="btn btn-primary btn-user btn-block" type="submit" value="updateCIE10" name="update">Actualizar</button>

		 <div class="responseProcessAjax"></div>

		<div id="msgBackendProcessAjaxData"></div>

		          </form>
    <div id="btnInsertCancelAjax"></div>
              </div>
            </div>
          </div>
        </div>
      </div>


<script type="text/javascript">
	

  $(document).ajaxStart(function() {


/*window.onbeforeunload = function(e) {
  return e;
};*/
    $("#btnInsertCancelAjax").html("<br><button class='btn btn-danger' name='btnCancelRequestAjax' onclick='location.reload();'>Cancelar</button>");
});


</script>