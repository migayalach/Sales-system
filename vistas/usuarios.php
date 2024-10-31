<?php 
session_start();
if(isset($_SESSION['usuario'])){
	?>
	<!DOCTYPE html>
	<html>
	<head>
		<title>usuarios</title>
		<?php require_once "menu.php"; ?>
		<?php require_once "../clases/Conexion.php"; 
			$c= new conectar();
			$conexion=$c->conexion();
			$sql="SELECT * 
				  FROM nivel
				  WHERE tipo like '%Estandar' or tipo like '%Administrador' 
				  ORDER BY tipo";
			$result=mysqli_query($conexion,$sql);
		?>
	</head>
	<body>
		<div class="container">
			<h1>Administrar usuarios</h1>
			<div class="row">
				<div class="col-sm-3">
					<form id="frmRegistro">
							<label>Nombre</label>
							<input type="text" class="form-control input-sm" name="nombre" id="nombre">
							<label>Apellido</label>
							<input type="text" class="form-control input-sm" name="apellido" id="apellido">
							<label>Carnet</label>
							<input type="text" class="form-control input-sm" name="carnet" id="carnet">
							<label>Direccion</label>
							<textarea class="form-control input-sm" name="direccion" id="direccion"></textarea>
							<label>Celular</label>
							<input type="text" class="form-control input-sm" name="celular" id="celular">
							<label>Telefono</label>
							<input type="text" class="form-control input-sm" name="telefono" id="telefono">
							<label>Usuario</label>
							<input type="text" class="form-control input-sm" name="usuario" id="usuario">
							<label>Contraseña</label>
							<input type="text" class="form-control input-sm" name="password" id="password">
							
							<label>Nivel de acceso</label>
								<select class="form-control input-sm" id="categoriaSelect" name="categoriaSelect">
									<option value="A">Seleccionar tipo de acceso</option>
									<?php 
										$sql="SELECT * 
										FROM nivel
										WHERE tipo like '%Estandar' or tipo like '%Administrador'
										ORDER BY tipo";
										$result=mysqli_query($conexion,$sql);
									?>
									<?php while($ver=mysqli_fetch_row($result)): ?>
										<option value="<?php echo $ver[0]; ?>"><?php echo $ver[1]; ?></option>
									<?php endwhile; ?>
								</select>							
							<p></p>
						<span class="btn btn-primary" id="registro">Registrar</span>
					</form>
				</div>
				<div class="col-sm-9">
					<div id="tablaUsuariosLoad"></div>
				</div>
			</div>
		</div>

		<!-- Modal -->
		<div class="modal fade" id="actualizaUsuarioModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
			<div class="modal-dialog modal-sm" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						<h4 class="modal-title" id="myModalLabel">Actualiza Usuario</h4>
					</div>
					<div class="modal-body">
						<form id="frmRegistroU">
							<input type="text" hidden="" id="idUsuario" name="idUsuario">
							<label>Nombre</label>
							<input type="text" class="form-control input-sm" name="nombreU" id="nombreU">
							<label>Apellido</label>
							<input type="text" class="form-control input-sm" name="apellidoU" id="apellidoU">
							<label>Carnet</label>
							<input type="text" class="form-control input-sm" name="carnetU" id="carnetU">
							<label>Direccion</label>
							<textarea class="form-control input-sm" name="direccionU" id="direccionU"></textarea>
							<label>Celular</label>
							<input type="text" class="form-control input-sm" name="celularU" id="celularU">
							<label>Telefono</label>
							<input type="text" class="form-control input-sm" name="telefonoU" id="telefonoU">
							<label>Usuario</label>
							<input type="text" class="form-control input-sm" name="usuarioU" id="usuarioU">
							<label>Nivel de acceso</label>
							<select class="form-control input-sm" id="accesoU" name="accesoU">
									<option value="A"></option>
									<?php 
										$sql="SELECT * 
										FROM nivel
										WHERE tipo like'%Estandar' or tipo like '%Administrador'
										ORDER BY tipo";
										$result=mysqli_query($conexion,$sql);
									?>
									<?php while($ver=mysqli_fetch_row($result)): ?>
										<option value="<?php echo $ver[0]; ?>"><?php echo $ver[1]; ?></option>
									<?php endwhile; ?>
								</select>							
						</form>
					</div>
					<div class="modal-footer">
						<button id="btnActualizaUsuario" type="button" class="btn btn-warning" data-dismiss="modal">Actualiza Usuario</button>
					</div>
				</div>
			</div>
		</div>

	</body>
	</html>

	<script type="text/javascript">
		function agregaDatosUsuario(idusuario){
			$.ajax({
				type:"POST",
				data:"idusuario=" + idusuario,
				url:"../procesos/usuarios/obtenDatosUsuario.php",
				success:function(r){
					dato=jQuery.parseJSON(r);

					$('#idUsuario').val(dato['id_usuario']);
					$('#nombreU').val(dato['nombre']);
					$('#apellidoU').val(dato['apellido']);
					$('#carnetU').val(dato['carnet']);
					$('#direccionU').val(dato['direccion']);
					$('#celularU').val(dato['celular']);
					$('#telefonoU').val(dato['telefono']);
					$('#usuarioU').val(dato['usuario']);
					$('#accesoU').val(dato['id_nivel']);
				}
			});
		}
		function eliminarUsuario(idusuario){
			alertify.confirm('¿Desea eliminar este usuario?', function(){ 
				$.ajax({
					type:"POST",
					data:"idusuario=" + idusuario,
					url:"../procesos/usuarios/eliminarUsuario.php",
					success:function(r){
						if(r==1){
							$('#tablaUsuariosLoad').load('usuarios/tablaUsuarios.php');
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
			$('#btnActualizaUsuario').click(function(){

				datos=$('#frmRegistroU').serialize();
				$.ajax({
					type:"POST",
					data:datos,
					url:"../procesos/usuarios/actualizaUsuario.php",
					success:function(r){
						//console.log(r);
						if(r==1){
							$('#tablaUsuariosLoad').load('usuarios/tablaUsuarios.php');
							alertify.success("Actualizado con exito :D");
						}else{
							alertify.error("No se pudo actualizar :(");
						}
					}
				});
			});
		});
	</script>

	<script type="text/javascript">
		$(document).ready(function(){

			$('#tablaUsuariosLoad').load('usuarios/tablaUsuarios.php');
			$('#registro').click(function(){

				vacios=validarFormVacio('frmRegistro');

				if(vacios > 0){
					alertify.alert("Debes llenar todos los campos!!");
					return false;
				}

				datos=$('#frmRegistro').serialize();
				$.ajax({
					type:"POST",
					data:datos,
					url:"../procesos/regLogin/registrarUsuario.php",
					success:function(r){
						//alert(r);
						if(r==2)
							alert("Ya existe este usuario, ¡No se aceptan carnets repetidos! :D");
						else if(r==1){
							$('#frmRegistro')[0].reset();
							$('#tablaUsuariosLoad').load('usuarios/tablaUsuarios.php');
							alertify.success("Agregado con exito");
						}else{
							alertify.error("Fallo al agregar :(");
						}
					}
				});
			});
		});
	</script>

	<?php 
}else{
	header("location:../index.php");
	session_destroy();
}
?>