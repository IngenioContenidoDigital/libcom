<?php	
	include 'classes/hosts.php';
	date_default_timezone_set('America/Bogota');	
	
	 $usuario = $_SESSION['usuario'];	
    $perfil = $_SESSION['perfil'];
    $privilegio = $_SESSION['privilegio'];
    $cliente=$_GET['seguimiento'];

	$sqlclientes="SELECT contactos.IdContacto, contactos.NombreContacto, contactos.TelefonoContacto, contactos.ExtensionContacto, 
	contactos.MovilContacto, contactos.CorreoContacto, contactos.Observaciones, contactos.Responsable, clientes.IdCliente, 
	clientes.Digito, clientes.Nombre, clientes.NombreUso, areas.IdArea, areas.Area 
	FROM contactos 
	LEFT JOIN clientes ON contactos.IdCliente = clientes.IdCliente 
	INNER JOIN areas ON contactos.IdArea = areas.IdArea";

	if ($cliente!="XGN"){
		$sqlclientes.=" WHERE contactos.IdCliente = '".$cliente."'";
	}
	
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
<a href="colombia.php?location=clcliente"><img src="images/crm/back.png" /></a>
<div align="left">
	<table>
		<tr>
            <td><h3 class="modulo">Gestion de Contactos</h3></td><td><img src="images/crm/callcenter.png" alt="Listado de Contactos" /></td>
            <td>
                <table class="filtro">
                    <tr>
                        <td><p id="filtro_inst" class="filtro-crm"></p></td>
                        <td><p id="filtro_area" class="filtro-crm"></p></td>
                        <td><p id="filtro_cont" class="filtro-crm"></p></td>
                        <td><p id="filtro_ciu" class="filtro-crm"></p></td>
                    </tr>
                </table>
                <p id="filtro_gest"></p>
                <p id="filtro_edic"></p>
                <p id="filtro_crea"></p>
                <p id="filtro_no"></p>
                <p id="filtro_tel"></p>
            </td>
        </tr>
	</table>
	<?php
		if($cliente!='XGN'){
			echo '<div>Registrar Nuevo Contacto<input type="image" src="images/crm/plus.png" alt="Nuevo Contacto" />';
			echo '<input type="hidden" id="filtrocliente" value="'.$cliente.'"/>';
			echo '</div>';
			echo '<input type="hidden" id="origen" value="filtrado"/>';
		}else{
			echo '<input type="hidden" id="origen" value="general"/>';
		}
	?>
    <br />			
</div>
<div id="listadoclientes">
<table id="tbclientes">
    <thead>
        <tr>
            <th>Gestion</th>
            <th>Edicion</th>
            <th>Nombre Contacto</th>
            <th>Telefono Contacto</th>
            <th>Institucion</th>
            <th>Area</th>
            <th>Ciudad</th>
        </tr>
    </thead>
    <tfoot>
        <tr>
            <th>Gestion</th>
            <th>Edicion</th>   
            <th>Nombre Contacto</th>
            <th>Telefono Contacto</th>
            <th>Institucion</th>
            <th>Area</th>
            <th>Ciudad</th>
        </tr>
    </tfoot>
	<tbody>
		<?php
			while($rscli=$cli->Resultado()) {
				echo '<tr>';
				$datos = $rscli['IdContacto'].'|'.$rscli['NombreContacto'].'|'.$rscli['TelefonoContacto'].'|'.$rscli['ExtensionContacto'].'|'.$rscli['MovilContacto'].'|'.$rscli['CorreoContacto'].'|'.$rscli['Observaciones'].'|'.$rscli['IdCliente'].'|'.$rscli['Digito'].'|'.$rscli['Nombre'].'|'.$rscli['Area'].'|'.$rscli['Responsable'].'|'.$rscli['IdArea'].'|'.$rscli['NombreUso'];
				
				/*$sqlcall="SELECT cod_efectividad.Efectividad FROM cod INNER JOIN cod_efectividad ON cod.IdEfectividad = cod_efectividad.IdEfectividad WHERE cod.order_nr = '".$rscod['OrdenNumero']."'";
				$call=new Conectar();	
				$call->Conecta($host,$user,$pass,$db);
				$clcall=$call->Consulta($sqlcall);
				$fcall=$call->Filas();
				if($fcall>0){
					$rscall=$call->Resultado();
					$efect=$rscall['Efectividad'];	
				}else{
					$efect="";		
				}
				$call->Cerrar();*/
				
				echo '<td><input type="image" src="images/crm/call.gif" value="'.$datos.'" alt="Registrar Llamada"></td>';	
                                echo '<td><input type="image" src="images/crm/editar.png" value="'.$datos.'" alt="Actualiza Contacto"></td>';
				echo '<td>'.$rscli['NombreContacto'].'</td>';
				echo '<td>'.$rscli['TelefonoContacto'].'</td>';
				echo '<td>'.$rscli['Nombre'].'</td>';		
				echo '<td>'.$rscli['Area'].'</td>';
				echo '<td>'.$rscli['NombreUso'].'</td>';
				echo '</tr>';
			}
		?>
	</tbody>
