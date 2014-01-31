<?php	
	include 'classes/hosts.php';
	date_default_timezone_set('America/Bogota');	
	
	$usuario = $_SESSION['usuario'];	
        $perfil = $_SESSION['perfil'];
        $privilegio = $_SESSION['privilegio'];
        $cliente=$_GET['seguimiento'];

	$sqlclientes="SELECT * FROM vw_gestion WHERE vw_gestion.IdCliente=".$cliente;
	
	$cli = new Conectar();	
	$cli->Conecta($host,$user,$pass,$db);
	$clcli=$cli->Consulta($sqlclientes);		
	
?>
<div id="contenedor_crm">
<a href="colombia.php?location=clcliente"><img src="images/crm/back.png" /></a>
<div align="left">
	<table>
		<tr>
            <td><h2 class="modulo">Reporte de Gestion</h2></td><td><img src="images/crm/callcenter.png" alt="Reporte de Gestion" /></td>            
        </tr>
	</table>			
</div>
<div>
    <table class="filtro">
                    <tr>
                        <td><p id="filtro_area"></p></td>
                        <td><p id="filtro_cont"></p></td>
                        <td><p id="filtro_fecha"></p></td>
                    </tr>
                    <tr>
                        <td><p id="filtro_gest"></p></td>
                        <td><p id="filtro_efect"></p></td>
                        <td><p id="filtro_agen"></p></td>
                    </tr>
                    <tr>
                        <td><p id="filtro_user"></p></td>
                    </tr>
                </table>
                <p id="filtro_obs"></p>
                <p id="filtro_inst"></p>
</div>
<div id="listadoclientes">
<table id="tbclientes">
	<thead>
		<tr>
                    <th>INSTITUCION</th>
                    <th>AREA</th>
                    <th>CONTACTO</th>
                    <th>GESTION</th>
                    <th>EFECTIVIDAD</th>
                    <th>AGENDA</th>
                    <th>OBSERVACIONES</th>
                    <th>FECHA</th>
                    <th>USUARIO</th>
		</tr>
	</thead>
    <tfoot>
        <tr>
            <th>Institucion</th>
            <th>Area</th>
			<th>Contacto</th>
            <th>Gestion</th>
			<th>Efectividad</th>
			<th>Agenda</th>
			<th>Observaciones</th>
            <th>Fecha</th>
            <th>Usuario</th>
        </tr>
    </tfoot>
	<tbody>
		<?php
			while($rscli=$cli->Resultado()) {
				echo '<tr>';
				echo '<td>'.$rscli['Nombre'].'</td>';
				echo '<td>'.$rscli['Area'].'</td>';
				echo '<td>'.$rscli['NombreContacto'].'</td>';
				echo '<td>'.$rscli['Contacto'].'</td>';		
				echo '<td>'.$rscli['Efectividad'].'</td>';
				echo '<td>'.$rscli['Agenda'].'</td>';
                echo '<td>'.$rscli['Observaciones'].'</td>';		
				echo '<td>'.$rscli['fecha_gestion'].'</td>';
				echo '<td>'.$rscli['usuario'].'</td>';
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
                { sSelector: "#filtro_inst", type:"null"},
                { sSelector: "#filtro_area", type:"select"},
                { sSelector: "#filtro_cont", type:"select"},
                { sSelector: "#filtro_gest", type:"select"},
                { sSelector: "#filtro_efect", type:"select"},
                { sSelector: "#filtro_agen", type:"text"},
				{ sSelector: "#filtro_obs", type:"null"},
                { sSelector: "#filtro_fecha", type:"text"},
				{ sSelector: "#filtro_user", type:"select"}
        ]}
    );
    		
</script>