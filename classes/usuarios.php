<?php	
	include('hosts.php');	
	
	class Usuario{
		
		public $usuario="";				
		public $nombre="";
		public $perfil="";
                public $privilegio="";
		public $correo="";
		public $estado=0;		
		public $permiso=0;
		public $clave="";		
		
		function Login($usuario, $clave){
						
			$this->usuario=$usuario;
			$this->clave=md5($clave);
			$cnn = new mysqli($GLOBALS['host'], $GLOBALS['user'], $GLOBALS['pass'], $GLOBALS['db']);
			$sql = "SELECT usuarios.Usuario, usuarios.`Password`, usuarios.Nombre, usuarios.Correo, usuarios.IdPerfil, perfiles.Perfil 
            FROM usuarios 
            INNER JOIN perfiles ON usuarios.IdPerfil = perfiles.IdPerfil 
            WHERE usuarios.Usuario = '".$this->usuario."' AND usuarios.`Password` = '".$clave."'";

			$result=$cnn->query($sql);
			if($result->num_rows>=1){
				$row=$result->fetch_assoc();				
				$_SESSION['usuario']=$row['Usuario'];		
				$_SESSION['correo']=$row['Correo'];
				$_SESSION['nombre']=$row['Nombre'];
                $_SESSION['perfil']=$row['IdPerfil'];
				$_SESSION['privilegio']=$row['Perfil'];
				$this->estado=1;
				$this->nombre=$row['Nombre'];
				$this->perfil=$row['IdPerfil'];
                $this->privilegio=$row['Perfil'];
				$this->correo=$row['Correo'];
				$result->free();
			}
			$cnn->close();
		}		
		
		function Logout(){
			session_destroy();
			$this->estado=0;
		}		
		
		function Conectado(){
			return $this->estado;
		}			
		
                function Nombre(){
                    return $this->nombre;
                }
                
                function Privilegios($perfil, $tipo){
                    include('hosts.php');
                    $cnn = new mysqli($GLOBALS['host'], $GLOBALS['user'], $GLOBALS['pass'], $GLOBALS['db']);
                    
                    $sql="SELECT perfiles.".$tipo." FROM perfiles WHERE perfiles.Perfil='".$perfil."'";
                    $result=$cnn->query($sql);
                    $row=$result->fetch_assoc();				
                    $this->permiso=$row[$tipo];
                    $result->free();
                    $cnn->close();
                    return $this->permiso;
		}
	};
?>