<?php	
	include 'classes/hosts.php';
	date_default_timezone_set('America/Bogota');	
	
	$usuario = $_SESSION['usuario'];	

	$sqlcod="SELECT SO.id_sales_order AS IdOrden, SO.order_nr AS OrdenNumero, SO.created_at as FechaCreacion, 
	DATEDIFF(NOW(),SO.created_at) AS DuracionDias, DI.first_name AS Nombres, DI.last_name AS Apellidos, 
	SO.customer_email AS Email, DI.address1 AS Direccion, DI.address2 AS ComplementoDir, DI.additional_info AS Barrio, 
	DI.city AS Ciudad, DI.phone AS Telefono1, DI.phone2 AS Telefono2, SO.payment_method AS MedioPago, 
	GROUP_CONCAT(SOI.sku) AS SkuSimples, GROUP_CONCAT(SOIS.name) AS EstadosSKU, GROUP_CONCAT(WMSE.name) AS EstadosWMS, 
	CAST(SUM(SOI.paid_price) AS DECIMAL) AS NetSales FROM `bob_live_colombia`.`sales_order` SO 
	INNER JOIN bob_live_colombia.sales_order_item SOI ON SO.id_sales_order=SOI.fk_sales_order 
	LEFT JOIN bob_live_colombia.sales_order_item_status SOIS ON SOIS.id_sales_order_item_status=SOI.fk_sales_order_item_status 
	INNER JOIN `bob_live_colombia`.`sales_order_address` DI ON DI.id_sales_order_address=SO.fk_sales_order_address_billing 
	LEFT JOIN `bob_live_colombia`.`sales_order_shipment` WMS ON WMS.fk_sales_order = SO.id_sales_order 
	LEFT JOIN bob_live_colombia.sales_order_shipment_status WMSE ON WMSE.id_sales_order_shipment_status = WMS.fk_sales_order_shipment_status 
	WHERE (SO.payment_method = 'CashOnDeliveryPayment' OR SO.payment_method ='CashOnDeliverySodexoPayment') AND CAST(SO.created_at AS DATE) >= CAST(ADDDATE(NOW(), INTERVAL -35 DAY) AS DATE) 
	GROUP BY SO.id_sales_order";
	
	$cod = new Conectar();	
	$cod->Conecta($host_daf,$user_daf,$pass_daf,$db_daf);
	$clcod=$cod->Consulta($sqlcod);
	
	
	$tip= new Conectar();
	$tip->Conecta($host,$user,$pass,$db);
	
	$xml = new DomDocument("1.0");
	$raiz=$xml->createElement("tipificacion");

	$sql="SELECT cod_contacto.IdContacto, cod_contacto.Contacto FROM cod_contacto";
	$tip->Consulta($sql);

	while($rstip = $tip->Resultado()){ 
			$contacto=$xml->createElement("contacto");
			$idcontact=$contacto->setAttribute("id",$rstip['IdContacto']);
			$ncontact=$contacto->setAttribute("nombre",utf8_encode($rstip['Contacto']));
			
			$efec=new Conectar();
			$efec->Conecta($host,$user,$pass,$db);
			$sqlefec="SELECT cod_efectividad.IdEfectividad, cod_efectividad.Efectividad FROM cod_efectividad WHERE cod_efectividad.fk_IdContacto = ".$rstip['IdContacto'];
			$efec->Consulta($sqlefec);
			while($rsefec=$efec->Resultado()){
				$efectividad=$xml->createElement("efectividad");
				$idefec=$efectividad->setAttribute("id",$rsefec['IdEfectividad']);
				$nefec=$efectividad->setAttribute("nombre",utf8_encode($rsefec['Efectividad']));
				
				$deta=new Conectar();
				$deta->Conecta($host,$user,$pass,$db);
				$sqldet="SELECT cod_detalle.IdDetalle, cod_detalle.Detalle FROM cod_detalle WHERE cod_detalle.fk_IdEfectividad =".$rsefec['IdEfectividad'];
				$deta->Consulta($sqldet);
				while($rsdeta=$deta->Resultado()) {
					$detalle=$xml->createElement("detalle");
					$iddeta=$detalle->setAttribute("id",$rsdeta['IdDetalle']);
					$ndeta=$detalle->setAttribute("nombre",utf8_encode($rsdeta['Detalle']));
					$efectividad->appendChild($detalle);
				}				
				$contacto->appendChild($efectividad);
			}
			$raiz->appendChild($contacto);
	}
	$xml->appendChild($raiz);
	$xml->save("tipificacionCOD.xml");	
	
	
	
