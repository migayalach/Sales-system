<?php 
	require_once "../../clases/Conexion.php";
	require_once "../../clases/Usuarios.php";

	$obj= new usuarios();
	//print_r($_POST);

	$pass=sha1($_POST['password']);
	$datos=array(
		$_POST['nombre'],
		$_POST['apellido'],
		$_POST['carnet'],
		$_POST['direccion'],
		$_POST['celular'],
		$_POST['telefono'],
		$_POST['usuario'],
		$pass,
		$_POST['categoriaSelect']);
	
		$c=$_POST['carnet'];
		$u=$_POST['usuario'];
		if(($obj->dobleUsuario($c,$u))==1)
			echo 2;
		else
			echo $obj->registroUsuario($datos);

	
	
	//llamada del metodo
	//echo $obj->registroUsuario($datos);
 ?>