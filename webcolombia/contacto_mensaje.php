<?php    
    
    $cabeceras  = 'MIME-Version: 1.0' . "\r\n";
    $cabeceras .= 'Content-type: text/html; charset=utf-8' . "\r\n";
    $cabeceras .= 'From: contacto@grupolibcom.com'. "\r\n";  
    $cabeceras .= 'Bcc: lfelipeqn@gmail.com';
        
	$correo=utf8_decode($_POST['correo']);
	$mensaje=utf8_decode($_POST['mensaje']);
	$nombre=utf8_decode($_POST['nombre']);
	$compania=utf8_decode($_POST['compania']);
	$telefono=utf8_decode($_POST['telefono']);
    $pais=utf8_decode($_POST['pais']);
	
	$mensajefinal="
		<!DOCTYPE html>
		<html lang=\"es\">
    		<head>
    			<meta http-equiv=\"content-type\" content=\"text/html; charset=ISO-8859-1\" />
    			<meta http-equiv=\"X-UA-Compatible\" content=\"IE=edge; chrome=1\" />
    		</head>
    		<body>
				<h2>Compa&ntilde;a: ".$compania."</h2>
                <h3>Mensaje de ".$nombre."</h3>
				<div><a href=\"mailto:".$correo."\">".$correo."</a></div>
				<div>".$telefono." - ".$pais."</div>
				<br />
				<p>".$mensaje."</p>
			</body>
		</html>";     
        
    mail('libcom@grupolibcom.com','Mensaje desde la Web de Libcom',$mensajefinal,$cabeceras);
    
    echo 'Mensaje Enviado Correctamente';
    
?>