    <div class="card o-hidden border-0 shadow-lg my-5">
      <div class="card-body p-0">
        <!-- Nested Row within Card Body -->
        <div class="row">
          <div class="col-lg-7">
            <div class="p-5">
              <div class="text-center">
                <h1 class="h3 mb-2 text-gray-800">Datos de la Cuenta</h1>
              </div>



              <?php 
              $userEncryptURl= explode("/",$_GET['views']);

              $msjError="<div class='form-group row'>
                    <h3 class='h3 mb-2 red'>Error de solicitud de la Cuenta </h3>

              <a href=".SERVERURL."/dashboard>&larr; Regresa al Tablero de Inicio</a>

              </div>
            </div>
          </div>
        </div>
      </div>
              ";              
              if (!isset($userEncryptURl[1]) || empty($userEncryptURl[1])){

                echo $msjError;

                exit;

              }

               
                // Evitar que un user no admin  entre a los datos de otros usuarios
                // 
              $requestedAliasUser = $loginController->decryption($userEncryptURl[1]);

              if ($_SESSION["id_nivel_permiso"] > 1 && strcmp($_SESSION["aliasUser"],$requestedAliasUser) != 0) {
      
              echo $loginController->forceClosureController();

              }

              // comrprobar que exista el usuario solicitado
                 $requestAjax =  FALSE;

                require_once "./controller/userController.php";
              
                $userController = new userController();

  

    $userAttributesFilter =  [];

    $userFilterValues = [];

    array_push($userAttributesFilter, 'alias = :aliasUser');
    $userFilterValues[':aliasUser'] = [
    'value' => $requestedAliasUser,
    'type' => \PDO::PARAM_STR,
    ];
               $queryUserRequested=$userController->getQueryInnerJoimForUserModel($userAttributesFilter,$userFilterValues);
              
                $queryUserRequested->execute();     
                
                if(!$queryUserRequested->rowCount()){
                echo $msjError;

                exit;
                }

                $fieldsUserRequested=$queryUserRequested->fetch();

              ?>
   <form class="formAjax form-update form-group text-center user" action="<?php echo SERVERURL; ?>ajax/userAjax.php" method="POST" data-form="update" autocomplete="off">
            

        <div class="form-group row">
          <div class="col-sm-5">
            <p class="form-control">


          <?php if($fieldsUserRequested['id_nacionalidad'] == 1){
            $fieldsUserRequested['nacionalidad']='V';}else{
            $fieldsUserRequested['nacionalidad']='E';
              }
            ?>

          <?php echo $fieldsUserRequested['nacionalidad']."-".$fieldsUserRequested['doc_identidad']; ?>

            <input name= "id_nacionalidad" type="hidden" value="<?php echo $fieldsUserRequested['id_nacionalidad']; ?>">

            <input name= "doc_identidad" type="hidden" value="<?php echo $fieldsUserRequested['doc_identidad']; ?>">

            </p>
          </div>
        </div>

                <div class="form-group row">
                  <div class="col-sm-6 mb-3 mb-sm-0">
                    <input type="text" class="form-control
                    form-control-user
                      form-control-person" id="nombres" name="nombres"  placeholder="Nombres" value ="<?php if(isset($fieldsUserRequested['nombres'])) echo $fieldsUserRequested['nombres']; ?>">
                  </div>
                  <div class="col-sm-6">
                    <input type="text" class="form-control
                    form-control-user  form-control-person" id="apellidos"  name="apellidos" placeholder="Apellidos" value ="<?php if(isset($fieldsUserRequested['apellidos'])) echo $fieldsUserRequested['apellidos']; ?>">
                  </div>
                </div>

                <div class="form-group row">
                  <div class="col-sm-6 mb-3 mb-sm-0">
                <select name='id_genero' id='id_genero' class="form-control
                form-control-person" autocomplete='on' class="form-control">
                      <option value="">Genero</option>
                        <option <?php if($fieldsUserRequested['id_genero'] == 1) echo 'selected';?> value="1">Masculino</option>
                        <option <?php if($fieldsUserRequested['id_genero'] == 2) echo 'selected'; ?> value="2">Femenino</option>
                    </select>
    
                  </div>
              <div class="col-sm-6">
                <input type="date" class="form-control 
                form-control-user
                form-control-person" id="fecha_nacimiento" name="fecha_nacimiento" value="<?php if(isset($fieldsUserRequested['fecha_nacimiento'])) echo $fieldsUserRequested['fecha_nacimiento']; ?>" >

                </div>

                </div>

            <p class="form-control ">
                <?php echo $fieldsUserRequested['usuario_alias'];
                ?>
            <input name= "aliasUser" type="hidden" value="<?php echo $fieldsUserRequested['usuario_alias']; ?>">

            </p>

                <div class="form-group">
                  <input type="email" class="form-control 
                  form-control-user" id="email" name="email" placeholder="Correo Electronico" value ="<?php if(isset($fieldsUserRequested['email'])) echo $fieldsUserRequested['email']; ?>">
                </div>
                
                <div class="form-group row">
                  <div class="col-sm-3">
                    <p>Telefono</p>
                  </div>

                  <div class="col-sm-3">
                    <?php
                    $telefonoPart1 = substr($fieldsUserRequested['telefono'],0,4);
                    $telefonoPart2 = substr($fieldsUserRequested['telefono'],4,4);
                    $telefonoPart3 = substr($fieldsUserRequested['telefono'],8,11);
                     ?>
                    <input type="number" class="form-control
                    form-control-user" id="telefonoPart1" name="telefonoPart1"  placeholder="0000" value="<?php echo $telefonoPart1; ?>">
                  </div>
                  
                  <div class="col-sm-3">
                    <input type="number" class="form-control
                    form-control-user" id="telefonoPart2" name="telefonoPart2"  placeholder="0000" value="<?php echo $telefonoPart2; ?>">
                  </div>

                  <div class="col-sm-3">
                    <input type="number" class=" form-control
                    form-control-user" id="telefonoPart3" name="telefonoPart3"  placeholder="000" value="<?php echo $telefonoPart3; ?>">
                  </div>
                </div>

                                    
                <div class="form-group row">
                  <div class="col-sm-6 mb-3 mb-sm-0">
                <select name='id_nivel_permiso' id='id_nivel_permiso' class="form-control
                form-control-person" autocomplete='on' class="form-control"<?php if ($_SESSION['id_nivel_permiso'] != 1) echo "disabled"; ?>
