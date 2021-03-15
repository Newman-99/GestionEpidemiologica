    <div class="card o-hidden border-0 shadow-lg my-5">
      <div class="card-body p-0">
        <!-- Nested Row within Card Body -->
        <div class="row">
          <div class="col-lg-7">
            <div class="p-5">
              <div class="text-center">
                <h1 class="h3 mb-2 text-gray-800">Seguridad</h1>
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
              $requestedAliasUser = $loginController->decryption($userEncryptURl[1]);

              if (strcmp($_SESSION["aliasUser"],$requestedAliasUser) != 0) {
                echo $loginController->forceClosureController();
              }

              // comrprobar que exista el usuario solicitado
                 $requestAjax =  FALSE;

                require_once "./controller/userController.php";
              
                $userController = new userController();

                $userAttributesFilter =  [];

                $userFilterValues = [];

/*
                array_push($userAttributesFilter, 'alias = :aliasUser');
                $userFilterValues[':aliasUser'] = [
                'value' => $requestedAliasUser,
                'type' => \PDO::PARAM_STR,
                ];

*/
                $queryIsExistUser = mainModel::connectDB()->query("SELECT alias FROM usuarios WHERE alias = '$requestedAliasUser'");
  
                $queryIsExistUser->execute();     
                
                if(!$queryIsExistUser->rowCount()){
                echo $msjError;

                exit;
                }

                $fieldsUserRequested=$queryIsExistUser->fetch();

?>



   <form class="formAjax form-update form-group text-center user" action="<?php echo SERVERURL; ?>ajax/userAjax.php" method="POST" data-form="config" autocomplete="off">

                <div class="form-group">
            <p class="form-control">
                <?php echo $fieldsUserRequested['alias'];
                ?>
            <input name= "aliasUser" type="hidden" value="<?php echo $fieldsUserRequested['alias']; ?>">

            </p>
            </div>

                <div class="form-group">
                    <input type="password" class="form-control form-control-user" id="password" name="password" placeholder="Contraseña">
              </div>


  <?php 

$isDisabled = '';

  if ($requestedAliasUser === 'admin'){$isDisabled = 'disabled';}?>
    

 
                <div class="form-group">
                  <input type="password" class="form-control 
                  form-control-user" id="question1" name="question1" <?php echo $isDisabled ?> placeholder="¿Cual fue el nombre de tu primera mascota?">
                </div>

                <div class="form-group">
                  <input type="password" class="form-control 
                  form-control-user" id="question2" name="question2" <?php echo $isDisabled ?> placeholder="¿Cual es el nombre de tu artista favorita?">
                </div>

            <hr>
              <h5 class="h5 mb-2 text-gray-800">Nuevos Datos</h5>

                <div class="form-group row">
                  <div class="col-sm-6 mb-3 mb-sm-0">
                    <input type="password" class="form-control form-control-user" id="newPassword" name="newPassword" placeholder="Nueva Contraseña">
                  </div>
                  <div class="col-sm-6">
                    <input type="password" class="form-control form-control-user" id="newPasswordConfirm" name="newPasswordConfirm" placeholder="Confirmar contraseña" >
                  </div>
                </div>

                <div class="form-group">
                  <input type="password" class="form-control 
                  form-control-user" id="newQuestion1" name="newQuestion1" <?php echo $isDisabled ?> placeholder="¿Cual fue el nombre de tu primera mascota?">
                </div>

                <div class="form-group">
                  <input type="password" class="form-control 
                  form-control-user" id="newQuestion2" name="newQuestion2" <?php echo $isDisabled ?> placeholder="¿Cual es el nombre de tu artista favorita?">
                </div>


		  
		 <button class="btn btn-primary btn-user btn-block" type="submit" value="configSecurityUser" name="config">Guardar</button>

		 <div class="responseProcessAjax"></div>
		          </form>

              </div>
            </div>
          </div>
        </div>
      </div>