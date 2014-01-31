<?php	
	include 'classes/hosts.php';
	date_default_timezone_set('America/Bogota');	
	
	$usuario = $_SESSION['usuario'];	
   $perfil = $_SESSION['perfil'];
   $privilegio = $_SESSION['privilegio'];

	$sqlclientes="SELECT clientes.IdCliente, clientes.Digito, clientes.Nombre, clientes.Direccion, clientes.Departamnto, clientes.NombreFactura, 
	clientes.NombreUso, clientes.TerminoPago 
	FROM clientes";
	
	$cli = new Conectar();	
	$cli->Conecta($host,$user,$pass,$db);
	$clcli=$cli->Consulta($sqlclientes);	
	
	$xml = new DomDocument("1.0");
	$raiz=$xml->createElement("tipificacion");


    $tip= new Conectar();
    $tip->Conecta($host,$user,$pass,$db);
	
    $sql="SELECT con_contacto.IdContacto, con_contacto.Contacto 
    FROM con_contacto 
    INNER JOIN perfiles_contacto ON perfiles_contacto.IdContacto = con_contacto.IdContacto 
    WHERE perfiles_contacto.IdPerfil =".$perfil;
    
	$tip->Consulta($sql);

	while($rstip = $tip->Resultado()){ 
			$contacto=$xml->createElement("contacto");
			$idcontact=$contacto->setAttribute("id",$rstip['IdContacto']);
			$ncontact=$contacto->setAttribute("nombre",utf8_encode($rstip['Contacto']));
			
			$efec=new Conectar();
			$efec->Conecta($host,$user,$pass,$db);
			$sqlefec="SELECT con_efectividad.IdEfectividad, con_efectividad.Efectividad FROM con_efectividad INNER JOIN perfiles_efectividad ON con_efectividad.IdEfectividad = perfiles_efectividad.IdEfectividad 
            WHERE perfiles_efectividad.IdPerfil = ".$perfil." AND con_efectividad.fk_IdContacto = ".$rstip['IdContacto'];
			$efec->Consulta($sqlefec);
			while($rsefec=$efec->Resultado()){
				$efectividad=$xml->createElement("efectividad");
				$idefec=$efectividad->setAttribute("id",$rsefec['IdEfectividad']);
				$nefec=$efectividad->setAttribute("nombre",utf8_encode($rsefec['Efectividad']));				
				$contacto->appendChild($efectividad);
			}
			$raiz->appendChild($contacto);
	}
	$xml->appendChild($raiz);
	$xml->save("tipificacion.xml");	
	
?>
<div>			
<table>
    <tr><td><h2 class="modulo">Registro Instituciones</h2></td><td><img src="images/crm/hospital.png" alt="Registro de Clientes" /></td></tr>
	<tr>
		<td><label><b>NIT: </b></label></td>
		<td>
            <table>
                <tr>
                    <td><input type="text" id="idcliente" name="idcliente" style="width:175px;" /></td>
                    <td>DV</td>
                    <td><input type="text" id="digito" name="digito" style="width:15px;" /></td>
                </tr>
            </table>
        </td>
		<td><label><b>INSTITUCION: </b></label></td>
		<td><input type="text" id="nombre" name="nombre" style="width:220px;" /></td>
	</tr>
	<tr>
		<td><label><b>CIUDAD: </b></label></td>
		<td><input type="text" id="nombreuso" name="nombreuso" style="width:220px;" /></td>
        <td><label><b>DEPARTAMENTO: </b></label></td>
		<td><input type="text" id="departamento" name="departamento" style="width:220px;" /></td>
	</tr>			
	<tr>
		<td><label><b>DIRECCION: </b></label></td>
		<td colspan="3">
			<input type="text" id="direccion" name="direccion" style="width:580px;" />
		</td>
	</tr>
</table>
<table width="95%">
	<tr><td colspan="2"><input type="image" src="images/crm/ok.png" id="send" style="float:right;" /></td></tr>
</table>
</div>
<script>
    $('#send').click(function(){
        var idcliente = $('#idcliente').val().toUpperCase()
        var digito = $('#digito').val().toUpperCase()
        var nombre = $('#nombre').val().toUpperCase()
        var direccion = $('#direccion').val().toUpperCase()
        var departamento = $('#departamento').val().toUpperCase()
        var nombreuso = $('#nombreuso').val().toUpperCase()
        var tipo = 'crear'
        $.ajax({
				type:"post",
				url: "crm/ajaxcliente.php",
				data:{
					"idcliente":idcliente,
					"digito":digito,
					"nombre":nombre,
					"direccion":direccion,
					"departamento":departamento,
					"nombreuso":nombreuso,
					"tipo":tipo					
				},
				success: function(response){
					if(response=='Cliente Creado'){
					   alert('El Cliente ha sido Creado')
					   window.location='colombia.php?location=ncliente';
					}
				}	
        })
    		
 	})	
</script>