>
                      <option value="">Nivel Permiso</option>
                        <option <?php if($fieldsUserRequested['id_nivel_permiso'] == 1) echo 'selected';?> value="1">Nivel: Administrador</option>

                        <option <?php if($fieldsUserRequested['id_nivel_permiso'] == 2) echo 'selected'; ?> value="2">Nivel: Operador</option>

                        <option <?php if($fieldsUserRequested['id_nivel_permiso'] == 3) echo 'selected'; ?> value="3">Nivel: Invitado</option>

                    </select>
    
                  </div>

                  <div class="col-sm-6 mb-3 mb-sm-0">
                <select name='id_estado' id='id_estado' class="form-control
                form-control-person" autocomplete='on' class="form-control" <?php if ($_SESSION['id_nivel_permiso'] != 1) echo "disabled"; ?> >
                      <option value="">Estado</option>
                        <option <?php if($fieldsUserRequested['id_estado'] == 0) echo 'selected';?> value="0">Estado: Inactivo</option>
                        <option <?php if($fieldsUserRequested['id_estado'] == 1) echo 'selected'; ?> value="1">Estado: Activo</option>
                        <option <?php if($fieldsUserRequested['id_estado'] == 2) echo 'selected'; ?> value="2">Estado: Reiniciado</option>
                    </select>
    
                  </div>                
                </div>

                  <button class="btn btn-primary btn-user btn-block" type="submit" value="updaterUser" name="save">Actualizar</button>
                </a> 

                <div class="responseProcessAjax"></div>
              </form>

              </div>
            </div>
          </div>
        </div>
      </div>