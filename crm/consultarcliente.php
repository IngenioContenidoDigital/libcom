<?php	
	include 'classes/hosts.php';
        include 'classes/usuarios.php';
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
	
        /*$usr = new Usuario();
        $permiso=$usr->Privilegios($privilegio, 'EliminarCliente');*/
?>
<div>
<div align="left">
	<table>
		<tr>
            <td><h3 class="modulo">Consulta Instituciones</h3></td><td><img src="images/crm/doctor.png" alt="Listado de Clientes" /></td>
            <td>
                <table class="filtro">
                    <tr>
                        <td><p id="filtro_nit" class="filtro-crm"></p></td>
                        <td><p id="filtro_inst" class="filtro-crm"></p></td>
                        <td><p id="filtro_dep" class="filtro-crm"></p></td>
                        <td><p id="filtro_ciu" class="filtro-crm"></p></td>
                    </tr>
                </table>
            </td>
        </tr>
	</table>			
</div>

<div id="listadoclientes">
<p id="filtro_dv"></p>
<p id="filtro_op"></p>

<table id="tbclientes">
	<thead>
		<tr>
                        <?php
                            if($privilegio=="Administrador"){
                                echo '<th>ELIMINAR</th>';
                            }
                        ?>    
			<th>NIT</th>
			<th>DV</th>
			<th>INSTITUCION</th>
			<th>DEPARTAMENTO</th>
			<th>CIUDAD</th>
         <th>VER</th>
         <th>REPORTE</th>
		</tr>
	</thead>
    <tfoot>
		<tr>
			<?php
                            if($privilegio=="Administrador"){
                                echo '<th>ELIMINAR</th>';
                            }
                        ?>
			<th>NIT</th>
			<th>DV</th>
			<th>INSTITUCION</th>
			<th>DEPARTAMENTO</th>
			<th>CIUDAD</th>
         <th>VER</th>
         <th>REPORTE</th>
		</tr>
	</tfoot>
	<tbody>
		<?php
			while($rscli=$cli->Resultado()) {
				echo '<tr>';
                                
                                    if($privilegio=="Administrador"){
                                        echo '<td><img src="images/elimina.png" alt="colombia.php?location=eliminains&seguimiento='.$rscli['IdCliente'].'"/></td>';
                                    }
                                
                                                                    
				echo '<td><a href="colombia.php?location=editains&seguimiento='.$rscli['IdCliente'].'">'.$rscli['IdCliente'].'</a></td>';
				echo '<td>'.$rscli['Digito'].'</td>';
				echo '<td>'.$rscli['Nombre'].'</td>';
				//echo '<td>'.$rscli['Direccion'].'</td>';		
				echo '<td>'.$rscli['Departamnto'].'</td>';
				echo '<td>'.$rscli['NombreUso'].'</td>';
                echo '<td><a href="colombia.php?location=crm&seguimiento='.$rscli['IdCliente'].'">Ver</a></td>';
                echo '<td><a href="colombia.php?location=report&seguimiento='.$rscli['IdCliente'].'">Reporte</a></td>';
				echo '</tr>';
			}
		?>
	</tbody>
</table>
</div>


</div>	
<script>	
	
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
				{ sSelector: "#filtro_op", type:"null" },				
				{ sSelector: "#filtro_nit" },
				{ sSelector: "#filtro_dv", type:"null" },
				{ sSelector: "#filtro_inst", type:"select", sSortDataType: "dom-text"},
				{ sSelector: "#filtro_dep", type:"select", sSortDataType: "dom-text"},
				{ sSelector: "#filtro_ciu", type:"select", sSortDataType: "dom-text"}
        ]}
    );
    
    $('img').click(function(){
        var dest=$(this).attr('alt')
        if((dest!=null) && (dest!='Listado de Clientes')){
            if(confirm("Va a Eliminar la Instituci&oacute;n. Seguro desea Continuar?")){
                window.location=dest
            }else{
                alert('Ha cancelado la acci&oacute;n, No se realizaron cambios')
            }
        }
    })
    		
</script> 