</table>
</div>
<div id="gestion" name="gestion" title="CRM Libcom">
<div>
	<form method="post" action="" id="form_cod" name="form_cod">
    <h3 id="accion">Informaci&oacute;n del Contacto</h3>
	<hr />
	<br />
	<table style="width:100%;">
		<tr>
			<td><label><b>No. Contacto: </b></label></td>
			<td><input type="text" id="idcontactocliente" name="idcontactocliente" readonly="readonly" style="width:220px;" /></td>
			<td><label><b>Nombre Contacto: </b></label></td>
			<td><input type="text" id="contacto" name="contacto" readonly="readonly" style="width:220px;" /></td>
		</tr>
		<tr>
			<td><label><b>Telefono: </b></label></td>
			<td><input type="text" id="telefono" name="telefono" readonly="readonly" style="width:220px;" /></td>
			<td><label><b>Extension: </b></label></td>
			<td><input type="text" id="extension" name="extension" readonly="readonly" style="width:220px;" /></td>
		</tr>
		<tr>
			<td><label><b>Movil: </b></label></td>
			<td><input type="text" id="movil" name="movil" readonly="readonly" style="width:220px;" /></td>
			<td><label><b>Correo: </b></label></td>
			<td><input type="text" id="correo" name="correo" readonly="readonly" style="width:220px;" /></td>
		</tr>			
		<tr>
			<td><label><b>Institucion: </b></label></td>
			<td>
                <select id="idcliente" name="idcliente" style="width: 225px;">
					<option value="">--- Elija un Cliente ---</option> 
			<?php
				$sqlcl="SELECT clientes.IdCliente, clientes.Nombre FROM clientes";
				$cl= new Conectar();
    			$cl->Conecta($host,$user,$pass,$db);
    			
    			$cl->Consulta($sqlcl);

				while($rscl = $cl->Resultado()){ 
					echo '<option value="'.$rscl['IdCliente'].'">'.$rscl['Nombre'].'</option>';
				}				
			?>
				</select>
            </td>
			<td><label><b>Area: </b></label></td>
			<td>
				<select id="area" name="area" style="width: 225px;">
					<option value="">--- Elija un Area ---</option> 
			<?php
				$sqlareas="SELECT areas.IdArea, areas.Area FROM areas";
				$ar= new Conectar();
    			$ar->Conecta($host,$user,$pass,$db);
    			
    			$ar->Consulta($sqlareas);

				while($rsar = $ar->Resultado()){ 
					echo '<option value="'.$rsar['IdArea'].'">'.$rsar['Area'].'</option>';
				}				
			?>
				</select>
			</td>
		</tr>
    </table>
    <div id="tipificacion">
	<h3>Gesti&oacute;n de Contacto</h3>
	<hr />
	<br />
	<div align="center">
    <table>
        <tr>
            <td colspan="2"><div class="descipcion">Este modulo le permite programar la agenda de gestion y generar un reporte a su e-mail</div></td>
            <td colspan="2"><div class="descipcion">Este modulo le permite compartir un resumen de la gestion realizada con otros contactos</div></td>
        </tr>
        <tr>
            <td><label><b>Contacto: </b></label></td>
            <td>
                <select id="scontact" name="scontact" style="width:250px">
                        <option value="">--- Tipo de Contacto ---</option>
                    <?php
                           $cont=new Conectar();
                           $cont->Conecta($host,$user,$pass,$db);
                           $sqlcont="SELECT con_contacto.IdContacto, con_contacto.Contacto FROM con_contacto 
                               INNER JOIN perfiles_contacto ON perfiles_contacto.IdContacto = con_contacto.IdContacto 
                               WHERE perfiles_contacto.IdPerfil =".$perfil;

                           $cont->Consulta($sqlcont);
                           while($rscont=$cont->Resultado()){
                               echo'<option value="'.$rscont['IdContacto'].'">'.$rscont['Contacto'].'</option>';
                           }
                    ?>
                </select>
            </td>
            <td><label><b>Correo: </b></label></td>
            <td><input type="text" id="destino" class="campocorreo" /></td>
        </tr>
        <tr>
            <td><label><b>Efectividad: </b></label></td>
			<td>
				<select id="sefect" name="sfect" style="width:250px">
					<option value="">--- Elija Efectividad ---</option>
				</select>
			</td>
            <td><label><b>Copia: </b></label></td>
            <td><input type="text" id="copia" class="campocorreo" /></td>
        </tr>
        <tr>
            <td><label><b>Fecha Agenda: </b></label></td>			
			<td>
                <input type="text" id="fagenda" class="tcal" />
			</td>
            <td><b>Asunto:&nbsp;</b></td>
            <td><input type="text" id="asunto" class="campocorreo"/></td>
        </tr>
        <tr>
            <td colspan="2"><textarea id="observ" name="observ" cols="35" rows="3"></textarea></td>
            <td colspan="2"><textarea id="mensaje-contenido"></textarea></td>
        </tr>
        </table>
	</div>
    </div>
    <div align="center">
    <table>
        <tr>
            <td colspan="2" style="width: 350px;">
                <table>
                    <tr>
                        <td>
                            <img src="images/crm/ok.png" id="send" name="send" style="float:right;" />
                            <img src="images/crm/ok.png" id="send2" name="send2" style="float:right;" />
                            <img src="images/crm/ok.png" id="send3" name="send3" style="float:right;" />
                        </td>
                        <td>
                            <label style="font-size: 12pt; font-weight: bold;">Enviar</label>
                        </td>
                    </tr>
                </table>
            </td>
            <td colspan="2" style="width: 350px;">
                <div id="enviarcorreo">
                    <table>
                        <tr>
                            <td><input type="checkbox" id="correocontacto"/><label style="font-weight:bold">Compartir con direcciones de correo al ENVIAR</label></td>
                        </tr>
                    </table>
                </div>
            </td>
        </tr>
    </table>
    </div>
    <div id="detresultado" name="detresultado" align="center"></div>
	<div id="historico" name="historico">	
	<br />
	<h3>Historico de Contactos</h3>
	<hr />
	<br />
	<div id="dethistorico" name="dethistorico" align="center"></div>
	</div>
	<br />
	<br />
	
