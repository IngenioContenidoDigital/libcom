<?php	
	include('hosts.php');
	class Galeria{
		public $id;				
		public $nombre;
        public $resultado = array();
				
		function CreaGaleria($galeria){
			$this->nombre=$galeria;
			
			$cnn = new mysqli($GLOBALS['host'], $GLOBALS['user'], $GLOBALS['pass'], $GLOBALS['db']);
			$sql = "INSERT INTO galerias (NombreGaleria) VALUES ('".$galeria."')";

			$result=$cnn->query($sql);
			$this->id=$cnn->insert_id;
			$cnn->close();
		}		
		
		function getIdGaleria(){
			return $this->id;
		}		
		
                function getNombreGaleria(){
			return $this->nombre;
		}
                
		function ImagenesGaleria($imagenes, $id){
                    $cnn = new mysqli($GLOBALS['host'], $GLOBALS['user'], $GLOBALS['pass'], $GLOBALS['db']);
                    $sql="INSERT INTO galerias_imagenes (imagen, IdGaleria) VALUES ('".$imagenes."', '".$id."')";
                    $result=$cnn->query($sql);
                    $cnn->close();
		}
                
                               
       function Tubnails(){
           $cnn = new mysqli($GLOBALS['host'], $GLOBALS['user'], $GLOBALS['pass'], $GLOBALS['db']);
           
           $sql="SELECT galerias.IdGaleria, galerias.NombreGaleria, 
               (SELECT imagen FROM galerias_imagenes WHERE galerias_imagenes.IdGaleria=galerias.IdGaleria LIMIT 1) AS imagen 
               FROM galerias ORDER BY galerias.IdGaleria DESC LIMIT 3";
           
           $result=$cnn->query($sql);
           
           while($arr=$result->fetch_assoc()){
               $row['IdGaleria']=$arr['IdGaleria'];
               $row['NombreGaleria']=$arr['NombreGaleria'];
               $row['imagen']=$arr['imagen'];
               array_push($this->resultado,$row);
           }
           return $this->resultado;
    }            
}
?>