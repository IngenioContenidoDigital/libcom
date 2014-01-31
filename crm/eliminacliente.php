<?php
	//session_start();
	error_reporting(E_ALL);
	include('classes/Clientes.php');	
    
   $cliente = new Cliente();
    
   $idcliente=$_GET['seguimiento'];
   
   $cliente->EliminaCliente($idcliente);
   
   $salida='Cliente Eliminado';
   echo '<div class="confirma-elimina">El Cliente Seleccionado ha sido Eliminado de forma Exitosa</div>';
?>