<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title><?php echo ORGANIZATION; ?></title>
<?php require_once "inc/linksStyle.php"; ?>
</head>
	

	<?php 


  $requestAjax = false;

      require_once "./controller/loginController.php";
      $loginController = new loginController();

	require_once "./controller/viewsController.php";; 
	
	$viewsController =  new viewsController();

	$requestedView= $viewsController->getViewsController();	

	if($requestedView == "register-user" || $requestedView == "login" || $requestedView == "404" || $requestedView == "forgot-password" || $requestedView == "restartUser"){
      require_once "./view/contents/".$requestedView."-view.php";
		}else{

	     session_start(['name'=>'dptoEpidemi']);
      if(!isset($_SESSION['token_dptoEpidemi']) || !isset($_SESSION['aliasUser'])){
        echo $loginController->forceClosureController();
        exit();

      }
	?>
	
<body id="page-top">
  <!-- Page Wrapper -->
  <div id="wrapper">

    <!-- Sidebar -->
    <?php require_once "inc/sideBar.php"; ?>
    <!-- End of Sidebar -->

    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">

      <!-- Main Content -->
      <div id="content">

        <!-- Topbar -->
      <?php require_once "inc/topBar.php"; ?>
        <!-- End of Topbar -->

        <!-- Begin Page Content -->
        <div class="container-fluid">
	
	<?php require_once $requestedView; ?>
        </div>
        <!-- /.container-fluid -->

      </div>
      <!-- End of Main Content -->

      <!-- Footer -->
      <?php require_once "inc/footer.php"; ?>
      <!-- End of Footer -->

    </div>
    <!-- End of Content Wrapper -->

  </div>
  <!-- End of Page Wrapper -->

  <!-- Scroll to Top Button-->

<?php require_once "inc/scrollTopButton.php"; ?>  

  <!-- Logout Modal-->


<?php //require_once "inc/logOutScript.php"; ?>


<?php } ?>
<?php require_once "inc/script.php"; ?>

</body>
</html>
	