<?php 

class ventas
{
	public function obtenDatosProducto($idproducto){
		$c=new conectar();
		$conexion=$c->conexion();

		$sql = "SELECT p.tamaño, p.stock, c.precio_venta 
				FROM producto p, cantidad c
				WHERE p.id_producto=c.id_producto and p.id_producto='$idproducto'";
		$result=mysqli_query($conexion,$sql);

		$ver=mysqli_fetch_row($result);

		$data=array(
			'tamano'=>$ver[0],
			'stock'=>$ver[1],
			'precio'=>$ver[2]
		);		
		return $data;
	}

	public function crearVenta(){
		$c= new conectar();
		$conexion=$c->conexion();

		$fecha=date('Y-m-d');
		$idventa=self::creaFolio();
		$datos=$_SESSION['tablaComprasTemp'];
		$r=0;

		for ($i=0; $i < count($datos) ; $i++) { 
			$d=explode("||", $datos[$i]);
			$tt=$d[3]*$d[6];
			$totalFIn=$tt-$d[8];
			$debeCantidad=$d[6]-$d[9];
			$sql="INSERT into venta (id_venta,
									 id_cliente,
									 id_producto,
									 precio,
									 cantidad,
									 total,
									 fechaCompra,
									 garantia,
									 acuentaDinero,
									 acuantaCantidad,
									 totalfin,
									 debeCantidad)
							values ('$idventa',
									'$d[5]',
									'$d[0]',
									'$d[3]',
									'$d[6]',
									'$tt',
									'$fecha',
									'$d[7]',
									'$d[8]',
									'$d[9]',
									'$totalFIn',
									'$debeCantidad')";
			$r= $r + $result=mysqli_query($conexion,$sql);
			self::descuentaCantidad($d[0],$d[6]);
		}
		return $r;
	}

	public function descuentaCantidad($idproducto,$cantidad)
	{
		$c= new conectar();
		$conexion=$c->conexion();

		$sql="SELECT stock 
			  from producto 
			  where id_producto='$idproducto'";
		
		$resul=mysqli_query($conexion,$sql);
		$cantidad1=mysqli_fetch_row($resul)[0];
		$cantidadNueva=abs($cantidad-$cantidad1);

		$sql="UPDATE producto
			  set stock='$cantidadNueva'
			  where id_producto='$idproducto'";
		mysqli_query($conexion,$sql);
	}

	public function creaFolio(){
		$c= new conectar();
		$conexion=$c->conexion();

		$sql="SELECT id_venta from venta group by id_venta desc";

		$resul=mysqli_query($conexion,$sql);
		$id=mysqli_fetch_row($resul)[0];

		if($id=="" or $id==null or $id==0){
			return 1;
		}else{
			return $id + 1;
		}
	}

	public function nombreCliente($idCliente){
		$c= new conectar();
		$conexion=$c->conexion();

		 $sql="SELECT apellido,nombre 
			from cliente
			where id_cliente='$idCliente'";
		$result=mysqli_query($conexion,$sql);

		$ver=mysqli_fetch_row($result);

		return $ver[0]." ".$ver[1];
	}

	public function obtenerTotal($idventa){
		$c= new conectar();
		$conexion=$c->conexion();

		$sql="SELECT total
				from venta
				where id_venta='$idventa'";
		$result=mysqli_query($conexion,$sql);

		$total=0;

		while($ver=mysqli_fetch_row($result)){
			$total=$total + $ver[0];
		}

		return $total;
	}

	public function actualizaDeuda($datos)
	{
		$c=new conectar();
		$conexion=$c->conexion();

		$sql="UPDATE venta 
			  set garantia=garantia-'$datos[8]',

			  	  acuentaDinero=acuentaDinero+'$datos[12]',
				  totalfin=totalfin-'$datos[12]',
				 
				  acuantaCantidad=acuantaCantidad+'$datos[10]',
				  debeCantidad=debeCantidad-'$datos[10]'
	  	where id_venta='$datos[0]' and id_producto='$datos[1]'";
		echo mysqli_query($conexion,$sql);
	}


}