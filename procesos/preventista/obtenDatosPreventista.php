<?php 

	require_once "../../clases/Conexion.php";
	require_once "../../clases/Preventista.php";

	$obj= new preventista();
	$idart=$_POST['idart'];

	echo json_encode($obj->obtenDatosPreventista($idart));
 ?>