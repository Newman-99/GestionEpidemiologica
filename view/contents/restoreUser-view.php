
<body >

  <div class="container">

    <!-- Outer Row -->
    <div class="row justify-content-center">

      <div class="col-xl-8 col-lg-12 col-md-12">

        <div class="card o-hidden border-0 shadow-lg my-5">
          <div class="card-body p-0">
            <!-- Nested Row within Card Body -->
            <div class="row">
              
              <div class="col-lg-12">
                <div class="p-3">
                  <div class="text-center">
                    <h1 class="h4 text-gray-900 mb-2">¿Has solicitado el Restablecer tu cuenta?</h1>
                    <p class="mb-4">Rellena los campos correctamente para que el reinico se ha autorizado por un administrador y se ha reactivada su cuenta</p>
                  </div>


<?php        

$queryIsExistUserReload = $loginController->getUserController(["id_estado"],array("id_estado"=>2)); 

        $queryIsExistUserReload->execute(); 

        if (!$queryIsExistUserReload->rowCount()){
                echo $loginController->forceClosureController();
              }

?>



   <form class="formAjax form-update form-group text-center user" action="<?php echo SERVERURL; ?>ajax/loginAjax.php" method="POST" data-form="restart" autocomplete="off">


                <div class="form-group">
                  <input type="text" class="form-control 
                  form-control-user
                  form-control-user" id="aliasUser" name="aliasUser" placeholder="Alias de Usuario" required minlength = '5' maxlength = '20'>
                </div>

                <div class="form-group">
                  <input type="text" class="form-control form-control-user" id="aliasUser" name="aliasUser" placeholder="Alias de Usuario" minlength = '5' maxlength = '20' required>
                </div>


              <h5 class="h5 mb-2 text-gray-800">Nuevos Datos</h5>

              <hr>

                <div class="form-group">
                  <input type="password" class="form-control 
                  form-control-user" id="newQuestion1" name="newQuestion1" placeholder="¿Cual fue el nombre de tu primera mascota?" minlength = '3' maxlength = '30' required>
                </div>

                <div class="form-group">
                  <input type="password" class="form-control 
                  form-control-user" id="newQuestion2" name="newQuestion2" placeholder="¿Cual es el nombre de tu artista favorita?" minlength = '3' maxlength = '30' required>
                </div>


                <div class="form-group row">
                  <div class="col-sm-6 mb-3 mb-sm-0">
                    <input type="password" class="form-control form-control-user" id="newPassword" name="newPassword" placeholder="Nueva Contraseña minlength = '8' maxlength = '20'">
                  </div>
                  <div class="col-sm-6">
                    <input type="password" class="form-control form-control-user" id="newPasswordConfirm" name="newPasswordConfirm" placeholder="Confirmar contraseña minlength = '8' maxlength = '20'">
                  </div>
                </div>

     <button class="btn btn-primary btn-user btn-block" type="submit" value="updateDataReloadUser" name="updateDataReloadUser">Restablecer</button>

     <div class="responseProcessAjax"></div>
      
      <div class="msgBackendProcess"></div>

                  </form>
                  <hr>
               <div class="text-center">
                <a class="small" href=" <?php echo SERVERURL ?>forgotPassword/">Olvido su contraseña?</a>
              </div>

              <div class="text-center">
                <a class="small" href=" <?php echo SERVERURL ?>login/">Ya posee un cuenta? Inicie Sesion</a>
              </div>

                </div>
              </div>
            </div>
          </div>
        </div>

      </div>

    </div>

  </div>
  