
<?php 
 ?>
          <!-- Page Heading -->
  
          <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Tablero de Inicio</h1>
            
            <!--<a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-download fa-sm text-white-50"></i> Generate Report</a>-->
          </div>

          <!-- Content Row -->
          <div class="row">


            <!-- Earnings (Monthly) Card Example -->
            <div class="col-xl-3 col-md-6 mb-4" style="width:100%;">
              <div class="card border-left-info shadow h-100 py-2">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                      <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Usuarios</div>
                      <div class="row no-gutters align-items-center">
                        <div class="col-auto">
          <?php $requestAjax = FALSE;
           require_once "./controller/userController.php";
          $userController= new userController(); 

          echo $userController->printUserCountByTypeController();

          ?>
                        </div>
                      </div>
                    </div>
                    <div class="col-auto">
                      <i class="fas fa-users fa-2x text-gray-300"></i>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            

                        <!-- Earnings (Monthly) Card Example -->
            <div class="col-xl-3 col-md-6 mb-4" style="width:100%;">
              <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                      <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Casos Epidemiologicos</div>
                      <div class="row no-gutters align-items-center">
                        <div class="col-auto">
                    
          <?php $requestAjax = FALSE;
           require_once "./controller/casosEpidemiController.php";
          $casosEpidemiController= new casosEpidemiController(); 
          echo $casosEpidemiController->printEpidemiCaseCountController();
          ?>
                        </div>
                      </div>
                    </div>
                    <div class="col-auto">
                      <i class="fas fa-file-medical fa-2x text-gray-300"></i>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <!-- Logos  -->
            <div class="col-lg-6">
                <div class="card-body">
                <img class="dash-view-lg" src= "<?php echo SERVERURL; ?>view/img/cp-logo.png">
                <img class="dash-view-lg" src= "<?php echo SERVERURL; ?>view/img/IVSS-logo-blue.png">
                </div>
                <div class="card-body">
                <img class="dash-view-mppps-logo" src= "<?php echo SERVERURL; ?>view/img/mppps-logo.png">
                </div>
            </div>

            </div>
  