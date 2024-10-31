<?php 

	require_once "../../clases/Conexion.php";
	require_once "../../clases/Cliente.php";

	$obj= new cliente;

	echo json_encode($obj->obtenDatosCliente($_POST['idusuario']));

 ?>