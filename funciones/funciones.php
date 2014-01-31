<?php
function changelocation($location) {
	switch ($location) {
		case 'crm':
			include('crm/crm.php');
			break;
        case 'ncliente':
            include('crm/creacliente.php');
				break;
	    case 'editains':
		  		include('crm/editacliente.php');
				break;
        case 'clcliente':
            include('crm/consultarcliente.php');
			break;
        case 'report':
            include('crm/reportegestion.php');
				break;
		case 'eliminains':
		  	include('crm/eliminacliente.php');
			break;
	}
 }
 
function changelocation2($location) {
	switch ($location) {
		case 'inicio':
			include ('webcolombia/inicio_contenido.php'); 
			break;
		case 'contacto':
			include ('webcolombia/contacto_contenido.php'); 
			break;
        case 'nosotros':
            include ('webcolombia/nosotros_contenido.php'); 
			break;
        case 'eventos':
            include ('webcolombia/eventos_contenido.php'); 
			break;
        case 'adm-eventos':
            include ('webcolombia/eventos_galeria.php'); 
			break;
        case 'productos':
            include ('webcolombia/productos_menu.php'); 
			break;
	    case 'productos-dpto':
            include ('webcolombia/productos_contenido.php'); 
			break;
        case 'productos-ins':
            include ('webcolombia/productos_listado.php'); 
			break;
        case 'productos-brand':
            include ('webcolombia/productos_marcas.php'); 
			break;
        case 'present':
            include('webcolombia/present_contenido.php');
            break;
        case 'video':
            include('webcolombia/videos_contenido.php');
            break;
	}
 }
?>