?>

<div align="left">
	<table>
		<tr><td><h2 class="modulo">Pago contra Entrega</h2></td><td><img src="images/cash.png" alt="Cash on Delivery" ></td></tr>
	</table>			
</div>
<div id="ordenescod" name="ordenescod">
<table style="font-size:13px" id="tcod" name="tcod">
	<thead>
		<tr>
			<th>Opciones</th>
			<th>OrdenNumero</th>
			<th>FechaCreacion</th>
			<th>Dias</th>
			<th>Ciudad</th>
			<th>Estado CallCenter</th>
			<th>sku simples</th>
			<th>Estados SKU</th>
			<th>Estados WMS</th>
			<th>Total</th>
		</tr>
	</thead>
	<tbody>
		<?php
			while($rscod=$cod->Resultado()) {
				echo '<tr>';
				$datos = $rscod['OrdenNumero'].'|'.$rscod['FechaCreacion'].'|'.$rscod['NetSales'].'|'.$rscod['Nombres'].' '.$rscod['Apellidos'].'|'.$rscod['Email'].'|'.$rscod['Telefono1'].'|'.$rscod['Telefono2'].'|'.$rscod['DuracionDias'].'|'.$rscod['Direccion'].'|'.$rscod['ComplementoDir'].'|'.$rscod['Ciudad'];
				
				$sqlcall="SELECT cod_efectividad.Efectividad FROM cod INNER JOIN cod_efectividad ON cod.IdEfectividad = cod_efectividad.IdEfectividad WHERE cod.order_nr = '".$rscod['OrdenNumero']."'";
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
				$call->Cerrar();
				
				echo '<td><input type="image" src="images/call.gif" value="'.$datos.'" alt="Registrar Llamada"></td>';				
				echo '<td>'.$rscod['OrdenNumero'].'</td>';
				echo '<td>'.$rscod['FechaCreacion'].'</td>';
				echo '<td>'.$rscod['DuracionDias'].'</td>';
				echo '<td>'.$rscod['Ciudad'].'</td>';
				echo '<td>'.$efect.'</td>';		
				echo '<td>'.$rscod['SkuSimples'].'</td>';
				echo '<td>'.$rscod['EstadosSKU'].'</td>';
				echo '<td>'.$rscod['EstadosWMS'].'</td>';
				echo '<td>'.$rscod['NetSales'].'</td>';
				echo '</tr>';
			}
		?>
	</tbody>
