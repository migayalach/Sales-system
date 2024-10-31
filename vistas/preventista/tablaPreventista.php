<?php 
	require_once "../../clases/Conexion.php";
	$c= new conectar();
	$conexion=$c->conexion();
	$sql="SELECT p.idPreventista,r.nombreEmpresa, p.nombre, p.apellido, p.celular
		  from preventista p, proveedor r
		  Where p.idProveedor=r.idproveedor";
	$result=mysqli_query($conexion,$sql);
 ?>

<table class="table table-hover table-condensed table-bordered" style="text-align: center;">
	<caption><label>Preventista</label></caption>
	<tr>
		<td>Empresa</td>
		<td>Nombre</td>
		<td>Apellido</td>
		<td>Celular</td>
		<td>Editar</td>
		<td>Eliminar</td>
	</tr>

	<?php while($ver=mysqli_fetch_row($result)): ?>

	<tr>
		<td><?php echo $ver[1]; ?></td>
		<td><?php echo $ver[2]; ?></td>
		<td><?php echo $ver[3]; ?></td>
		<td><?php echo $ver[4]; ?></td>
		<td>
			<span  data-toggle="modal" data-target="#abremodalUpdatePreventista" class="btn btn-warning btn-xs" onclick="agregaDatosPreventista('<?php echo $ver[0] ?>')">
				<span class="glyphicon glyphicon-pencil"></span>
			</span>
		</td>
		<td>
			<span class="btn btn-danger btn-xs" onclick="eliminaPreventista('<?php echo $ver[0] ?>')">
				<span class="glyphicon glyphicon-remove"></span>
			</span>
		</td>
	</tr>
<?php endwhile; ?>
</table>		