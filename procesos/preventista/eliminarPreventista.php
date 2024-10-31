<?php 
require_once "../../clases/Conexion.php";
require_once "../../clases/Preventista.php";
$idart=$_POST['idarticulo'];

	$obj=new preventista();

	echo $obj->eliminaPreventista($idart);

 ?>