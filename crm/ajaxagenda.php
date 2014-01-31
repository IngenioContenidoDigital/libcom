<?php
	session_start();
    date_default_timezone_set('America/Bogota');
	require('../classes/Agenda.php');
	
    $agenda = new Agenda();
    
    $usuario=$_POST['user'];
    $para=$_SESSION['correo'];
    $fecha=date('Y-m-d');
    
    $agenda->ConsultaAgenda($usuario, $fecha);
    $total=$agenda->GetFilas();
    if($total>0){
        $resultado=$agenda->EnviarMensaje($para, 'Agenda para Gestion del dia');
    }else{
        $resultado=0;
    }
    echo $resultado;
    
?>