</table>
</div>
<div id="gestion" name="gestion" style="background:white; border-radius:15px;">
<div style="padding: 25px;">
	<form method="post" action="" id="form_cod" name="form_cod">
	<h3>Informaci&oacute;n de la Orden</h3>
	<hr>
	<br>
	<table style="width:100%;">
		<tr>
			<td><label><b>No. Orden: </b></label></td>
			<td><input type="text" id="norden" name="norden" READONLY style="width:220px;"></td>
			<td><label><b>Fecha Orden: </b></label></td>
			<td><input type="text" id="forden" name="forden" READONLY style="width:220px;"></td>
		</tr>
		<tr>
			<td><label><b>Total Dias: </b></label></td>
			<td><input type="text" id="dias" name="dias" READONLY style="width:220px;"></td>
			<td><label><b>Valor Orden: </b></label></td>
			<td><input type="text" id="vorden" name="vorden" READONLY style="width:220px;"></td>
		</tr>
		<tr>
			<td><label><b>Nombre Cliente: </b></label></td>
			<td><input type="text" id="ncliente" name="ncliente" READONLY style="width:220px;"></td>
			<td><label><b>Email Cliente: </b></label></td>
			<td><input type="text" id="ecliente" name="ecliente" READONLY style="width:220px;"></td>
		</tr>
		<tr>
			<td><label><b>Telefono 1: </b></label></td>
			<td><input type="text" id="tel1" name="tel1" READONLY style="width:220px;"></td>
			<td><label><b>Telefono 2: </b></label></td>
			<td><input type="text" id="tel2" name="tel2" READONLY style="width:220px;"></td>
		</tr>			
		<tr>
			<td><label><b>Direccion: </b></label></td>
			<td>
				<input type="text" id="dir" name="dir" style="width:220px;">
				<input type="hidden" id="ncity" name="ncity">
			</td>
			<td><label><b>Complemento Dir: </b></label></td>
			<td><input type="text" id="comdir" name="comdir" style="width:220px;"></td>
		</tr>
	</table>
	<br>
	<div id="detresultado" name="detresultado" align="center"></div>
	<div id="historico" name="historico">	
	<br>
	<h3>Historico de Marcaciones</h3>
	<hr>
	<br>
	<div id="dethistorico" name="dethistorico" align="center"></div>
	</div>
	<br>
	<h3>Gesti&oacute;n de Llamada</h3>
	<hr>
	<br>
	<div align="center">
	<table>
		<tr>
			<td><label><b>Contacto: </b></label></td>
			<td>
				<select id="scontact" name="scontact" style="width:250px">
					<option value="">--- Tipo de Contacto ---</option>
				<?php
					$cont=new Conectar();
					$cont->Conecta($host,$user,$pass,$db);
					$sqlcont="SELECT cod_contacto.IdContacto, cod_contacto.Contacto FROM cod_contacto";
					$cont->Consulta($sqlcont);
					while($rscont=$cont->Resultado()){
						echo'<option value="'.$rscont['IdContacto'].'">'.$rscont['Contacto'].'</option>';
					}
				?>
				</select>
			</td>
			<td rowspan="3">
				<textarea id="observ" name="observ" cols="35" rows="3"></textarea>
			</td>
		</tr>
		<tr>
			<td><label><b>Efectividad: </b></label></td>
			<td>
				<select id="sefect" name="sfect" style="width:250px">
					<option value="">--- Elija Efectividad ---</option>
				</select>
			</td>
		</tr>
		<tr>
			<td><label><b>Detalle: </b></label></td>
			<td>
				<select id="sdet" name="sdet" style="width:250px">
					<option value="">--- Elija Detalle ---</option>
				</select>
			</td>
		</tr>
		<tr id="fagenda" name="fagenda">
			<td><label><b>Fecha Agenda: </b></label></td>			
			<td>
				<select id="fagenda" name="fagenda" style="width:250px">
					<option value="">--- Elija una Fecha ---</option>
					<?php
						$fecha = date('Y-m-d');
						$nfecha = strtotime('+1 day', strtotime ( $fecha ));
						$nfecha = date ('Y-m-d',$nfecha);
						echo '<option value="'.$nfecha.'">'.$nfecha.'</option>';
						for($i=1;$i<=30;$i++) {
							$nfecha = strtotime ( '+1 day', strtotime($nfecha)) ;
							$nfecha = date ('Y-m-d',$nfecha);
							echo '<option value="'.$nfecha.'">'.$nfecha.'</option>';
							$fecha=$nfecha;
						}						
					?>
				</select>
			</td>
			<td>
				<select id="horario" name="horario" style="width:305px;">
					<option value="">--- Elija Horario ---</option>
					<?php
						$hor = new Conectar();
						$hor->Conecta($host,$user,$pass,$db);
						$sqlhor="SELECT cod_horario.IdHorario, cod_horario.Horario FROM cod_horario";
						$hor->Consulta($sqlhor);
						while($rshor=$hor->Resultado()){
							echo'<option value="'.$rshor['IdHorario'].'">'.$rshor['Horario'].'</option>';
						}
					?>
				</select>
			</td>
		</tr>
		<tr id="nguia" name="nguia">
			<td><label><b>No. Guia: </b></label></td>			
			<td colspan="3">
				<input type="text" id="nrguia" name="nrguia" style="width:250px;">
			</td>
		</tr>
	</table>
	</div>
	<br>
	<table width="100%">
		<tr><td><img src="images/close.png" id="close" name="close"></td><td><img src="images/ok.png" id="send" name="send" style="float:right;"></td></tr>
	</table>
