<?php 

//print_r($_POST);
require_once "../../clases/Conexion.php";
require_once "../../clases/Articulos.php";

$obj= new articulos();

$datos=array(
		$_POST['idArticulo'],
		$_POST['categoriaSelectU'],
	    $_POST['nombreU'],
	    $_POST['descripcionU']
	);

    echo $obj->actualizarArticulo($datos);
	//echo(";DDDD");
 ?>