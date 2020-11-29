
<body class="bg-gradient-primary">

  <div class="container">

    <!-- Outer Row -->
    <div class="row justify-content-center">

      <div class="col-xl-10 col-lg-12 col-md-9">

        <div class="card o-hidden border-0 shadow-lg my-5">
          <div class="card-body p-0">
            <!-- Nested Row within Card Body -->
            <div class="row">
              <div class="col-lg-6 d-none d-lg-block bg-password-image"></div>
              <div class="col-lg-6">
                <div class="p-5">
                  <div class="text-center">
                    <h1 class="h4 text-gray-900 mb-2">¿Has olvidado tu contraseña?</h1>
                    <p class="mb-4">Rellena los campos correctamente para que la recuperacion de contraseña se ha autorizada por un administrador y se ha reactivada su cuenta</p>
                  </div>

          <form class="formAjax form-group text-center user" action="<?php echo SERVERURL; ?>ajax/loginAjax.php" method="POST" data-form="forgotPassUser" autocomplete="off">

                <div class="form-group">
                  <input type="text" class="form-control 
                  form-control-user
                  form-control-user" id="aliasUser" name="aliasUser" placeholder="Alias de Usuario">
                </div>

                <div class="form-group">
                  <input type="password" class="form-control 
                  form-control-user" id="question1" name="question1" placeholder="¿Cual fue el nombre de tu primera mascota?">
                </div>

                <div class="form-group">
                  <input type="password" class="form-control 
                  form-control-user" id="question2" name="question2" placeholder="¿Cual es el nombre de tu artista favorita?">
                </div>

<hr>
                <div class="form-group">
                  <input type="password" class="form-control 
                  form-control-user" id="newPassword" name="newPassword" placeholder="Nueva Contraseña">
                </div>


                <div class="form-group">
                  <input type="password" class="form-control 
                  form-control-user" id="newPasswordConfirm" name="newPasswordConfirm" placeholder="Confirmar Contraseña">
                </div>

                  <button class="btn btn-primary btn-user btn-block" type="submit" value="forgotPassUser" name="forgotPassUser">Recuperar</button>

    <div class="msgBackendProcess"></div>

                  </form>
                  <hr>
                  <div class="text-center">
                    <a class="small" href="<?php echo SERVERURL; ?>registerUser/">Crear una Cuenta</a>
                  </div>
                  <div class="text-center">
                    <a class="small" href="<?php echo SERVERURL; ?>login/">Ya tienes una cuenta? Inicie Sesion</a>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>

      </div>

    </div>

  </div>
  