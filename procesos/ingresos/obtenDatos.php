<?php 

	require_once "../../clases/Conexion.php";
	require_once "../../clases/Ingresos.php";
	
	$obj= new ingresos();
	$idart=$_POST['idart'];

	echo json_encode($obj->obtenDatos($idart));
 ?>