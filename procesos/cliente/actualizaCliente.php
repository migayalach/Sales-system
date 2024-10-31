<?php 

	//print_r($_POST);
	require_once "../../clases/Conexion.php";
	require_once "../../clases/Cliente.php";

	$obj= new cliente;

	$datos=array(
			$_POST['idUsuario'],  
		    $_POST['nombreU'] , 
		    $_POST['apellidoU'],  
		    $_POST['carnetU'],
			$_POST['direccionU'] , 
		    $_POST['celularU'],  
		    $_POST['telefonoU']
		);  
	echo $obj->actualizaCliente($datos);
 ?>