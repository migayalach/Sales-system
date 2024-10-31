<?php 
	//print_r($_POST);
	require_once "../../clases/Conexion.php";
	require_once "../../clases/Usuarios.php";

	$obj= new usuarios;

	$datos=array(
			$_POST['idUsuarioM'],  
		    $_POST['nombreM'] , 
		    $_POST['apellidoM'],  
		    $_POST['carnetM'],
			$_POST['direccionM'] , 
		    $_POST['celularM'],  
		    $_POST['telefonoM'],
			$_POST['usuarioM'] , 
		    $_POST['claveM']
		);  
	echo $obj->actualizaUsuarioM($datos);
 ?>