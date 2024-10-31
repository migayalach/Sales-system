<?php 
	require_once "../../clases/Conexion.php";
	$c= new conectar();
	$conexion=$c->conexion();
	$sql="SELECT v.id_venta, v.id_producto, v.fechaCompra, c.nombre, c.apellido, c.carnet, p.nombre_producto, v.garantia, v.debeCantidad, v.totalfin, p.tamaño
		  FROM venta v, cliente c, producto p
		  where v.id_cliente=c.id_cliente and p.id_producto=v.id_producto and (v.totalfin>0 or v.debeCantidad>0 or v.garantia>0)";
	$result=mysqli_query($conexion,$sql);
?>

<table class="table table-hover table-condensed table-bordered" style="text-align: center;">
	<tr>
		<td>Fecha de compra</td>
		<td>Nombre y apellido</td>
		<td>Carnet</td>
		<td>Producto</td>
		<td>Garantia dejada</td>
		<td>Debe productos vacios</td>
		<td>Saldo a cancelar</td>
		<td>Cancelar Deuda</td>
	</tr>

	<?php
	while ($ver=mysqli_fetch_row($result)):
	 ?>
	<tr>
		<td><?php echo $ver[2] ?></td>
		<td><?php echo $ver[3]." ".$ver[4]?></td>
		<td><?php echo $ver[5] ?></td>
		<td><?php echo $ver[6]." ".$ver[10] ?></td>
		<td><?php echo $ver[7] ?></td>
		<td><?php echo $ver[8] ?></td>
		<td><?php echo $ver[9] ?></td>
		<td>
			<span  data-toggle="modal" data-target="#cancelaDeudaM" class="btn btn-danger btn-xs" onclick="cancelarDeuda('<?php echo $ver[0] ?>','<?php echo $ver[1] ?>','<?php echo $ver[3] ?>','<?php echo $ver[4] ?>','<?php echo $ver[5] ?>','<?php echo $ver[6] ?>','<?php echo $ver[10] ?>','<?php echo $ver[7] ?>','<?php echo $ver[8] ?>','<?php echo $ver[9]?>')">
				<span class=" glyphicon glyphicon-pencil"></span>
			</span>
		</td>
	</tr>

<?php endwhile; ?>
</table>