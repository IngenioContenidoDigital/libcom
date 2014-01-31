<div>
        <div class="titulo-present-eventos">EVENTOS</div>
        <div class="titulo-galerias">
            <div class="titulo-noticias">Noticias del Dia en Twitter</div>
            <div class="titulo-evento"><div id="n-evento">Meditech 2012</div></div>
        </div>
                
        <div class="back-eventos">
                <div class="bxslider">
                    <div><img src="webcolombia/eventos/meditech 2012/1.jpg" /></div>
                    <div><img src="webcolombia/eventos/meditech 2012/2.jpg" /></div>
                    <div><img src="webcolombia/eventos/meditech 2012/3.jpg" /></div>
                    <div><img src="webcolombia/eventos/meditech 2012/4.jpg" /></div>
                    <div><img src="webcolombia/eventos/meditech 2012/5.jpg" /></div>
                    <div><img src="webcolombia/eventos/meditech 2012/6.jpg" /></div>
                    <div><img src="webcolombia/eventos/meditech 2012/7.jpg" /></div>
                    <div><img src="webcolombia/eventos/meditech 2012/8.jpg" /></div>
                    <div><img src="webcolombia/eventos/meditech 2012/9.jpg" /></div>
                    <div><img src="webcolombia/eventos/meditech 2012/10.jpg" /></div>
                    <div><img src="webcolombia/eventos/meditech 2012/11.jpg" /></div>
                    <div><img src="webcolombia/eventos/meditech 2012/12.jpg" /></div>
                    <div><img src="webcolombia/eventos/meditech 2012/13.jpg" /></div>
                    <div><img src="webcolombia/eventos/meditech 2012/14.jpg" /></div>
                    <div><img src="webcolombia/eventos/meditech 2012/15.jpg" /></div>
                    <div><img src="webcolombia/eventos/meditech 2012/16.jpg" /></div>
                </div>
                <div class="contenedor-navegacion">
            		<table class="contenido">
            			<tr>
                            <td><div id="anterior"><img src="images/eventos/pieza-52.png"/></div></td>
                            <td><div class="texto-navegacion">Anterior</div></td>
                            <td><div id="separador"><img src="images/eventos/pieza-56.png"/></div></td>
                            <td><div class="texto-navegacion">Siguiente</div></td>
                            <td><div id="siguiente"><img src="images/eventos/pieza-53.png"/></div></td>
            			</tr>
            		</table>
            	</div>
        </div>        
        <div class="titulo-galerias-2">
            <div class="titulo-tweets">Tweets</div>
            <div class="boton-seguir"><a href="https://twitter.com/Grupolibcom" target="_blank"><img src="images/pieza-49.png"/></a></div>    
        </div>
    	<div class="titulo-galerias-2">
            <div class="contenedor-noticias">
            <div id="noticias">
                <img src="images/eventos/pieza-55.png" />
                <div id="tweet1" class="tweet"></div>
                <img src="images/eventos/pieza-55.png" />
           	</div>
            </div>
        </div>
        <div class="titulo-galerias-2">
            <div id="galerias">Galerias</div>
        	<div class="lista-galerias">
            	<table>
            		<tr id="tubnails">
                        <td><div class="contenedor-galeria"><img src="webcolombia/eventos/meditech 2012/1.jpg" /><div>MEDITECH 2012</div></div></td>
                        <td><div class="contenedor-galeria"><div></div></div></td>
                        <td><div class="contenedor-galeria"><div></div></div></td>
                    </tr>
            	</table>
        	</div>
        </div>
        <br />
        <br />
</div>
<script>
	$(document).ready(function(){
            $.getJSON("https://api.twitter.com/1/statuses/user_timeline/Grupolibcom.json?count=2&include_rts=1&callback=?", function(data) {
                //var texto="<table><tr><td rowspan=\"2\"><img src=\"images/pieza-54.png\" /></td><td><div>Grupolibcom <span>@Grupolibcom</span></div></td><tr><td><div>"+data[1].text+"</div></td></tr></table>";
                var texto1="<table><tr><td rowspan=\"2\"><img src=\"images/pieza-54.png\" /></td><td><div>Grupolibcom <span>@Grupolibcom</span></div></td><tr><td><div>"+data[0].text+"</div></td></tr></table>";
                $("#tweet1").html(texto1);
                //$("#tweet2").html(texto);
            })
            
        });
   
        $(function(){
  		var slider = $('.bxslider').bxSlider({
    		controls: false,
    		pager:false
  		});

  		$('#anterior').click(function(){
                        var total=slider.getSlideCount()
                        var slideNr = slider.getCurrentSlide() - 1;

 			if(slideNr<0){
 				slider.goToSlide(total-1);
 			}else{
 				slider.goToSlide(slideNr);	
 			}
                    //slider.goToPreviousSlide();
 
                });
 
                $('#siguiente').click(function(){
                        var total=slider.getSlideCount()
                        var slideNr = slider.getCurrentSlide() + 1;

                        if(slideNr>=total){
                                slider.goToSlide(0);
                        }else{
                                slider.goToSlide(slideNr);	
                        }        	 
                });
        });

</script>