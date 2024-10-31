<?php 
	session_start();
	require_once "../../clases/Conexion.php";

	$c= new conectar();
	$conexion=$c->conexion();

	$idcliente=$_POST['clienteVenta'];
	$idproducto=$_POST['productoVenta'];
	$descripcion=$_POST['descripcionV'];
	$cantidad=$_POST['cantidadV'];
	$precio=$_POST['precioV'];
	$cv=$_POST['cantidadVenta'];

	//desde aqui se agrego lo nuevo
	$garantia=$_POST['garantia'];
	$dineroCuenta=$_POST['dineroCuenta'];
	$cantidadProductos=$_POST['cantidadProductos'];
	//fin

	
	$sql="SELECT nombre,apellido 
			from cliente 
			where id_cliente='$idcliente'";
	$result=mysqli_query($conexion,$sql);
	//c=cliente
	$c=mysqli_fetch_row($result);
	//n=nombre de cliente
	$ncliente=$c[1]." ".$c[0];

	$sql="SELECT nombre_producto
			from producto
			where id_producto='$idproducto'";
	$result=mysqli_query($conexion,$sql);

	$nombreproducto=mysqli_fetch_row($result)[0];

	$articulo=$idproducto."||".
			  $nombreproducto."||".
			  $descripcion."||".
			  $precio."||".
			  $ncliente."||".
			  $idcliente."||".
			  $cv."||".
			  //desde aqui se agrego lo nuevo		  
			  $garantia."||".
			  $dineroCuenta."||".
			  $cantidadProductos."||"
			  ;

	$_SESSION['tablaComprasTemp'][]=$articulo;

 ?>