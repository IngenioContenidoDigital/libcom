<div>
<div class="fondo-productos">
    <table class="contenido">
        <tr>
            <td>
                <div class="titulo-present-productos">X DEPARTAMENTOS</div>
            </td>
            <td></td>
        </tr>
    </table>
    <br />
    <div id="contenedor-clinica">
        <img src="images/productos/pieza-38.png" usemap="#map"/>
    </div>
</div>
</div>
<map name="map">
    <area shape="rect" coords="511, 382, 578, 421" href="#" alt="Farmacia-14"/>
    <area shape="rect" coords="331, 374, 452, 420" href="#" alt="Urgencias-26"/>
    
    <area shape="rect" coords="248, 336, 302, 356" href="#" alt="Centro Mezclas-25"/>
    <area shape="rect" coords="312, 336, 372, 358" href="#" alt="Cardiolog&oacute;a-5"/>
    <area shape="rect" coords="382, 335, 461, 357" href="#" alt="Enfermeria-7"/>
    <area shape="rect" coords="469, 336, 527, 357" href="#" alt="Im&aacute;genes-22"/>
    <area shape="rect" coords="537, 335, 598, 358" href="#" alt="Ingenier&iacute;a-44"/>
    <area shape="rect" coords="608, 335, 661, 363" href="#" alt="Direccion Medica-49"/>
    
    <area shape="rect" coords="611, 303, 663, 327" href="#" alt="Quimico farmaceutico-48"/>
    <area shape="rect" coords="536, 303, 601, 330" href="#" alt="Lavander&iacute;a-9"/>
    <area shape="rect" coords="468, 303, 529, 330" href="#" alt="Anestesiolog&iacute;a-36"/>
    <area shape="rect" coords="380, 302, 459, 329" href="#" alt="Dir. Cientifica-28"/>
    <area shape="rect" coords="310, 302, 373, 329" href="#" alt="Coord. Enfermer&iacute;a-41"/>
    <area shape="rect" coords="244, 301, 303, 328" href="#" alt="Urolog&iacute;a-6"/>
    
    <area shape="rect" coords="244, 268, 302, 294" href="#" alt="Traumatolog&iacute;a-16"/>
    <area shape="rect" coords="311, 269, 372, 294" href="#" alt="Ortopedia-40"/>
    <area shape="rect" coords="379, 271, 457, 295" href="#" alt="Laboratorio-23"/>
    <area shape="rect" coords="466, 271, 527, 295" href="#" alt="Odontolog&iacute;a-42"/>
    <area shape="rect" coords="536, 271, 603, 297" href="#" alt="Control Infecciones-20"/>
    <area shape="rect" coords="613, 269, 664, 297" href="#" alt="Neurolog&iacute;a-24"/>
    
    <area shape="rect" coords="612, 237, 664, 262" href="#" alt="Neurocirug&iacute;a-47"/>
    <area shape="rect" coords="536, 237, 605, 265" href="#" alt="Psiquiatria-43"/>
    <area shape="rect" coords="467, 237, 527, 263" href="#" alt="Materno-8"/>
    <area shape="rect" coords="382, 235, 459, 264" href="#" alt="Salud Ocupacional-33"/>
    <area shape="rect" coords="311, 235, 371, 263" href="#" alt="Consulta Externa-37"/>
    <area shape="rect" coords="246, 233, 301, 260" href="#" alt="Psicolog&iacute;a-10"/>
    
    <area shape="rect" coords="248, 201, 305, 227" href="#" alt="Gastroenterolog&iacute;a-18"/>
    <area shape="rect" coords="316, 203, 372, 226" href="#" alt="Esterilizaci&oacute;n-15"/>
    <area shape="rect" coords="385, 202, 455, 226" href="#" alt="Terapia Respiratoria-13"/>
    <area shape="rect" coords="468, 203, 524, 228" href="#" alt="Hemodinamia-17"/>
    <area shape="rect" coords="536, 203, 605, 226" href="#" alt="Hospitalizaci&oacute;n-12"/>
    <area shape="rect" coords="614, 204, 663, 228" href="#" alt="Ginecolog&iacute;a-46"/>
    
    <area shape="rect" coords="612, 170, 662, 194" href="#" alt="Coordinacion M&eacute;dica-45"/>
    <area shape="rect" coords="538, 170, 605, 195" href="#" alt="Cuidados Intermedios-11"/>
    <area shape="rect" coords="469, 171, 529, 197" href="#" alt="Cirugia-1"/>
    <area shape="rect" coords="387, 169, 459, 195" href="#" alt="UCI Pediatrico-4"/>
    <area shape="rect" coords="315, 168, 377, 193" href="#" alt="UCI Neonatal-3"/>
    <area shape="rect" coords="248, 166, 306, 193" href="#" alt="UCI Adultos-2"/>
    
    <area shape="rect" coords="30, 385, 97, 405" href="#" alt="Tesoreria-39"/>
    <area shape="rect" coords="30, 358, 99, 380" href="#" alt="Mantenimiento-21"/>
    <area shape="rect" coords="30, 331, 99, 353" href="#" alt="Casino-19"/>
    <area shape="rect" coords="29, 305, 98, 328" href="#" alt="Cartera-31"/>
    <area shape="rect" coords="30, 279, 97, 300" href="#" alt="Compras-34"/>
    <area shape="rect" coords="29, 253, 96, 275" href="#" alt="Almac&eacute;n-35"/>
    <area shape="rect" coords="27, 226, 94, 248" href="#" alt="Arquitectura-32"/>
    <area shape="rect" coords="26, 202, 96, 222" href="#" alt="Financiero-38"/>
    <area shape="rect" coords="27, 174, 94, 197" href="#" alt="Dir. Administrativo-30"/>
    <area shape="rect" coords="27, 144, 95, 169" href="#" alt="Gerencia-27" />
</map>

<script>
    $('area').click(function(){
        var valor=$(this).attr('alt')
        var idgrupo = valor.split('-');
        window.location="colombia.php?location=productos-ins&seguimiento=5&accion=grupo&idgrupo="+idgrupo[1]
    })
</script>