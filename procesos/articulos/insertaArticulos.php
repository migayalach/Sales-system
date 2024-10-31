<?php 
	//print_r($_POST);
	session_start();
	require_once "../../clases/Conexion.php";
	require_once "../../clases/Articulos.php";
		$obj= new articulos();
		$datos=array( $_POST['categoriaSelect'],
					  $_POST['nombre'],
					  $_POST['descripcion']
					);
	echo $obj->insertaArticulos($datos);
 ?>