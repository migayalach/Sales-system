<?php 

//print_r($_POST);
require_once "../../clases/Conexion.php";
require_once "../../clases/Preventista.php";

$obj= new preventista();

$datos=array(
		$_POST['idPreventistaU'],
		$_POST['preventistaU'],
	    $_POST['nombreU'],
	    $_POST['apellidoU'],
	    $_POST['celularU']
	);

    echo $obj->actualizaPreventista($datos);
	//echo(";DDDD");
 ?>