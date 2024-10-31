<?php 
	require_once "../../clases/Conexion.php";
	$c= new conectar();
	$conexion=$c->conexion();
?>
<br><br>
<div class="row">
	
	<div class="col-sm-2">
		<div class="form-group">
			<label>Buscar desde:</label>
			<input type="date" class="form-control input-sm" id="bd-desde"><br>
		</div>
	</div>
	<div class="col-sm-2">
		<div class="form-group">
			<label>Buscar hasta:</label>
			<input type="date" class="form-control input-sm" id="bd-hasta"><br>
		</div>
	</div>    
	
	<div class="col-sm-3">
		<label>Clientes:</label>
		<select id="buscadorvivo" class="form-control input-sm">
			<option>Seleciona uno</option>
			<?php
				$sql="SELECT id_cliente,nombre,apellido,carnet 
				from cliente";
				$result=mysqli_query($conexion,$sql);
				while($ver=mysqli_fetch_row($result)): 
			 ?>
				<option value="<?php echo $ver[0] ?>">
					<?php echo $ver[1]." ".$ver[2]." ".$ver[3]?>
				</option>

			<?php endwhile; ?>

		</select>
	</div>

	<div class="col-sm-3">
		<label>Producto:</label>
		<select id="buscadorvivo1" class="form-control input-sm">
			<option>Seleciona uno</option>
			<?php
				$sql="SELECT id_producto,nombre_producto, tamaño 
					  from producto";
				$result=mysqli_query($conexion,$sql);
				while($ver=mysqli_fetch_row($result)): 
			 ?>
				<option value="<?php echo $ver[0] ?>">
					<?php echo $ver[1]." ".$ver[2]?>
				</option>
			<?php endwhile; ?>
		</select>
	</div>

	<br>

	<form id="frmLimpiar" enctype="multipart/form-data">
		<div class="col-sm-1">
			<div class="form-group">
				<span id="btnLimpiar" class="btn btn-primary glyphicon glyphicon-trash"></span>
			</div>
		</div>
	</form>

	<div class="col-xs-1">
		<div class="form-group">
			<a href="../procesos/clientes/crearReportePdf.php"><span class="btn btn-primary glyphicon glyphicon-print"></span></a>
		</div>
	</div>
</div>

<script type="text/javascript">
	$(function(){
		$('#bd-desde').on('change', function(){
			var desde = $('#bd-desde').val();
			var hasta = $('#bd-hasta').val();
			var url = '../procesos/clientes/busca_producto_fecha.php';
			$.ajax({
			type:'POST',
			url:url,
			data:'desde='+desde+'&hasta='+hasta,
			success: function(datos){
				console.log(datos);
				$('#tablaClientesLoad').load("clientes/tablaClientes.php");
			}
		});
		return false;
		});
		
		$('#bd-hasta').on('change', function(){
			var desde = $('#bd-desde').val();
			var hasta = $('#bd-hasta').val();
			var url = '../procesos/clientes/busca_producto_fecha.php';
			$.ajax({
			type:'POST',
			url:url,
			data:'desde='+desde+'&hasta='+hasta,
			success: function(datos){
				console.log(datos);
				$('#tablaClientesLoad').load("clientes/tablaClientes.php");
			}
		});
		return false;
		});	
	});
</script>


<script type="text/javascript">
	$(document).ready(function(){
		$('#buscadorvivo').select2();	
		$('#buscadorvivo').change(function(){
			$.ajax({
				type:"post",
				data:'valor=' + $('#buscadorvivo').val(),
				url:'../procesos/clientes/crearsesion.php',
				success:function(r){
					console.log(r);
					$('#tablaClientesLoad').load("clientes/tablaClientes.php");
				}
			});
		});
	});
</script>

<script type="text/javascript">
	$(document).ready(function(){
		$('#buscadorvivo1').select2();		
		$('#buscadorvivo1').change(function(){
			$.ajax({
				type:"post",
				data:'valor1=' + $('#buscadorvivo1').val(),
				url:'../procesos/clientes/crearsesionProductos.php',
				success:function(r){
					console.log(r);
					$('#tablaClientesLoad').load("clientes/tablaClientes.php");
				}
			});
		});
	});
</script>

<script type="text/javascript">
	$(document).ready(function(
	){		
		$('#tablaClientesLoad').load("clientes/tablaClientes.php");
		$('#btnLimpiar').click(function(){
			
			datos=$('#frmLimpiar').serialize();
			$.ajax({
				type:"POST",
				data:datos,
				url:'../procesos/clientes/limpiar.php',
				success:function(r)
				{	
					$('#tablaClientesLoad').load("clientes/tablaClientes.php");			
				}				
			});
		});
	});
</script>