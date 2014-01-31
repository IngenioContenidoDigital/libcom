<?php	
	include('hosts.php');	
	
	class Gestion{
        
        public $resultado=array();
        public $idgestion;
       
		function CreaGestion($idcontactocliente, $idcontacto, $idefectividad, $agenda, $observaciones, $fecha, $usuario){ 
                      
			$cnn = new mysqli($GLOBALS['host'], $GLOBALS['user'], $GLOBALS['pass'], $GLOBALS['db']);
			$sql = "INSERT INTO gestion (IdContactoCliente, IdContacto, IdEfectividad, Agenda, Observaciones, fecha_estado, usuario) 
            VALUES ('$idcontactocliente','$idcontacto','$idefectividad','$agenda','$observaciones','$fecha','$usuario')";

			$result=$cnn->query($sql) or die(mysql_error());
            $this->idgestion=$cnn->insert_id;
			$cnn->close();
		}
        
        function GetGestion(){
            return $this->idgestion;
        }
        
        function Historico($idcontacto){
            $cnn = new mysqli($GLOBALS['host'], $GLOBALS['user'], $GLOBALS['pass'], $GLOBALS['db']);
            
            $sql="SELECT gestion.fecha_estado, con_contacto.Contacto, con_efectividad.Efectividad, 
            gestion.Agenda, gestion.Observaciones, gestion.usuario 
            FROM gestion 
            INNER JOIN con_contacto ON gestion.IdContacto = con_contacto.IdContacto 
            INNER JOIN con_efectividad ON gestion.IdEfectividad = con_efectividad.IdEfectividad 
            WHERE gestion.IdContactoCliente =".$idcontacto;
            
            $result=$cnn->query($sql);
            while($arr=$result->fetch_assoc()){
                $row['Fecha']=date('Y-m-d',strtotime($arr['fecha_estado']));
                $row['Contacto']=$arr['Contacto'];
                $row['Efectividad']=utf8_encode($arr['Efectividad']);
                $row['Agenda']=$arr['Agenda'];
                $row['Observacion']=utf8_encode($arr['Observaciones']);
                $row['Usuario']=$arr['usuario'];
                array_push($this->resultado,$row);
            }
			$cnn->close();
	
            return $this->resultado;
        }
        
        function EnviaGestion($idgestion, $correocontacto, $correo, $copia, $asunto, $textomensaje){
            if(($correocontacto==true) || ($correocontacto==true)){
                $mensaje ="";
            
                $cnn = new mysqli($GLOBALS['host'], $GLOBALS['user'], $GLOBALS['pass'], $GLOBALS['db']);
                $sql="SELECT * FROM vw_gestion WHERE vw_gestion.IdGestion=".$idgestion;
            
                $result=$cnn->query($sql);
                $arr=$result->fetch_assoc();
                
                $mensaje.='<p style="font-size:12px; height:14px;">'.utf8_encode($arr['Nombre']).'</p>';
                $mensaje.='<p style="font-size:12px; height:14px;">'.utf8_encode($arr['NombreContacto']).'</p>';
                $mensaje.='<p style="font-size:12px; height:14px;">'.utf8_encode($arr['Area']).'</p><br />';
                $mensaje.='<p style="font-size:12px; height:14px;">'.utf8_encode($textomensaje).'</p><br /><br />';
                $mensaje.='<p style="font-size:12px; height:14px;"><b>Detalle de la Gestión Realizada</b></p>';
                $mensaje.='<div style="width:600px; font-size:14px; text-align:justify;">'.utf8_encode($arr['Observaciones']).'</div><br />';                
                $mensaje.='<br />';
                $mensaje.='<p style="font-size:14px;color:#F00"><b>Por Favor NO responsa este mensaje</b></p>';
                $mensaje.='</body></html>';
			
                $cabeceras  = 'MIME-Version: 1.0' . "\r\n";
                $cabeceras .= 'Content-type: text/html; charset=utf-8' . "\r\n";
                $cabeceras .= 'From: '.utf8_encode($arr['Correo']). "\r\n";
                
                if(strlen($copia)>=1){
                    $cabeceras .= 'CC: '.$copia;    
                }  
            
                if($correocontacto==true){
                    mail($correo,$asunto,$mensaje,$cabeceras);
                }
            
                $cnn->close();   
            }
        }
        
        function ActualizaUsuario($idcontactocliente, $nombre, $telefono, $extension, $movil, $correo, $idcliente, $idarea){ 
                      
			$cnn = new mysqli($GLOBALS['host'], $GLOBALS['user'], $GLOBALS['pass'], $GLOBALS['db']);
			$sql = "UPDATE contactos SET NombreContacto='".$nombre."', TelefonoContacto='".$telefono."', ExtensionContacto='".$extension."', 
            MovilContacto='".$movil."', CorreoContacto='".$correo."', IdCliente='".$idcliente."', IdArea='".$idarea."' WHERE contactos.IdContacto=".$idcontactocliente;

			$result=$cnn->query($sql) or die(mysql_error());
			$cnn->close();
		}
        
        function CreaUsuario($nombre, $telefono, $extension, $movil, $correo, $idcliente, $idarea){ 
                      
			$cnn = new mysqli($GLOBALS['host'], $GLOBALS['user'], $GLOBALS['pass'], $GLOBALS['db']);
			$sql = "INSERT INTO contactos (NombreContacto, TelefonoContacto, ExtensionContacto, MovilContacto, CorreoContacto, IdCliente, IdArea) 
            VALUES ('".$nombre."', '".$telefono."', '".$extension."', '".$movil."', '".$correo."', '".$idcliente."', '".$idarea."')";

			$result=$cnn->query($sql) or die(mysql_error());
			$cnn->close();
		}        		
	};
?>