</form>
</div>	
</div>

</div>
<script>

	$("#fagenda").datepicker('disable');

	$(document).ready(function(){
		$('#gestion').hide();
		$('#historico').hide();
		$("#dethistorico").html("");
		$('#tipificacion').hide();
        $('#enviarcorreo').hide();
        $("#correocontacto").removeAttr("checked");
        $('#send').hide();
        $('#send2').hide();
        $('#send3').hide();
	});

	$('input:image').bind('click',function(){
			$('#historico').hide();
            $('#enviarcorreo').hide();
            $("#correocontacto").removeAttr("checked");
			$("#dethistorico").html("");
            
            $('#destino').val("");
            $('#copia').val("");
            $('#asunto').val("");
            $('#mensaje-contenido').val("");
            			
			var tipo = $(this).attr('alt');
            
            if(tipo=='Nuevo Contacto'){
                $("#gestion").dialog({
                    modal: true,
                    width: 1000,
                    show: {
                        effect: "blind",
                        duration: 1000
                    },
                    hide: {
                        effect: "explode",
                        duration: 1000
                    }
                });
                
                var idcliente=$('#filtrocliente').val();
                
                
                $('#idcontactocliente').val("");
                $('#contacto').val("");
				$('#telefono').val("");
				$('#extension').val("");
				$('#movil').val("");
				$('#correo').val("");
				$('#idcliente').val(idcliente);
                $('#area').val("");
                
                
                $('#historico').hide();
				$("#dethistorico").html("");
				$("#dethistorico").hide();
				$('#tipificacion').hide();
                
                $('#idcliente:not(:selected)').attr('disabled', true);
                $('#area:not(:selected)').attr('disabled', false);
                
				$('#contacto').prop('readonly',false);
				$('#telefono').prop('readonly',false);
				$('#extension').prop('readonly',false);
				$('#movil').prop('readonly',false);
				$('#correo').prop('readonly',false);
				$('#idcliente').prop('readonly',false);
                //$('#area').prop('readonly',false);
                
                $('#accion').html("Registro de Nuevo Contacto")
                
                $('#send').hide();
                $('#send2').hide();
                $('#send3').show(); 
			}else{
			 
                var valor = $(this).val();
                var arreglo = $(this).val().split('|');
                var idcontactocliente=arreglo[0];
                var contacto=arreglo[1];
                var telefono=arreglo[2];
                var extension=arreglo[3];
                var movil=arreglo[4];
                var correo=arreglo[5];
                var idcliente=arreglo[7];
                var area=arreglo[10];
                var idarea=arreglo[12];
                
                
                $('#idcontactocliente').val(idcontactocliente);
                $('#contacto').val(contacto);
                $('#telefono').val(telefono);
                $('#extension').val(extension);
                $('#movil').val(movil);
                $('#correo').val(correo);
                $('#idcliente').val(idcliente);
                $('#area').val(idarea);
                
                $('#idcliente:not(:selected)').attr('disabled', true);
                $('#area:not(:selected)').attr('disabled', true);
                
                $('#idcontactocliente').prop('readonly',true);
                $('#contacto').prop('readonly',true);
                $('#telefono').prop('readonly',true);
                $('#extension').prop('readonly',true);
                $('#movil').prop('readonly',true);
                $('#correo').prop('readonly',true);
                $('#idcliente').prop('readonly',true);
                			
			
            }
			
			if(tipo=='Registrar Llamada'){
			        $('#enviarcorreo').show(); 
					$('#area:not(:selected)').attr('disabled', true);
                    $('#idcliente:not(:selected)').attr('disabled', true);
					$('#accion').html("Informacion del Contacto")
                    $('#scontact').val("");
                    $('#sefect').val("");
                    $('#observ').val("");
                    $('#fagenda').val("");
                    $('#asignacion').hide();		  			
  					$("#gestion").dialog({
						modal: true,
						width: 1000,
						show: {
							effect: "blind",
							duration: 1000
						},
						hide: {
							effect: "explode",
							duration: 1000
						}
					}); 
                
					tipo='Historia';
					$.ajax({
						type: "post",
						url: "crm/ajaxgestion.php",
						data: {
							'idcontactocliente':idcontactocliente,
							'tipo':tipo,
						},
						success: function (response){
							var json = $.parseJSON(response);
							var table='<table id="thist" name="thist" class="ordenes" ><thead><tr><th>Fecha Gestion</th><th>Contacto</th><th>Efectividad</th><th>Agenda</th><th>Observacion</th><th>Usuario</th</tr></thead><tbody>';
							var i=0;
							$.each(json,function(){
								table+='<tr><td>'+this.Fecha+'</td><td>'+this.Contacto+'</td><td>'+this.Efectividad+'</td><td>'+this.Agenda+'</td><td>'+this.Observacion+'</td><td>'+this.Usuario+'</td></tr>';
								i+=1;
							})
							table+='</tbody></table>';
							if(i>0){
								$('#historico').show();
								$("#dethistorico").html(table);
								$("#dethistorico").show();
							}
						}
					})
					
					$("#tipificacion").show(); 
					$('#send').show();
                    $('#send2').hide();
                    $('#send3').hide();
					                               
    		}
            
            if(tipo=='Actualiza Contacto'){
				$('#enviarcorreo').hide();
                $("#correocontacto").removeAttr("checked");
            
                $('#asignacion').show();
                
				$('#idcontactocliente').prop('readonly',true);
				$('#contacto').prop('readonly',false);
				$('#telefono').prop('readonly',false);
				$('#extension').prop('readonly',false);
				$('#movil').prop('readonly',false);
				$('#correo').prop('readonly',false);
				$('#idcliente').prop('readonly',false);
				
				$('#historico').hide();
				$("#dethistorico").html("");
				$("#dethistorico").hide();
				$('#tipificacion').hide();
				
				$('#idcliente:not(:selected)').attr('disabled', true);
                $('#area:not(:selected)').attr('disabled', false);				
				$('#accion').html("Actualizar Informacion del Contacto")
				$("#gestion").dialog({
					modal: true,
					width: 1000,
					show: {
						effect: "blind",
						duration: 1000
					},
					hide: {
						effect: "explode",
						duration: 1000
					}
				});
				
				$('#send').hide();
                $('#send2').show();
                $('#send3').hide();								
					    			
    		}
			      
 	})	
	
	$('#tbclientes').dataTable({
		"oLanguage": {
			"sLengthMenu": "Mostrar _MENU_ registros",
			"sZeroRecords": "No se han encontrado registros",
			"sInfo": "Mostrando _START_ a _END_ de _TOTAL_ registros",
			"sInfoEmpty": "mostrando 0 a 0 de 0 registros",
			"sInfoFiltered": "(Filtrado de _MAX_ registros totales)",
			"sSearch": "Filtrar: ",
			'oPaginate': {
        			'sFirst':    "Primero",
        			'sPrevious': "Anterior",
        			'sNext':     "Siguiente",
        			'sLast':     "Ultimo"
    		},
    		"bAutoWidth": false
		}
	}).columnFilter({
	       aoColumns:[
                { sSelector: "#filtro_gest", type:"null"},
                { sSelector: "#filtro_edic", type:"null"},
                { sSelector: "#filtro_cont", type:"select", sSortDataType: "dom-text"},
                { sSelector: "#filtro_tel", type:"null"},
				{ sSelector: "#filtro_inst", type:"select", sSortDataType: "dom-text"},
                { sSelector: "#filtro_area", type:"select", sSortDataType: "dom-text"},
				{ sSelector: "#filtro_ciu", type:"select", sSortDataType: "dom-text"}
        ]}
    );
    
    $('#scontact').change(function(){
		var op= $(this).val();
		$('#fagenda').val("");
		//$('#horario').val("");
		$('#sefect').children().remove();
		$('#sefect').append('<option value="">--- Elija Efectividad ---</option>');
			$.ajax({
				type: "GET",
				url: "tipificacion.xml",
				dataType: "xml",
				success: function(xml) {
				$(xml).find('contacto').each(function(){									
					var idc = $(this).attr('id');									
					if(idc==op){						
						$(this).find('efectividad').each(function(){
							$('#sefect').append('<option value="'+$(this).attr('id')+'">'+$(this).attr('nombre')+'</option>');
						})															
					}	
				})
				}
			})
	})
    
    $('#send').click(function(){
        var idcontactocliente=$('#idcontactocliente').val();
        var contacto=$('#scontact').val();
        var efectividad=$('#sefect').val();
        var agenda=$('#fagenda').val();
        var observ=$('#observ').val();
        var destino=$('#destino').val();
        var copia=$('#copia').val();
        var correo=$('#correo').val();
        var asunto=$('#asunto').val();
        var mensaje=$('#mensaje-contenido').val();
        var tipo='Nuevo';
        if(($('#correocontacto').is(":checked")==true) && ((asunto=="")||(destino==""))){
            alert('El Asunto del Correo y Destinatario son Obligatorios')
        }else{
            $.ajax({
                type:"post",
                url:"crm/ajaxgestion.php",
                data:{
                    "idcontactocliente":idcontactocliente,
                    "tipo":tipo,
                    "idcontacto":contacto,
                    "idefectividad":efectividad,
                    "agenda":agenda,
                    "observaciones":observ,
                    "destino":destino,
                    "copia":copia,
                    "correo":correo,
                    "asunto":asunto,
                    "mensaje":mensaje,
                    "enviacontacto":$('#correocontacto').is(":checked")  
                },
                success:function(response){
                    if(response=='Gestion Registrada'){
                        alert('Se ha registrado la Gesti�n Realizada.')
                        $( "#gestion" ).dialog("close");
                    }
                }
            })
            $('#correocontacto').removeAttr("checked");
        }   
    })
    
    $('#send2').click(function(){
        var idcontactocliente=$('#idcontactocliente').val();
        var nombre=$('#contacto').val();
        var telefono=$('#telefono').val();
        var extension=$('#extension').val();
        var movil=$('#movil').val();
        var correo=$('#correo').val();
        var idcliente=$('#idcliente').val();
        var idarea=$('#area').val();
        var tipo='Actualiza';
        var origen=$('#origen').val();
        $.ajax({
            type:"post",
            url:"crm/ajaxgestion.php",
            data:{
              "idcontactocliente":idcontactocliente,
              "tipo":tipo,
              "nombre":nombre,
              "telefono":telefono,
              "extension":extension,
              "movil":movil,
              "correo":correo,
              "idcliente":idcliente,
              "idarea":idarea,
              "origen":origen
            },
            success:function(response){
                if(response=='Contacto Actualizado'){
                    alert('Se ha actualizado la informacion del cliente.')
                    $( "#gestion" ).dialog("close");
                    window.location='colombia.php?location=crm&seguimiento='+idcliente;
                }
                if(response=='General Actualizado'){
                    alert('Se ha actualizado la informacion del cliente.')
                    $( "#gestion" ).dialog("close");
                    window.location='colombia.php?location=crm&seguimiento=XGN';
                }
            }
        })
    })
    
    $('#send3').click(function(){
        var nombre=$('#contacto').val().toUpperCase();
        var telefono=$('#telefono').val();
        var extension=$('#extension').val();
        var movil=$('#movil').val();
        var correo=$('#correo').val().toLowerCase();
        var idcliente=$('#idcliente').val();
        var idarea=$('#area').val();
        var tipo='Contacto';
        $.ajax({
            type:"post",
            url:"crm/ajaxgestion.php",
            data:{
              "tipo":tipo,
              "nombre":nombre,
              "telefono":telefono,
              "extension":extension,
              "movil":movil,
              "correo":correo,
              "idcliente":idcliente,
              "idarea":idarea
            },
            success:function(response){
                if(response=='Contacto Creado'){
                    alert('Se ha creado el contacto')
                    $( "#gestion" ).dialog("close");
                    window.location='colombia.php?location=clcliente';
                }
            }
        })
    })
    		
</script>