<?php
	session_start();
    date_default_timezone_set('America/Bogota');
	require('../classes/Productos.php');
	
    $producto = new Producto();
    $accion=$_POST['accion'];
    
    if($accion=='tipo'){
        $idtipoproducto=$_POST['tipo'];
        $resultado=$producto->TipoProducto($idtipoproducto);
        echo json_encode($resultado);    
    }
     
    if($accion=='marca'){
        $idmarca=$_POST['marca'];
        $resultado=$producto->MarcaProducto($idmarca);
        echo json_encode($resultado);
    } 
    
    if($accion=='grupo'){
        $idgrupo=$_POST['grupo'];
        $resultado=$producto->GrupoProducto($idgrupo);
        echo json_encode($resultado);
    }
    
    if($accion=='busc'){
        $criterio=$_POST['criterio'];
        $resultado=$producto->BuscarProducto($criterio);
        echo json_encode($resultado);
    }
        
?>