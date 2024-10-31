<?php 

	//echo $_GET['idventa'];
	require_once "../../clases/Conexion.php";
	require_once "../../clases/Ventas.php";

	$objv= new ventas();
	$c=new conectar();
	$conexion= $c->conexion();	
	$idventa=$_GET['idventa'];

	$sql="SELECT v.id_venta, v.fechaCompra, c.id_cliente, c.nombre, r.precio_venta, p.tamaño
		  from venta v, cliente c, producto p, cantidad r
		  WHERE  c.id_cliente= v.id_cliente and v.id_producto=p.id_producto and p.id_producto=r.id_producto and v.id_venta='$idventa'
		  Order by v.id_venta DESC";

	$result=mysqli_query($conexion,$sql);

		$ver=mysqli_fetch_row($result);

		$folio=$ver[0];
		$fecha=$ver[1];
		$idcliente=$ver[2];
 ?>	

 <!DOCTYPE html>
 <html>
 <head>
 	<title>Reporte de venta</title>
 	<link rel="stylesheet" type="text/css" href="../../librerias/bootstrap/css/bootstrap.css">
 </head>
 <body>
 		<img src="" width="150" height="150">
 		<br>
		<h1>Recibo de venta :D</h1>
 		<table class="table">
 			<tr>
 				<td>Fecha de venta: <?php echo $fecha; ?></td>
 			</tr>
 			<tr>
 				<td>Numero de venta: <?php echo $folio ?></td>
 			</tr>
 			<tr>
 				<td>Cliente: <?php echo $objv->nombreCliente($idcliente); ?></td>
 			</tr>
 		</table>

 		<table class="table">
 			<tr>
				<td>Nro.</td>
				<td>Nombre</td>
				<td>Descripcion</td>
				<td>Precio unitario</td>
				<td>Cantidad a vender</td>
				<td>Productos vacios a cuenta</td>
				<td>Deuda cajas</td>
				<td>Precio total</td>
				<td>Bs.- Acuenta</td>
				<td>Garantia</td>
				<td>Total saldo</td>
 			</tr>

 			<?php 
 			$sql="SELECT v.id_venta, 
			 			 p.nombre_producto, 
						 p.tamaño, 
						 v.precio, 
						 v.cantidad, 
						 v.total,
       					 v.acuantaCantidad,
						 v.acuentaDinero,
						 v.garantia
					from venta v, producto p
					where p.id_producto=v.id_producto and v.id_venta='$idventa'";
			$result=mysqli_query($conexion,$sql);

			$total=0;
			$con=1;
			$r1=0;
			$saldo=0;
			$sumSando=0;
			$sumGarantia=0;
			while($mostrar=mysqli_fetch_row($result)):
 			 ?>
 			<tr>
				<td><?php echo $con; ?></td>
 				<td><?php echo $mostrar[1]; ?></td>
 				<td><?php echo $mostrar[2]; ?></td>
 				<td><?php echo $mostrar[3]; ?></td>
 				<td><?php echo $mostrar[4]; ?></td>
				<td><?php echo $mostrar[6]; ?></td>
				<td><?php echo $r1=($mostrar[4]-$mostrar[6]); ?></td>
				<td><?php echo $mostrar[5]; ?></td>
				<td><?php echo $mostrar[7]; ?></td>
				<td><?php echo $mostrar[8]; ?></td>
				<td><?php echo $saldo=$mostrar[5]-$mostrar[7]; ?></td>

 			</tr>
 			<?php 
 				$total=$total + $mostrar[5];
				$con++;
				$sumSando=$sumSando+$saldo;
				$sumGarantia=$sumGarantia+$mostrar[8];
 			endwhile;
 			 ?>
 		</table>
		<table>
			<tr>
 			 	<td>Total a cancelar = <?php echo "Bs.- ".$total; ?></td><br>
 			</tr>
			<tr>
				<td>Total saldo = <?php echo "Bs.- ".$sumSando; ?></td><br>
			</tr>
			<tr>
				<td>Total garantia dejada = <?php echo "Bs.- ".$sumGarantia; ?></td>
			</tr>
		<?php
        if($sumSando==0):
        ?>
           <td>CANCELADO</td>
        <?php 
       endif;
        ?>
		
		<?php
        if($sumSando>0):
        ?>
           <td>CON DEUDA A CANCELAR</td>
        <?php 
       endif;
        ?>
		 </table>
 </body>
 </html>