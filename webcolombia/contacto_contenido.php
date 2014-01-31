<div>
    <div class="tit-contacto">CONTACTO</div>
    <table class="contenido">
        <tr>
            <td rowspan="5"><div class="lctito"><img src="images/contacto/pieza-40.png" /></div></td>
            <td><div class="titcontacto">Nombre</div></td>
            <td colspan="3"><input type="text" id="nombre" class="inputcontacto-largo"/></td>
        </tr>
        <tr>
            <td><div class="titcontacto">Compa&ntilde;ia</div></td>
            <td colspan="3"><input type="text" id="compania" class="inputcontacto-largo"/></td>
        </tr>
        <tr>
            <td><div class="titcontacto">Tel&eacute;fono</div></td>
            <td><input type="text" id="telefono" class="inputcontacto"/></td>
            <td><div class="titcontacto">Pa&iacute;s</div></td>
            <td><input type="text" id="pais" class="inputcontacto"/></td>
        </tr>
        <tr>
            <td><div class="titcontacto">email</div></td>
            <td colspan="3"><input type="text" id="correo" class="inputcontacto-largo"/></td>
        </tr>            
        <tr>
            <td colspan="4">
                <div class="textomensaje">
                    <textarea id="textomensaje"></textarea>
                </div>
            </td>
        </tr>
        <tr>
            <td>
                <div class="sociales">
                <table class="contenido">
                    <tr>
                        <td colspan="3"><div>Siguenos en</div></td>
                    </tr>
                    <tr>
                        <td><div class="sociales-img"><a href="http://www.twitter.com/grupolibcom" target="_blank"><img src="images/contacto/pieza-41.png" /></a></div></td>
                        <td><div class="sociales-img"><a href="#"><img src="images/contacto/pieza-42.png" /></a></div></td>
                        <td><div class="sociales-img"><a href="https://www.facebook.com/libcomdecolombia" target="_blank"><img src="images/contacto/pieza-43.png" /></a></div></td>
                    </tr>
                </table>
                </div>
            </td>
            <td colspan="4">
                <div class="envio-contacto">
                    <table>
                        <tr>
                            <td><a href="#" id="borracorreo">Borrar</a></td>
                            <td><a href="#" id="enviacorreo">Enviar</a></td>
                        </tr>
                    </table>
                </div>
            </td>
        </tr>
    </table>
    <div class="direcciones">
        <table>
            <tr>
                <td><div style="font-weight: bold;">Espa&ntilde;a</div></td>
                <td><div style="font-weight: bold;">Colombia</div></td>
                <td><div style="font-weight: bold;">Venezuela</div></td>
            </tr>
            <tr>
                <td><div>C/Chile 10, Of. 247-248</div></td>
                <td><div>Carrera 11A # 97A-19Of. 606</div></td>
                <td><div>Av. San Felipe entre 1 y 2 Transversal. La Castellana, Caracas, Edo Miranda,</div></td>
            </tr>
            <tr>
                <td><div>28290 Las Rozas, Madrid, España</div></td>
                <td><div>Edificio IQ Bogot&aacute;, Colombia</div></td>
                <td><div>Rep&uacute;blica Bolivariana de Venezuela</div></td>
            </tr>
            <tr>
                <td><div>Tel: +34 916376148</div></td>
                <td><div>Tel: +57 1 6012013</div></td>
                <td><div>Tel: +58 02122125111</div></td>
            </tr>
        </table>
    </div>
</div>

<script>
	$('#enviacorreo').click(function(){
		var nombre = $('#nombre').val().toUpperCase();
		var compania = $('#compania').val().toUpperCase();
		var mensaje = $('#textomensaje').val().toUpperCase();
		var telefono = $('#telefono').val();
		var correo = $('#correo').val().toLowerCase();
        var pais = $('#pais').val().toUpperCase();
		$.ajax({
			type:"post",
			url: "webcolombia/contacto_mensaje.php",
			data: {
				'nombre': nombre,
				'compania': compania,
				'mensaje': mensaje,
				'telefono': telefono,
				'correo': correo,
                'pais':pais
			},
			success: function(response){
				alert(response);
				$('#nombre').val("");
				$('#compania').val("");
				$('#textomensaje').val("");
				$('#telefono').val("");
				$('#correo').val("");																	
                $('#pais').val("");
			} 
		})
	})
    
     $(document).ready(function() {
            var psconsole = $('#textomensaje');
            psconsole.scrollTop(
                psconsole[0].scrollHeight - psconsole.height()
            );
     });
    
    $('#borracorreo').click(function(){
		$('#nombre').val("");
		$('#compania').val("");
		$('#textomensaje').val("");
		$('#telefono').val("");
		$('#correo').val("");																	
        $('#pais').val("");
	})
    
</script>