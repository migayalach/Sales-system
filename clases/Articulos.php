<?php 
	class articulos
	{	
		public function insertaArticulos($datos)
		{
			$c=new conectar();
			$conexion=$c->conexion();
			$s=0;
			$sql="INSERT INTO `producto`( `id_categoria`,`nombre_producto`, `tamaño`,`Stock`)
   				  values ('$datos[0]',
					 	  '$datos[1]',
						  '$datos[2]',
						  '$s'
						  )";
			return mysqli_query($conexion,$sql);
		}

		public function actualizarArticulo($datos)
		{
			$c=new conectar();
			$conexion=$c->conexion();
			$sql="UPDATE producto set id_categoria='$datos[1]',
									  nombre_producto='$datos[2]',
									  tamaño='$datos[3]'
									where id_producto='$datos[0]'";
			return mysqli_query($conexion,$sql);	
		}

		public function eliminaArticulo($id_producto)
		{
			$c=new conectar();
			$conexion=$c->conexion();
			$sql="DELETE from producto where id_producto='$id_producto'";
			return mysqli_query($conexion,$sql);	
		}

		public function obtenDatosArticulo($idarticulo)
		{
			$c=new conectar();
			$conexion=$c->conexion();
			$sql="SELECT id_producto,
						 id_categoria,
						 nombre_producto,
			 			 tamaño
				  FROM producto where id_producto='$idarticulo'";
				 $result=mysqli_query($conexion,$sql);
				 $ver=mysqli_fetch_row($result);
				 $datos=array(
					  		  "id_producto"=>$ver[0],
							  "id_categoria"=>$ver[1],
							  "nombre_producto"=>$ver[2], 
							  "tamaño"=>$ver[3]);
				return $datos;
				//mysqli_querry($conexion,$sql);
		}
	}	
?>