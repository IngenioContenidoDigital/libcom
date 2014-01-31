<?php
	session_start();
    date_default_timezone_set('America/Bogota');
	require('../classes/Gestion.php');
	
    $gestion = new Gestion();
    
    $tipo=$_POST['tipo'];
    
    if($tipo=='Nuevo'){
        $idcontactocliente=$_POST['idcontactocliente'];
        $idcontacto=$_POST['idcontacto'];
        $idefectividad=$_POST['idefectividad'];
        $agenda=$_POST['agenda'];
        $observaciones=utf8_decode($_POST['observaciones']);
        $fecha=date('Y-m-d');
        $usuario=$_SESSION['usuario'];
        
        $destino=$_POST['destino'];
        $copia=$_POST['copia'];
        
        $correo=$_POST['correo'];
        $correocontacto=$_POST['enviacontacto'];
        //$correogerencia=$_POST['enviagerencia'];
        $asunto=utf8_decode($_POST['asunto']);
        $mensaje=utf8_decode($_POST['mensaje']);
        
        $gestion->CreaGestion($idcontactocliente, $idcontacto, $idefectividad, $agenda, $observaciones,$fecha,$usuario);
        $idgestion=$gestion->GetGestion();
        
        if($correocontacto=="true"){
            $gestion->EnviaGestion($idgestion, $correocontacto, $destino, $copia, $asunto, $mensaje);
        }
        
        echo 'Gestion Registrada';   
    }
    
    if($tipo=='Historia'){
        $idcontactocliente=$_POST['idcontactocliente'];
        $resultado=$gestion->Historico($idcontactocliente);
        echo json_encode($resultado);
    }
    
    if($tipo=='Actualiza'){
        $idcontactocliente=$_POST['idcontactocliente'];
        $nombre=strtoupper(utf8_decode($_POST['nombre']));
        $telefono=$_POST['telefono'];
        $extension=$_POST['extension'];
        $movil=$_POST['movil'];
        $correo=strtolower($_POST['correo']);
        $idcliente=$_POST['idcliente'];
        $idarea=$_POST['idarea'];
        $origen=$_POST['origen'];
        $gestion->ActualizaUsuario($idcontactocliente, $nombre, $telefono, $extension, $movil, $correo, $idcliente, $idarea);
        
        if($origen=='filtrado'){
        		echo 'Contacto Actualizado';
        }
        
        if($origen=='general'){
        		echo 'General Actualizado';
        }           
    }
    
    if($tipo=='Contacto'){
        $nombre=strtoupper(utf8_decode($_POST['nombre']));
        $telefono=$_POST['telefono'];
        $extension=$_POST['extension'];
        $movil=$_POST['movil'];
        $correo=strtolower($_POST['correo']);
        $idcliente=$_POST['idcliente'];
        $idarea=$_POST['idarea'];
        $gestion->CreaUsuario($nombre, $telefono, $extension, $movil, $correo, $idcliente, $idarea);
        echo 'Contacto Creado';
    }
    
?>