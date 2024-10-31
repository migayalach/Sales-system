<?php 
session_start();
if(isset($_SESSION['usuario'])){
?>
	<!DOCTYPE html>
	<html>
	<head>
		<title>proveedor</title>
		<?php require_once "menu.php"; ?>
	</head>
	<body>	<div class="container">
			<h1>Proveedor</h1>
			<div class="row">
				<div class="col-sm-4">
					<form id="frmProveedor" enctype="multipart/form-data">
						<label>Nombre empresa</label>
						<input type="text" class="form-control input-sm" id="nombre" name="nombre">
						<label>Celular</label>
						<input type="text" class="form-control input-sm" id="celular" name="celular">
						<label>Telefono</label>
						<input type="text" class="form-control input-sm" id="telefono" name="telefono">
						<label>Dirección</label>
						<input type="text" class="form-control input-sm" id="direccion" name="direccion">
						<p></p>
						<span id="btnAgregaProveedor" class="btn btn-primary">Agregar</span>
					</form>
				</div>
				<div class="col-sm-8">
					<div id="tablaProveedoresLoad"></div>
				</div>
			</div>
		</div>

		<!-- Modal -->
		<div class="modal fade" id="abremodalUpdateProveedor" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
			<div class="modal-dialog modal-sm" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						<h4 class="modal-title" id="myModalLabel">Actualiza Proveedor</h4>
					</div>
					<div class="modal-body">
						<form id="frmProveedorU" enctype="multipart/form-data">
							<input type="text" id="idProveedorU" hidden="" name="idProveedorU">
							<label>Nombre empresa</label>
							<input type="text" class="form-control input-sm" id="nombreU" name="nombreU">
							<label>Celular</label>
							<input type="text" class="form-control input-sm" id="celularU" name="celularU">
							<label>Telefono</label>
							<input type="text" class="form-control input-sm" id="telefonoU" name="telefonoU">
							<label>Dirección</label>
							<input type="text" class="form-control input-sm" id="direccionU" name="direccionU">
						</form>
					</div>
					<div class="modal-footer">
						<button id="btnActualizaproveedor" type="button" class="btn btn-warning" data-dismiss="modal">Actualizar</button>
					</div>
				</div>
			</div>
		</div>

</body>
</html>

<script type="text/javascript">
	$(document).ready(function(
	){		
		$('#tablaProveedoresLoad').load("proveedor/tablaProveedor.php");
		$('#btnAgregaProveedor').click(function(){
			vacios=validarFormVacio('frmProveedor');
			if(vacios > 0)
			{
				alertify.alert("Debes llenar todos los campos!!");
				return false;
			}
			//console.log(datos);

			datos=$('#frmProveedor').serialize();
			$.ajax({
				type:"POST",
				data:datos,
				url:"../procesos/proveedor/insertaProveedor.php",
				success:function(r)
				{	
					//alert(r);				
					if(r==1)
					{
						//esta linea nos permite limpiar el formulario al insetar un registro
						$('#frmProveedor')[0].reset();
						$('#tablaProveedoresLoad').load("proveedor/tablaProveedor.php");
						alertify.success("Proveedor agregada con exito :D");
					}
					else
						alertify.error("No se pudo agregar proveedor");
				}				
			});
		});
	});
</script>

<script type="text/javascript">
		function agregaDatosProveedor(idarticulo){
			$.ajax({
				type:"POST",
				data:"idart=" + idarticulo,
				url:"../procesos/proveedor/obtenDatosProveedor.php",
				success:function(r){
					//alert(r);
					dato=jQuery.parseJSON(r);
					$('#idProveedorU').val(dato['idproveedor']);
					$('#nombreU').val(dato['nombreEmpresa']);
					$('#celularU').val(dato['celular']);	
					$('#telefonoU').val(dato['telefono']);
					$('#direccionU').val(dato['direccion']);
				}
			});
		}
 
		function eliminaProveedor(idArticulo){
			alertify.confirm('¿Desea eliminar este producto?', function(){ 
				$.ajax({
					type:"POST",
					data:"idarticulo=" + idArticulo,
					url:"../procesos/proveedor/eliminarProveedor.php",
					success:function(r){
						//alert(r);
						if(r==1){
							$('#tablaProveedoresLoad').load("proveedor/tablaProveedor.php");
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

	<script type="text/javascript">
		$(document).ready(function(){
			$('#btnActualizaproveedor').click(function(){
				datos=$('#frmProveedorU').serialize();
				$.ajax({
					type:"POST",
					data:datos,
					url:"../procesos/proveedor/actualizaProveedor.php",
					success:function(r)
					{
						//console.log(r);
						if(r==1){
							$('#tablaProveedoresLoad').load("proveedor/tablaProveedor.php");
							alertify.success("Actualizado con exito :D");
						}else{
							alertify.error("Error al actualizar :(");
						}
					}
				});
			});
		});
	</script>
<?php 
}else{
	header("location:../index.php");
}
?>