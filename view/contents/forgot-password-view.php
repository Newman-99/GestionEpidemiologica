
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
                    <p class="mb-4">Rellena los campos correctamente para que la recuperacion de contraseña se ha autorizada por un administrador</p>
                  </div>
                  <form class="user">
                    <div class="form-group">
                      <input type="email" class="form-control form-control-user" id="emailHelp" name="emailHelp" aria-describedby="emailHelp" placeholder="¿Cual es tu correo electronico?">
                    </div>

                    <div class="form-group">
                      <input type="email" class="form-control form-control-user" id="emailHelp" name="emailHelp" placeholder="¿Cual es tu correo electronico?">
                    </div>


                    <a href="<?php echo SERVERURL; ?>login/" class="btn btn-primary btn-user btn-block">
                      Recuperar Contraseña
                    </a>
                  </form>
                  <hr>
                  <div class="text-center">
                    <a class="small" href="<?php echo SERVERURL; ?>register/">Crear una Cuenta!</a>
                  </div>
                  <div class="text-center">
                    <a class="small" href="<?php echo SERVERURL; ?>login/">Ya tienes una cuenta? Login!</a>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>

      </div>

    </div>

  </div>
  