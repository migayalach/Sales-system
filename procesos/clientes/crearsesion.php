<?php 
	//print_r($_POST);
	//print($_POST['consulta']);

	session_start();
	$idper=$_POST['valor'];
	$_SESSION['consulta']=$idper;
	//echo $idper;
 ?>