<?php 
	session_start();
	//print_r($_SESSION['tablaComprasTemp']);
	$res=0;
 ?>

 <h4>Hacer venta</h4>
 <h4><strong><div id="nombreclienteVenta"></div></strong></h4>
 <table class="table table-bordered table-hover table-condensed" style="text-align: center;">
 	<caption>
 		<span class="btn btn-success" onclick="crearVenta()"> Generar venta
 			<span class="glyphicon glyphicon-shopping-cart"></span>
 		</span>
 	</caption>
 	<tr>
 		<td>Nombre</td>
 		<td>Descripcion</td>
		<td>Cantidad a vender</td>
 		<td>Precio unitario</td>
			<td>Productos vacios a cuenta</td>
			<td>Deuda cajas</td>
			<td>Precio total</td>
			<td>Bs.- Acuenta</td>
			<td>Garantia</td>
			<td>Total saldo</td>
		<td>Quitar</td>
 	</tr>

 	<?php 
	$x=1;
	$t=0;
 	$total=0;
	$tg=0;
 	$cliente=""; //en esta se guarda el nombre del cliente
 		if(isset($_SESSION['tablaComprasTemp'])):
 			$i=0;
 			foreach (@$_SESSION['tablaComprasTemp'] as $key) 
			{
 				$d=explode("||", @$key);
 	 ?>

 	<tr>
 		<td><?php echo $d[1]; ?></td> <!-NOMBRE DEL PRODUCTO-!>
 		<td><?php echo $d[2];?></td>  <!-DESCRIPCION-!>
 		<td><?php echo $d[6]; ?></td> <!-VENTA-!>
		<td><?php echo $d[3]; ?></td> <!-PRECIO UNITARIO-!>
		<td><?php echo $d[9];?></td><!-PRODUCTOS VACIOS A CUENTA-!>
		<?php $h=$d[6]-$d[9];?>
		<td><?php echo $h;?></td><!-DEUDA PRODUCTOS-!>
			<?php //cantidad * precio unitario
				  $x=$d[6]*$d[3];
				  //suma total de ventas
				  $total=$total + $x;?>
		<td><?php echo $x;?></td>
		<td><?php echo $d[8];?></td><!-DINERO A CUENTA-!>	
		<td><?php echo $d[7];?></td><!-GARANTIA-!>
			  <?php //dinero resta
			  $f=$x-$d[8];
			  //total a pagar
			  $res=$res+$f; ?>
			<td><?php echo $f;?></td><!-DEUDA BOLIVIANOS-!>
		<td>
 			<span class="btn btn-danger btn-xs" onclick="quitarP('<?php echo $i; ?>')">
 				<span class="glyphicon glyphicon-remove"></span>
 			</span>
 		</td>
 	</tr>

 <?php 
 		$tg=$tg+$d[7];
 		$i++;
 		$cliente=$d[4];
 	}
 	endif; 
 ?>

 	<tr>
 		<td>Total de venta: <?php echo "Bs.- ".$total; ?></td>
		<td>Total deuda Bs.-: <?php echo "Bs.- ".$res;//$total; ?></td>
		<td>Total de garantia dejada: <?php echo "Bs.- ".$tg; ?></td>
 	</tr>
 </table>

 <script type="text/javascript">
 	$(document).ready(function(){
 		nombre="<?php echo @$cliente ?>";
 		$('#nombreclienteVenta').text("Nombre de cliente: " + nombre);
 	});
 </script>