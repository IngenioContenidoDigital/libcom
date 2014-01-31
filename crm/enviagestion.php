<?php
	session_start();
   date_default_timezone_set('America/Bogota');
	
       
    $cliente=$_POST['cliente'];
    $gerente=$_POST['gerente'];
    $correo=$_POST['correo'];
    
    $fecha=date('Y-m-d');
    
    $agenda->ConsultaAgenda($usuario, $fecha);
    $resultado=$agenda->EnviarMensaje($para, 'Agenda para Gestion del dia');
    echo $resultado;
    
?>