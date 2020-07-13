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


                <form class="formAjax   form-group text-center user" action="<?php echo SERVERURL; ?>ajax/userAjax.php" method="POST" data-form="save" autocomplete="off">
            

              <div class="form-group row">

       <div class="col-sm-3 mb-3 mb-sm-0">
       <span alt="¿La persona ya ha sido registrada como paciente o usuario?">¿La persona ya esta registrada?<input type="checkbox" name="siExistPerson" id="siExistPerson" class="form-control form-control-user" value="1">  
        </span>

    </div>   
       <div class="col-sm-4 mb-3 mb-sm-0">

          <select name='idNacionalidad' id='idNacionalidad' class="form-control user">
              
              <option value="">-</option>
                  
              <option value="1">V</option>
                  
              <option value="2">E</option>
              
          </select>

               </div>

                  <div class="col-sm-5">
                    <input type="number" class="form-control form-control-user 
                    " id="docIdentidad" name ="docIdentidad" placeholder="Documento de Identidad">
                  </div>
                </div>

                <div class="form-group row">
                  <div class="col-sm-6 mb-3 mb-sm-0">
                    <input type="text" class="form-control
                    form-control-user
                      form-control-person" id="nombres" name="nombres"  placeholder="Nombres" value ="<?php if(isset($_POST['nombres'])) echo $_POST['nombres']; ?>">
                  </div>
                  <div class="col-sm-6">
                    <input type="text" class="form-control
                    form-control-user  form-control-person" id="apellidos"  name="apellidos" placeholder="Apellidos" value ="<?php if(isset($_POST['apellidos'])) echo $_POST['apellidos']; ?>">
                  </div>
                </div>

                <div class="form-group row">
                  <div class="col-sm-6 mb-3 mb-sm-0">

                <select name='idGenero' id='idGenero' class="form-control
                form-control-person" autocomplete='on' class="form-control" >
                      <option value="">Genero</option>
                        <option <?php if(isset($_POST['idGenero'])) echo 'selected';?> value="1">Masculino</option>
                        <option <?php if(isset($_POST['idGenero'])) echo 'selected'; ?> value="2">Femenino</option>
                    </select>
    
                  </div>
              <div class="col-sm-6">
                <input type="date" class="form-control 
                form-control-user
                form-control-person" id="fechaNacimiento" name="fechaNacimiento">

                </div>

                </div>


                <div class="form-group">
                  <input type="text" class="form-control 
                  form-control-user
                  form-control-user" id="aliasUser" name="aliasUser" placeholder="Alias de Usuario">
                </div>

                <div class="form-group">
                  <input type="emai" class="form-control 
                  form-control-user" id="email" name="email" placeholder="Correo Electronico" value ="<?php if(isset($_POST['email'])) echo $_POST['email']; ?>">
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
                    <input type="password" class="form-control form-control-user" id="password" name="password" placeholder="Contraseña" value ="<?php if(isset($_POST['password'])) echo $_POST['password']; ?>">
                  </div>
                  <div class="col-sm-6">
                    <input type="password" class="form-control form-control-user" id="passwordConfirm" name="passwordConfirm" placeholder="Confirmar contraseña" value ="<?php if(isset($_POST['passwordConfirm'])) echo $_POST['passwordConfirm']; ?>">
                  </div>
                </div>

                  <button class="btn btn-primary btn-user btn-block" type="submit" value="registerUser" name="save">Registar</button>

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