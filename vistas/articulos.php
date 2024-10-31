<?php 
session_start();
if(isset($_SESSION['usuario'])){
?>
	<!DOCTYPE html>
	<html>
	<head>
		<title>productos</title>
		<?php require_once "menu.php"; ?>
	</head>
	<body>	<div class="container">
			<h1>Productos</h1>
			<div class="row">
				<div class="col-sm-4">
					<form id="frmArticulos" enctype="multipart/form-data">
					<?php require_once "../clases/Conexion.php"; 
						$c= new conectar();
						$conexion=$c->conexion();
						$sql="SELECT id_categoria,nombre_categoria
						from categorias";
						$result=mysqli_query($conexion,$sql);
					?>
					<label>Categoria</label>
							<select class="form-control input-sm" id="categoriaSelect" name="categoriaSelect">
								<option value="A">Selecciona Categoria</option>
								<?php while($ver=mysqli_fetch_row($result)): ?>
									<option value="<?php echo $ver[0];?>"> <?php echo $ver[1]?></option>
								<?php 
								endwhile;?>	
							</select>
						<label>Nombre</label>
						<input type="text" class="form-control input-sm" id="nombre" name="nombre">
						<label>Tamaño</label>
						<input type="text" class="form-control input-sm" id="descripcion" name="descripcion">
						<p></p>
						<span id="btnAgregaArticulo" class="btn btn-primary">Agregar</span>
					</form>
				</div>
				<div class="col-sm-8">
					<div id="tablaArticulosLoad"></div>
				</div>
			</div>
		</div>

		<!-- Modal -->
		<div class="modal fade" id="abremodalUpdateArticulo" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
			<div class="modal-dialog modal-sm" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						<h4 class="modal-title" id="myModalLabel">Actualiza Producto</h4>
					</div>
					<div class="modal-body">
						<form id="frmArticulosU" enctype="multipart/form-data">
							<input type="text" id="idArticulo" hidden="" name="idArticulo">
							<?php require_once "../clases/Conexion.php"; 
								$c= new conectar();
								$conexion=$c->conexion();
								$sql="SELECT id_categoria,nombre_categoria
								from categorias";
								$result=mysqli_query($conexion,$sql);
							?>
							<label>Categoria</label>
									<select class="form-control input-sm" id="categoriaSelectU" name="categoriaSelectU">
										<option value="A">Selecciona Categoria</option>
										<?php while($ver=mysqli_fetch_row($result)): ?>
											<option value="<?php echo $ver[0];?>"> <?php echo $ver[1]?></option>
										<?php 
										endwhile;?>	
									</select>
							<label>Nombre</label>
							<input type="text" class="form-control input-sm" id="nombreU" name="nombreU">
							<label>Tamaño</label>
							<input type="text" class="form-control input-sm" id="descripcionU" name="descripcionU">
						</form>
					</div>
					<div class="modal-footer">
						<button id="btnActualizaarticulo" type="button" class="btn btn-warning" data-dismiss="modal">Actualizar</button>
					</div>
				</div>
			</div>
		</div>

</body>
</html>

<script type="text/javascript">
	$(document).ready(function(
	){		
		$('#tablaArticulosLoad').load("articulos/tablaArticulos.php");
		$('#btnAgregaArticulo').click(function(){
			vacios=validarFormVacio('frmArticulos');
			if(vacios > 0)
			{
				alertify.alert("Debes llenar todos los campos!!");
				return false;
			}
			//console.log(datos);

			datos=$('#frmArticulos').serialize();
			$.ajax({
				type:"POST",
				data:datos,
				url:"../procesos/articulos/insertaArticulos.php",
				success:function(r)
				{	
					//alert(r);				
					if(r==1)
					{
						//esta linea nos permite limpiar el formulario al insetar un registro
						$('#frmArticulos')[0].reset();
						$('#tablaArticulosLoad').load("articulos/tablaArticulos.php");
						alertify.success("Producto agregada con exito :D");
					}
					else
						alertify.error("No se pudo agregar producto");
				}				
			});
		});
	});
</script>

<script type="text/javascript">
		function agregaDatosArticulo(idarticulo){
			$.ajax({
				type:"POST",
				data:"idart=" + idarticulo,
				url:"../procesos/articulos/obtenDatosArticulo.php",
				success:function(r){
					//alert(r);
					dato=jQuery.parseJSON(r);
					$('#idArticulo').val(dato['id_producto']);
					$('#categoriaSelectU').val(dato['id_categoria']);
					$('#nombreU').val(dato['nombre_producto']);
					$('#descripcionU').val(dato['tamaño']);					
				}
			});
		}
 
		function eliminaArticulo(idArticulo){
			alertify.confirm('¿Desea eliminar este producto?', function(){ 
				$.ajax({
					type:"POST",
					data:"idarticulo=" + idArticulo,
					url:"../procesos/articulos/eliminarArticulo.php",
					success:function(r){
						//alert(r);
						if(r==1){
							$('#tablaArticulosLoad').load("articulos/tablaArticulos.php");
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
			$('#btnActualizaarticulo').click(function(){
				vacios=validarFormVacio('frmArticulos');
				if(vacios > 0)
				{
					alertify.alert("Debes llenar todos los campos!!");
					return false;
				}
				datos=$('#frmArticulosU').serialize();
				$.ajax({
					type:"POST",
					data:datos,
					url:"../procesos/articulos/actualizaArticulos.php",
					success:function(r)
					{
						//console.log(r);
						if(r==1){
							$('#tablaArticulosLoad').load("articulos/tablaArticulos.php");
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