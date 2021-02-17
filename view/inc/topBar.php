        <!-- Topbar -->
        <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

          <!-- Sidebar Toggle (Topbar) -->
          <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
            <i class="fa fa-bars"></i>
          </button>

          <!-- Topbar Search -->
        
          <!-- Topbar Navbar -->
          <ul class="navbar-nav ml-auto">

            <!-- Nav Item - Alerts -->


            <!-- Nav Item - Messages -->


            <div class="topbar-divider d-none d-sm-block"></div>

            <!-- Nav Item - User Information -->
            <li class="nav-item dropdown no-arrow">
              <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <span class="mr-2 d-none d-lg-inline text-gray-600 small"><?php echo $_SESSION['nameUser']." ".$_SESSION['lastNameUser']; ?></span>


                <img class="img-profile rounded-circle" src="<?php echo SERVERURL.'view/img/'.$_SESSION['iconUser']; ?>">
              </a>
              <!-- Dropdown - User Information -->
              <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">


                <?php if ($_SESSION['aliasUser'] !== 'admin'): ?>
                  
                <a class="dropdown-item" href="<?php echo SERVERURL; ?>dataAccount/<?php echo $loginController->encryption($_SESSION['aliasUser']);?>/">
                  <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                  Perfil
                </a>
              
              <?php endif ?>

                <a class="dropdown-item" href="<?php echo SERVERURL; ?>userSettings/<?php echo $loginController->encryption($_SESSION['aliasUser']);?>/">
                  <i class="fas fa-lock fa-sm fa-fw mr-2 text-gray-400"></i>
                  Seguridad
                </a>

                <a class="dropdown-item" href="<?php echo SERVERURL; ?>activityLogSessions/<?php echo $loginController->encryption($_SESSION['aliasUser']);?>/">
                  <i class="fas fa-list fa-sm fa-fw mr-2 text-gray-400"></i>
                  Mi Registro de Sesiones
                </a>


              <?php $URL_token_dptoEpidemi = SERVERURL."ajax/loginAjax.php?"."operationType=closeSession"."&tokenCurrentUser=".$loginController->encryption($_SESSION["token_dptoEpidemi"])?>

                <div class="dropdown-divider"></div>
                <a class="dropdown-item btn-exit-system" href="<?php echo $URL_token_dptoEpidemi;?>">
                  <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                  Cerrar Sesion


                </a>
              </div>
            </li>

          </ul>

        </nav>
        <!-- End of Topbar -->
