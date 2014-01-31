<?php	
	include('hosts.php');	
	
	class Marca{		
		public $resultado="";
        
		function getLogo($idmarca){
						
			$cnn = new mysqli($GLOBALS['host'], $GLOBALS['user'], $GLOBALS['pass'], $GLOBALS['db']);
			$sql = "SELECT marcas.IdMarca, marcas.Marca, marcas.Logo 
            FROM marcas WHERE marcas.IdMarca=".$idmarca;

			$result=$cnn->query($sql);
            $arr=$result->fetch_assoc();
            $this->resultado=$arr['Logo'];
			$cnn->close();
            return $this->resultado;
		}
                
	};
?>