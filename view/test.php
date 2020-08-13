
   <form class="formAjax form-group text-center user" action="<?php ?>ajax/userAjax.php" method="POST" data-form="update" autocomplete="off">

                <div class="form-group row">
                  <div class="col-sm-6 mb-3 mb-sm-0">
                    <input disabled type="text" class="form-control
                    form-control-user
                      form-control-person" id="nombres" name="nombres"  placeholder="Nombres" value ="<?php if(isset($fieldsUserRequested['nombres'])) echo $fieldsUserRequested['nombres']; ?>">
                  </div>
                  <div class="col-sm-6">
                    <input disabled type="text" class="form-control
                    form-control-user  form-control-person" id="apellidos"  name="apellidos" placeholder="Apellidos" value ="<?php if(isset($fieldsUserRequested['apellidos'])) echo $fieldsUserRequested['apellidos']; ?>">
                  </div>
                </div>

</form>

<script type="text/javascript">

$(document).ready(function(){
  $.(".form-control").dblclick(function(){
      alert("has hecho doble click en el párrafo con id=parrafo");
  })
});

</script>