<?php
include ('../classes/Galerias.php');
// A list of permitted file extensions

$objgaleria = new Galeria();

$allowed = array('png', 'jpg', 'gif');
$galeria=strtolower($_POST['nombre']);
$flag=0;
if (!file_exists('eventos/'.$galeria)) {
    mkdir("eventos/".$galeria, 0777);
    $objgaleria->CreaGaleria($galeria);
    $idgaleria=$objgaleria->getIdGaleria();
}

if(isset($_FILES['upl'])){
	$extension = pathinfo($_FILES['upl']['name'], PATHINFO_EXTENSION);
	if(!in_array(strtolower($extension), $allowed) && $extension!=null){
		echo 'El Archivo seleccionado no es un archivo de Imagen';
		exit;
	}else{
            move_uploaded_file($_FILES['upl']['tmp_name'], 'eventos/'.$galeria.'/'.$_FILES['upl']['name']);
            $objgaleria->ImagenesGaleria('eventos/'.$galeria.'/'.$_FILES['upl']['name'], $idgaleria);
            $flag=1;
        }
}else{
    echo 'No hay Archivos seleccionados para Cargar';
    exit;
}
if($flag==1){
    echo 'La carga se ha realizado de forma exitosa';
    exit;
}