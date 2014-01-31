<?php
	session_start();
	require('../classes/Clientes.php');
	
    $cliente = new Cliente();
    
    $idcliente=$_POST['idcliente'];
    $digito=$_POST['digito'];
    $nombre=utf8_decode($_POST['nombre']);
    $direccion=$_POST['direccion'];
    $departamento=utf8_decode($_POST['departamento']);
    $nombreuso=utf8_decode($_POST['nombreuso']);
    $tipo=$_POST['tipo'];
    $salida="";
    
    if($tipo=='crear'){
    	//$factura=$_POST['factura'];    
    	//$plazo=$_POST['plazo'];
    	$cliente->CreaCliente($idcliente, $digito, $nombre, $direccion, $departamento, $nombreuso);
    	$salida='Cliente Creado';
    }
    
    if($tipo=='editar'){
		$cliente->ActCliente($idcliente, $digito, $nombre, $direccion, $departamento, $nombreuso);
    	$salida='Institucion Actualizada';
    }
    
    echo $salida;
	
?>