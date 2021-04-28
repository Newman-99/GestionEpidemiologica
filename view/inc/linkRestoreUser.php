<?php 
// Si existen usuadios en estadp Restablecer se muestra el sisguiente btn
$queryIsExistUserReload = $loginController->getUserController(['id_estado'],array("id_estado"=>2)); 

$queryIsExistUserReload->execute(); 

if ($queryIsExistUserReload->rowCount()){

?>
	<div class="text-center">
		<a class="small" href="<?php echo SERVERURL; ?>restoreUser/">Restablecer Cuenta</a>
	</div>

<?php }
?>
