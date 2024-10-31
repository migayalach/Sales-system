<?php 
	session_start();
	require_once "../../clases/Conexion.php";
	require_once "../../clases/Categorias.php";
	
	$categoria=$_POST['categoria'];

	$datos=array(
		$categoria);
	
	$obj= new categorias();
	echo $obj->agregaCategoria($datos);
 ?>