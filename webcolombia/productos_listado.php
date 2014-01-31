<?php
    $tipo=$_GET['seguimiento'];
    $accion=$_GET['accion'];
    $idmarca=0;
    $idgrupo=0;
    $criterio='';
    if($accion=='marca'){
        $idmarca=$_GET['idmarca'];    
    }
    
    if($accion=='grupo'){
        $idgrupo=$_GET['idgrupo'];    
    }
    
    if($accion=='busc'){
        $criterio=$_GET['criterio'];    
    }
?>
<div>
    <?php
        echo '<input id="uso" type="hidden" value="'.$tipo.'" />';
        echo '<input id="accion" type="hidden" value="'.$accion.'" />';
        echo '<input id="marca" type="hidden" value="'.$idmarca.'" />';
        echo '<input id="grupo" type="hidden" value="'.$idgrupo.'" />';
        echo '<input id="criterio" type="hidden" value="'.$criterio.'" />';
    ?>
    <div class="titulo-fichas">
        <table class="contenido">
            <tr>
                <td><img id="imagen-area" src="" /></td>
                <td><div id="titulo-area"></div></td>
            </tr>
        </table>
    </div>
    <br />
    <div class="contenedor-fichas">
        <div id="lista-productos">
        </div>
    </div>
</div>
<script>
    $(document).ready(function(){
        $('#lista-productos').html("");
        var tipo=$('#uso').val();
        var accion=$('#accion').val();
        var marca=$('#marca').val();
        var grupo=$('#grupo').val();
        var criterio=$('#criterio').val();
        
        switch(tipo){
            case "1":
                $('#imagen-area').attr('src','images/productos/pieza-30.png');
                $('#titulo-area').html('<span>EQUIPOS</span> / INSUMOS');
                break;
            case "2":
                $('#imagen-area').attr('src','images/productos/pieza-34.png');
                $('#titulo-area').html('<span>INSUMOS</span> / EQUIPOS');
                break;
            case "3":
                $('#imagen-area').attr('src','images/productos/pieza-32.png');
                $('#titulo-area').html('<span>INSUMOS</span> / MEDICAMENTOS');
                break;
            case "4":
                $.ajax({
                    type:"post",
                    url:"webcolombia/ajaxmarcas.php",
                    data:{
                        "marca":marca
                    },
                    success:function(response){
                        $('#imagen-area').attr('src',response);      
                    }
                    
                })
                $('#titulo-area').html('<span>INSUMOS</span> / MEDICAMENTOS / EQUIPOS');
                break;
            case "5":
                $('#imagen-area').attr('src','images/productos/pieza-29.png');
                $('#titulo-area').html('<span>INSUMOS</span> / MEDICAMENTOS / EQUIPOS');
                break;
            case "6":
                $('#imagen-area').attr('src','images/productos/pieza-33.png');
                $('#titulo-area').html('<span>INSUMOS</span> / MEDICAMENTOS / EQUIPOS');
                break;
        }
        
        
        $.ajax({
            type:"post",
            url:"webcolombia/ajaxproductos.php",
            data:{
                "accion":accion,
                "tipo":tipo,
                "marca":marca,
                "grupo":grupo,
                "criterio":criterio
            },
            success:function(response){
                var json = $.parseJSON(response);
                $('#lista-productos').append('<ul id="contenido-lista"></ul>');
                $.each(json,function(){
                    $('#contenido-lista').append('<table class="tabla-equipos"><tr><td><image src="images/pdf.gif" /></td><td><div><a href="'+this.manual+'" target="_blank">'+this.NombreProducto+'</a></div></td><td><a href="'+this.manual+'" target="_blank">Ver Documento</a></td></tr></table>');
                })
            }
            
        })
    })
</script>