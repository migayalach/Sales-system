<?php 
	//print_r($_POST);
	require_once "../../clases/Conexion.php";
	require_once "../../clases/Ingresos.php";
	
	$id=$_POST['idcategoria'];

	$obj= new ingresos();
	$obj->actualizaIngresosResta($id);
	echo $obj->eliminaIngresos($id);
?>