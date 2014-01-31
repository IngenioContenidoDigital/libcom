<?php	
	include('hosts.php');
    
	class Cliente{		    
		function CreaCliente($idcliente, $digito, $nombre, $direccion, $departamento, $nombreuso){ 
                      
			$cnn = new mysqli($GLOBALS['host'], $GLOBALS['user'], $GLOBALS['pass'], $GLOBALS['db']);
			$sql = "INSERT INTO clientes (IdCliente, Digito, Nombre, Direccion, Departamnto, NombreUso) 
            VALUES ('$idcliente','$digito','$nombre','$direccion','$departamento','$nombreuso')";

			$result=$cnn->query($sql) or die(mysql_error());
			$cnn->close();
		}
        
        function ActCliente($idcliente, $digito, $nombre, $direccion, $departamento, $nombreuso){
            $cnn = new mysqli($GLOBALS['host'], $GLOBALS['user'], $GLOBALS['pass'], $GLOBALS['db']);
			$sql = "UPDATE clientes SET IdCliente='$idcliente', Digito='$digito', Nombre='$nombre', Direccion='$direccion', Departamnto='$departamento', NombreUso='$nombreuso' WHERE clientes.IdCliente=".$idcliente;

			$result=$cnn->query($sql) or die(mysql_error());
			$cnn->close();
        }
        
        function EliminaCliente($idcliente){
            include('hosts.php');
            $cnn = new mysqli($host, $user, $pass, $db);
			$sql = "DELETE FROM clientes WHERE clientes.IdCliente='".$idcliente."'";

            $result=$cnn->query($sql) or die(mysql_error());
			$cnn->close();
        }  
	}
?>