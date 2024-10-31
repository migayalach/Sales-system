<?php 
	session_start();
	//echo($_SESSION['nivel']);
	if(isset($_SESSION['usuario']))
	{		
 ?>

<!DOCTYPE html>
<html>
<head>
	<title>inicio</title>
	<?php require_once "menu.php"; ?>
</head>
<body>
	<div class="container">
		<h1>Saldos pendientes por cancelar</h1>
		<div class="col-sm-12">
			<div id="tablaInicioLoad"></div>
		</div>
	</div>
	
<!-- Modal -->
<div class="modal fade" id="cancelaDeudaM" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
	<div class="modal-dialog modal-sm" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title" id="myModalLabel">Cancelar deuda</h4>
			</div>
			<div class="modal-body">
				<form id="frmCancelarDU" enctype="multipart/form-data">
					<input type="text" id="idVentaU" hidden="" name="idVentaU">
					<input type="text" id="idProductoU" hidden="" name="idProductoU">
					<label>Nombre</label>
					<input readonly="" type="text" class="form-control input-sm" id="nombreU" name="nombreU">
					<label>Apellido</label>
					<input readonly="" type="text" class="form-control input-sm" id="apellidoU" name="apellidoU">
					<label>Carnet</label>
					<input readonly="" type="text" class="form-control input-sm" id="carnetU" name="carnetU">
					<label>Producto</label>
					<input readonly="" type="text" class="form-control input-sm" id="productoU" name="productoU">
					<label>Tamaño</label>
					<input readonly="" type="text" class="form-control input-sm" id="tamanoU" name="tamanoU">
					<label>Garantia</label>
					<input readonly="" type="text" class="form-control input-sm" id="garantiaU" name="garantiaU">
					<label>Devolucion de garantia</label>
					<input type="text" class="form-control input-sm" id="garantiaDevueltaU" name="garantiaDevueltaU">
					<label>Saldo productos vacios</label>
					<input readonly="" type="text" class="form-control input-sm" id="pVaciosU" name="pVaciosU">
					<label>Devolucion de productos vacios</label>
					<input type="text" class="form-control input-sm" id="pVaciosDevueltosU" name="pVaciosDevueltosU">
					<label>Saldo Bs.-</label>
					<input readonly="" type="text" class="form-control input-sm" id="saldoU" name="saldoU">
					<label>Cancelacion de Saldo Bs.-</label>
					<input type="text" class="form-control input-sm" id="saldoCanceladoU" name="saldoCanceladoU">
				</form>
			</div>
			<div class="modal-footer">
				<button id="btnActualizaEstado" type="button" class="btn btn-warning" data-dismiss="modal">Saldar Deuda</button>
			</div>
		</div>
	</div>
</div>
</body>
</html>
<?php 
	}
	else
		header("location:../index.php");
?>

<script type="text/javascript">
	$(document).ready(function()
	{
		$('#tablaInicioLoad').load("inicio/tablaInicio.php");
	});
</script>

<script type="text/javascript">
	function cancelarDeuda(idVenta,idProducto,nombre,apellido,carnet,producto,tamano,garantia,pVacios,saldo){
		$('#idVentaU').val(idVenta);
		$('#idProductoU').val(idProducto);
		$('#nombreU').val(nombre);
		$('#apellidoU').val(apellido);
		$('#carnetU').val(carnet);
		$('#productoU').val(producto);
		$('#tamanoU').val(tamano);
		$('#garantiaU').val(garantia);
		$('#pVaciosU').val(pVacios);
		$('#saldoU').val(saldo);
	}
</script>


<script type="text/javascript">
	$(document).ready(function(){
		$('#btnActualizaEstado').click(function(){
			vacios=validarFormVacio('frmCancelarDU');
			if(vacios > 0)
			{
				alertify.alert("Debes llenar todos los campos!!");
				return false;
			}	
			datos=$('#frmCancelarDU').serialize();
			$.ajax({
				type:"POST",
				data:datos,
				url:"../procesos/inicio/actualizaDeuda.php",
				success:function(r)
				{
					//console.log(r);
					if(r==1){
						$('#tablaInicioLoad').load("inicio/tablaInicio.php");
						//imprimir pdf
						alertify.success("Actualizado con exito :D");
					}else{
						alertify.error("Error al actualizar :(");
					}
				}
			});
		});
	});
</script>