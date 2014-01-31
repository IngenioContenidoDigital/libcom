<?php

class Conectar{

  private $conexion;
  public $consulta;
  public $id;
  
  public function Conecta($host, $usuario, $password, $db){ 
    if(!isset($this->conexion)){
      $this->conexion = (mysql_connect($host,$usuario,$password)) or die(mysql_error());
      mysql_select_db($db,$this->conexion) or die(mysql_error());
    }
  }

  public function Consulta($consulta){  
    $this->consulta = mysql_query($consulta,$this->conexion);    
    if(!$this->consulta){ 
      echo 'MySQL Error: ' . mysql_error();
      exit;
    }
    return $this->consulta;
  }
  
  public function VerSQL(){
  		return $this->consulta;
  }

  public function Resultado(){
   return mysql_fetch_assoc($this->consulta);
  }
  
  public function IdCreado(){
        $this->id=mysql_insert_id($this->conexion);
        return $this->id;  	
  }
    
  public function Arreglo(){
   return mysql_fetch_array($this->consulta);
  }

  public function Filas(){
   return mysql_num_rows($this->consulta);
  }
  
  public function Cerrar(){
  		return mysql_close($this->conexion);
  }

}

?>