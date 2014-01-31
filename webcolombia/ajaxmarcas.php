<?php
	session_start();
    date_default_timezone_set('America/Bogota');
	require('../classes/Marcas.php');
	
    $marca = new Marca();
    $idmarca=$_POST['marca'];
            
    $resultado=$marca->getLogo($idmarca);
    echo $resultado;
    
?>