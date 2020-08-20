<?php 
// Si existen usuadios en estadp reiniciar se muestra el sisguiente btn
$queryIsExistUserReload = $loginController->getUserController(array("idEstado"=>2)); 

$queryIsExistUserReload->execute(); 

if ($queryIsExistUserReload->rowCount()){

?>
	<div class="text-center">
		<a class="small" href="<?php echo SERVERURL; ?>restartUser/">Reestablecer Cuenta</a>
	</div>

<?php }
?>
