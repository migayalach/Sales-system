<?php 
session_start();
if(isset($_SESSION['usuario'])){
?>
	<!DOCTYPE html>
	<html>
	<head>
		<title>ingresos</title>
		<?php require_once "menu.php"; ?>
		<?php require_once "../clases/Conexion.php"; 
			$c= new conectar();
			$conexion=$c->conexion();
			$sql="SELECT id_producto,nombre_producto, tamaño
			from producto";
			$result=mysqli_query($conexion,$sql);
		?>
	</head>
	<body>

		<div class="container">
			<h1>Ingresos</h1>
			<div class="row">
				<div class="col-sm-3">
					<form id="frmIngresos">
						<label>Producto</label>
							<select class="form-control input-sm" id="idProducto" name="idProducto">
								<option value="A">Selecciona Producto</option>
								<?php while($ver=mysqli_fetch_row($result)): ?>
									<option value="<?php echo $ver[0];?>"> <?php echo $ver[1]." - ".$ver[2];?></option>
								<?php 
								endwhile;?>	
							</select>

							<label>Preventista</label>
							<select class="form-control input-sm" id="idpreventista" name="idpreventista">
							<?php require_once "../clases/Conexion.php"; 
								$c= new conectar();
								$conexion=$c->conexion();
								$sql="SELECT *
								from preventista";
								$result=mysqli_query($conexion,$sql);
							?>
								<option value="A">Selecciona Preventista</option>
								<?php while($ver=mysqli_fetch_row($result)): ?>
									<option value="<?php echo $ver[0];?>"> <?php echo $ver[2]." ".$ver[3];?></option>
								<?php 
								endwhile;?>	
							</select>
						<label>Stock Nuevo</label>
						<input type="text" class="form-control input-sm" name="stockNuevo" id="stockNuevo">
						<label>Precio compra</label>
						<input type="text" class="form-control input-sm" name="compra" id="compra">
						<label>Precio venta</label>
						<input type="text" class="form-control input-sm" name="venta" id="venta">
						<label>Fecha de entrada</label>
						<input type="date" class="form-control input-sm" name="fechaEntrada" id="fechaEntrada">
						<label>Fecha de vencimiento</label>
						<input type="date" class="form-control input-sm" name="fechaVencimiento" id="fechaVencimiento">
						<p></p>
						<span class="btn btn-primary" id="btnAgregaIngresos">Agregar</span>
					</form>
				</div>
				<div class="col-sm-9">
					<div id="tablaIngresosLoad"></div>
				</div>
			</div>
		</div>

		<!-- Modal -->
		<div class="modal fade" id="actualizaIngreso" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
			<div class="modal-dialog modal-sm" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						<h4 class="modal-title" id="myModalLabel">Actualiza ingresos</h4>
					</div>
					<div class="modal-body">
						<form id="frmIngresosU">
							<input type="text" hidden="" id="idproveedorU" name="idproveedorU">
							<?php require_once "../clases/Conexion.php"; 
								$c= new conectar();
								$conexion=$c->conexion();
								$sql="SELECT id_producto,nombre_producto, tamaño
								from producto";
								$result=mysqli_query($conexion,$sql);
							?>
							<label>Producto</label>
							<select class="form-control input-sm" id="idProductoU" name="idProductoU">
								<option value="A">Selecciona Producto</option>
								<?php while($ver=mysqli_fetch_row($result)): ?>
									<option value="<?php echo $ver[0];?>"> <?php echo $ver[1]." - ".$ver[2];?></option>
								<?php 
								endwhile;?>	
							</select>

							<label>Preventista</label>
							<select class="form-control input-sm" id="idpreventistaU" name="idpreventistaU">
							<?php require_once "../clases/Conexion.php"; 
								$c= new conectar();
								$conexion=$c->conexion();
								$sql="SELECT *
								from preventista";
								$result=mysqli_query($conexion,$sql);
							?>
								<option value="A">Selecciona Preventista</option>
								<?php while($ver=mysqli_fetch_row($result)): ?>
									<option value="<?php echo $ver[0];?>"> <?php echo $ver[2]." ".$ver[3];?></option>
								<?php 
								endwhile;?>	
							</select>
							<label>Stock</label>
							<input readonly="" type="text" class="form-control input-sm" name="stockNuevoU" id="stockNuevoU">
							<label>Precio compra</label>
							<input type="text" class="form-control input-sm" name="compraU" id="compraU">
							<label>Precio venta</label>
							<input type="text" class="form-control input-sm" name="ventaU" id="ventaU">
							<label>Fecha de entrada</label>
							<input type="date" class="form-control input-sm" name="fechaEntradaU" id="fechaEntradaU">
							<label>Fecha de vencimiento</label>
							<input type="date" class="form-control input-sm" name="fechaVencimientoU" id="fechaVencimientoU">
						</form>
					</div>
					<div class="modal-footer">
						<button type="button" id="btnActualizaIngreso" class="btn btn-warning" data-dismiss="modal">Guardar</button>

					</div>
				</div>
			</div>
		</div>
	</body>
	</html>

	<script type="text/javascript">
		$(document).ready(function()
		{
			$('#tablaIngresosLoad').load("ingresos/tablaIngresos.php");
			$('#btnAgregaIngresos').click(function()
			{
				vacios=validarFormVacio('frmIngresos');
				if(vacios > 0)
				{
					alertify.alert("Debes llenar todos los campos!!");
					return false;
				}

				datos=$('#frmIngresos').serialize();
				$.ajax(
				{
					type:"POST",
					data:datos,
					url:"../procesos/ingresos/agregaIngresos.php",
					success:function(r)
					{
						//alert(r);
						if(r==1)
						{
							//esta linea nos permite limpiar el formulario al insetar un registro
							$('#frmIngresos')[0].reset();
							$('#tablaIngresosLoad').load("ingresos/tablaIngresos.php");
							alertify.success("Ingreso de produsto agregado con exito :D");

						}
						else
							alertify.error("No se pudo agregar el ingreso");
					}
				});
			});
		});
	</script>

	<script type="text/javascript">
		$(document).ready(function(){
			$('#btnActualizaIngreso').click(function(){

				datos=$('#frmIngresosU').serialize();
				$.ajax({
					type:"POST",
					data:datos,
					url:"../procesos/ingresos/actualizaIngresos.php",
					success:function(r){
						if(r==1){
							$('#tablaIngresosLoad').load("ingresos/tablaIngresos.php");
							alertify.success("Actualizado con exito :)");
						}else{
							alertify.error("no se pudo actaulizar :(");
						}
					}
					
				});
			});
		});
	</script>


<script type="text/javascript">
	function agregaDatoIngresos(idCategoria){
		$.ajax({
			type:"POST",
			data:"idart=" + idCategoria,
			url:"../procesos/ingresos/obtenDatos.php",
			success:function(r){
				//alert(r);
				dato=jQuery.parseJSON(r);
				$('#idproveedorU').val(dato['id_cantidad']);
				$('#idProductoU').val(dato['id_producto']);
				$('#idpreventistaU').val(dato['idPreventista']);
				$('#stockNuevoU').val(dato['stockNuevo']);		
				$('#compraU').val(dato['precio_compra']);
				$('#ventaU').val(dato['precio_venta']);
				$('#fechaEntradaU').val(dato['fecha_entrada']);
				$('#fechaVencimientoU').val(dato['fecha_vencimiento']);		
			}
		});
	}
</script>


<script type="text/javascript">
	function eliminaIngreso(idcategoria){
		alertify.confirm('¿Desea eliminar este ingreso?', function(){ 
			$.ajax({
				type:"POST",
				data:"idcategoria=" + idcategoria,
				url:"../procesos/ingresos/eliminarIngresos.php",
				success:function(r){
					//console.log(r);
					if(r==11){
						$('#tablaIngresosLoad').load("ingresos/tablaIngresos.php");
						alertify.success("Eliminado con exito!!");
					}else{
						alertify.error("No se pudo eliminar :(");
					}
				}
			});
		}, function(){ 
			alertify.error('Cancelo !')
		});
	}
</script>

<?php 
}else{
	header("location:../index.php");
}
?>