<?php 
	require_once "../../clases/Conexion.php";
	require_once "../../clases/Cliente.php";

	$obj= new cliente();
	//print_r($_POST);

	$datos=array(
		$_POST['nombre'],
		$_POST['apellido'],
		$_POST['carnet'],
		$_POST['direccion'],
		$_POST['celular'],
		$_POST['telefono']);
	
		$c=$_POST['carnet'];
		if(($obj->dobleCliente($c))==1)
			echo 2;
		else
			echo $obj->registroCliente($datos);

	
	
	//llamada del metodo
	//echo $obj->registroUsuario($datos);
 ?>