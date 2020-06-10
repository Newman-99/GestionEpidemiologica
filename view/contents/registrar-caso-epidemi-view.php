        <!-- Page Heading -->
 

 <h1 class="h3 mb-4 text-gray-800">Registrar Caso Epidemiologico</h1>
 
 	<form action="<?php echo SERVERURL; ?>ajax/casosEpidemiAjax.php" method="post" class="form-group text-center">
            
            Ya Existe el Paciente
         	<input type="checkbox" name="siExist" id="" class="form-control" placeholder="" value="<?php if(isset($siExist)) echo $siExist; ?>">
	Fecha de Registro
  	<input type="date" name="dateRegisterCasoEpidemi" id="" class="form-control" placeholder="Fecha de Registro" value="<?php if(isset($dateRegisterCasoEpidemi)) echo $dateRegisterCasoEpidemi; ?>">

  	<input type="text" name="nombres" id="" class="form-control" placeholder="Nombres" value="<?php if(isset($nombres)) echo $nombres; ?>">

  	<input type="text" name="apellidos" id="" class="form-control" placeholder="Apellidos" value="<?php if(isset($apellidos)) echo $apellidos; ?>">

        <select name='idNacionalidad' id='' class="form-control" autocomplete='on' class="form-control" >
          <?php $idNacionalidad =1; ?>
            <option <?php if($idNacionalidad == '1') echo 'selected'; ?> value='1'>V</option>
            <option <?php if($idNacionalidad == '2') echo 'selected';?> value='2'>E</option>
        </select>

  	<input type="number" name="docIdentidad" id="" class="form-control" placeholder="Cedula" value="<?php if(isset($docIdentidad)) echo $docIdentidad; ?>">

  	<?php $idGenero =1; ?>

    <select name='idGenero' id='' class="form-control">
       <option <?php if($idGenero == '1') echo 'selected';?> value='1'>Masculino</option>
       <option <?php if($idGenero == '2') echo 'selected';?> value='2'>Femenino</option>
    </select>

  	<input type="date" name="fechaNacimiento" id="" class="form-control" placeholder="Cedula" value="<?php if(isset($fechaNacimiento)) echo $fechaNacimiento; ?>">

  	<input type="number" name="telefono" id="" class="form-control" placeholder="Telefono" value="<?php if(isset($telefono)) echo $telefono; ?>">

  	<input type="number" name="idParroquia" id="" class="form-control" placeholder="Parroquia" value="<?php $idParroquia='958'; if(isset($idParroquia)) echo $idParroquia; ?>">

    <textarea rows="3" cols="40" name="direccion" id="" class="form-control" placeholder="Direccion" required><?php if(isset($direccion)) echo $direccion;?></textarea>

  	<input type="text" name="codeCIE10" id="" class="form-control" placeholder="Codigo: CIE-10" value="<?php $codeCIE10 ='A000'; if(isset($codeCIE10)) echo $codeCIE10; ?>">

	<button class="btn btn-primary btn-block" type="submit" value="Registrar" name="registrar">REGISTRAR</button>


            </form>
