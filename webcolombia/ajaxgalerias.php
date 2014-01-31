<?php
    session_start();
    date_default_timezone_set('America/Bogota');
    require('/classes/Galerias.php');
	
    $galeria = new Galeria();
    $accion=$_POST['accion'];
    
    if($accion=='tubnail'){
        $resultado=$galeria->Tubnails();
        echo json_encode($resultado);    
    } 
    
    /*if($accion=='vergaleria'){
        $idgaleria=$_POST['idgaleria'];
        $resultado=$galeria->Imagenes($idgaleria);
        echo json_encode($resultado);
    }*/
?>