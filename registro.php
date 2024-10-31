<?php 
	require_once "clases/Conexion.php";
	$obj= new conectar();
	$conexion=$obj->conexion();

	
	$sql="SELECT n.tipo
		  FROM nivel n, usuario u
		  WHERE n.id_nivel=u.id_nivel and n.tipo like '%Administrador%'";
	$result=mysqli_query($conexion,$sql);
	
	//ENTRADA A REGISTRO
	$validar=0;
	if(mysqli_num_rows($result) > 0)
		header("location:index.php");	
	?>

<!DOCTYPE html>
<html>
<head>
	<title>registro</title>
	<link rel="stylesheet" type="text/css" href="librerias/bootstrap/css/bootstrap.css">
	<script src="librerias/jquery-3.2.1.min.js"></script>
	<script src="js/funciones.js"></script>

</head>
<body style="background-color: gray">
	<br><br><br>
	<div class="container">
		<div class="row">
			<div class="col-sm-4"></div>
			<div class="col-sm-4">
				<div class="panel panel-danger">
					<div class="panel panel-heading">Registrar Usuario</div>
					<div class="panel panel-body">
						<form id="frmRegistro">
							<label>Nombre</label>
							<input type="text" class="form-control input-sm" name="nombre" id="nombre">
							<label>Apellido</label>
							<input type="text" class="form-control input-sm" name="apellido" id="apellido">
							<label>Carnet</label>
							<input type="text" class="form-control input-sm" name="carnet" id="carnet">
							<label>Direccion</label>
							<input type="text" class="form-control input-sm" name="direccion" id="direccion">
							<label>Celular</label>
							<input type="text" class="form-control input-sm" name="celular" id="celular">
							<label>Telefono</label>
							<input type="text" class="form-control input-sm" name="telefono" id="telefono">
							<label>Usuario</label>
							<input type="text" class="form-control input-sm" name="usuario" id="usuario">
							<label>Password</label>
							<input type="text" class="form-control input-sm" name="password" id="password">
							<p></p>
							<select class="form-control input-sm" name="categoriaSelect" id="categoriaSelect">
								<option value="A">Seleccionar tipo de acceso</acceso>
								<?php
									$sql="SELECT *
									FROM nivel
									WHERE tipo like '%Ad%' or tipo like '%Es%'";
									$result=mysqli_query($conexion,$sql);
								?>
								<?php while($ver=mysqli_fetch_row($result)): ?>
								<option value="<?php echo $ver[0];?>"> <?php echo $ver[1];?></option>
								<?php endwhile; ?>
							</select>
							<p></p>
							<span class="btn btn-primary" id="registro">Registrar</span>
							<p></p>
							<a href="index.php" class="btn btn-default">Regresar login</a>
						</form>
					</div>
				</div>
			</div>
			<div class="col-sm-4"></div>
		</div>
	</div>
</body>
</html>

<script type="text/javascript">
	$(document).ready(function(){
		$('#registro').click(function(){

			vacios=validarFormVacio('frmRegistro');

			if(vacios > 0){
				alert("Debes llenar todos los campos!!");
				return false;
			}

			datos=$('#frmRegistro').serialize();
			$.ajax({
				type:"POST",
				data:datos,
				url:"procesos/regLogin/registrarUsuario.php",
				success:function(r)
				{
					//alert(r);
					if(r==2)
						alert("Ya existe, prueba con otro :D");
					else if(r==1)
						alert("Agregado con exito");
					else
						alert("Fallo al agregar :(");
		
				}
			});
		});
	});
</script>