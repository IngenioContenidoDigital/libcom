<table class="contenido">
    <tr>
        <td colspan="2">
            <div class="buscador" id="buscador">
                <table class="contenido">
                    <tr>
                        <td rowspan="2">
                        	<div id="myGallery">
                        		<img src="images/galeria-1.jpg" width="630px" height="240px" class="active" />
                        		<img src="images/galeria-2.jpg" width="630px" height="240px" />
                        		<img src="images/galeria-3.jpg" width="630px" height="240px" />
                        	</div>
                        </td>
                        <td>
                            <div id="contenedorbusq">
                                <input type="text" id="search" class="minig" value="Ingresa una Palabra Clave"/>
                            </div>
                        </td>
                    </tr>
                </table>
            </div>
        </td>
    </tr>
</table>
<script>

	$(document).ready(function(){
      setInterval('swapImages()', 5000);
    });

    function swapImages(){
      var $active = $('#myGallery .active');
      var $next = ($('#myGallery .active').next().length > 0) ? $('#myGallery .active').next() : $('#myGallery img:first');
      $active.fadeOut(function(){
      $active.removeClass('active');
      $next.fadeIn().addClass('active');
      });
    }
    
  </script>