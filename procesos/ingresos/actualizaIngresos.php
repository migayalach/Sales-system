<?php 
	//print_r($_POST);
	require_once "../../clases/Conexion.php";
	require_once "../../clases/Ingresos.php";

	$datos=array( $_POST['idproveedorU'],
				  $_POST['idProductoU'],
				  $_POST['stockNuevoU'], 
				  $_POST['fechaEntradaU'],
				  $_POST['fechaVencimientoU'], 
				  $_POST['idpreventistaU'],
				  $_POST['compraU'],
				  $_POST['ventaU']
				);

	$obj= new ingresos();

	echo $obj->actualizaDatosIngresos($datos);

 ?>