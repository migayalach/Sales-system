<?php 
	class usuarios
	{
		public function dobleUsuario($carnet,$usuario)
		{
			$c=new conectar();
			$conexion=$c->conexion();
			$sql="Select *
				  from usuario
				  where carnet='$carnet' and usuario='$usuario'";
    		$result=mysqli_query($conexion,$sql);
			if(mysqli_num_rows($result)>0)
				return 1;
			else
				return 0;
		}

		public function registroUsuario($datos)
		{
			$c=new conectar();
			$conexion=$c->conexion();

				$sql="INSERT into usuario (
						`nombre`,
						`apellido`,
						`carnet`,
						`direccion`,
						`celular`,
						`telefono`,
						`usuario`,
						`contraseña`,
						`id_nivel`)
				values ('$datos[0]',
						'$datos[1]',
						'$datos[2]',
						'$datos[3]',
						'$datos[4]',
						'$datos[5]',
						'$datos[6]',
						'$datos[7]',
						'$datos[8]')";
		return mysqli_query($conexion,$sql);
		}
 
		
		public function loginUser($datos)
		{
			$c=new conectar();
			$conexion=$c->conexion();
			$password=sha1($datos[1]);

			$_SESSION['usuario']=$datos[0];
			$_SESSION['idcliente']=self::traeID($datos);
			
			$sql="SELECT * 
				  from usuario 
				  where usuario='$datos[0]' and contraseña='$password'";
			$result=mysqli_query($conexion,$sql);
			
			$usua=mysqli_fetch_array($result);
			$_SESSION['nivel']=($usua['id_nivel']);
			
			if(mysqli_num_rows($result) > 0)
				return 1;
			else
				return 0;
		}
		
		public function traeID($datos){
			$c=new conectar();
			$conexion=$c->conexion();

			$password=sha1($datos[1]);

			$sql="SELECT id_usuario 
				  from usuario 
				  where usuario='$datos[0]'	and contraseña='$password'"; 
			$result=mysqli_query($conexion,$sql);

			return mysqli_fetch_row($result)[0];
		}

		public function obtenDatosUsuario($idusuario){

			$c=new conectar();
			$conexion=$c->conexion();

			$sql="SELECT id_usuario,
					 	 nombre,
						 apellido,
						 carnet,
						 direccion,
						 celular,
						 telefono,
						 usuario,
						 id_nivel
					from usuario where id_usuario='$idusuario'";
			$result=mysqli_query($conexion,$sql);

			$ver=mysqli_fetch_row($result);

			$datos=array(
						'id_usuario' => $ver[0],
						'nombre' => $ver[1],
						'apellido' => $ver[2],
						'carnet' => $ver[3],
						'direccion' => $ver[4],
						'celular' => $ver[5],
						'telefono' => $ver[6],
						'usuario' => $ver[7],
						'id_nivel' => $ver[8]);
			return $datos;
		}

		public function actualizaUsuario($datos){
			$c=new conectar();
			$conexion=$c->conexion();

			$sql="UPDATE usuario set nombre='$datos[1]',
									  apellido='$datos[2]',
									  carnet='$datos[3]',
									  direccion='$datos[4]',
									  celular='$datos[5]',
									  telefono='$datos[6]',
									  usuario='$datos[7]',
									  id_nivel='$datos[8]'
						where id_usuario='$datos[0]'";
			return mysqli_query($conexion,$sql);	
		}

		public function actualizaUsuarioM($datos){
			$c=new conectar();
			$conexion=$c->conexion();

			$sql="UPDATE usuario set nombre='$datos[1]',
									 apellido='$datos[2]',
									 carnet='$datos[3]',
									 direccion='$datos[4]',
									 celular='$datos[5]',
									 telefono='$datos[6]',
									 usuario='$datos[7]',
									 contraseña=sha1('$datos[8]')
						where id_usuario='$datos[0]'";
			return mysqli_query($conexion,$sql);	
		}

		public function eliminaUsuario($idusuario){
			$c=new conectar();
			$conexion=$c->conexion();

			$sql="DELETE from usuario 
					where id_usuario='$idusuario'";
			return mysqli_query($conexion,$sql);
		}
	}
 ?>