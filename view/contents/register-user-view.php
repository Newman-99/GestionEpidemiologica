<body class="bg-gradient-primary">

  <div class="container">

    <div class="card o-hidden border-0 shadow-lg my-5">
      <div class="card-body p-0">
        <!-- Nested Row within Card Body -->
        <div class="row">
          <div class="col-lg-5 d-none d-lg-block bg-register-image"></div>
          <div class="col-lg-7">
            <div class="p-5">
              <div class="text-center">
                <h1 class="h4 text-gray-900 mb-4">Crear una Cuenta</h1>
              </div>

                <form action="<?php echo SERVERURL; ?>ajax/userAjax.php" method="post" class="form-group text-center user">

              <div class="form-group row">
                  <div class="col-sm-6 mb-3 mb-sm-0">
                  <select name='idNacionalidad' id='idNacionalidad' class="form-control" autocomplete='on' class="form-control" >
                      <option>Nacionalidad</option>
                        <option <?php if(isset($nacionalidad)) if($nacionalidad == '1') echo 'selected';?> value="1">V</option>
                        <option <?php if(isset($nacionalidad)) if($nacionalidad == '2') echo 'selected'; ?> value="2">E</option>
                    </select>
               </div>
                  <div class="col-sm-6">
                    <input type="number" class="form-control form-control-user" id="docIdentidad" name ="docIdentidad" placeholder="Documento de Identidad">
                  </div>
                </div>
                

                <div class="form-group row">
                  <div class="col-sm-6 mb-3 mb-sm-0">
                    <input type="text" class="form-control form-control-user" id="nombres" name="nombres"  placeholder="Nombres">
                  </div>
                  <div class="col-sm-6">
                    <input type="text" class="form-control form-control-user" id="apellidos"  name="apellidos" placeholder="Apellidos">
                  </div>
                </div>

                <div class="form-group row">
                  <div class="col-sm-6 mb-3 mb-sm-0">
                  <label for="" class="">Masculino</label>                                        
                <input type="radio" <?php if(isset($_POST["idGenero"])){ if($_POST["idGenero"] == '1') echo "checked";}else{if(isset($idGenero)){ if($idGenero == '1') echo "checked";}}?> name="idGenero" value="1" id="">
                 <br>

                 <label for="idGenero" class="">Femenino</label>
                <input type="radio" name="idGenero" <?php if(isset($_POST["idGenero"])){ if($_POST["idGenero"] == '2') echo "checked";}else{if(isset($idGenero)){ if($idGenero == '2') echo "checked";}} ?> value="2" id="">

                  </div>
              <div class="col-sm-6">
                <input type="date" class="form-control form-control-user" id="fechaNacimiento" name="fechaNacimiento" placeholder="Alias de Usuario">

                </div>

                </div>


                <div class="form-group">
                  <input type="text" class="form-control form-control-user" id="aliasUser" name="aliasUser" placeholder="Alias de Usuario">
                </div>

                <div class="form-group">
                  <input type="email" class="form-control form-control-user" id="email" name="email" placeholder="Correo Electronico">
                </div>



                <div class="form-group">
                  <input type="number" class="form-control form-control-user" id="telefono" name="telefono" placeholder="Telefono">
                </div>

                <div class="form-group row">
                  <div class="col-sm-6 mb-3 mb-sm-0">
                    <input type="password" class="form-control form-control-user" id="password" name="password" placeholder="contraseña confirmar">
                  </div>
                  <div class="col-sm-6">
                    <input type="password" class="form-control form-control-user" id="passwordConfirm" name="passwordConfirm" placeholder="Confirmar contraseña">
                  </div>
                </div>

                  <button class="btn btn-primary btn-user btn-block" type="submit" value="registerUser" name="registerUser">Registar Cuenta</button>

                </a> 
              </form>
              <hr>
              <div class="text-center">
                <a class="small" href=" <?php echo SERVERURL ?>forgot-password/">Olvido su contraseña?</a>
              </div>

              <div class="text-center">
                <a class="small" href=" <?php echo SERVERURL ?>login/">Ya posee un cuenta? Inicio de Sesion</a>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

  </div>