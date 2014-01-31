<div>
    <div class="titulo-equipo">PRODUCTOS</div>    
    <br />
    <br />
    <div class="contenido-equipo">
    <table class="contenido">
        <tr>
            <td><div>INSUMOS</div></td>
            <td><div><a href="colombia.php?location=productos-ins&seguimiento=2&accion=tipo" ><img src="images/productos/pieza-34.png" /></a></div></td>
            <td><div>DEPARTAMENTOS</div></td>
            <td><div><a href="colombia.php?location=productos-dpto" ><img src="images/productos/pieza-29.png" /></a></div></td>
        </tr>
        <tr>
            <td><div>EQUIPOS</div></td>
            <td><div><a href="colombia.php?location=productos-ins&seguimiento=1&accion=tipo" ><img src="images/productos/pieza-30.png" /></a></div></td>
            <td><div>MARCAS</div></td>
            <td><div><br /><a href="colombia.php?location=productos-brand" ><img src="images/productos/pieza-35.png" /></a></div></td>
        </tr>
        <tr>
            <td><div>MEDICAMENTOS</div></td>
            <td><div><a href="colombia.php?location=productos-ins&seguimiento=3&accion=tipo" ><img src="images/productos/pieza-32.png" /></a></div></td>
            <td><div>BUSCAR</div></td>
            <td><div><div><input type="text" id="find" /><img id="busc" src="images/productos/pieza-33.png" /></div></div></td>
        </tr>
        <tr>
            <td colspan="4"><div><a href="colombia.php?location=productos-ins&seguimiento=4&accion=marca&idmarca=6"><img src="images/productos/pieza-28.png" /></a></div></td>
        </tr>
    </table>
    </div>
</div>
<script>
       $('#busc').click(function(){
           var criterio=$('#find').val();
           window.location='colombia.php?location=productos-ins&seguimiento=6&accion=busc&criterio='+criterio;
           
       })
</script>