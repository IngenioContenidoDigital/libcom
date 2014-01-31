<?php
    session_start();
    error_reporting(0);
    $location=$_GET['location']; if (empty($location)) { $location='inicio'; }
    include('funciones/funciones.php');
    include('classes/Conectar.php');    
?>
<!DOCTYPE html>
<html lang="es">
    <head>
        <meta http-equiv="content-type" content="text/html; charset=ISO-8859-1" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge; chrome=1" />
        <script type="text/javascript" src="scripts/jquery.js"></script>
        <script type="text/javascript" src="scripts/jquery.cookie.js"></script>
        
        <script type="text/javascript" src="scripts/jquery-ui/js/jquery-ui-1.10.0.custom.js"></script>
        <link type="text/css" href="scripts/jquery-ui/css/custom-theme/jquery-ui-1.10.0.custom.css" rel="stylesheet" />
        
	<script type="text/javascript" src="scripts/datatables/js/jquery.dataTables.js"></script>
        <script type="text/javascript" src="scripts/datatables/js/jquery.dataTables.columnFilter.js"></script>
        <link type="text/css" href="scripts/datatables/css/jquery.dataTables.css" rel="stylesheet" />
        
        <script type="text/javascript" src="scripts/bxslider/jquery.bxslider.js"></script>
        <link type="text/css" href="scripts/bxslider/jquery.bxslider.css" rel="stylesheet" />
        
        <script type="text/javascript" src="scripts/tigra/tcal.js"></script>
        <link type="text/css" href="scripts/tigra/tcal.css" rel="stylesheet" />
        
        <script>
            var pg=0;
        </script>
        
        <link type="text/css" href="styles/colombia.css" rel="stylesheet" />
        <title>Grupo Libcom</title>
    </head>
    <body>
        <div id="pagina">
            <div id="encabezado">
                    <table>
                        <tr>
                            <td rowspan="2"><a href="index.php"><div id="logo"><img src="images/logolibcom_co.png" /></div></a></td>
                        </tr>   
                        <tr>
                            <td>
                            <?php
                            	if(!isset($_SESSION['usuario'])){
                            ?>
                            <div class="form-ingreso">
                                <form class="ingreso">
                                    <table class="contenido">
                                        <tr>
                                            <td rowspan="2"><img src="images/persona.png"/></td>
                                            <td><div class="usuarios">Usuario</div></td>
                                            <td rowspan="2"><img src="images/candado.png"/></td>
                                            <td><div class="usuarios">Contrase&ntilde;a</div></td>
                                        </tr>
                                        <tr>
                                            <td><input type="text" id="usuario"/></td>
                                            <td><input type="password" id="clave"/></td>
                                        </tr>
                                        <tr>
                                            <td colspan="4">
                                                <div id="ingreso">Ingresar a mi Cuenta</div>
                                            </td>
                                        </tr>
                                    </table>
                                </form>
                            </div>
                            <?php		
                            	}else{
                                    echo '
                                    <div class="form-ingreso">
                                                    <form class="ingreso">
                                                    <table class="contenido">
                                                        <tr>
                                                <td><img src="images/persona.png"/></td>
                                                <td>'.$_SESSION['usuario'].'</td>
                                                <td><img src="images/candado.png"/></td>
                                                <td><a id="desconectar" href="salir.php">Cerrar Sesion</a></td>
                                          </tr>
                                            </table>
                                            </form>
                                     </div>';
                            	}
                            ?>
                            </td>
                        </tr>
                    </table>
                    <?php
                        if (isset($_SESSION['usuario'])){
                    ?>
                        <div class="crm_options">
                            <ul>
                                <li><a href="colombia.php?location=ncliente">Registro Instituciones</a></li>                                    
                                <li><a href="colombia.php?location=clcliente">Consulta Instituciones</a></li>
                                <li><a href="colombia.php?location=crm&seguimiento=XGN">Consulta General</a></li>
                                <?php
                                if($_SESSION['privilegio']=="Administrador"){
                                    echo '<li style="width: 300px; float: right; text-align: right;"><a href="colombia.php?location=adm-eventos">Administrar Galerias</a></li>';
                                }
                                ?>
                            </ul>
                        </div>
                    <?php
                        }
                    ?>
            </div>
            <div id="cuerpo">
            <?php                  
                changelocation($location);
                changelocation2($location);
            ?>
            </div>
            <?php
                if(!isset($_SESSION['usuario'])){
            ?>
            <div id="pie-pagina">
                <div>
                    <table class="contenido">
                        <tr>
                            <td>
                                <div class="bt-nav">
                                    <div id="last-page"><img src="images/inicio/pieza-20.png" /></div>
                                    <div class="titulo-menu">Anterior</div>
                                </div>
                            </td>
                            <td>
                                <div class="menu-inferior">
                                    <table class="contenido">
                                        <tr>
                                            <td>
                                                <div class="imagen-menu-inferior"><a href="colombia.php?location=productos"><img src="images/inicio/pieza-57-1.png" /></a></div>
                                            </td>
                                            <td>
                                                <div class="imagen-menu-inferior"><a href="colombia.php?location=present"><img src="images/inicio/pieza-58-1.png" /></a></div>
                                            </td>
                                            <td>
                                                <div class="imagen-menu-inferior"><a href="colombia.php?location=video"><img src="images/inicio/pieza-61-1.png" /></a></div>
                                            </td>
                                            <td>
                                                <div class="imagen-menu-inferior"><a href="colombia.php?location=nosotros"><img src="images/inicio/pieza-60-1.png" /></a></div>
                                            </td>
                                            <td>
                                                <div class="imagen-menu-inferior"><a href="colombia.php?location=eventos"><img src="images/inicio/pieza-59-1.png" /></a></div>
                                            </td>
                                            <td>
                                                <div class="imagen-menu-inferior" style="padding-left: 10px;"><a href="colombia.php?location=contacto"><img src="images/inicio/pieza-62-1.png" /></a></div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <div class="texto-menu-inferior">Productos</div>
                                            </td>
                                            <td>
                                                <div class="texto-menu-inferior">Presentaciones</div>
                                            </td>
                                            <td>
                                                <div class="texto-menu-inferior">Videos</div>
                                            </td>
                                            <td>                                        
                                                <div class="texto-menu-inferior">Equipo de Trabajo</div>
                                            </td>
                                            <td>                                        
                                                <div class="texto-menu-inferior">Eventos</div>
                                            </td>
                                            <td>
                                                <div class="texto-menu-inferior">Contactenos</div>
                                            </td>
                                        </tr>
                                    </table>
                                </div>
                            </td>
                            <td>
                                <div class="bt-nav">
                                    <div id="next-page"><img src="images/inicio/pieza-19.png" /></div>
                                    <div class="titulo-menu">Siguiente</div>
                                </div>
                            </td>
                        </tr>
                    </table>
                </div>
            </div>
            <?php
                }
            ?>
        </div>
        <script> 
            $('#last-page').click(function(){
                //window.location=document.referrer
                pg-=1;
                history.go(pg)
            })
            
            $('#next-page').click(function(){
                //window.location=document.referrer
                pg+=1;
                history.go(pg)
            })
        
            $('#ingreso').hover(function(){
                $(this).css('cursor', 'pointer');
            })
            
            $('#ingreso').click(function(){
                var user = $('#usuario').val();
                var pass = $('#clave').val();
                var ingreso=0;
                $.ajax({
                    type:"post",
                    url: "iniciar.php",
                    data: {
                        'user': user,
                        'pass': pass
                    },
                    success: function(response){
                        if(response==1){
                            
                            $.ajax({
                                type:"post",
                                url: "crm/ajaxagenda.php",
                                data: {
                                    'user': user
                                },
                                success: function(response){
                                    $('.pie-pagina').fadeOut("slow");
                                    window.location="colombia.php?location=clcliente";
                                    //window.location="colombia.php?location=inicio";
                                }
                            });
                        }else{
                            alert('No se pudo Iniciar su Sesion, Verifique los Valores e Intente de nuevo')
                        }
                    }
                });  
            })
            
            $('#desconectar').click(function(){
                var user = $('#usuario').val();
                            
                $.ajax({
                    type:"post",
                    url: "crm/ajaxagenda.php",
                    data: {
                        'user': user
                    },
                    success: function(response){
                        window.location="colombia.php";
                        //window.location="colombia.php?location=inicio";
                    }
                });
                        
                $.ajax({
                    type:"post",
                    url: "salir.php",
                    success: function(response){
                        if(response==0){
                            window.location="colombia.php?location=inicio";
                        }
                    }
                });
            })
        </script>
    </body>
</html>