<?php 
	//print_r($_POST);
	session_start();
	require_once "../../clases/Conexion.php";
	require_once "../../clases/Preventista.php";
		$obj= new preventista();
		$datos=array( $_POST['preventista'],
					  $_POST['nombre'],
					  $_POST['apellido'],
					  $_POST['celular']
					);
	echo $obj->insertaPreventista($datos);
 ?>