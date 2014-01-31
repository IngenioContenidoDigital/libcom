<?php	
	include('hosts.php');	
	
	class Agenda{
        
        public $mensaje='
        <html>
            <head>
                <meta http-equiv="content-type" content="text/html; charset="utf-8" />
                <meta http-equiv="content-type" content="text/html" />
            </head>
            <body>';
        public $filas=0;
        
        function ConsultaAgenda($usuario, $fecha){
            $cnn = new mysqli($GLOBALS['host'], $GLOBALS['user'], $GLOBALS['pass'], $GLOBALS['db']);
            
            $sql="SELECT
contactos.NombreContacto AS NombreContacto,
areas.Area,
con_contacto.Contacto,
con_efectividad.Efectividad,
gestion.Agenda,
gestion.Observaciones,
gestion.fecha_estado,
gestion.usuario,
contactos.IdCliente,
clientes.Nombre AS Institucion
FROM
contactos
INNER JOIN gestion ON gestion.IdContactoCliente = contactos.IdContacto
INNER JOIN con_contacto ON gestion.IdContacto = con_contacto.IdContacto
INNER JOIN con_efectividad ON gestion.IdEfectividad = con_efectividad.IdEfectividad
INNER JOIN clientes ON contactos.IdCliente = clientes.IdCliente
INNER JOIN areas ON contactos.IdArea = areas.IdArea
WHERE
gestion.usuario = '".$usuario."' AND
gestion.Agenda = '".$fecha."'";
            
            $result=$cnn->query($sql);
            $this->filas=$result->num_rows;
            $this->mensaje.='
                <p>A Continuaci&oacute;n se envia la Agenda pendiente para el d&iacute;a de hoy.</p>
                <br />';
            while($arr=$result->fetch_assoc()){
                                
                $this->mensaje.='
                <table style="border-collapse:collapse;">
                    <tr>
                        <td><div style="font-weight:bold; width:150px; font-size:10px;">INSTITUCION</div></td>
                        <td colspan="3"><div style="width:450px;border:solid; border-width:2px; border-color:black;font-size:10px;">'.utf8_encode($arr['Institucion']).'</div></td>
                    </tr>
                    <tr>
                        <td><div style="font-weight:bold; width:150px; font-size:10px;">NOMBRE DE CONTACTO</div></td>
                        <td colspan="3"><div style="width:450px;border:solid; border-width:2px; border-color:black;font-size:10px;">'.utf8_encode($arr['NombreContacto']).'</div></td>
                    </tr>
                    <tr>
                        <td><div style="font-weight:bold; width:150px; font-size:10px;">AREA</div></td>
                        <td><div style="width:150px;border:solid; border-width:2px; border-color:black;font-size:10px;">'.utf8_encode($arr['Area']).'</div></td>
                        <td><div style="font-weight:bold; width:150px; font-size:10px;">CONTACTO</div></td>
                        <td><div style="width:130px;border:solid; border-width:2px; border-color:black;font-size:10px;">'.utf8_encode($arr['Contacto']).'</div></td>
                    </tr>
                    <tr>
                        <td><div style="font-weight:bold; width:150px; font-size:10px;">EFECTIVIDAD</div></td>
                        <td><div style="width:150px;border:solid; border-width:2px; border-color:black;font-size:10px;">'.utf8_encode($arr['Efectividad']).'</div></td>
                        <td><div style="font-weight:bold; width:150px; font-size:10px;">AGENDA</div></td>
                        <td><div style="width:130px;border:solid; border-width:2px; border-color:black;font-size:10px;">'.$arr['Agenda'].'</div></td>
                    </tr>
                    <tr>
                        <td><div style="font-weight:bold; width:150px; font-size:10px;">USUARIO</div></td>
                        <td><div style="width:150px;border:solid; border-width:2px; border-color:black;font-size:10px;">'.utf8_encode($arr['usuario']).'</div></td>
                        <td><div style="font-weight:bold; width:150px; font-size:10px;">GESTION</div></td>
                        <td><div style="width:130px;border:solid; border-width:2px; border-color:black;font-size:10px;">'.date('Y-m-d',strtotime($arr['fecha_estado'])).'</div></td>
                    </tr>
                    <tr>
                        <td colspan="4"><div align="center" style="font-weight:bold; width:600px; height:25px; font-size:10px;">OBSERVACIONES</div></td>
                    </tr>
                    <tr>
                        <td colspan="4"><div style="width:600px; height:150px; border:solid; border-width:2px; border-color:black;font-size:10px;padding:5px">'.utf8_encode($arr['Observaciones']).'</div></td>
                    </tr>
                </table>
                <hr style="border:dashed; border-width:1px;">
                <br />';
            }
            $this->mensaje.='</body></html>';
			$cnn->close();
        }
        
        function GetMensaje(){
            return $this->mensaje;
        }
        
        function GetFilas(){
            return $this->filas;
        }
        
        function EnviarMensaje($para, $asunto){    
            if(strlen($this->mensaje)>=1){
                $cabeceras  = 'MIME-Version: 1.0' . "\r\n";
                $cabeceras .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
                $cabeceras .= 'From: administrador@grupolibcom.com'. "\r\n";  
                $cabeceras .= 'Bcc: lfelipeqn@gmail.com';
        
                mail($para,$asunto,$this->mensaje,$cabeceras);
            }
            return 1;    
        }    		
	};
?>