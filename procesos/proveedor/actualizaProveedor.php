<?php 
//print_r($_POST);
require_once "../../clases/Conexion.php";
require_once "../../clases/Proveedor.php";

$obj= new proveedor();

$datos=array(
		$_POST['idProveedorU'],
	    $_POST['nombreU'],
		$_POST['celularU'],
	    $_POST['telefonoU'],
		$_POST['direccionU']);
    echo $obj->actualizarProveedor($datos);
	//echo(";DDDD");
 ?>