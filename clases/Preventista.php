<?php 
	class preventista
	{	
		public function insertaPreventista($datos)
		{
			$c=new conectar();
			$conexion=$c->conexion();
			$sql="INSERT INTO `preventista`(`idProveedor`,`nombre`, `apellido`,`celular`)
   				  values ('$datos[0]',
					 	  '$datos[1]',
						  '$datos[2]',
						  '$datos[3]'
						  )";
			return mysqli_query($conexion,$sql);
		}

		public function actualizaPreventista($datos)
		{
			$c=new conectar();
			$conexion=$c->conexion();
			$sql="UPDATE preventista set idProveedor='$datos[1]',
									  nombre='$datos[2]',
									  apellido ='$datos[3]',
									  celular  ='$datos[4]'
									where idPreventista='$datos[0]'";
			return mysqli_query($conexion,$sql);	
		}

		public function eliminaPreventista($id_producto)
		{
			$c=new conectar();
			$conexion=$c->conexion();
			$sql="DELETE from preventista where idPreventista='$id_producto'";
			return mysqli_query($conexion,$sql);	
		}

		public function obtenDatosPreventista($idarticulo)
		{
			$c=new conectar();
			$conexion=$c->conexion();
			$sql="SELECT p.idPreventista, r.idproveedor, p.nombre, p.apellido, p.celular
				  FROM preventista p, proveedor r
				  where p.idProveedor=r.idproveedor AND p.idPreventista ='$idarticulo'";
				 $result=mysqli_query($conexion,$sql);
				 $ver=mysqli_fetch_row($result);
				 $datos=array(
					  		  "p.idPreventista"=>$ver[0],
							  "r.nombreEmpresa"=>$ver[1],
							  "p.nombre"=>$ver[2], 
							  "p.apellido"=>$ver[3],
							  "p.celular"=>$ver[4]);
				return $datos;
				//mysqli_querry($conexion,$sql);
		}
	}	
?>