</form>
</div>	
</div>
<script>
	
	$('input:image').bind('click',function(){
		var tipo = $(this).attr('alt')
		$("#fagenda").hide();
		$("#nguia").hide();
		$("#detresultado").hide();
		$("#historico").hide();
		$("#dethistorico").html("");
		$("#detresultado").html("");
		$('#observ').val("Observaciones...")
		if(tipo=='Registrar Llamada'){
			var arreglo = $(this).val().split('|');
			var orden = arreglo[0]
			var fecha = arreglo[1]
			var valor = arreglo[2]
			var cliente = arreglo[3]
			var email = arreglo[4]
			var tel1 = arreglo[5]
			var tel2 = arreglo[6]
			var dias = arreglo[7]
			var direccion = arreglo[8]
			var complemento = arreglo[9]
			var ciudad = arreglo[10]			
			
  			$('#norden').val(orden)
  			$('#forden').val(fecha)
  			$('#vorden').val(valor)
  			$('#ncliente').val(cliente)
  			$('#ecliente').val(email)
  			$('#tel1').val(tel1)
  			$('#tel2').val(tel2)
  			$('#dias').val(dias)
  			$('#dir').val(direccion)
  			$('#comdir').val(complemento)
  			$('#ncity').val(ciudad)
  			
  			$.ajax({
  				type: "post",
  				url: "tipificador/clt_ordenes_cod.php",
  				data: {'orden':orden},
  				success: function (response){
  					var json = $.parseJSON(response);									
					var table='<table id="tproducts" name="tproducts" class="ordenes" ><thead><tr><th>Ver en Dafiti</th><th>C&oacute;digo Cup&oacute;n</th><th>Nombre Producto</th><th>sku</th><th>Marca</th><th>Precio Unitario</th><th>Precio Pagado</th></tr></thead><tbody>';
					var i=0;									
					$.each(json,function(){
						table+='<tr><td><a href="'+this.link+'" target="_blank">Ver Producto en Dafiti</a></td><td>'+this.coupon_code+'</td><td>'+this.name+'</td><td>'+this.sku+'</td><td>'+this.Brand+'</td><td>'+this.unit_price+'</td><td>'+this.paid_price+'</td></tr>';
						i+=1;
					})
					table+='</tbody></table>';
					$("#detresultado").html(table);					
					if(i>0){
						$("#detresultado").html(table);
						$("#detresultado").show("slow");
					}else{
						$("#detresultado").show("slow");
						$("#detresultado").html('<p>No Hay Productos Asociados</p>');
					}
  				}
  			})
  			
  			$.ajax({
  				type: "post",
  				url: "tipificador/clt_historico_cod.php",
  				data: {'orden':orden},
  				success: function (response){
  					var json = $.parseJSON(response);									
					var table='<table id="thist" name="thist" class="ordenes" ><thead><tr><th>Fecha Llamada</th><th>Contacto</th><th>Efectividad</th><th>Detalle</th><th>Agenda</th><th>Horario</th><th>Observacion</th><th>Usuario</th</tr></thead><tbody>';
					var i=0;									
					$.each(json,function(){
						table+='<tr><td>'+this.Fecha+'</td><td>'+this.Contacto+'</td><td>'+this.Efectividad+'</td><td>'+this.Detalle+'</td><td>'+this.Agenda+'</td><td>'+this.Horario+'</td><td>'+this.Observacion+'</td><td>'+this.Usuario+'</td></tr>';
						i+=1;
					})
					table+='</tbody></table>';					
					if(i>0){
						$('#historico').show("slow");
						$("#dethistorico").html(table);
						$("#dethistorico").show("slow");
					}
  				}
  			})			  			
  			$("#gestion").dialog({      		
      		height: 610,
      		width: 1000
    		});
		}
 	})

	$(document).ready(function(){
		$('#gestion').hide();
	})	
	
	$('#close').click(function(){
		$('#gestion').dialog('close');
		$("#fagenda").hide();
		$("#nguia").hide();
		$("#detresultado").hide();
		$("#detresultado").html("");
		$('#observ').val("Observaciones...");
		$('#sefect').children().remove();
		$('#sdet').children().remove();
		$('#sefect').append('<option value="">--- Elija Efectividad ---</option>');
		$('#sdet').append('<option value="">--- Elija Detalle ---</option>');
		$('#scontact').val('--- Tipo de Contacto ---');
	})	
	
	/*$('#prueba').click(function(e) {
    $('#gestion').lightbox_me({
        centered: true//, 
        onLoad: function() { 
            $('#sign_up').find('input:first').focus()
            }
        });
    e.preventDefault();
	});	*/
	
	$('#tcod').dataTable({
		"oLanguage": {
			"sLengthMenu": "Mostrar _MENU_ registros",
			"sZeroRecords": "Nose han encontrado registros",
			"sInfo": "Mostrando _START_ a _END_ de _TOTAL_ registros",
			"sInfoEmpty": "mostranto 0 a 0 de 0 registros",
			"sInfoFiltered": "(Filtrado de _MAX_ registros totales)",
			"sSearch": "Filtrar: ",
			'oPaginate': {
        			'sFirst':    "Primero",
        			'sPrevious': "Anterior",
        			'sNext':     "Siguiente",
        			'sLast':     "Ultimo"
    		}
		}
	});
	
	$('#scontact').change(function(){
		var op= $(this).val();
		$('#fagenda').val("");
		$('#horario').val("");
		$('#sefect').children().remove();
		$('#sdet').children().remove();
		$('#sefect').append('<option value="">--- Elija Efectividad ---</option>');
		$('#sdet').append('<option value="">--- Elija Detalle ---</option>');
			$.ajax({
				type: "GET",
				url: "tipificacionCOD.xml",
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
	
	$('#sefect').change(function(){
		var op= $(this).val();
		$('#sdet').children().remove();
		$('#fagenda').val("");
		$('#horario').val("");
		$('#sdet').append('<option value="">--- Elija Detalle ---</option>');
			$.ajax({
				type: "GET",
				url: "tipificacionCOD.xml",
				dataType: "xml",
				success: function(xml) {
				$(xml).find('efectividad').each(function(){									
					var ide = $(this).attr('id');									
					if(ide==op){
						$(this).find('detalle').each(function(){
							$('#sdet').append('<option value="'+$(this).attr('id')+'">'+$(this).attr('nombre')+'</option>');
						})															
					}	
				})
				}
			})
	})
	
	$(document).ready(function(){
		$('#observ').focus(function(){
			$(this).val("")
		})
	})	
	
	$('#sdet').change(function(){
		var val = $(this).val()
		if((val==1)||(val==17)){
			$('#fagenda').val("");
			$('#horario').val("");
			$('#fagenda').show("slow");
			$('#nguia').show("slow");
		}else{
			$('#fagenda').val("");
			$('#horario').val("");
			$('#nguia').val("");
			$('#fagenda').hide("slow");
			$('#nguia').hide("slow");
		}
	})
	
	$('#send').click(function(){
		var orden=$('#norden').val()
		var contacto=$('#scontact').val()
		var efectividad=$('#sefect').val()
		var detalle=$('#sdet').val()
		var agenda=$('#fagenda').find(':selected').val()
		var horario=$('#horario').find(':selected').val()
		var observacion=$('#observ').val()			
		var direccion=$('#dir').val()
		var complemento=$('#comdir').val()
		var guia =$('#nrguia').val()
		var ciudad =$('#ncity').val()
		
		if ((contacto=="") || (efectividad=="") || (detalle=="") || (observacion=="Observaciones...") || (observacion=="")){
			alert('Debe Tipificar Correctamente la Llamada')
			if(observacion=="Observaciones..."){
				alert('Las Observaciones Registradas no son Validas')
			}
		}else{
			$.ajax({
				type:"post",
				url: "tipificador/registrar_cod.php",
				data:{
					"orden":orden,
					"contacto":contacto,
					"efectividad":efectividad,
					"detalle":detalle,
					"agenda":agenda,
					"horario":horario,
					"observacion":observacion,
					"direccion":direccion,
					"complemento":complemento,
					"guia": guia,
					"ciudad": ciudad					
				},
				success: function(response){
					alert(response)
					$('#gestion').dialog('close');
					$("#fagenda").hide();
					$("#detresultado").hide();
					$("#detresultado").html("");
					$('#observ').val("Observaciones...");
					$('#sefect').children().remove();
					$('#sdet').children().remove();
					$('#sefect').append('<option value="">--- Elija Efectividad ---</option>');
					$('#sdet').append('<option value="">--- Elija Detalle ---</option>');
					$('#scontact').val('--- Tipo de Contacto ---');
					window.location = "../inicio.php?location=cod"
				}	
			})
		}		
	})
	
</script>