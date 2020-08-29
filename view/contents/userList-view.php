<?php 
  if($_SESSION['idNivelPermiso']!=1){
    echo $loginController->forceClosureController();
    exit();
  }
?>


  <script src="<?php echo SERVERURL; ?>view/js/changeLanguageDatatables.js">

  </script>

          <!-- Page Heading -->
          <h1 class="h3 mb-2 text-gray-800">Usuarios</h1>
          
          <!-- <p class="mb-4">DataTables is a third party plugin that is used to generate the demo table below. For more information about DataTables, pleas>
          -->

          <?php
  
            $requestAjax = FALSE;
           require_once "./controller/userController.php";
          $userController= new userController();

           ?>
          <div class="card shadow mb-4">
            <div class="card-header py-3">
              <h6 class="m-0 font-weight-bold text-primary">Lista de Usuarios</h6>
            </div>
            <div class="card-body">

              <?php 
              $paginateURl= explode("/",$_GET['views']);
              if (!isset($paginateURl[1])){
                  $paginateURl[1] = "";
              }
              echo $userController->paginateUserController($paginateURl[1],$_SESSION['idNivelPermiso'],$_SESSION['aliasUser']);

              ?>
    
        

                        </div>
          </div>

<script type="text/javascript">
  
    $( document ).ready(function() {

      var table = $('#dataTable').DataTable({
          'language': LANGUAGE_SPANISH_DATATABLES
    });
  
});


</script>