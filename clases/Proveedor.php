<?php 
	class proveedor
	{	
		public function insertaProveedor($datos)
		{
			$c=new conectar();
			$conexion=$c->conexion();
			$sql="INSERT INTO `proveedor`(`nombreEmpresa`,`celular`, `telefono`,`direccion`)
   				  values ('$datos[0]',
					 	  '$datos[1]',
						  '$datos[2]',
						  '$datos[3]'
						  )";
			return mysqli_query($conexion,$sql);
		}

		public function actualizarProveedor($datos)
		{
			$c=new conectar();
			$conexion=$c->conexion();
			$sql="UPDATE proveedor set nombreEmpresa='$datos[1]',
									   celular='$datos[2]',
									   telefono='$datos[3]',
									   direccion='$datos[4]'
									where idproveedor='$datos[0]'";
			return mysqli_query($conexion,$sql);	
		}

		public function eliminaProveedor($id_producto)
		{
			$c=new conectar();
			$conexion=$c->conexion();
			$sql="DELETE from proveedor where idproveedor='$id_producto'";
			return mysqli_query($conexion,$sql);	
		}

		public function obtenDatosProveedor($idarticulo)
		{
			$c=new conectar();
			$conexion=$c->conexion();
			$sql="SELECT *
				  FROM proveedor where idproveedor='$idarticulo'";
				 $result=mysqli_query($conexion,$sql);
				 $ver=mysqli_fetch_row($result);
				 $datos=array(
					  		  "idproveedor"=>$ver[0],
							  "nombreEmpresa"=>$ver[1],
							  "celular"=>$ver[2], 
							  "telefono"=>$ver[3],
							  "direccion"=>$ver[4]);
				return $datos;
				//mysqli_querry($conexion,$sql);
		}
	}	
?>