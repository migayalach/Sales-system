<?php 

	require_once "../../clases/Conexion.php";
	require_once "../../clases/Cliente.php";

	$obj= new cliente;

	echo $obj->eliminaCliente($_POST['idusuario']);

 ?>