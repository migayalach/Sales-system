<?php 
session_start();
unset($_SESSION['consulta']);
if(isset($_SESSION['usuario'])){
?>
	<!DOCTYPE html>
	<html>
	<head>
		<title>Historial</title>
		<?php require_once "menu.php"; ?>
	</head>
	<body>
		<div class="container">
			<h1>Historial</h1>
				<div id="buscador"></div>
				<div id="tablaClientesLoad"></div>	
		</div>	
	</body>
	</html>

	<script type="text/javascript">
		$(document).ready(function(){
			$('#tablaClientesLoad').load("clientes/tablaClientes.php");
			$('#buscador').load('clientes/buscador.php');
		});
	</script>

	<?php 
}else{
	header("location:../index.php");
}
?>