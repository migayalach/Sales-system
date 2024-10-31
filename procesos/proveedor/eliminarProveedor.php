<?php 
require_once "../../clases/Conexion.php";
require_once "../../clases/Proveedor.php";
$idart=$_POST['idarticulo'];

	$obj=new proveedor();

	echo $obj->eliminaProveedor($idart);

 ?>