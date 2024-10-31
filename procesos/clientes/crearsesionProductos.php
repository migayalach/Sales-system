<?php 
	//print_r($_POST);
	//print($_POST['consulta1']);

	session_start();
	$idpro=$_POST['valor1'];
	$_SESSION['consulta1']=$idpro;
	//echo $idpro;
 ?>
