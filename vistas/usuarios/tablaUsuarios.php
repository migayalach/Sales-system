<?php 
	
	require_once "../../clases/Conexion.php";
	$c= new conectar();
	$conexion=$c->conexion();

/*	$sql="SELECT id_cliente,
				 nombre,
				 apellido,
				 carnet,
				 direccion,
				 celular,
				 telefono,
				 usuario,
				 id_nivel
			from cliente";*/
//	$result=mysqli_query($conexion,$sql);

$sql="SELECT 	 c.id_usuario,
				 c.nombre,
				 c.apellido,
				 c.carnet,
				 c.direccion,
				 c.celular,
				 c.telefono,
				 c.usuario,
				 n.tipo
	From usuario c, nivel n
	WHERE n.id_nivel=c.id_nivel";
	$result=mysqli_query($conexion,$sql);
?>

<table class="table table-hover table-condensed table-bordered" style="text-align: center;">
	<caption><label>Usuarios :)</label></caption>
	<tr>
		<td>Nombre</td>
		<td>Apellido</td>
		<td>Carnet</td>
		<td>Direccion</td>
		<td>Celular</td>
		<td>Telefono</td>
		<td>Usuario</td>
		<td>Nivel de acceso</td>
		<td>Editar</td>
		<td>Eliminar</td>
	</tr>

	<?php while($ver=mysqli_fetch_row($result)): ?>

	<tr>
		<td><?php echo $ver[1]; ?></td>
		<td><?php echo $ver[2]; ?></td>
		<td><?php echo $ver[3]; ?></td>
		<td><?php echo $ver[4]; ?></td>
		<td><?php echo $ver[5]; ?></td>
		<td><?php echo $ver[6]; ?></td>
		<td><?php echo $ver[7]; ?></td>
		<td><?php echo $ver[8]; ?></td>
		<td>
			<span data-toggle="modal" data-target="#actualizaUsuarioModal" class="btn btn-warning btn-xs" onclick="agregaDatosUsuario('<?php echo $ver[0]; ?>')">
				<span class="glyphicon glyphicon-pencil"></span>
			</span>
		</td>
		<td>
			<span class="btn btn-danger btn-xs" onclick="eliminarUsuario('<?php echo $ver[0]; ?>')">
				<span class="glyphicon glyphicon-remove"></span>
			</span>
		</td>
	</tr>
<?php endwhile; ?>
</table>