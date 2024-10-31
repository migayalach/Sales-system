<?php 
session_start();
if(isset($_SESSION['usuario'])){
?>
	<!DOCTYPE html>
	<html>
	<head>
		<title>preventista</title>
		<?php require_once "menu.php"; ?>
	</head>
	<body>	<div class="container">
			<h1>Preventista</h1>
			<div class="row">
				<div class="col-sm-4">
					<form id="frmPreventista" enctype="multipart/form-data">
					<?php require_once "../clases/Conexion.php"; 
						$c= new conectar();
						$conexion=$c->conexion();
						$sql="SELECT *
						from proveedor";
						$result=mysqli_query($conexion,$sql);
					?>
					<label>Proveedor</label>
							<select class="form-control input-sm" id="preventista" name="preventista">
								<option value="A">Selecciona Proveedor</option>
								<?php while($ver=mysqli_fetch_row($result)): ?>
									<option value="<?php echo $ver[0];?>"> <?php echo $ver[1]?></option>
								<?php 
								endwhile;?>	
							</select>
						<label>Nombre</label>
						<input type="text" class="form-control input-sm" id="nombre" name="nombre">
						<label>Apellido</label>
						<input type="text" class="form-control input-sm" id="apellido" name="apellido">
						<label>Celular</label>
						<input type="text" class="form-control input-sm" id="celular" name="celular">
						<p></p>
						<span id="btnAgregaPreventista" class="btn btn-primary">Agregar</span>
					</form>
				</div>
				<div class="col-sm-8">
					<div id="tablaPreventistaLoad"></div>
				</div>
			</div>
		</div>

		<!-- Modal -->
		<div class="modal fade" id="abremodalUpdatePreventista" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
			<div class="modal-dialog modal-sm" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						<h4 class="modal-title" id="myModalLabel">Actualiza Preventista</h4>
					</div>
					<div class="modal-body">
						<form id="frmPreventistaU" enctype="multipart/form-data">
							<input type="text" id="idPreventistaU" hidden="" name="idPreventistaU">
							<?php require_once "../clases/Conexion.php"; 
								$c= new conectar();
								$conexion=$c->conexion();
								$sql="SELECT *
								from proveedor";
								$result=mysqli_query($conexion,$sql);
							?>
							<label>Proveedor</label>
									<select class="form-control input-sm" id="preventistaU" name="preventistaU">
										<option value="A">Selecciona Categoria</option>
										<?php while($ver=mysqli_fetch_row($result)): ?>
											<option value="<?php echo $ver[0];?>"> <?php echo $ver[1]?></option>
										<?php 
										endwhile;?>	
									</select>
							<label>Nombre</label>
							<input type="text" class="form-control input-sm" id="nombreU" name="nombreU">
							<label>Apellido</label>
							<input type="text" class="form-control input-sm" id="apellidoU" name="apellidoU">
							<label>Celular</label>
							<input type="text" class="form-control input-sm" id="celularU" name="celularU">
						</form>
					</div>
					<div class="modal-footer">
						<button id="btnActualizaPreventista" type="button" class="btn btn-warning" data-dismiss="modal">Actualizar</button>
					</div>
				</div>
			</div>
		</div>

</body>
</html>

<script type="text/javascript">
	$(document).ready(function(
	){		
		$('#tablaPreventistaLoad').load("preventista/tablaPreventista.php");
		$('#btnAgregaPreventista').click(function(){
			vacios=validarFormVacio('frmPreventista');
			if(vacios > 0)
			{
				alertify.alert("Debes llenar todos los campos!!");
				return false;
			}
			//console.log(datos);

			datos=$('#frmPreventista').serialize();
			$.ajax({
				type:"POST",
				data:datos,
				url:"../procesos/preventista/insertaPreventista.php",
				success:function(r)
				{	
					//alert(r);				
					if(r==1)
					{
						//esta linea nos permite limpiar el formulario al insetar un registro
						$('#frmPreventista')[0].reset();
						$('#tablaPreventistaLoad').load("preventista/tablaPreventista.php");
						alertify.success("Preventista agregada con exito :D");
					}
					else
						alertify.error("No se pudo agregar preventista");
				}				
			});
		});
	});
</script>

<script type="text/javascript">
		function agregaDatosPreventista(idarticulo){
			$.ajax({
				type:"POST",
				data:"idart=" + idarticulo,
				url:"../procesos/preventista/obtenDatosPreventista.php",
				success:function(r){
					//alert(r);
					dato=jQuery.parseJSON(r);
					$('#idPreventistaU').val(dato['p.idPreventista']);
					$('#preventistaU').val(dato['r.nombreEmpresa']);
					$('#nombreU').val(dato['p.nombre']);
					$('#apellidoU').val(dato['p.apellido']);
					$('#celularU').val(dato['p.celular']);					
				}
			});
		}
 
		function eliminaPreventista(idArticulo){
			alertify.confirm('¿Desea eliminar este preventista?', function(){ 
				$.ajax({
					type:"POST",
					data:"idarticulo=" + idArticulo,
					url:"../procesos/preventista/eliminarPreventista.php",
					success:function(r){
						//alert(r);
						if(r==1){
							$('#tablaPreventistaLoad').load("preventista/tablaPreventista.php");
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
			$('#btnActualizaPreventista').click(function(){
				datos=$('#frmPreventistaU').serialize();
				$.ajax({
					type:"POST",
					data:datos,
					url:"../procesos/preventista/actualizaPreventista.php",
					success:function(r)
					{
						//console.log(r);
						if(r==1){
							$('#tablaPreventistaLoad').load("preventista/tablaPreventista.php");
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