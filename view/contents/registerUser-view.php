<body>

  <div class="container">

    <div class="card o-hidden border-0 shadow-lg my-5">
      <div class="card-body p-0">
        <!-- Nested Row within Card Body -->
        <div class="row">
          
          <div class="col-lg-12">
            <div class="p-4">
              <div class="text-center">
                <h1 class="h4 text-gray-900 mb-4">Crear una Cuenta</h1>
              </div>

       <form class="formAjax form-group text-center user" action="<?php echo SERVERURL; ?>ajax/userAjax.php" method="POST" data-form="save" autocomplete="off">
            

              <div class="form-group row">

       <div class="col-sm-3 mb-3 mb-sm-0">
       <span alt="¿La person ya ha sido registrada como paciente o usuario?">¿person ya registrada?<input type="checkbox" name="ifExistPerson" id="ifExistPerson" class="form-control form-control-user" value="1">
        </span>

    </div>
       <div class="col-sm-4 mb-3 mb-sm-0">

        <select name='id_nacionalidad' id='id_nacionalidad' class="form-control" class="form-control" required>
            <option  value=''>Nacionalidad</option>
            <option  value='1'>V</option>
            <option value='2'>E</option>
        </select>

               </div>

                  <div class="col-sm-5">
                    <input type="text" class="form-control form-control-user
                    " id="doc_identidad" name ="doc_identidad" placeholder="Documento de Identidad"     pattern="[0-9]{7,9}"
                      title="El campo debe poseer entre 7 y 9 cifras numericas"
                      required>
                  </div>
                </div>

                <div class="form-group row">
                  <div class="col-sm-6 mb-3 mb-sm-0">
                    <input type="text" class="form-control
                    form-control-user
                      form-control-person" id="nombres" name="nombres"  placeholder="Nombres" minlength = '2' maxlength = '40' required>
                  </div>
                  <div class="col-sm-6">
                    <input type="text" class="form-control
                    form-control-user  form-control-person" id="apellidos"  name="apellidos" placeholder="Apellidos" minlength = '2' maxlength = '40' required>
                  </div>
                </div>

                <div class="form-group row">
                  <div class="col-sm-6 mb-3 mb-sm-0">

                <select name='id_genero' id='id_genero' class="form-control
                form-control-person" autocomplete='on' class="form-control" required>
                  
                      <option value="">Genero</option>
                        <option value="1">Masculino</option>
                        <option  value="2">Femenino</option>
                    </select>
    
                  </div>
                  
              <div class="col-sm-6">
                <input type="date" class="form-control
                form-control-user
                form-control-person" id="fecha_nacimiento" name="fecha_nacimiento" required>

                </div>

                </div>


                <div class="form-group">
                  <input type="text" class="form-control
                  form-control-user
                  form-control-user" id="aliasUser" name="aliasUser" placeholder="Alias de Usuario" minlength = '5' maxlength = '20' required>
                </div>

                <div class="form-group">
                  <input type="email" class="form-control
                  form-control-user" id="email" name="email" placeholder="Correo Electronico" required>
                </div>

                <div class="form-group">
                  <input type="password" class="form-control
                  form-control-user" id="question1" name="question1" placeholder="¿Cual fue el nombre de tu primera mascota?" minlength = '3' maxlength = '30' required>
                </div>

                <div class="form-group">
                  <input type="password" class="form-control
                  form-control-user" id="question2" name="question2" placeholder="¿Cual es el nombre de tu artista favorita?" minlength = '3' maxlength = '30' required>
                </div>

                <div class="form-group row">
                  <div class="col-sm-3">
                    <p>Telefono</p>
                  </div>

                  <div class="col-sm-3">

                    <input type="text" class="form-control
                    form-control-user" id="telefonoPart1" name="telefonoPart1"placeholder="0000" pattern="[0-9]{4}"  title="El campo debe poseer 4 cifras numericas" required>
                  </div>
                  
                  <div class="col-sm-3">
                    <input type="text" class="form-control
                    form-control-user" id="telefonoPart2" name="telefonoPart2" placeholder="0000" pattern="[0-9]{4}"  title="El campo debe poseer 4 cifras numericas" required >
                  </div>

                  <div class="col-sm-3">
                    <input type="text" class="form-control
                    form-control-user" id="telefonoPart3" name="telefonoPart3" placeholder="000" pattern="[0-9]{3}" title="El campo debe poseer 3 cifras numericas" required>
                  </div>
                </div>

                <div class="form-group row">
                  <div class="col-sm-6 mb-3 mb-sm-0">
                    <input type="password" class="form-control form-control-user" id="password" name="password" placeholder="Contraseña" minlength = '8' maxlength = '20' required>
                  </div>
                  <div class="col-sm-6">
                    <input type="password" class="form-control form-control-user" id="passwordConfirm" name="passwordConfirm" placeholder="Confirmar contraseña" minlength = '8' maxlength = '20' required>
                  </div>
                </div>

                  <button class="btn btn-primary btn-user btn-block" type="submit" value="registerUser" name="save">Registar</button>
                </a>

                <div class="responseProcessAjax"></div>
              </form>
              <hr>
              <div class="text-center">
                <a class="small" href=" <?php echo SERVERURL ?>forgotPassword/">Olvido su contraseña?</a>
              </div>

              <div class="text-center">
                <a class="small" href=" <?php echo SERVERURL ?>login/">Ya posee un cuenta? Inicie Sesion</a>
              </div>

              <?php require "./view/inc/linkRestartUser.php"; ?>

            </div>
          </div>
        </div>
      </div>
    </div>

  </div>