<?php 

	//print_r($_POST);
	require_once "../../clases/Conexion.php";
	require_once "../../clases/Usuarios.php";

	$obj= new usuarios;

	$datos=array(
			$_POST['idUsuario'],  
		    $_POST['nombreU'] , 
		    $_POST['apellidoU'],  
		    $_POST['carnetU'],
			$_POST['direccionU'] , 
		    $_POST['celularU'],  
		    $_POST['telefonoU'],
			$_POST['usuarioU'] , 
		    $_POST['accesoU']
		);  
	echo $obj->actualizaUsuario($datos);
 ?>