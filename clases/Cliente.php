<?php 
	class cliente
	{
		public function dobleCliente($carnet)
		{
			$c=new conectar();
			$conexion=$c->conexion();
			$sql="Select *
				  from cliente
				  where carnet='$carnet'";
    		$result=mysqli_query($conexion,$sql);
			if(mysqli_num_rows($result)>0)
				return 1;
			else
				return 0;
		}

		public function registroCliente($datos)
		{
			$c=new conectar();
			$conexion=$c->conexion();

				$sql="INSERT into cliente (
						`nombre`,
						`apellido`,
						`carnet`,
						`direccion`,
						`celular`,
						`telefono`)
				values ('$datos[0]',
						'$datos[1]',
						'$datos[2]',
						'$datos[3]',
						'$datos[4]',
						'$datos[5]')";
		return mysqli_query($conexion,$sql);
		}
 
		public function obtenDatosCliente($idusuario){

			$c=new conectar();
			$conexion=$c->conexion();

			$sql="SELECT *
					from cliente where id_cliente='$idusuario'";
			$result=mysqli_query($conexion,$sql);

			$ver=mysqli_fetch_row($result);

			$datos=array(
						'id_cliente' => $ver[0],
						'nombre' => $ver[1],
						'apellido' => $ver[2],
						'carnet' => $ver[3],
						'direccion' => $ver[4],
						'celular' => $ver[5],
						'telefono' => $ver[6]);
			return $datos;
		}

		public function actualizaCliente($datos){
			$c=new conectar();
			$conexion=$c->conexion();

			$sql="UPDATE cliente set nombre='$datos[1]',
									  apellido='$datos[2]',
									  carnet='$datos[3]',
									  direccion='$datos[4]',
									  celular='$datos[5]',
									  telefono='$datos[6]'
						where id_cliente='$datos[0]'";
			return mysqli_query($conexion,$sql);	
		}

		public function eliminaCliente($idusuario){
			$c=new conectar();
			$conexion=$c->conexion();

			$sql="DELETE from cliente 
					where id_cliente='$idusuario'";
			return mysqli_query($conexion,$sql);
		}
	}
 ?>