<?php 
	//print_r($_POST);
	session_start();
	require_once "../../clases/Conexion.php";
	require_once "../../clases/Proveedor.php";
		$obj= new proveedor();
		$datos=array( $_POST['nombre'],
					  $_POST['celular'],
					  $_POST['telefono'],
					  $_POST['direccion']
					);
	echo $obj->insertaProveedor($datos);
 ?>