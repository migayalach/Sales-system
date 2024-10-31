<?php     
  require_once "dependencias.php";
  $idCliente=$_SESSION['idcliente'];
  //echo ($idCliente);
?>

<!DOCTYPE html>
<html>
<head>
  <title></title>
</head>
<body>

  <!-- Begin Navbar -->
  <div id="nav">
    <div class="navbar navbar-inverse navbar-fixed-top" data-spy="affix" data-offset-top="100">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
       <!--   <a class="navbar-brand" href="inicio.php"><img class="img-responsive logo img-thumbnail" src="../img/ventas.png" alt="" width="40px" height="40px"></a>-->
        </div>
        <div id="navbar" class="collapse navbar-collapse">

          <ul class="nav navbar-nav navbar-right">

            <li class="active"><a href="inicio.php"><span class="glyphicon glyphicon-home"></span> Inicio</a>
            </li>

            
          </li>
          <li class="dropdown">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><span class="glyphicon glyphicon-list-alt"></span> Administrar Productos <span class="caret"></span></a>
            <ul class="dropdown-menu">
              <li><a href="categorias.php">Categorias</a></li>
              <li><a href="articulos.php">Productos</a></li>
			  <li><a href="ingresos.php">Ingresos</a></li>
            </ul>
          </li>


		  </li>
          <li class="dropdown">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><span class="glyphicon glyphicon-list-alt"></span> Administrar Proveedores <span class="caret"></span></a>
            <ul class="dropdown-menu">
              <li><a href="proveedor.php">Proveedor</a></li>
              <li><a href="preventista.php">Preventista</a></li>
            </ul>
          </li>

        <!--CAMBIAR POR NIVEL DE ACCESO-->
        <?php
        if($_SESSION['nivel']==1):
        ?>
           <li><a href="usuarios.php"><span class="glyphicon glyphicon-user"></span> Usuarios</a>
            </li>
         <?php 
       endif;
          ?>

		  <li><a href="cliente.php"><span class="glyphicon glyphicon-folder-open"></span> Clientes</a>
            </li>

          <li><a href="ventas.php"><span class="glyphicon glyphicon-send"></span> Vender Productos</a>
          </li>
          
          <?php
        if($_SESSION['nivel']==1):
        ?>
           <li><a href="clientes.php"><span class="glyphicon glyphicon glyphicon-search"></span> Busqueda</a>
          </li>
        <?php 
       endif;
          ?> 
          
          <li class="dropdown" >
            <a href="#" style="color: red"  class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><span class="glyphicon glyphicon-user"></span> Usuario: <?php echo $_SESSION['usuario']; ?>  <span class="caret"></span></a>
            <ul class="dropdown-menu">  
            
			<li> <a style="color: blue" href="" data-toggle="modal" data-target="#actualizaUsuarioModalM" class="" onclick="agregaDatosUsuarioM('<?php echo $idCliente; ?>')">
			<span class="glyphicon glyphicon-wrench"></span> Administrar Usuario
			</a></li>                  

			<!--<li><span data-toggle="modal" data-target="#actualizaUsuarioModalM" class="btn btn-warning btn-xs" onclick="agregaDatosUsuarioM('<?php //echo $idCliente; ?>')">
				<span class="glyphicon glyphicon-wrench"></span>
			</span></li>-->

              <li> <a style="color: red" href="../procesos/salir.php"><span class="glyphicon glyphicon-off"></span> Salir</a></li> 
            </ul>  
          </li>
        </ul>
      </div>
    </div>
  </div>
</div>

<!-- Modal -->
<div class="modal fade" id="actualizaUsuarioModalM" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
	<div class="modal-dialog modal-sm" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title" id="myModalLabel">Actualiza Datos</h4>
			</div>
			<div class="modal-body">
				<form id="frmRegistroM">
					<input type="text" hidden="" id="idUsuarioM" name="idUsuarioM">
					<label>Nombre</label>
					<input type="text" class="form-control input-sm" name="nombreM" id="nombreM">
					<label>Apellido</label>
					<input type="text" class="form-control input-sm" name="apellidoM" id="apellidoM">
					<label>Carnet</label>
					<input type="text" class="form-control input-sm" name="carnetM" id="carnetM">
					<label>Direccion</label>
					<input type="text" class="form-control input-sm" name="direccionM" id="direccionM">
					<label>Celular</label>
					<input type="text" class="form-control input-sm" name="celularM" id="celularM">
					<label>Telefono</label>
					<input type="text" class="form-control input-sm" name="telefonoM" id="telefonoM">
					<label>Usuario</label>
					<input type="text" class="form-control input-sm" name="usuarioM" id="usuarioM">
          			<label>Nueva contraseña</label>
					<input type="text" class="form-control input-sm" name="claveM" id="claveM">
				</form>
			</div>
			<div class="modal-footer">
				<button id="btnActualizaUsuarioM" type="button" class="btn btn-warning" data-dismiss="modal">Actualiza Usuario</button>
			</div>
		</div>
	</div>
</div>

</body>
</html>

<script type="text/javascript">
		function agregaDatosUsuarioM(idusuario){
			$.ajax({
				type:"POST",
				data:"idusuarioM=" + idusuario,
				url:"../procesos/usuarios/obtenDatosUsuarioM.php",
				success:function(r){
					dato=jQuery.parseJSON(r);
					$('#idUsuarioM').val(dato['id_usuario']);
					$('#nombreM').val(dato['nombre']);
					$('#apellidoM').val(dato['apellido']);
					$('#carnetM').val(dato['carnet']);
					$('#direccionM').val(dato['direccion']);
					$('#celularM').val(dato['celular']);
					$('#telefonoM').val(dato['telefono']);
					$('#usuarioM').val(dato['usuario']);
				}
			});
		}
</script>

<script type="text/javascript">
	$(document).ready(function(){
		$('#btnActualizaUsuarioM').click(function(){
			vacios=validarFormVacio('frmRegistroM');
			if(vacios > 0){
				alertify.alert("Debes llenar todos los campos!!");
				return false;
			}

			datos=$('#frmRegistroM').serialize();
			$.ajax({
				type:"POST",
				data:datos,
				url:"../procesos/usuarios/actualizaUsuarioP.php",
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