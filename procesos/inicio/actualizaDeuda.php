<?php 
	//print_r($_POST);
	require_once "../../clases/Conexion.php";
	require_once "../../clases/Ventas.php";
	$obj= new ventas();

	$datos=array(
		$_POST['idVentaU'],
		$_POST['idProductoU'],
		$_POST['nombreU'],
		$_POST['apellidoU'],
		$_POST['carnetU'],
		$_POST['productoU'],
		$_POST['tamanoU'],
		$_POST['garantiaU'],
		$_POST['garantiaDevueltaU'],
		$_POST['pVaciosU'],
		$_POST['pVaciosDevueltosU'],
		$_POST['saldoU'],
		$_POST['saldoCanceladoU']);

	echo $obj->actualizaDeuda($datos);
	//echo $obj->actualizaBD($datos);
 ?>