<?php	
	include 'classes/hosts.php';
	date_default_timezone_set('America/Bogota');	
	
	$usuario = $_SESSION['usuario'];	
   $perfil = $_SESSION['perfil'];
   $privilegio = $_SESSION['privilegio'];
   $institucion=$_GET['seguimiento'];

	$sqlclientes="SELECT clientes.IdCliente, clientes.Digito, clientes.Nombre, clientes.Direccion, clientes.Departamnto, clientes.NombreFactura, 
	clientes.NombreUso, clientes.TerminoPago 
	FROM clientes WHERE clientes.IdCliente='".$institucion."'";
	
	$cli = new Conectar();	
	$cli->Conecta($host,$user,$pass,$db);
	$clcli=$cli->Consulta($sqlclientes);
	$rscli=$cli->Resultado();		
	
?>
<div id="contenedor_crm">
<div>
	<table>
		<tr><td><h2 class="modulo">Edici�n de Instituciones</h2></td><td><img src="images/crm/editainst.png" alt="Edici�n de Instituciones" /></td></tr>
	</table>			
</div>
<div>
	<form accept-charset="utf-8" id="edicion" name="edicion">
	<table style="width:100%;">
		<tr>
			<td><label><b>NIT: </b></label></td>
			<td>
                <table>
                    <tr>
                        <td>
                        <?php
                        	echo '<input type="text" id="idcliente" name="idcliente" style="width:170px;" readonly="readonly" value="'.$rscli['IdCliente'].'"/>';
                        ?>
                        </td>
                        <td>DV</td>
                        <td>
                        <?php
                        	echo '<input type="text" id="digito" name="digito" style="width:15px;" readonly="readonly" value="'.$rscli['Digito'].'"/>';
                        ?>
                        </td>
                    </tr>
                </table>
            </td>
			<td><label><b>INSTITUCION: </b></label></td>
			<td>
			<?php
				echo '<input type="text" id="nombre" name="nombre" style="width:220px;" value="'.$rscli['Nombre'].'"/>';
			?>
			</td>
		</tr>
		<tr>
			<td><label><b>CIUDAD: </b></label></td>
			<td>
			<?php
				echo '<input type="text" id="nombreuso" name="nombreuso" style="width:220px;" value="'.$rscli['NombreUso'].'"/>';
			?>
			</td>
         <td><label><b>DEPARTAMENTO: </b></label></td>
			<td>
			<?php
				echo '<input type="text" id="departamento" name="departamento" style="width:220px;" value="'.$rscli['Departamnto'].'"/>';
			?>
			</td>
		</tr>			
		<tr>
			<td><label><b>DIRECCION: </b></label></td>
			<td colspan="3">
			<?php
				echo '<input type="text" id="direccion" name="direccion" style="width:725px;" value="'.$rscli['Direccion'].'"/>';
			?>
			</td>
		</tr>
	</table>
	<table width="95%">
		<tr><td colspan="2"><input type="image" src="images/crm/ok.png" id="send" style="float:right;" /></td></tr>
	</table>	
	</form>
</div>	
</div>
<script>

    $('#send').click(function(){
        var idcliente = $('#idcliente').val().toUpperCase()
        var digito = $('#digito').val().toUpperCase()
        var nombre = $('#nombre').val().toUpperCase()
        var direccion = $('#direccion').val().toUpperCase()
        var departamento = $('#departamento').val().toUpperCase()
        var nombreuso = $('#nombreuso').val().toUpperCase()
        var tipo = 'editar'
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
					if(response=='Institucion Actualizada'){
					   alert('La instituci&oacute;n ha sido actualizada de forma exitosa')
					   window.location='colombia.php?location=clcliente';
					}
				}	
        })
    		
 	})	
</script>