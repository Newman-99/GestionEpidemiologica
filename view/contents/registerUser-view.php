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


       <form class="formAjax form-group text-center user" action="<?php echo SERVERURL; ?>ajax/userAjax.php" method="POST" data-form="save" autocomplete="off">
            

              <div class="form-group row">

       <div class="col-sm-3 mb-3 mb-sm-0">
       <span alt="¿La persona ya ha sido registrada como paciente o usuario?">¿Persona ya registrada?<input type="checkbox" name="siExistPerson" id="siExistPerson" class="form-control form-control-user" value="1">  
        </span>

    </div>   
       <div class="col-sm-4 mb-3 mb-sm-0">

          <select name='id_nacionalidad' id='id_nacionalidad' class="form-control user">
              
              <option value="">-</option>
                  
              <option value="1">V</option>
                  
              <option value="2">E</option>
              
          </select>

               </div>

                  <div class="col-sm-5">
                    <input type="number" class="form-control form-control-user 
                    " id="doc_identidad" name ="doc_identidad" placeholder="Documento de Identidad">
                  </div>
                </div>

                <div class="form-group row">
                  <div class="col-sm-6 mb-3 mb-sm-0">
                    <input type="text" class="form-control
                    form-control-user
                      form-control-person" id="nombres" name="nombres"  placeholder="Nombres">
                  </div>
                  <div class="col-sm-6">
                    <input type="text" class="form-control
                    form-control-user  form-control-person" id="apellidos"  name="apellidos" placeholder="Apellidos">
                  </div>
                </div>

                <div class="form-group row">
                  <div class="col-sm-6 mb-3 mb-sm-0">

                <select name='id_genero' id='id_genero' class="form-control
                form-control-person" autocomplete='on' class="form-control" >
                      <option value="">Genero</option>
                        <option value="1">Masculino</option>
                        <option  value="2">Femenino</option>
                    </select>
    
                  </div>
              <div class="col-sm-6">
                <input type="date" class="form-control 
                form-control-user
                form-control-person" id="fecha_nacimiento" name="fecha_nacimiento">

                </div>

                </div>


                <div class="form-group">
                  <input type="text" class="form-control 
                  form-control-user
                  form-control-user" id="aliasUser" name="aliasUser" placeholder="Alias de Usuario">
                </div>

                <div class="form-group">
                  <input type="emai" class="form-control 
                  form-control-user" id="email" name="email" placeholder="Correo Electronico">
                </div>

                <div class="form-group">
                  <input type="password" class="form-control 
                  form-control-user" id="question1" name="question1" placeholder="¿Cual fue el nombre de tu primera mascota?">
                </div>

                <div class="form-group">
                  <input type="password" class="form-control 
                  form-control-user" id="question2" name="question2" placeholder="¿Cual es el nombre de tu artista favorita?">
                </div>

                <div class="form-group row">
                  <div class="col-sm-3">
                    <p>Telefono</p>
                  </div>

                  <div class="col-sm-3">

                    <input type="number" class="form-control
                    form-control-user" id="telefonoPart1" name="telefonoPart1"  placeholder="0000">
                  </div>
                  
                  <div class="col-sm-3">
                    <input type="number" class="form-control
                    form-control-user" id="telefonoPart2" name="telefonoPart2"  placeholder="0000">
                  </div>

                  <div class="col-sm-3">
                    <input type="number" class="form-control
                    form-control-user" id="telefonoPart3" name="telefonoPart3"  placeholder="000">
                  </div>
                </div>

                <div class="form-group row">
                  <div class="col-sm-6 mb-3 mb-sm-0">
                    <input type="password" class="form-control form-control-user" id="password" name="password" placeholder="Contraseña">
                  </div>
                  <div class="col-sm-6">
                    <input type="password" class="form-control form-control-user" id="passwordConfirm" name="passwordConfirm" placeholder="Confirmar contraseña">
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