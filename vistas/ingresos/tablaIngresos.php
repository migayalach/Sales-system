	<?php 
			require_once "../../clases/Conexion.php";
			$c= new conectar();
			$conexion=$c->conexion();

			$sql="SELECT c.id_cantidad , p.nombre_producto, x.nombreEmpresa, r.nombre, c.stockNuevo, c.precio_compra, c.precio_venta, c.fecha_entrada, c.fecha_vencimiento, p.tamaño 
				  FROM cantidad c, producto p, preventista r, categorias a, proveedor x
				  WHERE a.id_categoria=p.id_categoria and p.id_producto=c.id_producto and c.idPreventista=r.idPreventista and x.idproveedor=r.idProveedor";
			$result=mysqli_query($conexion,$sql);
	 ?>


<table class="table table-hover table-condensed table-bordered" style="text-align: center;">
	<caption><label>Lista de ingresos :D</label></caption>
	<tr>
		<td>Producto</td>
		<td>Tamaño</td>
		<td>Empresa</td>
		<td>Preventista</td>
		<td>Stock entrada</td>
		<td>Precio compra</td>
		<td>Precio venta</td>
		<td>Fecha entrada</td>
		<td>Fecha vencimiento</td>
		<td>Editar</td>
		<td>Eliminar</td>
	</tr>

	<?php
	while ($ver=mysqli_fetch_row($result)):
	 ?>

	<tr>
		<td><?php echo $ver[1] ?></td>
		<td><?php echo $ver[9] ?></td>
		<td><?php echo $ver[2] ?></td>
		<td><?php echo $ver[3] ?></td>
		<td><?php echo $ver[4] ?></td>
		<td><?php echo $ver[5] ?></td>
		<td><?php echo $ver[6] ?></td>
		<td><?php echo $ver[7] ?></td>
		<td><?php echo $ver[8] ?></td>
		<td>
			<span  data-toggle="modal" data-target="#actualizaIngreso" class="btn btn-warning btn-xs" onclick="agregaDatoIngresos('<?php echo $ver[0] ?>')">
				<span class="glyphicon glyphicon-pencil"></span>
			</span>
		</td>
		<td>
			<span class="btn btn-danger btn-xs" onclick="eliminaIngreso('<?php echo $ver[0] ?>')">
				<span class="glyphicon glyphicon-remove"></span>
			</span>
		</td>
	</tr>

<?php endwhile; ?>
</table>
