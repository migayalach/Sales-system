<?php 

	require_once "../../clases/Conexion.php";
	require_once "../../clases/Proveedor.php";

	$obj= new proveedor();
	$idart=$_POST['idart'];

	echo json_encode($obj->obtenDatosProveedor($idart));
 ?>